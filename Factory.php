<?php
namespace App;

    $category = $_POST["category"];
    
    interface ProductInterface{
        public function addToDatabase();
    }

    class Electronics implements ProductInterface{
        private $name;
        private $cost;
        private $category;

        public function __construct($name,$cost,$category)
        {
            $this->name = $name;
            $this->cost = $cost;
            $this->category = $category;
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
        
        public function addToDatabase(){
            include 'mysql.php';
            $sql = "INSERT INTO products (pname, cost, category) VALUES ('$this->name', '$this->cost', '$this->category')";
            
            if ($conn->query($sql) === TRUE) {
                header('Location:http://localhost/pos/index.php');
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            $conn->close();
        }
    }

    class Clothing implements ProductInterface{
        private $name;
        private $cost;
        private $category;

        public function __construct($name,$cost,$category)
        {
            $this->name = $name;
            $this->cost = $cost;
            $this->category = $category;
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

        public function addToDatabase(){
            include 'mysql.php';
            $sql = "INSERT INTO products (pname, cost, category) VALUES ('$this->name', '$this->cost', '$this->category')";
            
            if ($conn->query($sql) === TRUE) {
                header('Location:http://localhost/pos/index.php');
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            $conn->close();
        }
    }

    class Groceries implements ProductInterface{
        private $name;
        private $cost;
        private $category;

        public function __construct($name,$cost,$category)
        {
            $this->name = $name;
            $this->cost = $cost;
            $this->category = $category;
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
        
        public function addToDatabase(){
            include 'mysql.php';
            $sql = "INSERT INTO products (pname, cost, category) VALUES ('$this->name', '$this->cost', '$this->category')";
            
            if ($conn->query($sql) === TRUE) {
              header('Location:http://localhost/pos/index.php');
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            $conn->close();
        }
    }

    class ProductFactory{
        
        public function create($type){
            $name = $_POST["name"];
            $cost = $_POST["cost"];
            switch ($type) {
                case 'Electronics':
                    return new Electronics($name,$cost,"Electronics");
                break;
                case 'Clothing':
                    return new Clothing($name,$cost,"Clothing");
                    break;
                case 'Groceries':
                    return new Groceries($name,$cost,"Groceries");
                break;
                         
                default:
                    echo "Invalid Category";
                break;
            }
        }
    }

    $factory = new ProductFactory();
    $product = $factory->create($category);
    $product->addToDatabase();
