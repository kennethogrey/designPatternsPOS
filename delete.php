<?php
    require 'mysql.php';
    if (isset($_POST["product_id"])) {
        $product_id = intval($_POST["product_id"]);

        $sql = "DELETE FROM products WHERE id = $product_id";
        
        if ($conn->query($sql) === TRUE) {
            header('Location:http://localhost/pos/index.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
?>