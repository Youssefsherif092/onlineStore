<?php
require_once "../classes/Conn.php";
require_once "../classes/ValEdit.php";
use Classes\Conn;
$conn = new Conn();
use Classes\ValEdit;

if(isset($_POST["submit"]) && isset($_GET['id'])){
    
    $title = htmlspecialchars(trim($_POST['name']));
    $body = htmlspecialchars(trim($_POST['desc']));
    $price = htmlspecialchars(trim($_POST['price']));
    $id = $_GET['id'];
    $errors = [];
    $query = "SELECT * FROM products WHERE id = $id";
    $runQuery = mysqli_query($conn->conn, $query);

    if (mysqli_num_rows($runQuery) == 1) {
        $product = mysqli_fetch_assoc($runQuery);
        $oldImage = $product['image'];  
        // Image validation and upload
        if (isset($_FILES['image']) && $_FILES['image']['name']) {
            $image = $_FILES['image'];  
            $val = new ValEdit($title,$body,$price,$image);
        } else {
            // If no new image is uploaded, keep the old image
            $val = new ValEdit($title,$body,$price,$oldImage);
        }
    }
    
    if(empty($val->errors)){
        $query = "UPDATE products SET `title` = '$title', `body` = '$body', `image` = '$val->newName', `price` = '$price' WHERE id = $id;";
        $runQuery = mysqli_query($conn->conn,$query);
        if($runQuery){
            $_SESSION['yes'] = "Product Edited Successfully";
                if (isset($_FILES['image']) && $_FILES['image']['name']) {
                    $targetDir = '../images/';
                    $targetFile = $targetDir . $val->newName;
                    if (!move_uploaded_file($val->imageTmpName, $targetFile)) {
                        $errors[] = "Failed to move uploaded file";
                    } else {
                        if ($oldImage && file_exists($targetDir . $oldImage)) {
                            unlink($targetDir . $oldImage);
                        }
                    }
                }
            unset($_SESSION['desc']);
            unset($_SESSION['title']);
            header("location: ../show.php?id=$id");
        } else{
            $_SESSION['errors'] = "Error while adding product";
            header("location:../edit.php");
        }
    }
    else{
        $_SESSION['errors'] = array_merge($val->errors , $errors);
        $_SESSION['title'] = $title;
        $_SESSION['desc'] = $body;
        header("location:../edit.php?id=$id");
    }
}else{
    header("location:../index.php");
}