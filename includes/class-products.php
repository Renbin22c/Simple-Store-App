<?php

class Products
{

    public $database;

    public function __construct()
    {
        try {
            // we'll try to establish the database connection
            $this->database = connectToDB();
        } catch ( Exception $error ) {
            die("Database Connection Failed");
        }
    }

    /**
     * retrieve all products from database
     */
    public function listAllProducts()
    {
        // prepare the database
        $statement = $this->database->prepare('SELECT * FROM products');
        // execute
        $statement->execute();
        /*
            fetch all data from database
            use PDO::FETCH_OBJ if you want array ->name
            use PDO::FETCH_ASSOC if you want object ['name']
            or left it empty for PDO::FETCH_BOTH
        */
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find product by id
     */
    public function findProduct( $product_id )
    {
        // find the product based on given product_id
        $statement = $this->database->prepare("SELECT * from products WHERE id = :id");
        $statement->execute([
            'id' => $product_id
        ]);

        // retrieve the product (array)
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

}