<?php

  // get route from the global variable $_SERVER
  $path = $_SERVER["REQUEST_URI"];

  // remove beginning slash & ending slash
  $path = trim( $path, '/' );

  // remove all the URL parameters that starts from ?
  $path = parse_url( $path, PHP_URL_PATH );

  // var_dump( $path );

  switch( $path ) {
    case 'login':
      require "pages/login.php";
      break;
    case 'signup':
      require "pages/signup.php";
      break;
    case 'cart':
      require "pages/cart.php";
      break;
    case 'orders':
      require "pages/orders.php";
      break;
    case 'checkout':
      require "pages/checkout.php";
      break;
    case 'payment-verification':
      require "pages/payment-verification.php";
      break;
    case 'logout':
      require "pages/logout.php";
      break;
    default:
      require "pages/home.php";
      break;
  }