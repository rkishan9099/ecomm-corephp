<?php
ob_start();
include("top.php");
$data = $curd->select("coupons","*");
/* update category status */
if(isset($_GET["id"])){
  $id = get_safe_value($con,$_GET["id"]);
}
  if(isset($_GET["type"])){
    $method = get_safe_value($con,$_GET["method"]);

      if($method=="activate"){
      $status = 1;
      }
      if($method=="deactivate"){
       $status = 0;
      }
      $update = $curd->update("coupons",["status"=>$status],["id"=>$id]);
      if($update){
        header("location: coupon.php");
      }
      if($method == "delete"){
        $delete= $curd->delete("coupons",["id" => $id]);
      if($delete){
        header("location: coupon.php");
      }else{
        echo("faild");
      }
        
      }
    }
  


?>
<!-- MAIN CONTENT-->
 <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                          
                            <div class="col-12">
                                <h2 class="title-1 m-b-25">Coupons</h2>
                       
                                    <a class="au-btn au-btn-icon au-btn--blue mb-3 text-light" href="manage_coupon.php">
                                        <i class="zmdi zmdi-plus"></i>Add coupon</a>

                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Sir no</th>
                                               
                                                <th>Coupon Code</th>
                                                <th>Coupon value</th>
                                                <th>Coupon Type</th>
                                                <th>Min Amount</th>
                                                <th></th>
                                           
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                          $i =1;
                                          foreach ($data as $row){
                                            
                                          ?>
                                            <tr class="text-right">
                                              <td><?php echo $i;?></td>
                    <td><?php echo($row["code"]);?></td>
                    <td><?php echo($row["value"]);?></td>
                    <td><?php echo($row["type"]);?></td>
                    <td><?php echo($row["min_order_amt"]);?></td>
                                                <td>
                                        <?php 
                                        if($row["status"]==1){
              echo( '<a href="coupon.php?id='.$row["id"].'&type=operation &method=deactivate" class="btn mb-sm-1 btn-success">Active</a>');
                                        }else{
                 echo( '<a href="coupon.php?id='.$row["id"].'&type=operation&method=activate" class="btn mb-sm-1 btn-warning">Deactive</a>');
                                        }
                                        ?>
          <a href="manage_coupon.php?id=<?php echo $row["id"];?>" class="btn btn-primary mb-sm-1 text-light">Edit</a>
            <a href="coupon.php?id=<?php echo $row['id'];?>&type=operation&method=delete" class="btn btn-danger text-light">Delete</a>
                                           </td>
                                           
                                            </tr>
                                       <?php  $i++;}?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                       
                        </div>
                    </div>
                </div>
   </div>
 <!-- END MAIN CONTENT-->
<?php
include("footer.php");
?>