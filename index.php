<?php

session_start();

require "./includes/functions.php";

// require the header part
require './parts/header.php'; 

?>

    <div class="container mt-5 mb-2 mx-auto" style="max-width: 900px;">
      <div class="min-vh-100">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h1 class="h1">My Store</h1>
          <div class="d-flex align-items-center justify-content-end gap-3">
            <a href="cart.php" class="btn btn-success">My Cart</a>
          </div>
        </div>

        <!-- products -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <div class="col">
            <div class="card h-100">
              <img
                src="https://cdn.shopify.com/s/files/1/0533/2089/files/placeholder-images-product-1_large.png?format=webp&v=1530129292"
                class="card-img-top"
                alt="Product 1"
              />
              <div class="card-body text-center">
                <h5 class="card-title">Product 1</h5>
                <p class="card-text">$50</p>
                <button class="btn btn-primary">Add to cart</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <img
                src="https://cdn.shopify.com/s/files/1/0533/2089/files/placeholder-images-product-2_large.png?format=webp&v=1530129318"
                class="card-img-top"
                alt="Product 2"
              />
              <div class="card-body text-center">
                <h5 class="card-title">Product 2</h5>
                <p class="card-text">$30</p>
                <button class="btn btn-primary">Add to cart</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <img
                src="https://cdn.shopify.com/s/files/1/0533/2089/files/placeholder-images-product-3_large.png?format=webp&v=1530129341"
                class="card-img-top"
                alt="Product 3"
              />
              <div class="card-body text-center">
                <h5 class="card-title">Product 3</h5>
                <p class="card-text">$20</p>
                <button class="btn btn-primary">Add to cart</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <img
                src="https://cdn.shopify.com/s/files/1/0533/2089/files/placeholder-images-product-4_large.png?format=webp&v=1530129292"
                class="card-img-top"
                alt="Product 4"
              />
              <div class="card-body text-center">
                <h5 class="card-title">Product 4</h5>
                <p class="card-text">$40</p>
                <button class="btn btn-primary">Add to cart</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <img
                src="https://cdn.shopify.com/s/files/1/0533/2089/files/placeholder-images-product-5_large.png?format=webp&v=1530129318"
                class="card-img-top"
                alt="Product 5"
              />
              <div class="card-body text-center">
                <h5 class="card-title">Product 5</h5>
                <p class="card-text">$35</p>
                <button class="btn btn-primary">Add to cart</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <img
                src="https://cdn.shopify.com/s/files/1/0533/2089/files/placeholder-images-product-6_large.png?format=webp&v=1530129341"
                class="card-img-top"
                alt="Product 6"
              />
              <div class="card-body text-center">
                <h5 class="card-title">Product 6</h5>
                <p class="card-text">$26</p>
                <button class="btn btn-primary">Add to cart</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- footer -->
      <div class="d-flex justify-content-between align-items-center pt-4 pb-2">
        <div class="text-muted small">
          © 2022 <a href="index.php" class="text-muted">My Store</a>
        </div>
        <div class="d-flex align-items-center gap-3">
        <?php if(isLoggedIn()): ?>
          <a href="orders.php" class="btn btn-light btn-sm">My Orders</a>
          <a href="logout.php" class="btn btn-light btn-sm">Logout</a>
        <?php else: ?>
          <a href="login.php" class="btn btn-light btn-sm">Login</a>
          <a href="signup.php" class="btn btn-light btn-sm">Sign Up</a>
        <?php endif;?>
        </div>
      </div>
    </div>

    <!-- require the footer part -->
    <?php require './parts/footer.php'; ?>