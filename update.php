<?php
    $id = $_POST['id'];
    $name = $_POST['name'];
    $cost = $_POST["cost"];
    $category = $_POST["category"];
    if( (isset($_POST['express_shipping'])) && (isset($_POST['gift_wrapping'])) ){
        $features ="Express Shipping, Gift Wrapping";
    }
    if( (!isset($_POST['express_shipping'])) && !(isset($_POST['gift_wrapping'])) ){
        $features ="";
    }
    if( !(isset($_POST['express_shipping'])) && (isset($_POST['gift_wrapping'])) ){
        $features = "Gift Wrapping";
    }
    if( (isset($_POST['express_shipping'])) && !(isset($_POST['gift_wrapping'])) ){
        $features = "Express Shipping";
    }

    require 'mysql.php';
    $sql = "UPDATE products SET pname='$name', cost='$cost', category='$category', bonus_feature='$features' WHERE id= $id";

    if ($conn->query($sql) === TRUE) {
        header('Location:http://localhost/pos/index.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
?>