<?php 
include("config.php");
include("function.inc.php");
include("database.php");

if(isset($_POST["sku"]) && $_POST["sku"] != ""){
 $sku = get_safe_value($con,$_POST["sku"]);
$row= $curd->select("products_attr","*",["sku"=>$sku]);
  if(count($row)==0){
    echo("valid");
  }else{
    echo("invalid");
  }
}
?>