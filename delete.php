<?php
    require 'mysql.php';
    if (isset($_POST["product_id"])) {
        $product_id = intval($_POST["product_id"]);

        $sql = "DELETE FROM products WHERE id = $product_id";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION["status"]="The product has been deleted successfully.";
            header('Location:http://localhost/pos/dashboard.php');
        } else {
            $_SESSION["status"] = "Error deleting the product.";
            header('Location:http://localhost/pos/dashboard.php');
        }
    }
    $conn->close();
?>