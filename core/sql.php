<?php
function createDatabase($host,$user,$password,$databasename){
    $link=mysqli_connect($host,$user,$password);
    if(!$link){
        die("Error: ".mysqli_connect_error());
    }
    if(!mysqli_select_db($link,$databasename)){
        $sql1="CREATE DATABASE $databasename";
        if(mysqli_query($link,$sql1)){
            $link=mysqli_connect($host,$user,$password,$databasename);
            echo "Database Created Successfully";
            echo "<br>";
            $sql2="CREATE TABLE `categories` (
                `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `name` VARCHAR(20),
                `description` VARCHAR(100)
            );";
            if(mysqli_query($link,$sql2)){
                echo "Categories Table Created Successfully";
                echo "<br>";
            }else{
                echo "Error during creating Categories Table".mysqli_error($link);
            }
            $sql3="CREATE TABLE `products` (
                `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `name` VARCHAR(20),
                `img` VARCHAR(100),
                `categoryId` INT,
                FOREIGN KEY (categoryId) REFERENCES categories(id)
            );";
        if(mysqli_query($link,$sql3)){
        echo "Products Table Created Successfully";
        echo "<br>";
        }else{
        echo "Error during creating Products Table".mysqli_error($link);
}
        }
    }else{
        echo "Error during creating Database".mysqli_error($link);
    }
}