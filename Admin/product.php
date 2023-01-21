<?php
ob_start();
include("top.php");

/* update category status */
if(isset($_GET["id"])){
  $id = get_safe_value($con,$_GET["id"]);
  $row = $curd->select("products","*",["id"=>$id]);
}
  if(isset($_GET["type"])){
    $method = get_safe_value($con,$_GET["method"]);

      if($method=="activate"){
      $status = 1;
      }
      if($method=="deactivate"){
       $status = 0;
      }
      $update = $curd->update("products",["p_status"=>$status],["id"=>$id]);
      if($update){
        header("location: product.php");
      }
      if($method == "delete"){
        $product_image = $row[0]["image"];

      $target= product_img_path.$product_image;
      unlink($target);
        $delete= $curd->delete("products",["id" => $id]);
      if($delete){
        header("location: product.php");
      }else{
        echo("faild");
      }
        
      }
    }
  

$data = $curd->select("products","*",[]);


?>
<!-- MAIN CONTENT-->
 <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                          
                            <div class="col-12">
                                <h2 class="title-1 m-b-25">Products</h2>
                       
                                    <a class="au-btn au-btn-icon au-btn--blue mb-3 text-light" href="manage_product.php">
                                        <i class="zmdi zmdi-plus"></i>Add Product</a>

                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Sir no</th>
                                               
                                                <th>Product Name</th>
                                                <th>Product Image</th>
                                              
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
                    <td><?php echo($row["name"]);?></td>
                    <td>
        <img src="<?php echo(product_path .$row["image"]);?>">
                      </td>

                                                <td>
                                        <?php 
                                        if($row["p_status"]==1){
              echo( '<a href="product.php?id='.$row["id"].'&type=operation &method=deactivate" class="btn mb-sm-1 btn-success">Active</a>');
                                        }else{
                 echo( '<a href="product.php?id='.$row["id"].'&type=operation&method=activate" class="btn mb-sm-1 btn-warning">Deactive</a>');
                                        }
                                        ?>
          <a href="manage_product.php?id=<?php echo $row["id"];?>" class="btn btn-primary mb-sm-1 text-light">Edit</a>
            <a href="product.php?id=<?php echo $row['id'];?>&type=operation&method=delete" class="btn btn-danger text-light">Delete</a>
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