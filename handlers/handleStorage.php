<?php
require_once "../classes/Conn.php";
require_once "../classes/Validate.php";
use Classes\Conn;
use Classes\Validate;
$conn = new Conn();

if(isset($_POST["submit"])){
    
    $title = htmlspecialchars(trim($_POST['name']));
    $body = htmlspecialchars(trim($_POST['desc']));
    $price = htmlspecialchars(trim($_POST['price']));
    $image = $_FILES['image'];
    $val = new Validate($title,$body,$price,$image);
    if(empty($val->errors)){
        $query = "INSERT INTO products(`title`,`body`,`image`,`price`) values('$title','$body','$val->newName','$price');";
        $runQuery = mysqli_query($conn->conn,$query);
        if($runQuery){
            move_uploaded_file($val->imageTmpName,"../images/$val->newName");
            $_SESSION['yes'] = "Product Added Successfully";
            unset($_SESSION['desc']);
            unset($_SESSION['title']);
            header('location: ../index.php');
        } else{
            $_SESSION['errors'] = "Error while adding product";
            header("location:../add.php");
        }
    }
    else{
        $_SESSION['errors'] = $val->errors;
        $_SESSION['title'] = $title;
        $_SESSION['desc'] = $body;
        header("location:../add.php");
    }
}else{
    header("location:../add.php");
}