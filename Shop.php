<?php
include("top.php");

$catid = "";
$search="";
$colors_list = select($con, "colors", ["status" => 1]);
$size_list = select($con, "sizes", ["status" => 1]);
$categories_list = select($con, "categories", ["status" => 1]);
$brand_list = select($con, "brands", ["status" => 1]);
if(isset($_GET["catid"])){
   $catid= get_safe_value($con,$_GET["catid"]);
}
if(isset($_POST["search"])){
   $search= get_safe_value($con,$_POST["search"]);
}
$product = get_product($con, "new", "", "", [], "", "", []);

foreach ($product["products"] as $list) {
  $product_price_range[] = $list["price"];
}

//pr($product_price_range);
 $min_product_price = min($product_price_range);
 $max_product_price = max($product_price_range);
?>
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
  <div class="container">
    <!-- STRART CONTAINER -->
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="page-title">
          <h1>Shop Left Sidebar</h1>
        </div>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb justify-content-md-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Pages</a></li>
          <li class="breadcrumb-item active">Shop page</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

  <!-- START SECTION SHOP -->
  <div class="section">
    <div class="container">
      <div class="row">

          <div class="col-lg-9" id="product">
            <div class="row align-items-center mb-4 pb-1 product_shorting">
              <div class="col-12">
                <div class="product_header">
                  <div class="product_header_left">
                    <div class="custom_select">
                      <select class="form-control form-control-sm" id="short">
                        <option value="new">Default sorting</option>
                        <option value="old">Sort by Old</option>
                        <option value="new">Sort by newness</option>
                        <option value="price_asc">Sort by price: low to high</option>
                        <option value="price_desc">Sort by price: high to low</option>
                      </select>
                    </div>
                  </div>
                  <div class="product_header_right">
                    <div class="products_view">
                      <a href="javascript:Void(0);" class="shorting_icon grid active"><i class="ti-view-grid"></i></a>
                      <a href="javascript:Void(0);" class="shorting_icon list"><i class="ti-layout-list-thumb"></i></a>
                    </div>
                    <div class="custom_select">
                      <select class="form-control form-control-sm"  id="show_number">
                        <option value="">Showing</option>
                        <option value="9">9</option>
                        <option value="12">12</option>
                        <option value="18">18</option>

                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row shop_container" id="product_list">
         
              <!----
              <div class="col-md-4 col-6">
                                    <div class="product">
                                        <div class="product_img">
                                           <a href="shop-product-detail.html">
                                        <img src="assets/images/product_img1.jpg" alt="product_img1">
                                         </a>
                                   <div class="product_action_box">
                                <ul class="list_none pr_action_btn">
                              <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                                   <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                    <li><a href="#"><i class="icon-heart"></i></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="product_info">
                                                                    <h6 class="product_title"><a href="shop-product-detail.html">Blue Dress For Woman</a></h6>
                                                                    <div class="product_price">
                                                                        <span class="price">$45.00</span>
                                                                        <del>$55.25</del>
                                                                        <div class="on_sale">
                                                                            <span>35% Off</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="rating_wrap">
                                                                        <div class="rating">
                                                                            <div class="product_rate" style="width:80%"></div>
                                                                        </div>
                                                                        <span class="rating_num">(21)</span>
                                                                    </div>
                                                                    <div class="pr_desc">
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                                                    </div>
                                                                    <div class="pr_switch_wrap">
                                                                        <div class="product_color_switch">
                                                                            <span class="active" data-color="#87554B"></span>
                                                                            <span data-color="#333333"></span>
                                                                            <span data-color="#DA323F"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="list_product_action_box">
                                                                        <ul class="list_none pr_action_btn">
                                                                            <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                                                            <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                                                                            <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                                                            <li><a href="#"><i class="icon-heart"></i></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        --->

            </div>
           <!----- <div class="row">
              <div class="col-12">
                <?php
                $total_record = count($pagination_product["product"]);
                $total_page = ceil($total_record/$limit);
                if ($total_page > 1) {
                  ?>

                  <ul class="pagination mt-3 justify-content-center pagination_style1">
                    <?php

                    if ($page > 1) {
                      echo('<li class="page-item">
           <a class="page-link" href="products.php?page='.($page-1).'">
           <i class="linearicons-arrow-left"></i></a>
        </li>');
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                      if ($i == $page) {
                        $active = "active";
                      } else {
                        $active = "";
                      }
                      echo('<li class="page-item '.$active.' ">
       <a class="page-link" href="products.php?page='.$i.'">'.$i.'</a></li>');
                    }
                    if ($total_page < $total_record) {
                      echo('<li class="page-item">
        <a class="page-link" href="products.php?page='.($page+1).'">
          <i class="linearicons-arrow-right"></i></a>
        </li>');
                    }
                    ?>
                  </ul>
                  <?php
                } ?>
              </div>
            </div>--->
          </div>
     
        <div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
          <div class="mb-3">
            <h4>Filters</h4>
            <div class="filters d-flex flex-wrap">

            </div>
          </div>
          <hr>
          <form id="filter_form" method="post">
            <input type="text" name="short" id="short_product" value="new" hidden/>
           <input type="text" name="product_limit" id="product_limit" value="" hidden/>
           <input type="text" name="search" id="search" value="<?php echo $search;?>" hidden >
            <div class="sidebar">
              <div class="widget">
                <h5 class="widget_title">Categories</h5>
                <ul class="widget_categories">

                  <li>
                    <a href="javascript:void(0)" data-catid="" class="category_link active_link">
                      <span class="categories_name ">All products</span>
                      <span class="categories_num">(<?php echo count(select($con, "products", ["p_status" => 1])); ?>)</span></a></li>
                  <?php
                  if (count($categories_list) > 0) {
                    foreach ($categories_list as $list) {
                      $product_count = count(select($con, "products", ["category_id" => $list["id"]]));
                      echo '<li><a href="javascript:void(0)" class="category_link" data-catid="'.$list["id"].'"><span class="categories_name">'.$list["category_name"].'</span>
         <span class="categories_num">('.$product_count.')</span></a></li>';
                    }
                  } else {
                    echo('<li><a href="javascript:void(0)"><span class="categories_name">No category Available</span><span class="categories_num"></span></a></li>');
                  }
                  ?>
                  <input type="text" name="catid" value="<?php echo $catid;?>" id="category_id_val" hidden>
                </ul>
              </div>
              <div class="widget">
                <h5 class="widget_title">Filter</h5>
                <div class="filter_price">
                  <div id="price_filter" data-min="<?php echo $min_product_price; ?>" data-max="<?php echo $max_product_price; ?>" data-min-value="500" data-max-value="5000" data-price-sign="$"></div>
                  <div class="d-flex justify-content-between">
                    <div class="price_range">
                      <span>Price: <span id="flt_price"></span></span>
                      <input type="text" name="min" id="price_first" hidden>
                      <input type="text" name="max" id="price_second" hidden>
                    </div>

                  </div>
                </div>

              </div>
              <div class="widget">
                <h5 class="widget_title">Brand</h5>
                <ul class="list_brand">

                  <?php
                  if (count($brand_list) > 0) {
                    foreach ($brand_list as $list) {
                      $bid = str_ireplace(" ", "_", $list["name"]);
                      echo '<li>
                       <div class="custome-checkbox">
    <input class="form-check-input apply_filters brand_'.$bid.'" type="checkbox" name="brand[]" id="'.$list["name"].'" value="'.$list["id"].'"
    data-Bname="'.$list["name"].'" >
                         <label class="form-check-label" for="'.$list["name"].'"><span>'.$list["name"].'</span></label>
                         </div>
                      </li>';
                    }
                  } else {
                    echo("<li>No brands Available</li>");
                  }

                  ?>
                </ul>
              </form>
            </div>
            <!--
            <div class="widget">
              <h5 class="widget_title">Size</h5>
              <div class="product_size_switch">
                <?php
                if (count($size_list) > 0) {
                  foreach ($size_list as $list) {

                    if ($size_id == $list["id"]) {

                      $active = "active";
                    } else {
                      $active = "";
                    }
                    echo '<a  href="products.php?size='.$list["id"].$cat_val.$color_val.'"><span class="'.$active.'">'.$list["size"].'</span></a>';
                  }

                } else {
                  echo("No size Available");
                }
                ?>

              </div>
            </div>
            <div class="widget">
              <h5 class="widget_title">Color</h5>
              <div class="product_color_switch">

                <?php

                if (count($colors_list) > 0) {

                  foreach ($colors_list as $list) {
                    if ($color_id == $list["id"]) {
                      $active = "active";
                    } else {
                      $active = "";
                    }
                    echo '<a href="products.php?color='.$list["id"].$cat_val.$size_val.'">
             <span class="'.$active.'" data-color="'.$list["color_code"].'"></span></a>';
                  }
                } else {
                  echo("No Color Available");
                }
                ?>
                <-<span data-color="#2F366C"></span>-
              </div>
            </div>
            <div class="widget">
              <div class="shop_banner">
                <div class="banner_img overlay_bg_20">
                  <img src="assets/images/sidebar_banner_img.jpg" alt="sidebar_banner_img">
                </div>
                <div class="shop_bn_content2 text_white">
                  <h5 class="text-uppercase shop_subtitle">New Collection</h5>
                  <h3 class="text-uppercase shop_title">Sale 30% Off</h3>
                  <a href="#" class="btn btn-white rounded-0 btn-sm text-uppercase">Shop Now</a>
                </div>
              </div>
            </div>--->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END SECTION SHOP -->
  <?php
  include("footer.php"); ?>
