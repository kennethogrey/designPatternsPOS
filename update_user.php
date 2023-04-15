<?php
session_start();
    $id = $_POST['user_id'];
    $email = $_POST['email'];
    $role = $_POST["role"];
    $pwd = $_POST["pwd"];
    

    require 'mysql.php';
    $sql = "UPDATE users SET email='$email', user_role='$role', pwd='$pwd' WHERE id= $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] = 'The User has been updated successfully';
        header('Location:http://localhost/pos/all_users.php');
    } else {
        $_SESSION["status"] = "Error updating the user.";
        header('Location:http://localhost/pos/all_users.php');
    }

    $conn->close();
?>