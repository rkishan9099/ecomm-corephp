<?php
include("config.php");
function pr($arr) {
  echo ("<pre>");
  print_r($arr);
}
function prx($arr) {
  ("<pre>");
  print_r($arr);
  die();
}

function get_safe_value($con, $str) {
  $str = mysqli_real_escape_string($con, $str);
  $str = trim($str);
  $str = strip_tags($str);
  return $str;
}

function select($con,$table,$where = [], $join = "",$column="",$short="",$col="") {
  $data = [];
  if($column==""){
    $cols= " * ";
  }else{
    $cols = $column;
  }
 $sql = "SELECT $cols FROM  $table  $join";

  if (count($where) > 0) {
    foreach ($where as $key => $val) {
      if($key !=""){
      $arg[] = "$key = '$val' ";
      }else{
        $arg[] = " $val ";
      }
    }
    $arg1 = implode("and ", $arg);
    if ($arg1 != "") {
      $sql .= " Where $arg1";
    }
  }
  if ($short != "" && $col != "") {

    if ($short == "high_to_low") {
      $sql .= " order by $table.$col desc ";
    }
    if ($short == "low_to_high") {
      $sql .= " order by $table.$col asc ";
    }
  }
  $res = mysqli_query($con, $sql) or die("query gggfaild");
  while ($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
  }
  return $data;
}
//pr(select($con,"products"));
//die();

function get_product($con,$short="",$limit="",$offset="",$where=[],$custom_con="",$search="",$price_filter=[]){
  $data=[];
  $sql = "SELECT products.*,categories.id as cat_id ,categories.category_name as cat_name FROM products join categories on products.category_id= categories.id where categories.status=1 and products.p_status=1 ";
  if($custom_con!=""){
    $sql .= " and $custom_con ";
  }
  if(count($where)>0){
    foreach ($where as $key=>$val){
      $arg[]= " $key = '$val' ";
    }
     $arg = implode(" and ",$arg);
     $sql .= " and $arg ";
  }
  if($search != ""){
    $sql .= " and products.name LIKE '%$search%' or products.short_desc LIKE '%$search%' or products.desc LIKE '%$search%' or category_name LIKE '%$search%' ";
  }
  if(count($price_filter)==2){
    $min= $price_filter["min"];
    $max=$price_filter["max"];
    $sql .= " and products.price BETWEEN $min AND $max ";
  }
  if($short != ""){
    if($short=="new"){
      $short_by= " products.id desc ";
    }else if($short=="old"){
      $short_by = " products.id asc ";
    }else if($short=="price_asc"){
      $short_by = " products.price asc ";
    }else if($short=="price_desc"){
      $short_by = " products.price desc ";
    }else if($short="ratting_high"){
      $short_by="products.product_ratting desc ";
    }
    $sql .= " order by  $short_by ";
  }
  if($limit!=""){
      if($offset!=""){
      $sql .= " LIMIT $offset,$limit ";
      }else{
      $sql .= " LIMIT $limit ";
      }
    }
  $res= mysqli_query($con,$sql) or die("query faild");
  if(mysqli_num_rows($res)>0){
    while($row= mysqli_fetch_assoc($res)){
      $data["products"][]=$row;
      $product_id= $row["id"];
      
     $product_multi_img= select($con,"product_images",["products_id"=>$product_id]);
     $data["products_img"][$product_id][]=$product_multi_img;
      
     
    }
    
  }
  return $data;
//  pr($data);
}
//$p=get_product($con,"","","",[],"","");

//pr($p);

