<?php
namespace Classes;

class ValEdit{
    public $errors;
    public $msg;
    public $imageTmpName;
    public $newName;
    public function __construct($title,$body,$price,$image){

        // Validation
        $errors = [];
        if(empty($title)){
            $errors[] = "Title is required"; 
        }else if(is_numeric($title)){
        $errors[] = "Title must be string";
        }
        if(empty($body)){
            $errors[] = "Body is required"; 
        }else if(is_numeric($body)){
            $errors[] = "Body must be string";
        }
        if(empty($price)){
            $errors[] = "Price is required"; 
        }else if(!is_numeric($price)){
            $errors[] = "Price must be numeric";
        }
        if(gettype($image) == 'array'){
        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $size = $image['size']/(1024*1024);
        $ext = strtolower(pathinfo($imageName,PATHINFO_EXTENSION));
        $error = $image['error'];
        $newName = uniqid().".$ext";
        $array_ext = ['png','jpg','jpeg','gif','jfif'];
        if($error != 0){
            $errors[] = "Image is required";
        }else if(!in_array($ext,$array_ext)){
            $errors[] = "Image invalid";
        }else if($size > 1){
            $errors[] = "Image too large";
        }
        if($errors == []){
            $message = 'Success!';
            $this->msg = $message;
            $this->imageTmpName = $imageTmpName;
            $this->newName = $newName;
        }
        else{
            $message = 'Fail.';
            $this->msg = $message;
            $this->errors = $errors;
        }
    }
    else if(gettype($image) == 'string'){
        if($errors == []){
            $message = 'Success!';
            $this->msg = $message;
            $this->newName = $image;
        }
        else{
            $message = 'Fail.';
            $this->msg = $message;
            $this->errors = $errors;
        }
    }
    }
}