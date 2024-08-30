<?php
namespace Classes;

class Conn{
    public $conn;
    public function __construct(){
        session_start();
        $conn = mysqli_connect("localhost","root","","store");
        $this->conn = $conn;
    }
}