function insertData($con,$table,$data){

  $column = array_keys($data);
  $column = implode("`, `",$column);
  $value = implode("', '",$data);
  
  $sql = "INSERT INTO $table (`$column`) VALUES('$value') ";
  
   if(mysqli_query($con,$sql)){
     return "done";
   }else{
     return "failed";
     file_put_contents("error_log.txt",$sql,FILE_APPEND);
   }
}
function updateData($con,$table,$data,$where=[],$custom_con=""){
  foreach ($data as $key => $value){
            $update_column[] = "`$key` = '$value'";
          }
          $update_column = implode(", " ,$update_column);
          $sql= " UPDATE `$table` SET $update_column ";
             if(count($where)>0){
              foreach ($where as $ke => $val){
                $arg[] = " $ke = '$val' ";
              }
              $arg = implode("and ",$arg);
              $sql .= " where $arg ";
              if($custom_con!=""){
               $sql .= " and $custom_con ";
               }
             }
     if(mysqli_query($con,$sql)){
        return true;
      }else{
         return false;
     }
            
}
function deleteData($con,$table,$where,$custom_con=""){
      if(count($where)>0){
         foreach ($where as $key => $val){
            $arg[]= " $key = '$val' ";
          }
          $arg = implode("and ",$arg);
          
          $sql = "DELETE FROM $table WHERE $arg ";
          if($custom_con!=""){
              $sql .= " and $custom_con ";
          }
          if(mysqli_query($con,$sql)){
            return true;
          }else{
            return false;
          }
      }else{
        return("Enter condition");
      }
  }
  
  
  
  
  
  
  
  
  
  function changeCartUserId($con){
    $pid=[];
    $cartUserId=$_SESSION["cart_userId"];
    $loginId=$_SESSION["userid"];
   $nonregcartdata= select($con, "cart",["user_id"=>$cartUserId]);
   $logincartdata=select($con, "cart",["user_id"=>$loginId]);
   $data= ["account_type"=>"Register","user_id"=>$loginId];
  $where=["user_id"=>$cartUserId];
   foreach ($logincartdata as $list ){
     $pid[]=$list["product_id"];
   }
   if(count($pid)>0){
    $not_insert_pid= implode(",",$pid);
    $update_data_con= " product_id NOT IN ($not_insert_pid) ";
    $delete_con= " product_id IN ( $not_insert_pid ) ";
     $delet=deleteData($con,"cart",$where ,$delete_con);
    }
    
    $update=updateData($con,"cart",$data,$where,$update_data_con);
    
    
     return "";
  }
 // changeCartUserId($con);
  
  /**** get cart item ***/
  function getcartitem($con){
  $data=[];
  if (isset($_SESSION["login"]) && isset($_SESSION["userid"]) && $_SESSION["login"] == true) {
    $uid = $_SESSION["userid"];
  } else {
    if (isset($_SESSION["cart_userId"])) {
      $uid = $_SESSION["cart_userId"];
    } 
  }
  $join = " LEFT JOIN products on cart.product_id = products.id ";
    $column = " products.name, products.id, products.price, products.image, cart.cart_qty,cart.cart_id";
    $cart_product = select($con, "cart", ["user_id" => $uid], $join, $column);
    $cart_total=0;
    foreach ($cart_product as $list){
      $data["product"][]=$list;
      $cart_total=$cart_total+ ($list["price"]*$list["cart_qty"]);
    }
    $data["cart_total"]=$cart_total;
    return $data;
    
}

 function productSellQty($con,$pid){
   $sql = "select  sum(order_details.product_qty) as qty from order_details LEFT join orders on order_details.oid = orders.order_id  where pid= $pid";
   $res=mysqli_query($con,$sql) or die("query failed");
   $row= mysqli_fetch_assoc($res);
   if($row["qty"]!=""){
   return $row["qty"];
   }else{
     return 0;
   }
 }
 
 function getproductRatting($con,$pid){
   $data=[];
  $data=select($con, "review",  ["pid"=>$pid,"status"=>1], "","ratting");
  $ratting =0;
  if(count($data)>0){
    foreach ($data as $rate){
     $ratting = $ratting + $rate["ratting"];
    }
    return ["ratting"=>($ratting/ count($data)), "count"=>count($data)];
  }else{
    return ["ratting"=>0, "count"=>0];
  }
  
 
 }
 
 
 
/*********** Google SMTP ******/
function send_email($email,$subject,$data){
  include('smtp/PHPMailerAutoload.php');
  $mail=new PHPMailer(true);
  $mail->isSMTP();
  //$mail->SMTPDebug = 2;
  $mail->Host = "smtp.gmail.com";
  $mail->SMTPAuth = true;
  
  // But you can comment from here
    $mail->SMTPSecure = "tls";
   $mail->Port = 587;
    $mail->CharSet = "UTF-8";
  	$mail->Username="kishanramani9099@gmail.com";
  	$mail->Password="rk4you9099@@";
  	$mail->SetFrom("kishanramani9099@gmail.com");
  	$mail->addAddress($email);
  	$mail->IsHTML(true);
  	$mail->Subject=$subject;
  	$mail->Body=$data;
  	$mail->SMTPOptions=array('ssl'=>array(
  		'verify_peer'=>false,
  		'verify_peer_name'=>false,
  		'allow_self_signed'=>false
  	));
  	if($mail->send()){
  return true;
  	}else{
  	return false;
  	}


}
//$html='88888';
/*$s=send_email("rkishan9099@gmail.com","test","<h1>hello world</h1>");
if($s){
  echo("send");
}else{
  echo("failed");
}
//pr($_SERVER);
*/

?>
