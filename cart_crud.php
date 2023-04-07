<?php
    require 'mysql.php';

    if (isset($_POST["product_id"])) {
        $product_id = intval($_POST["product_id"]);
        $sql = "DELETE FROM cart WHERE id = $product_id";
        
        if ($conn->query($sql) === TRUE) {
            header('Location:http://localhost/pos/cart.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if( isset($_POST['quantity']) && isset($_POST['id']) ){
        $product_id = intval($_POST["id"]);
        $product_quantity = intval($_POST["quantity"]);

        $stmt = $conn->prepare("SELECT * FROM cart WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $new_price = $row['cost'] * $product_quantity;
        $name =$row['pname'];

        $sql = "UPDATE cart SET cost = '$new_price', quantity ='$product_quantity' WHERE id='$product_id' AND pname='$name'";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['status']=$name.'quantity and price have been updated successfully';
            header('Location:http://localhost/pos/cart.php');
        } else {
        echo "Error updating record: " . $conn->error;
        }
    }
    $conn->close();
?>