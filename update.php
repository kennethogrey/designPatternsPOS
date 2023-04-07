<?php
session_start();
    $id = $_POST['id'];
    $name = $_POST['name'];
    $cost = $_POST["cost"];
    $category = $_POST["category"];
    $quantity = $_POST["quantity"];
    if( (isset($_POST['express_shipping'])) && (isset($_POST['gift_wrapping'])) ){
        $features ="Express Shipping, Gift Wrapping";
    }
    if( (!isset($_POST['express_shipping'])) && !(isset($_POST['gift_wrapping'])) ){
        $features ="None";
    }
    if( !(isset($_POST['express_shipping'])) && (isset($_POST['gift_wrapping'])) ){
        $features = "Gift Wrapping";
    }
    if( (isset($_POST['express_shipping'])) && !(isset($_POST['gift_wrapping'])) ){
        $features = "Express Shipping";
    }

    require 'mysql.php';
    $sql = "UPDATE products SET pname='$name', cost='$cost', category='$category', quantity='$quantity', bonus_feature='$features' WHERE id= $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['status']=$name.' has been updated successfully';
        header('Location:http://localhost/pos/index.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
?>