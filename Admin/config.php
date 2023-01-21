<?php
ob_start();
$host="localhost";
$user="root";
$password="";
$database= "ecommerce";
$con = mysqli_connect($host,$user,$password,$database) or die("connection failed");

define("category_img_path","media/category/");

define("brand_img_path","media/brand/");
define("banner_img_path","media/banner/");

define("product_path","media/product/");


if(session_id()){
  echo(999);
}else{
  session_start();
}
ob_clean();
?>