<?php
ob_start();
include("top.php");
$msg = "";
$category = "";
$parent_id = "";
$old_img = "";
$is_home = "";

if (isset($_GET["id"])) {
  $id = get_safe_value($con, $_GET["id"]);

  $row = $curd->select("categories", "*", ["id" => $id]);

  $category = $row[0]["category_name"];
  $parent_id = $row[0]["parent_category_id"];
  $old_img = $row[0]["category_image"];
  $is_home = $row[0]["is_home"];

}
if (isset($_POST["submit"])) {

  $category = get_safe_value($con, $_POST["category"]);
  $parent_id = get_safe_value($con, $_POST["parent_id"]);
  $old_img = get_safe_value($con, $_POST["old_img"]);
  $is_home = get_safe_value($con, $_POST["is_home"]);


  if ($_FILES["image"]["name"] != "") {
    $path = category_img_path;
    $file_name = $_FILES["image"]["name"];
    $file_type = $_FILES["image"]["type"];
    $tmp_name = $_FILES["image"]["tmp_name"];
    $file_size = $_FILES["image"]["size"];
    $file = file_upload($path, $file_name, $file_type, $file_size, $tmp_name);
    $img = $file[1]["img"];
  } else {
    $img = $old_img;
  }
  /* data update and insert array */

  $data = [
    "category_name" => $category,
    "parent_category_id" => $parent_id,
    "category_image" => $img,
    "is_home" => $is_home
  ];


  $row = $curd->select("categories", "*", ["id" => $id]);

  if (count($row) > 0) {
    if (isset($_GET["id"])) {
      $msg = "";
    } else {
      $msg = "Color Already Exists";
    }
  }
  if ($msg == "") {
    if (isset($_GET["id"])) {
      $update = $curd->update("categories", $data, ["id" => $id]);
      if ($update) {
        header("location: category.php");

      }
    } else {
      $insert = $curd->insert("categories", $data);
      //pr($insert);
      if ($insert) {

        header("location: category.php");
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
        <h2 class="title-1 m-b-25 col-12">Product Category</h2>
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>Category</strong>
              <small> Form</small>
            </div>
            <div class="card-body card-block">
              <form action="" method="post" enctype="multipart/form-data">

                <div class="form-row">

                  <div class="form-group col-6">
                    <label for="category" class=" form-control-label">Add Category</label>
                    <input type="text" id="category" name="category" placeholder="Enter Category.." class="form-control" value="<?php echo $category; ?>">
                  </div>
                  <div class="form-group col-6">
                    <label>Parents Category</label>
                    <select class="form-control" name="parent_id">
                      <option value="0">Select Parent category</option>
                      <?php
                      $get_categories = $curd->select("categories", "*", [], "");
                      foreach ($get_categories as $val) {
                        if ($val["id"] == $parent_id) {
                          echo("<option value='".$val["id"]." 'selected>".$val["category_name"]."</option>");
                        } else {
                          echo("<option value='".$val["id"]."'>".$val["category_name"]."</option>");
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-6">
                    <label>Category image</label><br>

                    <input type="file" class="form-control" name="image">
                    <input type="hidden" name="old_img" value="<?php echo $old_img; ?>">
                    <?php if (isset($_GET["id"])) {
                      ?>
                      <img src="<?php echo category_img_path.$old_img; ?>" width="200px">
                      <?php
                    } ?>
                  </div>

                  <div class="form-group col-6">
                    <label>Show in Home page</label>
                    <select class="form-control" name="is_home">
                      <?php
                      if ($is_home == 1) {
                        echo('<option value="1" selected>Yes</option>
                          <option value="0">No</option>');
                      } else {
                        echo('   <option value="1">Yes</option>
                          <option value="0" selected>No</option>');
                      }
                      ?>

                    </select>
                  </div>
                </div>

                <div>
                  <button name="submit" type="submit" class="btn btn-lg btn-info btn-block">Submit </button>
                </div>
              </form>
              <div class="form_error_msg text-danger mt-1">
                <?php echo($msg); ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!---- footer section ---->
      <div class="row">
        <div class="col-md-12">
          <div class="copyright">
            <p>
              Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.
            </p>
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