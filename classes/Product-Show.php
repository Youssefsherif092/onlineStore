<?php

namespace Classes;
use Classes\Conn;
Class Product_Show{
    
    public $title;
    public $price;
    public $body;
    public $id;
    public $image;
    public $msg;
    public $date;
    public $time;
    public function __construct($id){
        $conn = new Conn();
        $query = "SELECT * FROM products WHERE id=$id";
        $result = mysqli_query($conn->conn,$query);
        if(mysqli_num_rows($result) == 1){
            $product = mysqli_fetch_assoc($result);
            $this->id = $product["id"];
            $this->title = $product["title"];
            $this->price = $product["price"];
            $this->body = $product["body"];
            $this->image = $product["image"];
            $this->date = explode(" ",$product["created_at"])[0];
            $this->time = explode(" ",$product["created_at"])[1];
            $this->msg = 'Success!';
        }else{
            $this->msg = "Error while finding post";
        }

    }
}