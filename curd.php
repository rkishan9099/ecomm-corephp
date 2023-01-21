<?php
include("config.php");
class curd {
  
 private $host = "localhost:3306";
 private $user="root";
 private $pass="root";
 private $db="ecom";
 private $con = "";

    public function __construct(){
      $this->con = mysqli_connect($this->host,$this->user,$this->pass,$this->db) or die("faild");
  
    }
    
    public  function tableExist($table){
        $sql = "SHOW TABLES FROM ecom LIKE '$table'";
        $res = mysqli_query($this->con,$sql) or die("queries faild");
        if(mysqli_num_rows($res)>0){
         return true;
        }else{
          return false;
        }
      }
      
    public  function select($table,$row="*",$where=[],$join=""){
        $data= array();
         if($this->tableExist($table)){
           $sql = "SELECT $row FROM $table ";
           if($join !=""){
            $sql .= " $join ";
           }
           if(count($where)>0){
             foreach ($where as $key => $value){
               $arg[] = "$key = '$value'";
             }
             $arg = implode("and ",$arg);
          $sql .= " where $arg ";
           }
           $res = mysqli_query($this->con,$sql) or die("qhjsjsnsn");
          while($row = mysqli_fetch_assoc($res)){
             $data[]=$row;
           }
         return $data;
         }else{
           echo("no");
         }
      }
      
    public  function insert($table,$data){
        if($this->tableExist($table)){
          $column = array_keys($data);
          $column = implode("`, `",$column);
          
          $value = implode("', '",$data);
   echo $sql = "INSERT INTO $table (`$column`) VALUES('$value')";
         if(mysqli_query($this->con,$sql)){
           return array("inser_id"=>mysqli_insert_id($this->con));
           
         }else{
           return false;
         }
        }else{
          return false;
        }
      }
      
    public  function update($table,$data,$where){
        if($this->tableExist($table)){
          
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
             }
             if(mysqli_query($this->con,$sql)){
               return true;
             }else{
               return false;
             }
        }else{
          return false;
        }
      }
      
    public  function delete($table,$where){
        if($this->tableExist($table)){
          foreach ($where as $key => $val){
            $arg[]= " $key = '$val' ";
          }
          $arg = implode("and ",$arg);
          $sql = "DELETE FROM $table WHERE $arg ";
          if(mysqli_query($this->con,$sql)){
            return true;
          }else{
            return false;
          }
        }else{
          return false;
        }
      }


}
$curd = new curd();
/*
$arr=["color_code"=>"rk","color"=>"rk"];
$insert = $curd->select("colors","*",[]);
echo("<pre>");
print_r($insert);

$insert1 = $curd->select("brands","*",[]);
echo("<pre>");
print_r($insert1);

$inser1 = $curd->select("categories","*",[]);
echo("<pre>");
print_r($inser1);*/





function file_upload($path,$file_name,$file_type,$file_size,$tmp_name){
  
    $fle_exp= explode(".",$file_name);
    $file_extention= end($fle_exp);
    $all_ext = ["jpg","png","jpeg","gif"];
    $error = array();
    if(in_array($file_extention,$all_ext) == false){
      array_push($error,"Only jpeg, png, jpg and gif file should be uploaded");
    }
    if($file_size>3145728){
      array_push($error,"file size less than 3mb");
    }
     $img = time().$file_name;
    if(empty($error)==true){
      $target = $path.$img;
     $upload= move_uploaded_file($tmp_name,$target);
     if($upload){
      $error[]=["msg"=>"done"];
      $error[]=["img"=>$img];
     }else{
       $error[]="faild";
     }
      
    }
    return $error;
}




?>
