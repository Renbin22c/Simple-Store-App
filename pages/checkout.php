<?php

    session_start();

    require 'config.php';
    require 'includes/functions.php';
    require 'includes/class-products.php';
    require 'includes/class-orders.php';
    require 'includes/class-cart.php';

    // make sure it's POST request
    if ( $_SERVER["REQUEST_METHOD"] === 'POST' ) {

        // do error check
        // make sure cart is not empty
        if ( empty( $_SESSION['cart'] ) ) {
            $error = "Your cart is empty.";
        } 

        // make sure user is already logged in
        if ( !isLoggedIn() ) {
            $error = "You must be logged in to checkout";
        }

        // only proceed if there are no errors
        if ( !isset( $error ) ) {
            // proceed with order creation
            $orders = new Orders();
            $cart = new Cart();

            // create new order
            $bill_url = $orders->createNewOrder(
                $_SESSION['user']['id'], // $user_id
                $cart->total(), // $total_amount
                $_SESSION['cart'] // $products_in_cart
            );

            // empty cart
            $cart->emptyCart();

            // make sure bill url is valid url
            if ( isset( $bill_url ) && !empty( $bill_url ) ) {
                header( 'Location: ' . $bill_url );
                exit;
            } else {
                $error = 'missing bill url';
            }

        }

    }

    require "parts/header.php";
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <?php if ( isset( $error ) ): ?>
                <div class="alert alert-danger mb-3">
                    <?php echo $error; ?>
                </div>
            <?php else : ?>
                <div class="alert alert-danger mb-3">
                    Something has went wrong
                </div>
            <?php endif; ?>
            <a href="/cart" class="btn btn-primary">Back to cart</a>
        </div>
    </div>
</div><!-- .container -->
<?php
    require "parts/footer.php";