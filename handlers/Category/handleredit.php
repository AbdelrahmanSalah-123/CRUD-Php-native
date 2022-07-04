<?php
include "../../core/validation.php";
include "../../core/connect.php";
session_start();
if(isset($_POST['submit'])&& $_SERVER['REQUEST_METHOD']=="POST"){
    foreach($_POST as $key => $value){
        $$key = trim($value);
    }

    if(required($categoryname)){
        $errors[]="Please enter Category Name";
    }else if(!minVal($categoryname,3)){
        $errors[]="Please enter Category Name greater than 3";
    }else if(!maxVal($categoryname,20)){
        $errors[]="Please enter Category Name smaller than 20";
    }
    if(required($desc)){
        $errors[]="Please enter your description";
    }else if(!minVal($desc,3)){
        $errors[]="Please enter description greater than 3";
    }else if(!maxVal($desc,20)){
        $errors[]="Please enter description smaller than 20";
    }
    if(empty($errors)){
        $sql="UPDATE `categories` SET `name`='$categoryname',`description`='$desc' WHERE `id`='$id'";
        $result=mysqli_query($conn,$sql);
        $_SESSION['success']="Updated Successfully";
        
        header("location:../../Category/index.php");
    }else{
        $_SESSION['error']=$errors;
        header("location:../../Category/edit.php");
        die;
        
    }
   
}else{
    header("location:../../Category/index.php");
}