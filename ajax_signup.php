<?php
include("config.php");
include("function.inc.php");
if(isset($_POST["type"]) && $_POST["type"]=="signup"){
  $add_on= date("Y-m-d h:i:s");
  //pr($_POST);
  $fname= get_safe_value($con,$_POST["fname"]);
  $lname= get_safe_value($con,$_POST["lname"]);
  $mobile= get_safe_value($con,$_POST["mobile"]);
  $email= get_safe_value($con,$_POST["email"]);
  $password= get_safe_value($con,$_POST["password"]);
  $has_pass= password_hash($password, CRYPT_BLOWFISH);
  $confirmpassword= get_safe_value($con,$_POST["confirmpassword"]);
  if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $email_exist=select($con, "users",["email"=>$email]);
    $mobile_exist=select($con, "users",["mobile"=>$mobile]);
    if(count($mobile_exist)>0){
      $result=["error"=>"yes","msg"=>"Mobile number already exists"];
    }else if(count ($email_exist)>0){
      $result=["error"=>"yes","msg"=>"Email address already exists"];
    }else{
           $emailToken= bin2hex(random_bytes(15));
           $mobileOTP= rand(11111,99999);
           $data=[
                 "fname"=>$fname,
                 "lname"=>$lname,
                 "mobile"=>$mobile,
                 "email"=>$email,
                 "emaiVerify"=>0,
                 "mobileVerify"=>0,
                 "emailToken"=>$emailToken,
                 "mobileOTP"=>$mobileOTP,
                 "password"=>$has_pass,
                 "add_on"=>$add_on
                ];
                $insert=insertData($con,"users",$data);
               // $uid= mysqli_insert_id($con);
             if($insert=="done"){
               //email sending for email verification 
                $html='<div>
                  hello..<br>
                 <p><strong>'.$fname.' '.$lname.' </strong> Verify your account to click to the verify button</p> <br />
                  <br />
                <a href="'.site_url.'emaiVerify.php?t='.$emailToken.'" style="text-decoration:none; font-size:20px; font-weight:600;display:inline-block; border-radius:5px; padding:10px 30px; color:#fff; background:blue;">Click To Verify</a>
                </div>';
              $email_send= send_email($email,"Account verification",$html);
                if($email_send){
                  $email_msg="Verify your email";
                  $_SESSION["email_verify"]=$email;
                }else{
                  $email_msg="";
                }
                 $result =["error"=>"no" ,"msg"=>"Register successful <br>$email_msg"];
                }else{
                  $result =["error"=>"no","msg"=>"Try after few moments"];
                }
            } 
   }else{
     $result=["error"=>"yes","msg"=>"Enter valid email address"];
   }
  
   echo(json_encode($result));
}
?>