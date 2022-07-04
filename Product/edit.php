<?php
include_once "../core/databse.php";
include_once "../inc/header.php";
include_once "../inc/nav.php";
session_start();
?>
<?php
$id=$_GET['id'];
    $sql           = "SELECT products.*, categories.name AS cat_name, categories.id AS cat_id
                        FROM products
                        INNER JOIN categories ON categories.id = products.category_id
                        WHERE products.id='$id'";
$result=mysqli_query($conn,$sql);
$product=mysqli_fetch_assoc($result);
$sql1="SELECT `id`,`name` FROM `categories`";
$result1=mysqli_query($conn,$sql1);
$categoryname=mysqli_fetch_all($result1,MYSQLI_ASSOC);
?>
<div class="container">
<?php if(isset($_SESSION["error"])): ?>
    <?php foreach($_SESSION["error"] as $error):?>
    <div class="alert alert-danger text-center">
        <?= $error?>
    </div>
    <?php endforeach?>
    <?php unset($_SESSION["error"]); endif;?>
    <?php if(isset($_SESSION["success"])): ?>
    <div class="alert alert-success text-center">
        <?= $_SESSION["success"]?>
    </div>
    <?php unset($_SESSION["success"]); endif;?>
    <h1 class="text-center my-5">Edit Product - <?=$product['productname']?></h1>
    <form action="../handlers/Product/handleredit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$id?>">
<input class="form-control my-5" name="name" type="text" value="<?=$product['productname']?>" aria-label="default input example">
<label for="">Product Image</label>
<input class="form-control" name ="img" type="file" aria-label="default input example">
<select class="form-select" name="selection" aria-label="Default select example">
  <option >Open this select menu</option>
  <?php foreach($categoryname as $value):?>
  <option <?php if($product['cat_id'] === $category['id']) {echo "selected";} ?> value="<?=$category['id']?>"><?=$category['name']?></option>
    <?php endforeach;?>
</select>
<input type="submit" name="submit" value="Edit Product" class="btn btn-primary my-5">
</form>
</div>
<?php
include_once "../inc/footer.php";
?>