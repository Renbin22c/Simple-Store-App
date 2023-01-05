<?php

class Authentication
{
    public $database;

    public function __construct()
    {
        // this function will trigger the class is called
        $this->database = connectToDB();
    }

    public function login( $email = '', $password = '' )
    {

        // make sure all the fields are filled
        if ( 
            empty( $email ) || 
            empty( $password )
        ) 
        {
            return 'All fields are required.';
        }

        // find the user in database using the provided email
        $statement = $this->database->prepare(
            'SELECT * FROM users WHERE email = :email'
        );

        $statement->execute([
            'email' => $email 
        ]);

        // fetch one result from database
        $user = $statement->fetch();

        // if $user exists, it means the user exists in the database
        if ( $user ) {
            // check password
            if ( 
                password_verify( $password, $user['password'] ) 
            ) {
                // assign user data to user session
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'email' => $user['email']
                ];

                // remove the csrf token from the session data
                unset( $_SESSION['login_form_csrf_token'] );

                // redirect user back to index
                header('Location: /');
                exit;

            } else {
                return 'invalid email or password';
            }
        } else {
            // user doesn't exists
            return 'invalid email or password';
        }
    }

    public function signup( $email = '', $password = '', $confirm_password = '' ) 
    {

        $error = '';

        // make sure all the fields are filled
        if ( 
            empty( $email ) || 
            empty( $password ) || 
            empty( $confirm_password ) 
        ) 
        {
            $error = 'All fields are required.';
        }

        // check to make sure password & confirm_password is the same
        if (
            !empty( $password ) && // $password is not empty
            !empty( $confirm_password ) && // $confirm_password is not empty
            $password !== $confirm_password 
        ) {
            $error = "The password and confirm password fields should match";
        }

        if ( !empty( $error ) )
            return $error;

        // make sure user's email wasn't already exists in database
        $statement = $this->database->prepare(
            'SELECT * FROM users WHERE email = :email'
        );

        $statement->execute([
            'email' => $email 
        ]);

        // fetch one result from database
        $user = $statement->fetch();

        // if user exists, return error
        if ( $user ) {
            return 'Email already exists';
        } else {
            // if user doesn't exists, insert user data into database
            $statement = $this->database->prepare(
                'INSERT INTO users ( email, password )
                VALUES (:email, :password )'
            );

            $statement->execute([
                'email' => $email,
                'password' => password_hash( $password, PASSWORD_DEFAULT )
            ]);

            // redirect the user back to /login
            header('Location: /login');
            exit;

        }

    }
}