<?php
include 'inc/header.php'; 
require_once './classes/Conn.php';
use Classes\Conn;
$conn = new Conn();
require_once './inc/success.php';
require_once './inc/errors.php';

?>



<div class="container my-5">

    <div class="row">
        
<?php
    $query = "SELECT id , title, price, substring(body,1,200) as body, image, substring(created_at,1,10) AS created_at FROM products;";
    $runQuery = mysqli_query($conn->conn,$query);
    if(!mysqli_num_rows($runQuery) > 0){
    $msg = "No products found";
    echo $msg;
    }else{
    $products = mysqli_fetch_all($runQuery,MYSQLI_ASSOC);
    foreach($products as $product):

    
?>



    <div class="col-lg-4 mb-3">



            <div class="card">
            <img src="images/<?php echo $product['image'] ?>" class="card-img-top">
            <div class="card-body">
            <h5 class="card-title"><?php echo $product['title'] ?></h5>
            <p class="text-muted"><?php echo $product['price'] ?> EGP</p>
            <p class="text-muted">Created On: <?php echo $product['created_at'] ?></p>
            <p class="card-text"><?php echo $product['body'] ?>...</p>
            <a href="show.php?id=<?php echo $product['id'] ?>" class="btn btn-primary">Show</a>

            <a href="edit.php?id=<?php echo $product['id'] ?>" class="btn btn-info">Edit</a>
            <a href="handlers/handleDelete.php?id=<?php echo $product['id'] ?>" class="btn btn-danger">Delete</a>

            </div>
        </div>
        
    </div>

<?php endforeach;} ?>
    
        
    </div>

</div>



<?php include 'inc/footer.php'; ?>