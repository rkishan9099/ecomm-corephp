<?php
include("config.php");
include("function.inc.php");

//pr($_POST);
if(isset($_POST["payment_option"])){
  
  $fname=get_safe_value($con,$_POST["fname"]);
  $lname=get_safe_value($con,$_POST["lname"]);
  $country=get_safe_value($con,$_POST["country"]);
  $state=get_safe_value($con,$_POST["state"]);
  $city=get_safe_value($con,$_POST["city"]);
  $billing_address=get_safe_value($con,$_POST["billing_address"]);
  $billing_address2=get_safe_value($con,$_POST["billing_address2"]);
  $address=$billing_address ."\n" .$billing_address2;
  $zipcode=get_safe_value($con,$_POST["zipcode"]);
  $phone=get_safe_value($con,$_POST["phone"]);
  $email=get_safe_value($con,$_POST["email"]);
  $final_price=get_safe_value($con,$_POST["final_price"]);
  $coupon_code=get_safe_value($con,$_POST["coupon_code"]);
  $coupon_value=get_safe_value($con,$_POST["coupon_value"]);
  $payment_option=get_safe_value($con,$_POST["payment_option"]);
  $add_on= date("Y-m-d h:i:s");
  
  
  $cartItem=getcartitem($con);
  $total_price=$cartItem["cart_total"];
  if(isset($_SESSION["login"]) && $_SESSION["login"]===true){
      $uid=$_SESSION["userid"];
      
      $data=[
        "uid"=>$uid,
        "fname"=>$fname,
        "lname"=>$lname,
        "mobile"=>$phone,
        "email"=>$email,
        "country"=>$country,
        "state"=>$state,
        "city"=>$city,
        "address"=>$address,
        "pincode"=>$zipcode,
        "total_price"=>$total_price,
        "final_price"=>$final_price,
        "coupons_code"=>$coupon_code,
        "coupon_value"=>$coupon_value,
        "payment_method"=>$payment_option,
        "payment_id"=>"",
        "payment_status"=>"pending",
        "order_status"=>1,
        "add_on"=>$add_on
        ];
        
 $insert=insertData($con,"orders",$data);
 
 if($insert=="done"){
   $order_id= mysqli_insert_id($con);
   $_SESSION["order_id"]=$order_id;
    foreach ($cartItem["product"] as $list){
       $pid=$list["id"];
       $price=$list["price"];
       $product_qty=$list["cart_qty"];
       $list_data=["oid"=>$order_id,"pid"=>$pid,"product_price"=>$price,"product_qty"=>$product_qty];
       $insert_order_details=insertData($con,"order_details",$list_data);
       if($insert_order_details=="done"){
         $status="success";
         $msg="Place order Successful";
       }else{
         $status="faild";
         $msg="Try after Few moments";
       }
    }
    if($status=="success"){
      $cartEmpty= deleteData($con,"cart",["user_id"=>$uid]);
    }
 }else{
  $status="faild";
  $msg="Try after Few moments ";
 }
      
      
      
      
   }else{
     /*****" generate password *****/
      $bytes= random_bytes(5);
      $pass=bin2hex($bytes);
      $status="faild";
  $msg="please login than your orders";
   }
  
  
// pr($cartItem);
 $result=["msg"=>$msg,"status"=>$status];
 echo(json_encode($result));
}
?>