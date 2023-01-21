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
function select($con){
 $sql = "select * from products";
 $res= mysqli_query($con,$sql) or die("query faild select");
 $count= mysqli_num_rows($res);
 if($count>0){
   while ($row= mysqli_fetch_assoc($res)){
     pr($row);
   }
 }
} 
function select($con, $table, $where = [], $join = "", $short = "", $col = "") {
  $data = [];
 $sql = "SELECT * FROM  $table  $join";

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

//pr(select($con));
function product($con){
  $sql="select * from products ";
  $res= mysqli_query($con,$sql) or die("query faild product");
  $product_count= mysqli_num_rows($res);
  if($product_count>0){
    while($row=mysqli_fetch_assoc($res)){
      $data[]=$row;
    }
  return $data;
  }else {
    return [];
  }
}
$product=product($con);
pr($product);
?>