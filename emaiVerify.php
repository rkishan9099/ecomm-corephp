<?php
include("function.inc.php");
include("config.php");
if(isset($_GET["t"]) && $_GET["t"]!=""){
  $token= get_safe_value($con,$_GET["t"]);
  $where=["emailToken"=>$token];
  $userdata= select($con,"users",$where);
  if(count($userdata)>0){
  $update=updateData($con,"users",["emaiVerify"=>1],["emailToken"=>$token]);
  $_SESSION["login"]=true;
  $_SESSION["userid"]=$userdata[0]["uid"];
  $_SESSION["fname"]=$userdata[0]["fname"];
  $_SESSION["lname"]=$userdata[0]["lname"];
 unset($_SESSION["email_verify"]);
 if($update){
   header("location:index.php");
 }
  }

}

?>