<?php

class Orders
{
    public $database;

    public function __construct()
    {
        try {
            // establish database connection
            $this->database = connectToDB();
        } catch ( PDOException $error ) {
            die("Database connection failed");
        }
    }

    public function createNewOrder( 
        $user_id, // find out who make the order
        $total_amount = 0, // find out what's the total amount
        $products_in_cart = [] // get the products in the order
    )
    {

        // step #1: insert a new order into database
        $statement = $this->database->prepare(
            'INSERT INTO orders (user_id, total_amount, transaction_id)
            VALUES (:user_id, :total_amount, :transaction_id)'
        );

        $statement->execute([
            'user_id' => $user_id,
            'total_amount' => $total_amount,
            'transaction_id' => ''
        ]);

        // step 2: retrieve order id using lastInsertId()
        // lastInserId() allows us to retrieve the id of the new order we just added above
        $order_id = $this->database->lastInsertId();

        // step 3: create orders_products bridge
        foreach( $products_in_cart as $product_id => $quantity ) 
        {
            // insert each product in cart as new row in the orders_products table
            $statement = $this->database->prepare(
                'INSERT INTO orders_products (order_id, product_id, quantity)
                VALUES (:order_id, :product_id, :quantity)'
            );

            $statement->execute([
                'order_id' => $order_id,
                'product_id' => $product_id,
                'quantity' => $quantity
            ]);

        }

        // step 4: create bill url
        $bill_url = '';

        // create a bill in billplz using API
            // whenever we call API, there will be some response data
        $response = callAPI(
            BILLPLZ_API_URL . 'v3/bills', // https://www.billplz-sandbox.com/api/v3/bills
            'POST',
            [
                'collection_id' => BILLPLZ_COLLECTION_ID,
                'email' => $_SESSION['user']['email'],
                'name' => $_SESSION['user']['email'],
                'amount' => $total_amount * 100,
                'callback_url' => 'http://simple-store.local/payment-callback',
                'description' => 'Order #' . $order_id, // Order #3,
                'redirect_url' => 'http://simple-store.local/payment-verification'
            ],
            [
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode( BILLPLZ_API_KEY . ':' )
            ]
        );

        // Step 5: if the response if successful, update the order with bill id ($response->id)
        if ( isset( $response->id ) ) {
            $statement = $this->database->prepare(
                'UPDATE orders SET transaction_id = :transaction_id
                WHERE id = :order_id'
            );
            $statement->execute([
                'transaction_id' => $response->id,
                'order_id' => $order_id
            ]);
        }

        // Step 6: set bill_url
        if ( isset( $response->url ) ) {
            $bill_url = $response->url;
        }

        return $bill_url;
    }

    /**
     * Update order
     */
    public function updateOrder( $transaction_id, $status)
    {
        $statement = $this->database->prepare(
            'UPDATE orders SET status = :status WHERE transaction_id = :transaction_id'
        );

        $statement->execute([
            'status' => $status,
            'transaction_id' => $transaction_id
        ]);
    }

    /**
     * List all the orders by the logged-in user
     */
    public function listOrders( $user_id )
    {
        // retrieve the orders data from database based on the given user_id
        $statement = $this->database->prepare(
            'SELECT * FROM orders 
            WHERE user_id = :user_id 
            ORDER BY id DESC'
        );
        $statement->execute([
            'user_id' => $user_id
        ]);

        // fetch all the orders data 
        return $statement->fetchAll(PDO::FETCH_ASSOC); 
    }

    /**
     * List out all the products inside a single order
     */
    public function listProductsinOrder( $order_id )
    {
        // retrieve products data using JOIN
        $statement = $this->database->prepare(
            'SELECT
            products.id,
            products.name, 
            orders_products.order_id,
            orders_products.quantity
            FROM orders_products
            JOIN products
            ON orders_products.product_id = products.id
            WHERE order_id = :order_id'
        );
        $statement->execute([
            'order_id' => $order_id
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}