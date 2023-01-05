<?php

function connectToDB(){
    return new PDO(
        'mysql:host=devkinsta_db;dbname=Simple_Store',
        'root',
        '0sFa6YuOGxSVbOQa'
    );
}

function isLoggedIn()
{
    // if the user is logged in, it will return true
    // if the user is not logged in, it will return false
    return isset( $_SESSION['user'] );
}

function logout()
{
    // delete the session data so that the user logout
    unset( $_SESSION['user'] );
}

function callAPI( $api_url = '', $method = 'GET', $formdata = [], $headers = [] ) {

    // init curl
    $curl = curl_init();

    // assign it to curl props
    $curl_props = [
        CURLOPT_URL => $api_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FAILONERROR => true,
        CURLOPT_CUSTOMREQUEST => $method
    ];

    // if $formdata is not empty, then we'll add in a new key called "CURLOPT_POSTFIELDS"
    if ( !empty( $formdata ) ) {
        $curl_props[ CURLOPT_POSTFIELDS ] = json_encode( $formdata );
    }

    // if $headers is not empty, then we'll add in a new key called "CURLOPT_HTTPHEADER"
    if ( !empty( $headers ) ) {
        $curl_props[ CURLOPT_HTTPHEADER ] = $headers;
    }

    // setup curl
    curl_setopt_array( $curl, $curl_props );

    // execute curl
    $response = curl_exec( $curl );

    // catch error
    $error = curl_error( $curl );

    // close curl
    curl_close( $curl );

    if ( $error )
        return 'API not working';

    return json_decode( $response );
}

?>
