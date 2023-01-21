<?php
include("config.php");
include("function.inc.php");

if (isset($_POST["type"]) && $_POST["type"] == "emailVerify" && isset($_POST["email"])) {
  //pr($_POST);
  $email = get_safe_value($con, $_POST["email"]);
  $emailToken = bin2hex(random_bytes(15));
  $userdata = select($con, "users", ["email" => $email]);
  // pr($userdata);
  if (count($userdata) > 0) {
    $update = updateData($con, "users", ["emailToken" => $emailToken], ["email" => $email]);
    $html = '<div>
            hello..<br>
           <p><strong>'.$fname.' '.$lname.' </strong> Verify your account to click to the verify button</p> <br />
                  <br />
                <a href="'.site_url.'emaiVerify.php?t='.$emailToken.'" style="text-decoration:none; font-size:20px; font-weight:600;display:inline-block; border-radius:5px; padding:10px 30px; color:#fff; background:blue;">Click To Verify</a>
                </div>';
    $email_send = send_email($email, "Account verification", $html);
    if ($email_send) {
        $email_msg = "Please check your inbox.";
       $result=["error"=>"no","msg"=>$email_msg];
    } else {
        $email_msg = "Email not send try few moments after";
        $result=["error"=>"yes","msg"=>$email_msg];
    }
  }
echo(json_encode($result));
}
?>