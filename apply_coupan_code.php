<?php
include("config.php");
include("function.inc.php");
if(isset($_POST['code'])){
  //pr($_POST);
 $coupan_code=get_safe_value($con,$_POST["code"]);
$cartItem=getcartitem($con);
$cart_total=$cartItem["cart_total"];
$coupandata=select($con,"coupons",["code"=>$coupan_code]);
$final_price=$cart_total;
if(count($coupandata)>0){
 $coupan_value=$coupandata[0]["value"];
  $coupan_type=$coupandata[0]["type"];
  $min_order_amt=$coupandata[0]["min_order_amt"];
  $is_one_time=$coupandata[0]["is_one_time"];
  $status=$coupandata[0]["status"];
  if($status==1){
    
    if($cart_total>=$min_order_amt){
      if($coupan_type=="value"){
         $final_price=$cart_total- $coupan_value;
         $dd=$coupan_value;
      }
      if($coupan_type=="pre"){
        $final = ($coupan_value /100 ) * $cart_total;
        $final_price=$cart_total- $final;
        $dd=$cart_total - $final_price;
      }
      $msg="Coupon Applied Successful ";
      $erorr="no";
    }else{
    $msg="Coupon Apply to your order value is $min_order_amt";
    $erorr="yes";
  
    }
  }else{
    $msg="Coupon code Expired ";
    $erorr="yes";
    
  }
}else{
  $msg="Enter valid Coupon code ";
  $erorr="yes";
  
}
//pr($coupandata);
$result=["error"=>$erorr, "msg"=>$msg,"discount"=>$dd,"final_price"=>$final_price,"coupon"=>$coupan_code];
echo(json_encode($result));
}

?>