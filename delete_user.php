<?php
    require 'mysql.php';
    if (isset($_POST["user_id"])) {
        $user_id = intval($_POST["user_id"]);

        $sql = "DELETE FROM users WHERE id = $user_id";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION["status"] = "User has been deleted successfully";
            header('Location:http://localhost/pos/all_users.php');
        } else {
            $_SESSION["status"] = "Error deleting the user.";
            header('Location:http://localhost/pos/all_users.php');
        }
    }
    $conn->close();
?>