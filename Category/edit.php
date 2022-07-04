<?php
include_once "../core/connect.php";
include_once "../inc/header.php";
include_once "../inc/nav.php";
session_start();
?>
<?php
$id=$_GET['id'];
$sql="SELECT * FROM `categories` WHERE `id`='$id'";
$result=mysqli_query($conn,$sql);
$category=mysqli_fetch_assoc($result);
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
    <h1 class="text-center my-5">Edit Category - <?=$category['name']?></h1>
    <form action="../handlers/Category/handleredit.php" method="POST">
    <input type="hidden" name="id" value="<?= $category['Categoryid'] ?>">
<input class="form-control my-5" name="categoryname" type="text" value="<?=$category['name']?>" aria-label="default input example">
<input class="form-control" name ="desc" type="text" placeholder="Enter Category Description" aria-label="default input example">
<input type="submit" name="submit" value="Edit Category" class="btn btn-primary my-5">
</form>
</div>
<?php
include_once "../inc/footer.php";
?>