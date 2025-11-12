<?php
include 'dbconn.php';
$enteredPassword = $_POST['password'];
$storedHash = $_POST['hpassword']; // hashed password from your database

if (password_verify($enteredPassword, $storedHash)) {
    echo "Password is correct!";
} else {
    echo "Invalid password.";
}
?>