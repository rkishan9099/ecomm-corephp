<?php
ob_start();
include ("top.php");
$msg = "";
$path = product_path;
$brand_name = "";
$brand_image = "";

$product_name = "";
$product_cat = "";
$product_brand = "";
$product_model = "";
$product_short_desc = "";
$product_desc = "";
$product_keyword = "";
$product_warranty = "";
$product_uses = "";
$product_promo = "";
$product_tranding = "";
$product_featured = "";
$product_discount = "";
$product_tech_spec = "";
$old_product_img = "";

/* selection options get */
$status = ["status" => 1];
$get_category = $curd->select("categories", "*", $status);

$get_brand = $curd->select("brands", "*", $status);

$get_color = $curd->select("colors", "*", $status);

$get_size = $curd->select("sizes", "*", $status);

if (isset($_GET["id"])) {
  $id = get_safe_value($con, $_GET["id"]);

  /* data get from database */

  $row = $curd->select("products", "*", ["id" => $id]);
  $product_attr = $curd->select("products_attr", "*", ["products_id" => $id]);
  $product_multiple_img = $curd->select("product_images", "*", ["products_id" => $id]);

  $brand_image = $row[0]["image"];
  $brand_name = $row[0]["name"];
  $product_name = $row[0]["name"];
  $product_cat = $row[0]["category_id"];
  $product_brand = $row[0]["brand"];
  $product_model = $row[0]["model"];
  $product_short_desc = $row[0]["short_desc"];
  $product_desc = $row[0]["desc"];
  $product_keyword = $row[0]["keywords"];
  $product_warranty = $row[0]["warranty"];
  $product_uses = $row[0]["uses"];
  $product_promo = $row[0]["is_promo"];
  $product_tranding = $row[0]["is_tranding"];
  $product_featured = $row[0]["is_featured"];
  $product_discount = $row[0]["is_discounted"];
  $product_tech_spec = $row[0]["technical_specification"];
  $old_product_img = $row[0]["image"];
  $product_qty=$row[0]["qty"];
  $product_price=$row[0]["price"];
  $product_mrp=$row[0]["mrp"];
}

