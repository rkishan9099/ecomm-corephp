<?php
include("config.php");
include("function.inc.php");
include("curd.php");
//print_r($_POST);
if(isset($_POST["type"]) && $_POST["type"]=="contact"){
  $name=get_safe_value($con,$_POST["name"]);
  $email=get_safe_value($con,$_POST["email"]);
  $mobile=get_safe_value($con,$_POST["phone"]);
  $subject=get_safe_value($con,$_POST["subject"]);
  $msg=get_safe_value($con,$_POST["message"]);
$add_on= date("Y-m-d h:i:s");
if($name=="" || $email =="" || $mobile =="" || $subject == "" || $msg ==""){
  $result=["error"=>"yes","msg"=>"All fields Required"];
}else{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      $data=[
     "name"=>$name,
     "mobile"=>$mobile,
     "email"=>$email,
     "subject"=>$subject,
     "msg"=>$msg,
     "add_on"=>$add_on
    ];
        $insert = insertData($con,"contact",$data);
        if($insert=="done"){
         $result =["error"=>"no" ,"msg"=>"Massage sent... <br>contact to you  soon"];
        }else{
          $result =["error"=>"no","msg"=>"Massage not sent... <br> Try after few moments"];
        }
    } else {
      $result=["error"=>"yes","msg"=>"Enter Valid Email address"];
    }
   
}
echo json_encode($result);
}
?>