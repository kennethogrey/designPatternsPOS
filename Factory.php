<?php
namespace App;

    $category = $_POST["category"];
    
    interface ProductInterface{
        public function addToDatabase();
        public function addFeatures($feature);
    }

    class Electronics implements ProductInterface{
        private $name;
        private $cost;
        private $category;
        private $features = [];

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
        public function addFeatures($feature) {
            $this->features[] = $feature;
        }
    
        
        public function addToDatabase(){
            include 'mysql.php';
            $sql = "INSERT INTO products (pname, cost, category, bonus_feature) VALUES ('$this->name', '$this->cost', '$this->category', '" . implode(',', $this->features) . "')";
            
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
        private $features = [];

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
        public function addFeatures($feature) {
            $this->features[] = $feature;
        }
    
        
        public function addToDatabase(){
            include 'mysql.php';
            $sql = "INSERT INTO products (pname, cost, category, bonus_feature) VALUES ('$this->name', '$this->cost', '$this->category', '" . implode(',', $this->features) . "')";
            
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
        private $features = [];

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
        public function addFeatures($feature) {
            $this->features[] = $feature;
        }
    
        
        public function addToDatabase(){
            include 'mysql.php';
            $sql = "INSERT INTO products (pname, cost, category, bonus_feature) VALUES ('$this->name', '$this->cost', '$this->category', '" . implode(',', $this->features) . "')";
            
            if ($conn->query($sql) === TRUE) {
                header('Location:http://localhost/pos/index.php');
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            $conn->close();
        }
    }

    interface ProductDecoratorInterface {
        public function addFeatures(ProductInterface $product);
    }
    
    class ProductDecorator implements ProductDecoratorInterface {
        private $featureName;
        private $featureCost;
    
        public function __construct($featureName, $featureCost) {
            $this->featureName = $featureName;
            $this->featureCost = $featureCost;
        }
    
        public function addFeatures(ProductInterface $product) {
            $product->addFeatures($this->featureName);
            $product->addFeatures($this->featureCost);
        }
    }

    class ProductFactory{
        
        public function create($type){
            $name = $_POST["name"];
            $cost = $_POST["cost"];
            switch ($type) {
                case 'Electronics':
                    $product = new Electronics($name,$cost,"Electronics");
                break;
                case 'Clothing':
                    $product = new Clothing($name,$cost,"Clothing");
                    break;
                case 'Groceries':
                    $product = new Groceries($name,$cost,"Groceries");
                break;
                         
                default:
                    echo "Invalid Category";
                break;
            }
            if (isset($_POST['express_shipping'])) {
                $productDecorator = new ProductDecorator('Express Shipping', '$10.0');
                $productDecorator->addFeatures($product);
            }
    
            if (isset($_POST['gift_wrapping'])) {
                $productDecorator = new ProductDecorator('Gift Wrapping', '$5.0');
                $productDecorator->addFeatures($product);
            }
    
            return $product;
        }
    }

    $factory = new ProductFactory();
    $product = $factory->create($category);
    $product->addToDatabase();
