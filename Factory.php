<?php
namespace App;
session_start();


    $category = $_POST["category"];
    
    interface ProductInterface{
        public function addToDatabase();
        public function addFeatures($feature);

    }

    class Electronics implements ProductInterface{
        private $name;
        private $cost;
        private $category;
        private $quantity;
        private $features = [];

        public function __construct($name,$cost,$category,$quantity)
        {
            $this->name = $name;
            $this->cost = $cost;
            $this->category = $category;
            $this->quantity = $quantity;
        }
        public function getName(){
            return $this->name;
        }
        public function getCost(){
            return $this->cost;
        }
        public function getCategory(){
            return $this->category;
        }
        public function getQuantity(){
            return $this->quantity;
        }
        public function addFeatures($feature) {
            $this->features[] = $feature;
        }
        public function getFeatures() {
            return $this->features;
        }
    
        
        public function addToDatabase(){
            include 'mysql.php';
            $sql = "SELECT * FROM products WHERE pname = '$this->name'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $_SESSION['status'] ='The product already exists in the inventory';
                header('Location:http://localhost/pos/dashboard.php');
            }
            else{
                $sql = "INSERT INTO products (pname, cost, category, quantity, bonus_feature) VALUES ('$this->name', '$this->cost', '$this->category', '$this->quantity', '" . implode(',', $this->features) . "')";
            
                if ($conn->query($sql) === TRUE) {
                $_SESSION['status'] =$this->name.' has been added to the inventory successfully.';
                    header('Location:http://localhost/pos/dashboard.php');
                } else {
                    $_SESSION["status"] = "Error inserting ".$this->name." into the inventory.";
                    header('Location:http://localhost/pos/dashboard.php');
                }

            }
            
            $conn->close();
        }
    }
    class Clothing implements ProductInterface{
        private $name;
        private $cost;
        private $category;
        private $quantity;
        private $features = [];

        public function __construct($name,$cost,$category,$quantity)
        {
            $this->name = $name;
            $this->cost = $cost;
            $this->category = $category;
            $this->quantity = $quantity;
        }
        public function getName(){
            return $this->name;
        }
        public function getCost(){
            return $this->cost;
        }
        public function getCategory(){
            return $this->category;
        }
        public function getQuantity(){
            return $this->quantity;
        }
        public function addFeatures($feature) {
            $this->features[] = $feature;
        }
        public function getFeatures() {
            return $this->features;
        }
    
        
        public function addToDatabase(){
            include 'mysql.php';
            $sql = "SELECT * FROM products WHERE pname = '$this->name'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $_SESSION['status'] ='The product already exists in the inventory';
                header('Location:http://localhost/pos/dashboard.php');
            }
            else{
                $sql = "INSERT INTO products (pname, cost, category, quantity, bonus_feature) VALUES ('$this->name', '$this->cost', '$this->category', '$this->quantity', '" . implode(',', $this->features) . "')";
            
                if ($conn->query($sql) === TRUE) {
                $_SESSION['status'] =$this->name.' has been added to the inventory successfully.';
                    header('Location:http://localhost/pos/dashboard.php');
                } else {
                    $_SESSION["status"] = "Error inserting ".$this->name." into the inventory.";
                    header('Location:http://localhost/pos/dashboard.php');
                }

            }
            
            $conn->close();
        }
    }

    class Groceries implements ProductInterface{
        private $name;
        private $cost;
        private $category;
        private $quantity;
        private $features = [];

        public function __construct($name,$cost,$category,$quantity)
        {
            $this->name = $name;
            $this->cost = $cost;
            $this->category = $category;
            $this->quantity = $quantity;
        }
        public function getName(){
            return $this->name;
        }
        public function getCost(){
            return $this->cost;
        }
        public function getCategory(){
            return $this->category;
        }
        public function getQuantity(){
            return $this->quantity;
        }
        public function addFeatures($feature) {
            $this->features[] = $feature;
        }
        public function getFeatures() {
            return $this->features;
        }
    
        public function addToDatabase(){
            include 'mysql.php';
            $sql = "SELECT * FROM products WHERE pname = '$this->name'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $_SESSION['status'] ='The product already exists in the inventory';
                header('Location:http://localhost/pos/dashboard.php');
            }
            else{
                $sql = "INSERT INTO products (pname, cost, category, quantity, bonus_feature) VALUES ('$this->name', '$this->cost', '$this->category', '$this->quantity', '" . implode(',', $this->features) . "')";
            
                if ($conn->query($sql) === TRUE) {
                $_SESSION['status'] =$this->name.' has been added to the inventory successfully.';
                    header('Location:http://localhost/pos/dashboard.php');
                } else {
                    $_SESSION["status"] = "Error inserting ".$this->name." into the inventory.";
                    header('Location:http://localhost/pos/dashboard.php');
                }

            }
            
            $conn->close();
        }
    }

    interface ProductDecoratorInterface {
        public function addFeatures(ProductInterface $product);
    }
    
    class ProductDecorator implements ProductDecoratorInterface {
        private $featureName;
    
        public function __construct($featureName) {
            $this->featureName = $featureName;
        }

    
        public function addFeatures(ProductInterface $product) {
            $product->addFeatures($this->featureName);
        }
    }

    class ProductFactory{
        
        public function create($type){
            $name = $_POST["name"];
            $cost = $_POST["cost"];
            $quantity = $_POST["quantity"];
            switch ($type) {
                case 'Electronics':
                    $product = new Electronics($name,$cost,"Electronics", $quantity);
                break;
                case 'Clothing':
                    $product = new Clothing($name,$cost,"Clothing", $quantity);
                    break;
                case 'Groceries':
                    $product = new Groceries($name,$cost,"Groceries",$quantity);
                break;
                         
                default:
                    echo "Invalid Category";
                break;
            }
            if (isset($_POST['express_shipping'])) {
                $productDecorator = new ProductDecorator('Express Shipping');
                $productDecorator->addFeatures($product);
            }
    
            if (isset($_POST['gift_wrapping'])) {
                $productDecorator = new ProductDecorator('Gift Wrapping');
                $productDecorator->addFeatures($product);
            }
    
            return $product;
        }
    }

    $factory = new ProductFactory();
    $product = $factory->create($category);
    $product->addToDatabase();