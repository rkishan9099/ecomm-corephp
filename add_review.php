<?php
include("config.php");
include("function.inc.php");
if (isset($_POST["type"]) && $_POST["type"] == "review") {
  //pr($_POST);
  $ratting = get_safe_value($con, $_POST["ratting"]);
  $msg = get_safe_value($con, $_POST["message"]);
  $name = get_safe_value($con, $_POST["name"]);
  $pid = get_safe_value($con, $_POST["pid"]);
  $email = get_safe_value($con, $_POST["email"]);
  if ($ratting == "") {
    $msg = "Please select 🌟  ";
    $error = "yes";
  } else {
    if ($email != "" && $msg != "" && $name != "" && $ratting != "") {
      if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $add_on = date("Y-m-d h:i:s");
          $uid = $_SESSION["userid"];
          $check_puchese = select($con, "order_details", ["uid" => $uid, "pid" => $pid], " LEFT join orders on order_details.oid = orders.order_id ");
          if (count($check_puchese) > 0) {
            $it_purchese = 1;
          } else {
            $it_purchese = 0;
          }

          $data = ["pid" => $pid,
            "name" => $name,
            "email" => $email,
            "ratting" => $ratting,
            "add_on" => $add_on,
            "msg" => $msg,
            "uid" => $uid,
            "is_purchase" => $it_purchese];
          $insert = insertData($con, "review", $data);
          if ($insert == "done") {
            $rated_product = getproductRatting($con, $pid);
            $product_ratting = $rated_product["ratting"];
            $rated_user = $rated_product["count"];

            $update_ratting = updateData($con, "products", ["product_ratting" => $product_ratting, "rated_user" => $rated_user], ["id" => $pid]);
            $error = "no";
            $msg = "Your Review Submit successful";


          } else {
            $error = "yes";
            $msg = "Try after few moments";
          }
        } else {
          $msg = "Enter valid Email";
          $error = "yes";

        }
      } else {
        $error = "yes";
        $msg = "Please Login than you give product Reviews";
      }
    } else {
      $msg = " All filled are required";
      $error = "yes";
    }
  }
  $result = ["error" => $error,
    "msg" => $msg];
  echo json_encode($result);
}
?>