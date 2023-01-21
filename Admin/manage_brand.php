<?php
ob_start();
include("top.php");
$msg="";
$brand_name="";
$brand_image="";
if(isset($_GET["id"])){
  $id = get_safe_value($con,$_GET["id"]);
  
$row = $curd->select("brands","*",["id"=>$id]);
$brand_image = $row[0]["image"];
$brand_name= $row[0]["name"];

}
if (isset($_POST["submit"])) {


/*** image upload ***/
if ($_FILES["image"]["name"] != "") {
 
 $file_name = $_FILES["image"]["name"];
 $file_type = $_FILES["image"]["type"];
 $file_tmpname = $_FILES["image"]["tmp_name"];
 $file_size= $_FILES["image"]["size"];
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
     $img = time()."-".$file_name;
    if(empty($error)==true){
      $target = brand_img_path.$img;
      move_uploaded_file($file_tmpname,$target);
    }else{
      foreach ($error as $val){
        $msg .= $val ."<br>";
      }
    }
}else{
  $img = get_safe_value($con,$_POST["old_img"]);
  
}



  
  $brand_name = get_safe_value($con,$_POST["name"]);
  
  /* data update and insert array */
  
  $data = ["name"=>$brand_name,"image"=>$img];
     
  
 $row = $curd->select("brands","*",["name"=>$brand_name]);
 
  if(count($row)>0){
      if(isset($_GET["id"])){
        $msg ="";
      }else{
        $msg .= "Brand Already Exists";
      }
  }
if($msg ==""){
     if(isset($_GET["id"])){
       $update= $curd->update("brands",$data,["id"=>$id]);
        if($update){
         header("location: brands.php");
    
        }
      }else{
       $insert =$curd->insert("brands",$data);
        if($insert){
          
          header("location: brands.php");
        }
      }
}
  
}
?>
      <!-- MAIN CONTENT-->
      <div class="main-content">
        <div class="section__content section__content--p30">
          <div class="container-fluid">
            <div class="row">
                 <h2 class="title-1 m-b-25 col-12">Product Brand

                     </h2>
              <div class="col-lg-12">
                <div class="card">

                  <div class="card-body card-block">
                    <form action="" method="post" enctype="multipart/form-data">
                       <div class="form-group">
                      <label for="name" class=" form-control-label">Brand name</label>
                      <input type="text" id="name" name="name" placeholder="Enter Brand name.." class="form-control" value="<?php echo $brand_name;?>">
                      
                    </div>
                       <div class="form-group">
                      <label for="image" class=" form-control-label">Brand Image</label> <br>
                      <?php if (isset($_GET["id"])) {?>
                      <img  src="<?php echo brand_img_path.$brand_image;?>" width="200px" height="200px;" class="mb-2"/>
                      <?php }?>
                      <input type="file" id="image" name="image" class="form-control">
                      <input type="hidden" value="<?php echo $brand_image;?>" name="old_img" />
                    </div>
                  
                    <div>
                      <button name="submit" type="submit" class="btn btn-lg btn-info btn-block">Submit </button>
                    </div>
                    </form>
                       <div class="form_error_msg text-danger mt-1">
                              <?php echo($msg);?>
                        </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!---- footer section ---->
            <div class="row">
              <div class="col-md-12">
                <div class="copyright">
                  <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                </div>
              </div>
            </div>
            <!---- footer section end ---->
            
          </div>
        </div>
      </div>
      <!-- END MAIN CONTENT-->
<?php
include("footer.php");
?>