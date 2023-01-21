<?php
function pr($arr){
  echo("<pre>");
  print_r($arr);
  echo("</pre>");
}
function prx($arr){
  echo("<pre>");
  print_r($arr);
  echo("</pre>");
  die();
}
function get_safe_value($con,$str){
 $str = mysqli_real_escape_string($con,$str);
 $str = trim($str);
 
 return $str;
}

function url_genrate($parms){
  return implode('&',$parms);
};