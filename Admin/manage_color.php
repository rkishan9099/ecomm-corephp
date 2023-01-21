<?php
ob_start();
include("top.php");
$msg="";
$color_name="";
$color_code="";
if(isset($_GET["id"])){
  $id = get_safe_value($con,$_GET["id"]);
  
$row = $curd->select("colors","*",["id"=>$id]);

$color_name = $row[0]["color"];
$color_code = $row[0]["color_code"];

}
if (isset($_POST["submit"])) {
 pr($_POST);
  
  $color_name= get_safe_value($con,$_POST["color"]);
  $color_code = get_safe_value($con,$_POST["color_code"]);
  
  /* data update and insert array */
  
  $data = [
           "color"=>$color_name,
           "color_code"=>$color_code
           ];
     
  
 $row = $curd->select("colors","*",$data);
 
  if(count($row)>0){
      if(isset($_GET["id"])){
        $msg ="";
      }else{
        $msg = "Color Already Exists";
      }
  }
if($msg ==""){
     if(isset($_GET["id"])){
        $update= $curd->update("colors",$data,["id"=>$id]);
        if($update){
         header("location: colors.php");
    
        }
      }else{
        $insert =$curd->insert("colors",$data);
        if($insert){
          
          header("location: colors.php");
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
                 <h2 class="title-1 m-b-25 col-12">Product Color
                 <?php if(isset($_GET["id"])){ ?>
                     <div class="color border border-dark" style="background:<?php echo $color_code;?>"></div>
                     <?php } ?>
                     </h2>
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <strong>Color</strong>
                    <small> Form</small>
                  </div>
                  <div class="card-body card-block">
                    <form action="" method="post">
                       <div class="form-group">
                      <label for="color_name" class=" form-control-label">Color name</label>
                      <input type="text" id="coupan_title" name="color" placeholder="Enter color name.." class="form-control" value="<?php echo $color_name;?>">
                      
                    </div>
                    <div class="form-group">
                      <label for="coupon_code" class=" form-control-label">Coupon Code</label>
                      <input type="text" id="coupon_code" name="color_code" placeholder="Enter color code.." class="form-control" value="<?php echo $color_code;?>">
                      
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