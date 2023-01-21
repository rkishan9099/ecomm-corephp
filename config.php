<?php
ob_start();
$host="localhost";
$user="root";
$password="";
$database= "ecom";
$con = mysqli_connect($host,$user,$password,$database) or die("connection failed");
if(!session_id()){
  session_start();
}
define("category_img_path","Admin/media/category/");

define("brand_img_path","Admin/media/brand/");
define("banner_img_path","Admin/media/banner/");

define("product_path","Admin/media/product/");
define("product_attr_path","Admin/media/product_attr/");
define("product_img_path","Admin/media/product_img/");
define("site_url","http://localhost:8000/New%20Ecommerce/");
ob_clean();
?>