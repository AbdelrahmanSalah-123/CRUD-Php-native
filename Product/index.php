<?php 
include_once "../inc/header.php";
include "../core/connect.php";
session_start();
$sql="SELECT * FROM `products`";
$result=mysqli_query($conn,$sql);
$pro=mysqli_fetch_all($result,MYSQLI_ASSOC);
$i=1;
?>

<body>
    <?php
    include_once "../inc/nav.php";
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
        <a href="add.php"class="btn btn-primary my-5">Add Product</a>
        <?php if(mysqli_num_rows($result)>=1){?>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Image</th>
      <th scope="col">Category Id</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach($pro as $value):?>
    <tr>
      <th><?=$i++?></th>
      <td><?=$value['name']?></td>
      <td><img src="../uploads/images/Product/<?=$value['img']?>" alt="" style="width:80px;height:80px;border-radius:50%;"></td>
      <td><?=$value['categoryId']?></td>
      <td><a href="../handlers/Product/delete.php?id=<?=$value['id']?>" class="btn btn-danger">Delete</a></td>
      <td><a href="edit.php?id=<?=$value['id']?>" class="btn btn-primary">Edit</a></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<?php } else{
    echo"<h1>There are no products to show</h1>";
}?>
    </div>
    <?php include_once "../inc/footer.php"?>