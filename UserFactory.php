<?php
namespace App;
session_start();

    $role = $_POST["role"];
    
    interface UserInterface{
        public function addToDatabase();

    }

    class Admin implements UserInterface{
        private $email;
        private $role;
        private $pwd;

        public function __construct($email,$role,$pwd)
        {
            $this->email = $email;
            $this->role = $role;
            $this->pwd = $pwd;
        }

        public function getEmail(){
            return $this->email;
        }
        
        public function getRole(){
            return $this->role;
        }

        public function getPwd(){
            return $this->pwd;
        }
        
        public function addToDatabase(){
            include 'mysql.php';
            $sql = "SELECT * FROM users WHERE email = '$this->email'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $_SESSION['status'] ='The user already exists in the database';
                header('Location:http://localhost/pos/dashboard.php');
            }
            else{
                $sql = "INSERT INTO users (email, user_role, pwd) VALUES ('$this->email', '$this->role', '$this->pwd')";
            
                if ($conn->query($sql) === TRUE) {
                $_SESSION['status'] = 'User with email: '.$this->email.' has been added to the database successfully.';
                    header('Location:http://localhost/pos/dashboard.php');
                } else {
                    $_SESSION["status"] = "Error inserting user with email: ".$this->email." into the database.";
                    header('Location:http://localhost/pos/dashboard.php');
                }

            }
            
            $conn->close();
        }
    }

    class Cashier implements UserInterface{
        private $email;
        private $role;
        private $pwd;

        public function __construct($email,$role,$pwd)
        {
            $this->email = $email;
            $this->role = $role;
            $this->pwd = $pwd;
        }

        public function getEmail(){
            return $this->email;
        }
        
        public function getRole(){
            return $this->role;
        }

        public function getPwd(){
            return $this->pwd;
        }
        
        public function addToDatabase(){
            include 'mysql.php';
            $sql = "SELECT * FROM users WHERE email = '$this->email'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $_SESSION['status'] ='The user already exists in the database';
                header('Location:http://localhost/pos/dashboard.php');
            }
            else{
                $sql = "INSERT INTO users (email, user_role, pwd) VALUES ('$this->email', '$this->role', '$this->pwd')";
            
                if ($conn->query($sql) === TRUE) {
                $_SESSION['status'] = 'User with email: '.$this->email.' has been added to the database successfully.';
                    header('Location:http://localhost/pos/dashboard.php');
                } else {
                    $_SESSION["status"] = "Error inserting user with email: ".$this->email." into the database.";
                    header('Location:http://localhost/pos/dashboard.php');
                }

            }
            
            $conn->close();
        }
    }

    class UserFactory{
        
        public function create($type){
            $email = $_POST["email"];
            $role = $_POST["role"];
            $pwd = $_POST["pwd"];
            switch ($type) {
                case 'admin':
                    $user = new Admin($email,$role,$pwd);
                break;
                case 'cashier':
                    $user = new Cashier($email,$role,$pwd);
                break;
                         
                default:
                    echo "Invalid Category";
                break;
            }
            return $user;
        }
    }

    $userFactory = new UserFactory();
    $user = $userFactory->create($role);
    $user->addToDatabase();