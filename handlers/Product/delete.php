<?php
include "../../core/connect.php";
session_start();

if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['id'])){
    $id=$_GET['id'];
    $sql1="SELECT * FROM `products` WHERE `id`='$id'";
    $result1=mysqli_query($conn,$sql1);
    if(mysqli_num_rows($result1)>=1){
        $product=mysqli_fetch_assoc($result1);
        $sql="DELETE FROM `products` WHERE `id`='$id'";
        $result=mysqli_query($conn,$sql);
        unlink("../../uploads/images/Product/".$product['img']);
        if($result){
            $_SESSION['success']="Deleted Successfully";
            header("location:../../Product/index.php");
            exit();
                }
    }else{
        header("location:../../Product/index.php");
    }
}else{
    header("location:../../Product/index.php");
}