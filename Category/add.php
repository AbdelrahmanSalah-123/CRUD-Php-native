<?php
include_once "../inc/header.php";
include_once "../inc/nav.php";
session_start();
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
    <h1 class="text-center my-5">Add Category</h1>
    <form action="../handlers/Category/handleradd.php" method="POST">
<input class="form-control my-5" name="categoryname" type="text" placeholder="Enter Category Name" aria-label="default input example">
<input class="form-control" name ="desc" type="text" placeholder="Enter Category Description" aria-label="default input example">
<input type="submit" name="submit" value="Add Category" class="btn btn-primary my-5">
</form>
</div>
<?php
include_once "../inc/footer.php";
?>