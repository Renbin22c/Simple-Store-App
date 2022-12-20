<?php

function connectToDB(){
    return new PDO(
        'mysql:host=devkinsta_db;dbname=Simple_Store',
        'root',
        '0sFa6YuOGxSVbOQa'
    );
}

function isLoggedIn(){
    // if the user is logged in, it will return true
    // fi the user is not logged in, it will return false
    return isset($_SESSION['user']);
}

function logout(){
    // delete the section data so that the user can logout
    unset($_SESSION['user']);
}

?>