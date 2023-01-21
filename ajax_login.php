<?php
include("config.php");
include("function.inc.php");
//pr($_POST);
if (isset($_POST["type"]) && $_POST["type"] == "login") {
  $email = get_safe_value($con, $_POST["email"]);
  $password = get_safe_value($con, $_POST["password"]);

  if (($email != "" || $password != "") && ($password != "" && $email != "")) {

    // checking the valid email address
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

      /// get data from database by email in users table
      $user = select($con, "users", ["email" => $email]);
              if (count($user) > 0) {
                  //pr($user);
                   $hash_pass = $user[0]["password"];
                  if (password_verify($password, $hash_pass)) {
                      $_SESSION["login"]=true;
                      $_SESSION["userid"]=$user[0]["uid"];
                      $_SESSION["fname"]=$user[0]["fname"];
                      $_SESSION["lname"]=$user[0]["lname"];
                      
                      if (isset($_SESSION["cart_userId"])) {
                      changeCartUserId($con);
                      unset($_SESSION["cart_userId"]);
                      }
                      $msg = "Successful login";
                      $error = "no";
                      //remember me functionality
  if (isset($_POST["rememberMe"])) {
    setcookie("login_email", $email, time() + (86400 * 30*12), "/"); 
    setcookie("login_pass", $password, time() + (86400 * 30*12), "/"); 
  }else{
    if(isset($_COOKIE["login_pass"]) && $_COOKIE["login_email"]){
      setcookie("login_email", $email, time() - 3600, "/"); 
     setcookie("login_pass", $password, time() - 3600, "/"); 
    }
  }
                  } else {
                    $msg = "Enter Correct password";
                    $error = "yes";
                  }
              } else {
                $msg = "Enter valid email";
                $error = "yes";
              }
    } else {
      $msg = "Enter valid email";
      $error = "yes";
    }

} else {
    $error = "yes";
    $msg = "All fields required";
}
  

  $result = ["error" => $error,
    "msg" => $msg];
  echo json_encode($result);
}
?>