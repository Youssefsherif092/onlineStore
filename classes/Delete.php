<?php
require_once "../classes/Conn.php";
use Classes\Conn;


Class Delete{
    public function __construct($id){
        $conn = new Conn();
        $query = "DELETE FROM products WHERE id = $id;";
        $res = mysqli_query($conn->conn,$query);
        if(mysqli_affected_rows($conn->conn) > 0){
            $_SESSION['yes'] = 'Product Deleted Successfully!';
            header("location: ../index.php");
        }else{
            $_SESSION['errors'] = 'Error while deleting product.';
            header("location: ../index.php");
        }
    }
}