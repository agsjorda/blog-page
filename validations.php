<?php
session_start();
// ------------VALIDATE CELL NUMBERS--------------------
function validateCellNumber($number) {
    if (strlen($number) == 11 && $number[0] == '0') {
        for ($i = 0; $i < 11; $i++) {
            if (!is_numeric($number[$i])) {
                return false;
            }
        }
        return true;
    } else {
        return false;
    }
}
// ------------VALIDATE FIRST NAME OR LAST NAME--------------------
function validateName($name, $firstOrLast) {    // checks if string 
    $length = strlen($name);
    if ($length < 2 || $length > 50) {
        $_SESSION['errors'][] = "{$firstOrLast} must be 2 - 50 characters in length";
    }
    for ($i = 0; $i < $length; $i++) {  //checks if the name has numbers
        if (is_numeric($name[$i])) {
            $_SESSION['errors'][] = "{$firstOrLast} must not contain numbers";
        }
    }
    if(empty($name)) {
        $_SESSION['errors'][] = "{$firstOrLast} cannot be empty";
    }
    return true;
}
// ------------VALIDATE EMAIL--------------------
function validateEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors'][] = "Please enter a valid email";
    } 
}
// ------------VALIDATE PASSWORD--------------------
function validatePassword ($password, $confirm_password) {
    if(empty($password)) {
            $_SESSION['errors'][] = "password field is required";
        }
        if($password !== $confirm_password) {
            $_SESSION['errors'][] = "passwords must match";
        }
}


?>