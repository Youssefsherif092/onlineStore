<?php 

include 'inc/header.php'; 
require_once './classes/Conn.php';
require_once './classes/Product-Show.php';
use Classes\Conn;
use Classes\Product_Show;
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $product = new Product_Show($id);
    if(!($product->msg == 'Success!')){
        $_SESSION['errors'] = [$product->msg];
        header('location:index.php');
    }
else{

?>




<div class="container my-5">
<?php require_once './inc/success.php'; ?>

    <div class="row">


    <div class="col-lg-6">
            <img src="images/<?php echo $product->image ?>" class="card-img-top">
            </div>
            <div class="col-lg-6">
            <h5 ><?php echo $product->title ?></h5>
            <p class="text-muted">Price: <?php echo $product->price ?></p>
            <p class="text-muted">Date Updated: <?php echo $product->date ?></p>
            <p class="text-muted">Time Updated: <?php echo $product->time ?></p>
            <p><?php echo $product->body ?></p>
            <a href="index.php" class="btn btn-primary">Back</a>
            <a href="edit.php?id=<?php echo $product->id ?>" class="btn btn-info">Edit</a>
            <a href="handlers/handleDelete.php?id=<?php echo $product->id ?>" class="btn btn-danger">Delete</a>
        </div>
        
    </div>
</div>


<?php }} ?>
<?php include 'inc/footer.php'; ?>