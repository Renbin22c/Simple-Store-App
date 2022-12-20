<?php

session_start();

require "./includes/functions.php";

// make sure the user is logged in
if ( isset( $_SESSION['user'])){
    // delete the user's session data
    logout();
    // redirect user back to login page
    header('Location: /login.php');
    exit;
} else{
    // redirect to login page
    header('Location: /');
    exit;
}

?>