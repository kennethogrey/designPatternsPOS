<?php
    require 'mysql.php';

    if (isset($_POST["product_id"])) {
        $product_id = intval($_POST["product_id"]);
        $sql = "DELETE FROM cart WHERE id = $product_id";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION["status"]="Product has been deleted from the cart successfully.";
            header('Location:http://localhost/pos/cart.php');
        } else {
            $_SESSION["status"] = "Error deleting the product from the cart";
            header('Location:http://localhost/pos/cart.php');
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
            $_SESSION["status"] = "Error updating the quantity and price of ".$name;
            header('Location:http://localhost/pos/cart.php');
        }
    }
    $conn->close();
?>