//pr($get_categories);
if (isset($_POST["submit"])) {
 //pr($_POST);
 //die();
  $product_name = get_safe_value($con, $_POST["name"]);
  $product_cat = get_safe_value($con, $_POST["category"]);
  $product_brand = get_safe_value($con, $_POST["brand"]);
  $product_model = get_safe_value($con, $_POST["model"]);
  $product_short_desc = get_safe_value($con, $_POST["short_desc"]);
  $product_desc = get_safe_value($con, $_POST["desc"]);
  $product_keyword = get_safe_value($con, $_POST["keyword"]);
  $product_warranty = get_safe_value($con, $_POST["warranty"]);
  $product_uses = get_safe_value($con, $_POST["uses"]);
  $product_promo = get_safe_value($con, $_POST["is_promo"]);
  $product_tranding = get_safe_value($con, $_POST["is_tranding"]);
  $product_featured = get_safe_value($con, $_POST["is_featured"]);
  $product_discount = get_safe_value($con, $_POST["is_discounted"]);
  $product_tech_spec = get_safe_value($con, $_POST["tech_spec"]);
  $old_product_img = get_safe_value($con, $_POST["old_product_img"]);
  $product_mrp = get_safe_value($con,$_POST["product_mrp"]);
  $product_price = get_safe_value($con,$_POST["product_price"]);
  $product_qty = get_safe_value($con,$_POST["product_qty"]);



  /** image product image upload **/
  
  if ($_FILES["product_image"]["name"] != "") {
    $file_name = $_FILES["product_image"]["name"];
    $file_type = $_FILES["product_image"]["type"];
    $file_size = $_FILES["product_image"]["size"];
    $tmp_name = $_FILES["product_image"]["tmp_name"];
    $file1 = file_upload($path, $file_name, $file_type, $file_size, $tmp_name);
    $img = $file1[1]["img"];
  } else {
    $img = $old_product_img;
  }
  //pr($file1);

  /* product updates and add form data */
  $data = [
    "category_id" => $product_cat,
    "name" => $product_name,
    "price"=>$product_price,
    "mrp"=>$product_mrp,
    "qty"=>$product_qty,
    "brand" => $product_brand,
    "model" => $product_model,
    "short_desc" => $product_short_desc,
    "desc" => $product_desc,
    "keywords" => $product_keyword,
    "technical_specification" => $product_tech_spec,
    "uses" => $product_uses,
    "warranty" => $product_warranty,
    "is_promo" => $product_promo,
    "is_featured" => $product_featured,
    "is_discounted" => $product_discount,
    "is_tranding" => $product_tranding,
    "image" => $img
  ];



  /* check the condition product Already exists*/
  $row = $curd->select("products", "*", ["name" => $product_name]);
  if (count($row) > 0) {
    if (isset($_GET["id"])) {
      $msg = "";
    } else {
     $msg= "Product Already Exists";
    }
  }
  $attr_img = $_FILES["attr_img"];
  $img_list = array();
  $attr_path = product_path;
 // pr($attr_img);
  for ($i = 0; $i < count($attr_img["name"]); $i++) {

    if ($attr_img["name"][$i]){
      $file_name = $_FILES["attr_img"]["name"][$i];
      $file_type = $_FILES["attr_img"]["type"][$i];
      $tmp_name = $_FILES["attr_img"]["tmp_name"][$i];
      $file_size = $_FILES["attr_img"]["size"][$i];
      $file = file_upload($attr_path, $file_name, $file_type, $file_size, $tmp_name);
      array_push($img_list, $file[1]["img"]);
    } else {
      array_push($img_list, $_POST["old_attr_img"][$i]);
    }
  }

  /* product image */


  $product_M_img = $_FILES["product_img"];
  //pr($product_M_img);
  $img_ptoduct = array();
  for ($i = 0; $i < count($product_M_img["name"]); $i++) {
    if ($product_M_img["name"][$i] != "") {
      $path1 = product_path;
      $file_name = $product_M_img["name"][$i];
      $file_type = $product_M_img["type"][$i];
      $file_size = $product_M_img["size"][$i];
      $tmp_name = $product_M_img["tmp_name"][$i];
      $file4 = file_upload($path1, $file_name, $file_type, $file_size, $tmp_name);
      $img_ptoduct[] = $file4[1]["img"];
    } else {
      $img_ptoduct[] = $_POST["old_mp_img"][$i];
    }
  }


  /* Product data add and update */

  // pr($_POST);

  if ($msg == "") {

    if (isset($_GET["id"])) {

      $product_id = $id;
      /* product multiple img update */
      for ($i = 0; $i < count($_POST["img_p_id"]); $i++) {
        $data_img = [
          "products_id" => $id,
          "images" => $img_ptoduct[$i]
        ];
        if ($_POST["img_p_id"][$i] != "") {
          $update_M_img = $curd->update("product_images", $data_img, ["id" => $_POST["img_p_id"][$i]]);
        } else {
          
          $add_img_m[] = $curd->insert("product_images", $data_img);
          if (count($add_img_m) > 0) {
            $update_M_img = true;
          }
        }
      }

      $arrr = array();
      for ($i = 0; $i < count($_POST["sku"]); $i++) {
        $arrr[] = [
          "products_id" => $product_id,
          "id" => $_POST["id"][$i],
          "sku" => $_POST["sku"][$i],
          "mrp" => $_POST["mrp"][$i],
          "qty" => $_POST["qty"][$i],
          "size_id" => $_POST["size"][$i],
          "color_id" => $_POST["color"][$i],
          "price" => $_POST["price"][$i],
          "attr_image" => $img_list[$i]
        ];
      }
      foreach ($arrr as $val) {
        $p_attr = [
          "products_id" => $val["products_id"],
          "sku" => $val["sku"],
          "mrp" => $val["mrp"],
          "qty" => $val["qty"],
          "size_id" => $val["size_id"],
          "color_id" => $val["color_id"],
          "price" => $val["price"],
          "attr_image" => $val["attr_image"]
        ];
        if ($val["id"] != "") {
          $where = ["id" => $val["id"],
            "products_id" => $val["products_id"]];
          $update_attr = $curd->update("products_attr", $p_attr, $where);
        } else {
          $add[] = $curd->insert("products_attr", $p_attr);
        }
      }

      $update_product = $curd->update("products", $data, ["id" => $id]);
      if ($update_product && $update_attr && $update_M_img) {
       header("location: product.php");
      }

    } else {
      pr($data);
      /* products insert */
      $insert = $curd->insert("products", $data);
      pr($insert);
      $product_id = $insert["inser_id"];
      
      $arrr = array();
      
      for ($i = 0; $i < count($_POST["sku"]); $i++) {
        
        $arrr[] = [
          "products_id" => $product_id,
          "sku" => $_POST["sku"][$i],
          "mrp" => $_POST["mrp"][$i],
          "qty" => $_POST["qty"][$i],
          "size_id" => $_POST["size"][$i],
          "color_id" => $_POST["color"][$i],
          "price" => $_POST["price"][$i],
          "attr_image" => $img_list[$i]
        ];
      
          foreach ($arrr as $val) {
            $add[] = $curd->insert("products_attr", $val);
          }
        }
      /* product image insert */

          for ($i = 0; $i < count($_POST["img_p_id"]); $i++) {
            $data_img = [
              "products_id" => $product_id,
              "images" => $img_ptoduct[$i]
            ];
            $add_img[] = $curd->insert("product_images", $data_img);
          }
     
        if (count($insert) > 0 && count($add) > 0 && count($add_img) > 0) {
         header("location:product.php");
        }else{
          echo("failed");
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
        <h2 class="title-1 m-b-25 col-12">Product
        </h2>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="col-12">
            <div class="card">
              <div class="card-body card-block">
                <div class="form-group">
                  <label>Product Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter Product name.." value="<?php echo $product_name; ?>" required>
                </div>
                <div class="form-group">
                  <label>Product Category</label>
                  <select class="form-control" name="category">
                    <?php
                    foreach ($get_category as $val) {
                      if ($product_cat == $val["id"]) {
                        echo ('<option value="' . $val["id"] . '" selected>' . $val["category_name"] . '</option>');
                      } else
                      {
                        echo ('<option value="' . $val["id"] . '" >' . $val["category_name"] . '</option>');
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="row">
                  <div class="col-md-4 col-sm-12 col-12 form-group">
                    <label>Price</label>
                    <input type="number" name="product_price" class="form-control" placeholder="price" value="<?php echo $product_price; ?>">
                  </div>
                  <div class="col-md-4 col-sm-12 col-12 form-group">
                    <label>Mrp</label>
                    <input type="number" name="product_mrp" class="form-control" placeholder="Mrp" value="<?php echo $product_mrp;?>">
                  </div>
                  <div class="col-md-4 col-sm-12 col-12 form-group">
                    <label>Quantity</label>
                    <input type="number" name="product_qty" class="form-control" placeholder="Quantity" value="<?php echo $product_qty;?>">
                  </div>
                </div>
                <div class="form-group">
                  <label>Product Image</label>
                  <input type="file" class="form-control" name="product_image" >
                  <input type="hidden" name="old_product_img" value="<?php echo $old_product_img; ?>">
                  <?php if (isset($_GET["id"])) {
                    ?>
                    <img width="200px" src="<?php echo product_path.$old_product_img; ?>">
                    <?php
                  } ?>
                </div>
                <div class="form-group">
                  <label>Product Brand</label>
                  <select class="form-control" name="brand">
                    <?php
                    foreach ($get_brand as $val) {
                      if ($product_brand == $val["id"]) {
                        echo ('<option value="' . $val["id"] . '" selected>' . $val["name"] . '</option>');
                      } else
                      {
                        echo ('<option value="' . $val["id"] . '">' . $val["name"] . '</option>');
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Model</label>
                  <textarea class="form-control" name="model">
                    <?php echo ($product_model); ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label>Short Description</label>
                  <textarea class="form-control" id="short_desc" name="short_desc" required>
                    <?php echo ($product_short_desc); ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" id="desc" name="desc" required>
                    <?php echo ($product_desc); ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label>Keyword</label>
                  <textarea class="form-control" id="keyword" name="keyword">
                    <?php echo ($product_keyword); ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label>Technical Specifications</label>
                  <textarea class="form-control" id="tech_spec" name="tech_spec">
                    <?php echo ($product_tech_spec); ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label>Uses</label>
                  <input type="text" class="form-control" name="uses" value="<?php echo $product_uses; ?>">
                </div>
                <div class="form-group">
                  <label>Product Warranty</label>
                  <input type="text" class="form-control" name="warranty" value="<?php echo $product_warranty; ?>">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputCity">Product Promo</label>
                    <select class="form-control" name="is_promo">
                      <?php
                      if ($product_promo == 1) {
                        echo ('<option value="1" selected>Yes</option>
                                            <option value="0">No</option>');
                      } else {
                        echo ('<option value="1" >Yes</option>
                                            <option value="0" selected>No</option>');
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputState">Featured Product</label>
                    <select name="is_featured" class="form-control">
                      <?php
                      if ($product_featured == 1) {
                        echo ('<option value="1" selected>Yes</option>
                                              <option value="0">No</option>');
                      } else {
                        echo ('<option value="1" >Yes</option>
                                              <option value="0" selected>No</option>');
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputCity">Product Discount</label>
                    <select class="form-control" name="is_discounted">
                      <?php
                      if ($product_discount == 1) {
                        echo ('<option value="1" selected>Yes</option>
                                                <option value="0">No</option>');
                      } else {
                        echo ('<option value="1" >Yes</option>
                                                <option value="0" selected>No</option>');
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputState">Tranding Product</label>
                    <select name="is_tranding" class="form-control">
                      <?php
                      if ($product_tranding == 1) {
                        echo ('<option value="1" selected>Yes</option>
                                              <option value="0">No</option>');
                      } else {
                        echo ('<option value="1" >Yes</option>
                                              <option value="0" selected>No</option>');
                      }
                      ?>
                    </select>
                  </div>
                </div>
             
              </div>
            </div>
          </div>
          <h2 class="title-1 m-b-25 col-md-12">Product Image</h2>
          <?php if (isset($_GET["id"])) {
            $loop_img_c = 1;
            foreach ($product_multiple_img as $list) {
              ?>
              <div class="col-md-12" id="product_img_<?php echo $loop_img_c; ?>">
                <div class="card">
                  <div class="card-body">
                    <div class="form-row">
                      <input type="hidden" name="img_p_id[]" value="<?php echo $list["id"]; ?>" id="img_m_id<?php echo $loop_img_c; ?>">
                      <div class="form-group col-md-10">
                        <label>Product image</label>
                        <input type="file" name="product_img[]" class="form-control">
                        <input type="hidden" name="old_mp_img[]" value="<?php echo $list["images"]; ?>">
                        <img width="200px" src="<?php echo $path.$list["images"]; ?>" class="mt-1">
                      </div>
                      <?php if ($loop_img_c > 1) {
                        ?>
                        <div>
                          <label class="form-inline">&nbsp; &nbsp;</label>
                          <button class="btn btn-danger btn-lg btn-block" onclick="removeImg(<?php echo $loop_img_c; ?>);" type="button"><i class="fa fa-minus"></i>Remove</button>
                        </div>
                        <?php
                      } else {
                        ?>
                        <div>
                          <label class="form-inline">&nbsp; &nbsp;</label>
                          <button class="btn btn-primary btn-lg btn-block" onclick="addImg();" type="button"><i class="fa fa-plus"></i>Add</button>
                        </div>
                        <?php
                      } ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php $loop_img_c++;
            }} else {
            ?>
            <div class="col-md-12" id="product_img_1">
              <div class="card">
                <div class="card-body">
                  <div class="form-row">
                    <input type="text" name="img_p_id[]" value="">
                    <div class="form-group col-md-10">
                      <label>Product image</label>
                      <input type="file" name="product_img[]" class="form-control">
                    </div>
                    <div>
                      <label class="form-inline">&nbsp; &nbsp;</label>
                      <button class="btn btn-primary btn-lg btn-block" onclick="addImg();" type="button"><i class="fa fa-plus"></i>Add</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
          } ?>
          <h2 class="title-1 m-b-25 col-md-12">Product Attribute</h2>
          <?php
          if (isset($_GET["id"])) {
            $loop_count = 1;
            // pr($product_attr);
            foreach ($product_attr as $list) {
              ?>
              <div class="col-md-12" id="product_attr_<?php echo $loop_count; ?>">
                <div class="card">
                  <div class="card-body">
                    <input type="hidden" class="form-control" id="attr_id<?php echo $loop_count; ?>" name="id[]" value="<?php echo $list["id"]; ?>">
                    <div class="form-row">
                      <div class="form-group col-md-2 col-sm-4">
                        <label>Sku</label>
                        <input type="text" class="form-control"
                        id="sku<?php echo $loop_count;?>"
                        name="sku[]"
                        value="<?php echo $list["sku"]; ?>"
                        oninput="checksku(<?php echo $loop_count;?>);"
                        >
                        <span id="skumsg<?php echo $loop_count; ?>"> </span>
                      </div>
                      <div class="form-group col-md-2 col-sm-4">
                        <label>Mrp</label>
                        <input type="number" class="form-control" id="mrp" name="mrp[]" value="<?php echo $list["mrp"]; ?>">
                      </div>
                      <div class="form-group col-md-2 col-sm-4">
                        <label>Qty</label>
                        <input type="number" class="form-control" id="qty" name="qty[]" value="<?php echo $list["qty"]; ?>">
                      </div>
                      <div class="form-group col-md-2 col-sm-4">
                        <label>Price</label>
                        <input type="number" class="form-control" id="qty" name="price[]" value="<?php echo $list["price"]; ?>">
                      </div>
                      <div class="form-group col-md-2 col-sm-4">
                        <label>Size</label>
                        <select class="form-control" name="size[]" id="size">
                          <option value="">select size</option>

                          <?php
                          foreach ($get_size as $val) {
                            if ($list["size_id"] == $val["id"]) {
                              echo ('<option value="'.$val["id"].'" selected>' . $val["size"] . '</option>');
                            } else {
                              echo ('<option value="' . $val["id"] . '">' . $val["size"] . '</option>');
                            }
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-2 col-sm-4">
                        <label>Color</label>
                        <select class="form-control" name="color[]" id="color">
                          <option value="">select color</option>
                          <?php
                          foreach ($get_color as $val) {
                            if ($list["color_id"] == $val["id"]) {
                              echo ('<option value="' . $val["id"] . '" selected>' . $val["color"] . '</option>');
                            } else {
                              echo ('<option value="' . $val["id"] . '">' . $val["color"] . '</option>');
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-4 col-sm-8">
                        <label>Image</label>
                        <input type="file" class="form-control" name="attr_img[]">
                        <input type="hidden" name="old_attr_img[]" value="<?php echo $list["attr_image"]; ?>">
                        <img src="<?php echo $path.$list["attr_image"]; ?>">
                      </div>
                      <div class="form-group col-3">
                        <label class="form-inline">&nbsp; &nbsp;</label>
                        <?php if ($loop_count > 1) {
                          ?>
                          <button class="btn btn-danger btn-lg" type="button" onclick="remove(<?php echo $loop_count; ?>)"><i class="fa fa-plus"></i>
                            Remove</button>
                          <?php
                        } else {
                          ?>
                          <button class="btn btn-success btn-lg" type="button" onclick="Add()"><i class="fa fa-plus"></i>
                            Add</button><?php
                        } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php $loop_count++;
            }
          } else {
            ?>
            <div class="col-md-12" id="product_attr_1">
              <div class="card">
                <div class="card-body">
                  <div class="form-row">
                    <input type="hidden" class="form-control" id="qty" name="id[]" value="<?php echo $list["id"]; ?>">
                    <div class="form-group col-md-2 col-sm-4">
                      <label>Sku</label>
                      <input type="text" class="form-control" id="sku1" name="sku[]"
                      oninput="checksku(1);" required
                        >
                      <span id="skumsg1"> </span>
                    </div>
                    <div class="form-group col-md-2 col-sm-4">
                      <label>Mrp</label>
                      <input type="number" class="form-control" id="mrp" name="mrp[]" required>
                    </div>
                    <div class="form-group col-md-2 col-sm-4">
                      <label>Qty</label>
                      <input type="number" class="form-control" id="qty" name="qty[]" required>
                    </div>
                    <div class="form-group col-md-2 col-sm-4">
                      <label>Price</label>
                      <input type="number" class="form-control" id="qty" name="price[]" required>
                    </div>
                    <div class="form-group col-md-2 col-sm-4">
                      <label>Size</label>
                      <select class="form-control" name="size[]" id="size">
                        <option value="">select size</option>
                        <?php
                        foreach ($get_size as $val) {
                          echo ('<option value="' . $val["id"] . '">' . $val["size"] . '</option>');
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group col-md-2 col-sm-4">
                      <label>Color</label>
                      <select class="form-control" name="color[]" id="color">
                        <option value="">select color</option>
                        <?php
                        foreach ($get_color as $val) {
                          echo ('<option value="' . $val["id"] . '">' . $val["color"] . '</option>');
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-4 col-sm-8">
                      <label>Image</label>
                      <input type="file" class="form-control" name="attr_img[]" required>
                    </div>
                    <div class="form-group col-3">
                      <label class="form-inline">&nbsp; &nbsp;</label>
                      <button class="btn btn-success btn-lg" onclick="Add()" type="button"><i class="fa fa-plus"></i>
                        Add</button>
                    </div>
                    <div class="form-group col-2">
                      <input type="text" name="id_attr[]" value="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
          } ?>
          <div class="col-12">
            <button name="submit" type="submit" class="btn btn-lg btn-info btn-block">Submit </button>
          </div>
             <div class="form_error_msg text-danger mt-1">
        <?php echo $msg; ?>
                </div>
        </form>
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
include ("footer.php"); ?>

<script>
 
  
 
  var loop_img = 1;

  function addImg() {
    loop_img++;
    var img_html = `    <div class="col-md-12" id="product_img_${loop_img}">
    <div class="card">
    <div class="card-body">
    <div class="form-row">
    <input type="text" name="img_p_id[]" value="">

    <div class="form-group col-md-10">
    <label>Product image</label>
    <input type="file" name="product_img[]" class="form-control">
    </div>
    <div>
    <label class="form-inline">&nbsp; &nbsp;</label>
    <button class="btn btn-danger btn-lg btn-block" type="button" onclick="removeImg(${loop_img});"><i class="fa fa-minus"></i> Remove</button>
    </div>
    </div>
    </div>
    </div>
    </div>`;
    $("#product_img_1").append(img_html);
  }

  function removeImg(count) {
    // alert("remove");
    var id = $("#img_m_id"+count).val();

    if (id != "") {
      $.ajax({
        url: "delete_product_img.php",
        type: "post",
        data: "type=img&id="+id,
        success: function(result) {}});
    }
    $("#product_img_" + count).remove();


  }



  var loopcount = 1;

  function Add() {

    loopcount++;
    var color = $("#color").html();
    color = color.replace("selected", "");
    var size = $("#size").html();
    size = size.replace("selected", "");
    var html = `  <div class="col-md-12" id="product_attr_${loopcount}">
    <div class="card">
    <div class="card-body">
    <div class="form-row">
    <input type="hidden" class="form-control" id="qty" name="id[]" value=""    >

    <div class="form-group col-md-2 col-sm-4">
    <label>Sku</label>
    <input type="text" class="form-control" id="sku${loopcount}" name="sku[]"
    oninput="checksku(${loopcount});"
    >
    <span id="skumsg${loopcount}"></span>
    </div>
    <div class="form-group col-md-2 col-sm-4">
    <label>Mrp</label>
    <input type="number" class="form-control" id="mrp" name="mrp[]"  >
    </div>
    <div class="form-group col-md-2 col-sm-4">
    <label>Qty</label>
    <input type="number" class="form-control" id="qty" name="qty[]"  >
    </div>
    <div class="form-group col-md-2 col-sm-4">
    <label>Price</label>
    <input type="number" class="form-control" id="qty" name="price[]"  >
    </div>



    <div class="form-group col-md-2 col-sm-4">
    <label>Size</label>
    <select class="form-control" name="size[]" id="size">;
    ${size}
    </select>
    </div>
    <div class="form-group col-md-2 col-sm-4">
    <label>Color</label>
    <select class="form-control" name="color[]" id="color">;
    ${color}
    </select>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-4 col-sm-8">
    <label>Image</label>
    <input type="file" class="form-control" name="attr_img[]">
    </div>
    <div class="form-group col-3">
    <label class="form-inline">&nbsp; &nbsp;</label>
    <button class="btn btn-danger btn-lg" onclick="remove(${loopcount})"><i class="fa fa-minus"></i>
    Remove</button>
    </div>
    <div class="form-group col-2">
    <input type="text" name="id_attr[]" value="">
    </div>
    </div>
    </div>
    </div>
    </form>
    </div>`;

    $("#product_attr_1").append(html);
  }

  function remove(count) {
    var id = $("#attr_id"+count).val();

    if (id != "") {
      $.ajax({
        url: "delete_product_img.php",
        type: "post",
        data: "type=attr&id="+id,
        success: function(result) {}});
    }
    $("#product_attr_" + count).remove();
  }

function checksku(id){
 let skuVal = $("#sku"+id).val();
 let msg=  $("#skumsg"+id).html(skuVal);
 $.ajax({
   url:"check_sku.php",
   type:"post",
   data:"sku="+skuVal,
   success:function(response){
     if(response=="valid"){
       msg.html("<b class='text-success'>Sku valid </b>");
     }
     if(response=="invalid"){
       msg.html("<b class='text-danger'>Sku Alredy Exists </b>");
     }
   }
 });
 //alert(id);
}


</script>