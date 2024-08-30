<?php
require_once "../classes/Conn.php";
require_once "../classes/Delete.php";
use Classes\Conn;
$conn = new Conn();


if(isset($_GET["id"])){
    $id = $_GET["id"];
    $delete = new Delete($id);
}
