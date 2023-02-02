<?php
    require_once('validations.php');
    require_once('new-connection.php');
    session_start();
        
    if(isset($_POST['action']) && $_POST['action'] == 'register') {
        // call to function
        register_user($_POST); // use the Actual POST
    } else if (isset($_POST['action']) && $_POST['action'] == 'login') {
        
        login_user($_POST);
    } else {    // malicious navigation to process.php or someone is trying to logoff!
        session_destroy();
        header('location: index.php');
        die();
    }

    function register_user ($post) {     // just a parameter called post
        //------------begin validation checks------------------//
        $_SESSION['errors'] = array();
        validateName($post['first_name'],"first name");
        validateName($post['last_name'], "last name");
        validatePassword($post['password'], $post['confirm_password']);
        validateEmail($post['email']);
        
        // ----------------end of calidation checks-------------//
        if(count($_SESSION['errors']) > 0) {    // if I have any errors at all!!
            header("location: index.php");
            die();
        } else {        //now you need to insert the data into the database;
            $password = md5($post['password']);
            $query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at)
                    VALUES ('{$post['first_name']}', '{$post['last_name']}', '{$post['email']}', 
                    '{$password}', NOW(), NOW())";
            
            run_mysql_query($query);
            $_SESSION['success_message'] = "User successfully created!";
            header("location: index.php");
            die();
        }

    }
    function login_user ($post) {     // just a parameter called post
        $password = md5($post['password']);
        $query = "SELECT * FROM users WHERE users.email = '{$post['email']}' 
                AND users.password = '{$password}' ";
        $user = fetch_all($query); // go and attempt to grab user with above credentials
        if(count($user) > 0) {
            $_SESSION['user_id'] = $user[0]['id'];
            $_SESSION['first_name'] = $user[0]['first_name'];
            $_SESSION['logged_in'] = true;
            header('location: success.php');

        } else {
            $_SESSION['errors'][] = "invalid credentials was used. Please try again!";
            header('location: index.php');
            die();
        }
    }



?>