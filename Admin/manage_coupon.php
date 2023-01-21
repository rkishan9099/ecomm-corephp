<?php
ob_start();
include("top.php");
$msg="";
$coupan_code ="";
$coupan_val ="";
$coupan_type="";
$cart_min_val="";
$coupan_title="";
$coupan_use="";
if(isset($_GET["id"])){
  $id = get_safe_value($con,$_GET["id"]);
$row = $curd->select("coupons","*",["id"=>$id]);
$coupan_title = $row[0]["title"];
$coupan_code = $row[0]["code"];
$coupan_type = $row[0]["type"];
$coupan_val = $row[0]["value"];
$cart_min_val = $row[0]["min_order_amt"];
$coupan_use = $row[0]["is_one_time"];
}
if (isset($_POST["submit"])) {
 // pr($_POST);
  $coupan_title= get_safe_value($con,$_POST["title"]);
  $coupan_code = get_safe_value($con,$_POST["code"]);
  $coupan_val = get_safe_value($con,$_POST["value"]);
  $coupan_type= get_safe_value($con,$_POST["type"]);
  $cart_min_val= get_safe_value($con,$_POST["min_order_amt"]);
  $coupan_use = get_safe_value($con,$_POST["is_one_time"]);
  
  /* data update and insert array */
  
  $data = [
           "title"=>$coupan_title,
           "code"=>$coupan_code,
           "value"=>$coupan_val,
           "type"=>$coupan_type,
           "min_order_amt"=>$cart_min_val,
           "is_one_time"=>$coupan_use
           ];
   /* where condition arry */        
  $where = ["code"=>$coupan_code,"type"=>$coupan_type,"value"=>$coupan_val];
  
 $row = $curd->select("coupons","*",$where);
 
  if(count($row)>0){
      if(isset($_GET["id"])){
        $msg ="";
      }else{
        $msg = "Coupon Already Exists";
      }
  }
if($msg ==""){
     if(isset($_GET["id"])){
        $update= $curd->update("coupons",$data,["id"=>$id]);
        if($update){
         header("location: coupon.php");
    
        }
      }else{
        $insert =$curd->insert("coupons",$data);
        if($insert){
          echo("insert");
          header("location: coupon.php");
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
                 <h2 class="title-1 m-b-25 col-12">Product Coupon</h2>
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <strong>Coupon</strong>
                    <small> Form</small>
                  </div>
                  <div class="card-body card-block">
                    <form action="" method="post">
                       <div class="form-group">
                      <label for="coupan_title" class=" form-control-label">Coupan Title</label>
                      <input type="text" id="coupan_title" name="title" placeholder="Enter coupan title.." class="form-control" value="<?php echo $coupan_title;?>">
                      
                    </div>
                    <div class="form-group">
                      <label for="coupon_code" class=" form-control-label">Coupon Code</label>
                      <input type="text" id="coupon_code" name="code" placeholder="Enter coupon code.." class="form-control" value="<?php echo $coupan_code;?>">
                      
                    </div>
                       <div class="form-group">
                      <label for="coupan_val" class=" form-control-label">Coupan value</label>
                      <input type="text" id="coupan_val" name="value" placeholder="Enter Coupon value.." class="form-control" value="<?php echo $coupan_val;?>">
                      
                    </div>
                    <div class="form-group">
                      <label for="coupan_val" class=" form-control-label">Coupan Type</label>
                      <select name="type" class="form-control">
                        <option value="value">Value</option>
                        <option value="pre">Presentage</option>
                      </select>
                      
                    </div>
                    <div class="form-group">
                      <label for="cart_min_val" class=" form-control-label">Min cart amount</label>
                      <input type="text" id="cart_min_val" name="min_order_amt" placeholder="Enter min cart Amount.." class="form-control" value="<?php echo $cart_min_val;?>">
                      
                    </div>
                        <div class="form-group">
                      <label for="category" class=" form-control-label">Type number of use</label>
<select name="is_one_time" class="form-control">
  <option value="1">One time</option>
  <option value="0" >Multiple time</option>
</select>
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