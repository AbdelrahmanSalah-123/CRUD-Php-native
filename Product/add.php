<?php
include_once "../inc/header.php";
include_once "../inc/nav.php";
include "../core/connect.php";
session_start();
?>
<?php 
$sql1="SELECT `name`,`id` FROM `categories`;";
$result=mysqli_query($conn,$sql1);
$categoryname=mysqli_fetch_all($result,MYSQLI_ASSOC);
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
    <h1 class="text-center my-5">Add Product</h1>
    <form action="../handlers/Product/handleradd.php" method="POST" enctype="multipart/form-data">
<input class="form-control my-5" name="name" type="text" placeholder="Enter Product Name" aria-label="default input example">
<label for="">Product Image</label>
<input class="form-control mb-5" name ="img" type="file" aria-label="default input example">
<label for="">Category Name</label>
<select class="form-select" name="selection" aria-label="Default select example">
  <option selected>Open this select menu</option>
  <?php foreach($categoryname as $value):?>
    <option value="<?=$value['id']?>"><?=$value['name']?></option>
    <?php endforeach;?>
</select>
<input type="submit" name="submit" value="Add Product" class="btn btn-primary my-5">
</form>
</div>
<?php
include_once "../inc/footer.php";
?>