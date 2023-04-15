<?php
require "mysql.php";
session_start();

if (isset($_POST["login"])) {
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "SELECT * FROM users WHERE email = '$email' AND pwd = '$password'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $_SESSION["email"] = $email;
                header('Location:http://localhost/pos/dashboard.php');
            } else {
                $_SESSION['status'] = 'Invalid Email or Password.';
                header('Location:http://localhost/pos/index.php');
            }
        } else {
            $_SESSION['status'] = 'Invalid Email or Password.';
            header('Location:http://localhost/pos/index.php');
        }
    } else {
        $_SESSION['status'] = 'Invalid Email or Password.';
        header('Location:http://localhost/pos/index.php');
    }
} else {
    header('Location:http://localhost/pos/index.php');
}
