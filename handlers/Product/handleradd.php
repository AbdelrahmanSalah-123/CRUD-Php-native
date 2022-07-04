<?php
include "../../core/validation.php";
include "../../core/connect.php";
session_start();

if(isset($_POST['submit'])&& $_SERVER['REQUEST_METHOD']=="POST"){
    $errors=[];
    $name=trim(htmlspecialchars($_POST['name']))??"";
    $categoryid=$_POST['selection'];
    //product image
    $imgName=$_FILES['img']['name'];
    $imgType=$_FILES['img']['type'];
    $imgTemp=$_FILES['img']['tmp_name'];
    $imgSize=$_FILES['img']['size'];
    $allowedExt=["jpeg","jpg","png","gif"];
    $explodes=explode(".",$imgName);
    $imgExt=strtolower(end($explodes));
    //validation
    if(required($name)){
        $errors[]="Please enter Category Name";
    }else if(!minVal($name,3)){
        $errors[]="Please enter Category Name greater than 3";
    }else if(!maxVal($name,20)){
        $errors[]="Please enter Category Name smaller than 20";
    }
    if(required($imgName)){
        $errors[]="Please Enter Image";
    }else if(!in_array($imgExt,$allowedExt)){
        $errors[]="This Extension is not allowed";
    }else if($imgSize>5242880){
        $errors[]="The Image is very big";
    }
    if(empty($errors)){
        $img=time()."_".$imgName;
        move_uploaded_file($imgTemp,"../../uploads/images/Product/".$img);
        $sql="INSERT INTO `products`(`name`,`img`) VALUES('$name','$img')";
        $result=mysqli_query($conn,$sql);
        $_SESSION['success']="Added Successfully";
        header("location:../../Product/index.php");
    }else{
        $_SESSION['error']=$errors;
        header("location:../../Product/add.php");
        die;
        
    }

}else{
    header("location:../../Category/index.php");
}