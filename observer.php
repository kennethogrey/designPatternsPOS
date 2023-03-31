<?php
namespace App;
session_start();
interface Observer {
    public function add(Sales $subject);
    public function notify(Sales $subject);
}

class Cart implements Observer {
    private $products;

    public function __construct() {
        $this->products = array();
    }

    public function add(Sales $subject) {
        array_push($this->products, $subject);
    }

    public function getProducts() {
        return $this->products;
    }

    public function addToCart($id) {
        include 'mysql.php';

        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['pname'];
            $cost = $row["cost"];
            $category = $row["category"];
            $features = $row['bonus_feature'];
        }

        $sql = "INSERT INTO cart (pname, cost, category, bonus_feature) VALUES ('$name', '$cost', '$category', '$features')";
            
        if ($conn->query($sql) === TRUE) {
            $_SESSION['status'] = $name.' has been added to the cart';
            header('Location:http://localhost/pos/index.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
        echo $name;
        echo $cost;
        echo $category;
        echo $features;
    }

    public function notify(Sales $subject) {
        $subject->addToCart();
    }
}

interface Sales {
    public function addToCart();
}

class Product implements Sales {
    private $id;

    public function __construct($id) {
        $this->id = $id;
    }

    public function addToCart() {
        $cart = new Cart();
        $cart->addToCart($this->id);
    }
}

$id = $_POST['product_id'];
$sale = new Product($id);

$cart = new Cart();
$cart->add($sale);
$cart->notify($sale);

?>
