<?php
    session_start();
    if(isset($_POST["logout"])){
        $_SESSION['status'] = 'You have been logged out successfully.';
        header('Location:http://localhost/pos/index.php');
        session_destroy();
    }
?>