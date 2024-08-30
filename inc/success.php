<?php

if(isset($_SESSION['yes'])){
?>
<div class="alert alert-success" role="alert">
  <?php echo $_SESSION['yes'] ?>
</div>
<?php
unset($_SESSION['yes']);
}