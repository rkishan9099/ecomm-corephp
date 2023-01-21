<?php
include("config.php");
include("function.inc.php");
include("database.php");

if(isset($_POST["type"]) && $_POST["type"]=="img"){
 echo $id = get_safe_value($con,$_POST["id"]);
 $row = $curd->select("product_images","*",["id"=>$id]);
 
 if(count($row)>0){
 $image = $row[0]["images"];
  $target= product_img_path.$image;
  unlink($target);
        $delete= $curd->delete("product_images",["id" =>$id]);
  echo("done");
 }
}




if(isset($_POST["type"]) && $_POST["type"]=="attr"){
 echo $id = get_safe_value($con,$_POST["id"]);
 $row = $curd->select("products_attr","*",["id"=>$id]);
 
 if(count($row)>0){
 $image = $row[0]["attr_image"];
  $target= product_attr_path.$image;
  unlink($target);
        $delete= $curd->delete("products_attr",["id" =>$id]);
  echo("done");
 }
}
?>