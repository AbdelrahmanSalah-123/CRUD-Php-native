<?php
include_once "../../core/connect.php";
include "../../core/validation.php";
session_start();
if(isset($_POST['submit'])&& $_SERVER['REQUEST_METHOD']=='POST'){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $categoryid=$_POST['selection'];
    $errors=[];
    $sql="SELECT * FROM `products` WHERE `id`='$id'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)){
        $product=mysqli_fetch_assoc($result);
        $img=$product['img'];
        $imgName=$_FILES['img']['name'];
        $imgType=$_FILES['img']['type'];
        $imgTemp=$_FILES['img']['tmp_name'];
        $imgSize=$_FILES['img']['size'];
        if(required($name)){
            $errors[]="Please enter Product Name";
        }else if(!minVal($name,3)){
            $errors[]="Please enter Product Name greater than 3";
        }else if(!maxVal($name,255)){
            $errors[]="Please enter Product Name smaller than 20";
        }
        if(!empty($imgName)){
            $allowedExt=["jpeg","jpg","png","gif"];
            $explodes=explode(".",$imgName);
            $imgExt=strtolower(end($explodes));
            if(!in_array($imgExt,$allowedExt)){
                $errors[]="This Extension is not allowed";
            }else if($imgSize>5242880){
                $errors[]="The Image is very big";
            }
            $img=time()."_".$imgName;
            move_uploaded_file($imgTemp,"../../uploads/images/Product/".$img);
            unlink("../../uploads/images/Product/".$product['img']);
        }
        if(empty($errors)){
            $sql="UPDATE `products` SET `name`='$name',`img`='$img' `categoryId`='$categoryid' WHERE `id`='$id'";
            $result=mysqli_query($conn,$sql);
            if($result){
            $_SESSION['success']="Edit Successfully";
            header("location:../../Product/index.php");
            exit;
            }
        }else{
            $_SESSION['error']=$errors;
            header("location:../../Product/edit.php?id=".$id);
            die;
            
        }
    }else{
        header("location:../../Product/index.php");
    }
}