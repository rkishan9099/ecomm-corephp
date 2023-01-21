<?php
ob_start();
$arr=["id"=>889,"type"=>"delete"];
array_map($arr, function ($current){
  pr($current);
});
echo join("&",$arr);
die();
include("top.php");

/* update category status */
if (isset($_GET["id"])) {
  $id = get_safe_value($con, $_GET["id"]);
  $row = $curd->select("brands", "*", ["id" => $id]);

}
if (isset($_GET["type"])) {
  $method = get_safe_value($con, $_GET["method"]);
  echo $id;
die();
  if ($method == "activate") {
    $status = 1;
  }
  if ($method == "deactivate") {
    $status = 0;
  }
  $update = $curd->update("brands", ["status" => $status], ["id" => $id]);
  if ($update) {
    header("location: brands.php");
  }
  if ($method == "delete") {
    $brand_image = $row[0]["image"];

    $target = brand_img_path.$brand_image;
    unlink($target);
    $delete = $curd->delete("brands", ["id" => $id]);
    if ($delete) {
      header("location: brands.php");
    } else {
      echo("faild");
    }

  }
}



$data = $curd->select("brands", "*");
//pr($data);
?>
<!-- MAIN CONTENT-->
<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-12">
          <h2 class="title-1 m-b-25">Brands</h2>

          <a class="au-btn au-btn-icon au-btn--blue mb-3 text-light" href="manage_brand.php">
            <i class="zmdi zmdi-plus"></i>Add Banner</a>

          <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
              <thead class="thead-dark">
                <tr>
                  <th>Sir no</th>

                  <th>Brand Image</th>
                  <th>Brand Name</th>

                  <th></th>

                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                foreach ($data as $row) {

                  ?>
                  <tr class="text-right">
                    <td><?php echo $i; ?></td>

                    <td>
                      <img src="<?php echo(brand_img_path.$row["image"]); ?>"></td>
                    <td><?php echo($row["name"]); ?></td>

                    <td>
                      <?php
                      if ($row["status"] == 1) {
echo "<a href='brands.php?id=".$row['id']."&type=action &method=deactivate' class='btn mb-sm-1 btn-success'>Active</a>";                    
         
                      } else {
                        echo('<a href="brands.php?id='.$row["id"].'&type=action&method=activate" class="btn mb-sm-1 btn-warning">Deactive</a>');
                      }
                      ?>
                      <a href="manage_brand.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary mb-sm-1 text-light">Edit</a>
                      <a href="brands.php?id=<?php echo $row['id']; ?>&type=operation&method=delete" class="btn btn-danger text-light">Delete</a>
                    </td>

                  </tr>
                  <?php  $i++;
                } ?>
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