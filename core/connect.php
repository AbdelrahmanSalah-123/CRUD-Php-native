<?php
//include_once "sql.php";
$hostname="localhost";
$username="root";
$password="";
$databasename="demo";
//createDatabase($hostname,$username,$password,$databasename);
$conn=mysqli_connect($hostname,$username,$password,$databasename);
if(!$conn){
    die("Error: ".mysqli_connect_error());
}
