<?php 
include 'inc/header.php'; 
include './classes/Conn.php';
require_once './classes/Product-Show.php';

use Classes\Product_Show;

if(!isset($_GET['id'])){
    $_SESSION['errors'] = ["Error, please provide id."];
    header('location:index.php');
}
else{
    $id = $_GET['id'];
    $product = new Product_Show($id);
    if(!($product->msg == 'Success!')){
        $_SESSION['errors'] = [$product->msg];
        header('location:index.php');
    }
    else{

?>

<div class="container my-5">
<?php require_once './inc/errors.php'; ?>
    <div class="row">
        <div class="col-lg-6 offset-lg-3">


            <form action="./handlers/handleEdit.php?id=<?php echo $product->id ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name = "name" value="<?php echo $product->title ?>">
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" class="form-control" id="price" name="price" value="<?php echo $product->price ?>">
                </div>

                <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description:</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name = "desc"><?php echo $product->body ?></textarea>
                </div>

                <div class="mb-3">
                <label for="formFile" class="form-label">Image:</label>
                <input class="form-control" type="file" id="formFile" name="image">
                </div>

                <div class="col-lg-3">
                        <img src="images/<?php echo $product->image ?>" class="card-img-top">
                        </div>
                        
                <center><button on type="submit" class="btn btn-primary" name="submit">Confirm Edits!</button></center>
            </form>
        </div>
    </div>
</div>



<?php }} include 'inc/footer.php'; ?>