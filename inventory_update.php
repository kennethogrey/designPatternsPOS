
<?php
include "mysql.php";

// retrieve all rows from cart
$sql = "SELECT * FROM cart";
$result = $conn->query($sql);

// loop through each row
while ($row = $result->fetch_assoc()) {
   // check if the row exists in products
   $sql = "SELECT * FROM products WHERE pname = '{$row['pname']}'";
   $result2 = $conn->query($sql);

   // if the row exists, subtract the value from the corresponding column in cart from the corresponding column in products
   if ($result2->num_rows > 0) {
      $row2 = $result2->fetch_assoc();
      $value_to_subtract = intval($row['quantity']);

      $new_value = intval($row2['quantity']) - $value_to_subtract;
      // update the corresponding row in products with the new value
      $sql = "UPDATE products SET quantity = {$new_value} WHERE pname = '{$row['pname']}'";
      $conn->query($sql);
   }
}

$sql = "SELECT * FROM cart";
$result = $conn->query($sql);

$payment_method = $_POST['payment_method'];
// loop through each row
while ($row = $result->fetch_assoc()) {
    $sql = "INSERT INTO sales (pname, cost, quantity, category, payment_method) VALUES ('{$row['pname']}', '{$row['cost']}', '{$row['quantity']}', '{$row['category']}','$payment_method')";
    $conn->query($sql);

}



$sql = "DELETE FROM cart";
$conn->query($sql);
$conn->close();
header('Location:http://localhost/pos/index.php');

?>
