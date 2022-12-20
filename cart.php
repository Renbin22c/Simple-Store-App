<?php

session_start();

require "./includes/functions.php";

// require the header part
require './parts/header.php'; 

?>

        <div class="container mt-5 mb-2 mx-auto" style="max-width: 900px;">
            
            <div class="min-vh-100">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h1">My Cart</h1>
                </div>
    
                <!-- List of products user added to cart -->
                <table class="table table-hover table-bordered table-striped table-light">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Product 1</td>
                            <td>$50</td>
                            <td>2</td>
                            <td>$100</td>
                            <td>
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Product 2</td>
                            <td>$30</td>
                            <td>1</td>
                            <td>$30</td>
                            <td>
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end">Total</td>
                            <td>$130</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-center my-3">
                    <a href="index.php" class="btn btn-light btn-sm">Continue Shopping</a>
                    <button class="btn btn-primary">Checkout</a>
                </div>

            </div>

            <!-- footer -->
            <div class="d-flex justify-content-between align-items-center pt-4 pb-2">
                <div class="text-muted small">© 2022 <a href="index.php" class="text-muted">My Store</a></div>
                <div class="d-flex align-items-center gap-3">
                    <a href="login.php" class="btn btn-light btn-sm">Login</a>
                    <a href="signup.php" class="btn btn-light btn-sm">Sign Up</a>
                    <a href="orders.php" class="btn btn-light btn-sm">My Orders</a>
                </div>
            </div>

        </div>
        

    <!-- require the footer part -->
    <?php require './parts/footer.php'; ?>