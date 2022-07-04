<?php
include "../../core/connect.php";
session_start();

if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['id'])){
    $id=$_GET['id'];

    $sql="DELETE FROM `categories` WHERE `id`='$id'";
    $result=mysqli_query($conn,$sql);
    if($result){
$_SESSION['success']="Deleted Successfully";
header("location:../../Category/index.php");
exit();
    }
}else{
    header("location:../../Category/index.php");
}