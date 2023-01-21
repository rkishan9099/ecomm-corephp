<?php
ob_start();
include("top.php");
$msg="";
$size="";
if(isset($_GET["id"])){
  $id = get_safe_value($con,$_GET["id"]);
  
$row = $curd->select("sizes","*",["id"=>$id]);
$size = $row[0]["size"];

}
if (isset($_POST["submit"])) {

  
  $size = get_safe_value($con,$_POST["size"]);
  
  /* data update and insert array */
  
  $data = ["size"=>$size];
     
  
 $row = $curd->select("sizes","*",$data);
 
  if(count($row)>0){
      if(isset($_GET["id"])){
        $msg ="";
      }else{
        $msg = "Size Already Exists";
      }
  }
if($msg ==""){
     if(isset($_GET["id"])){
        $update= $curd->update("sizes",$data,["id"=>$id]);
        if($update){
         header("location: sizes.php");
    
        }
      }else{
        $insert =$curd->insert("sizes",$data);
        if($insert){
          
          header("location: sizes.php");
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
                 <h2 class="title-1 m-b-25 col-12">Product Size

                     </h2>
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <strong>Size</strong>
                    <small> Form</small>
                  </div>
                  <div class="card-body card-block">
                    <form action="" method="post">
                       <div class="form-group">
                      <label for="size" class=" form-control-label">Color name</label>
                      <input type="text" id="size" name="size" placeholder="Enter Size.." class="form-control" value="<?php echo $size;?>">
                      
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