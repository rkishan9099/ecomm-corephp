<?php
ob_start();
include("top.php");

$sql = "SELECT * FROM categories";
$res = mysqli_query($con, $sql) or die("query faild");
$data = array();
while ($row = mysqli_fetch_assoc($res)) {
  $data[] = $row;
}

/* update category status */
if (isset($_GET["id"])) {
  $id = get_safe_value($con, $_GET["id"]);
  $row = $curd->select("categories", "*", ["id" => $id]);

  if (isset($_GET["type"])) {
    $method = get_safe_value($con, $_GET["method"]);

    if ($method == "activate") {
      $status = 1;
    }
    if ($method == "deactivate") {
      $status = 0;
    }
    echo   $update = $curd->update("categories", ["status" => $status], ["id" => $id]);
    if ($update) {
      header("location: category.php");
    }
    if ($method == "delete") {
      $cat_image = $row[0]["category_image"];

      $target = category_img_path.$cat_image;
      unlink($target);
      $delete = $curd->delete("categories", ["id" => $id]);
      if ($delete) {
        header("location: category.php");
      } else {
        echo("faild");
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

        <div class="col-12">
          <h2 class="title-1 m-b-25">Product Categories</h2>

          <a class="au-btn au-btn-icon au-btn--blue mb-3 text-light" href="manage_category.php">
            <i class="zmdi zmdi-plus"></i>Add category</a>

          <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
              <thead>
                <tr>
                  <th>Sir no</th>
                  <th>Category Image</th>
                  <th>Name</th>
                 
                  <th></th>

                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                foreach ($data as $row) {

                  ?>
                  <tr class="text-right ">
                    <td class="align-middle"><?php echo $i; ?></td>
                    <td class="align-middle">
                      <img src="<?php echo category_img_path.$row["category_image"];?>" alt="" width="150px"/>
                    </td>
                    <td class="align-middle"><?php echo($row["category_name"]); ?></td>

                    <td class="align-middle">
                      <?php
                      if ($row["status"] == 1) {
                        echo('<a href="category.php?id='.$row["id"].'&type=operation &method=deactivate" class="btn btn-success">Active</a>');
                      } else {
                        echo('<a href="category.php?id='.$row["id"].'&type=operation&method=activate" class="btn btn-warning">Deactive</a>');
                      }
                      ?>
                      <a href="manage_category.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary text-light">Edit</a>
                      <a href="category.php?id=<?php echo $row['id']; ?>&type=operation&method=delete" class="btn btn-danger text-light">Delete</a>
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