<?php
include("top.php");
if (!isset($_GET["id"])) {
  header("location:index.php");
} else {
   $id = get_safe_value($con, $_GET["id"]);
}
$prodct_img = product_path;
$product=get_product($con,"new","","",["products.id"=>$id]);
$name = $product["products"][0]["name"];
$main_img = $product["products"][0]["image"];
$short_desc = $product["products"][0]["short_desc"];
$desc = $product["products"][0]["desc"];
$category = $product["products"][0]["cat_name"];
$catid = $product["products"][0]["category_id"];
$warranty = $product["products"][0]["warranty"];
$tech_spacification = $product["products"][0]["technical_specification"];
$price = $product["products"][0]["price"];
$mrp = $product["products"][0]["mrp"];
$sku = "";
$qty=$product["products"][0]["qty"];
$product_m_img = $product["products_img"][$id][0];
$product_ratting=$product["products"][0]["product_ratting"];
$rated_user=$product["products"][0]["rated_user"];



?>
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
  <div class="container">
    <!-- STRART CONTAINER -->
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="page-title">
          <h1>Product Detail</h1>
        </div>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb justify-content-md-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Pages</a></li>
          <li class="breadcrumb-item active">Product Detail</li>
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
        <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
          <div class="product-image">
            <div class="product_img_box">
              <img id="product_img" src="<?php echo $prodct_img.$main_img; ?>"
              data-zoom-image="<?php echo $prodct_img.$main_img; ?>" alt="product_img1" />
              <a href="#" class="product_img_zoom" title="Zoom">
                <span class="linearicons-zoom-in"></span>
              </a>
            </div>
            <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false">
              <div class="item ">
                <a href="#" class="product_gallery_item active" data-image="<?php echo $prodct_img.$main_img;?>" data-zoom-image="<?php echo $prodct_img.$main_img;?>">
                  <img src="<?php echo $prodct_img.$main_img;?>" />
                </a>
              </div>
              <?php foreach($product_m_img as $list){
            ?>
              <div class="item">
                <a href="#" class="product_gallery_item"
                data-image="<?php echo $prodct_img.$list["images"]; ?>" 
                data-zoom-image="<?php echo $prodct_img.$list["images"]; ?>">
                  <img src="<?php echo $prodct_img.$list["images"]?>" width="70px" />
                </a>
              </div>
              <?php }?>

            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="pr_detail">
            <div class="product_description">
              <h4 class="product_title"><a href="#"><?php echo $name; ?></a></h4>
              <div class="product_price">
                <span class="price">$<?php echo $price; ?></span>
                <del>$<?php echo $mrp; ?></del>
                <div class="on_sale">
                  <span>35% Off</span>
                </div>
              </div>
              <div class="rating_wrap">
                <div class="rating">
                  <div class="product_rate" style="width:<?php echo ($product_ratting*20); ?>%"></div>
                </div>
                <span class="rating_num">(<?php echo $rated_user;?>)</span>
              </div>
              <div class="pr_desc">
                <?php echo substr($short_desc, 0, 150); ?>
              </div>
             
              <?php
            
             $sellQty= productSellQty($con,$id);
             if(($qty - $sellQty)<=10 && ($qty-$sellQty)>1){
               echo "<span class='text-danger'>only ".($qty - $sellQty)." Item left</span>";
             }
                if($qty>$sellQty){
                  $avilable="In Stock";
                  $class="success";
                }else{
                  $avilable="Out of Stock";
                  $class="danger";
                }
              ?>
             <strong class="d-block mb-2">Availability: <span class="badge badge-pill badge-<?php echo $class;?>"><?php echo $avilable;?></span></strong>
              <div class="product_sort_info">

                <ul>
                  <li><i class="linearicons-shield-check"></i> <?php echo $warranty; ?>bbh</li>
                  <li><i class="linearicons-sync"></i> 30 Day Return Policy</li>
                  <li><i class="linearicons-bag-dollar"></i> Cash on Delivery available</li>
                </ul>
              </div>
              <!---
              <div class="pr_switch_wrap">
                <span class="switch_lable">Color</span>
                <div class="product_color_switch">
                  <span class="active" data-color="#87554B"></span>
                  <span data-color="#333333"></span>
                  <span data-color="#DA323F"></span>
                </div>
              </div>
              <div class="pr_switch_wrap">
                <span class="switch_lable">Size</span>
                <div class="product_size_switch">
                  <span>xs</span>
                  <span>s</span>
                  <span>m</span>
                  <span>l</span>
                  <span>xl</span>
                </div>
              </div>--->
            </div>
            <hr />
            <div class="cart_extra">
          <?php
        $sellQty= productSellQty($con,$id);
                if($qty>$sellQty){
                  
              ?>
             <div class="cart-product-quantity">
                <div class="quantity">
                  <input type="button" value="-" class="minus">
                  <input type="text" name="quantity" value="1" title="Qty" class="qty" size="4" id="cart_qty" max="5">
                  <input type="button" value="+" class="plus">
                </div>
              </div>
              <?php }?>
              <div class="cart_btn">
                          <?php
        $sellQty= productSellQty($con,$id);
                if($qty>$sellQty){
                  
              ?>
               <button class="btn btn-fill-out btn-addtocart"
                class="add_cart_btn_<?php echo $id;?>" type="button" onclick="add_toCart(<?php echo $id;?>)">
                  <i class="icon-basket-loaded"></i> Add to cart
               </button>
               <?php }?>
                <a class="add_compare" href="#"><i class="icon-shuffle"></i></a>
                <a class="add_wishlist" href="#"><i class="icon-heart"></i></a>
              </div>
            </div>
            <hr />
            <ul class="product-meta">
              <li>SKU: <a href="#"><?php echo $sku; ?></a></li>
              <li>Category: <a href="shop.php?catid=<?php echo $catid; ?>"><?php echo $category; ?></a></li>
              <li>Tags: <a href="#" rel="tag">Cloth</a>, <a href="#" rel="tag">printed</a> </li>
            </ul>

            <div class="product_share">
              <span>Share:</span>
              <ul class="social_icons">
                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                <li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
                <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="large_divider clearfix"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="tab-style3">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="Description-tab" data-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">Description</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="Additional-info-tab" data-toggle="tab" href="#Additional-info" role="tab" aria-controls="Additional-info" aria-selected="false">Additional info</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="Reviews-tab" data-toggle="tab" href="#Reviews" role="tab" aria-controls="Reviews" aria-selected="false">Reviews (<?php echo $rated_user;?>)</a>
              </li>
            </ul>
            <div class="tab-content shop_info_tab">
              <div class="tab-pane fade show active" id="Description" role="tabpanel" aria-labelledby="Description-tab">
                <?php echo $desc; ?>
              </div>
              <div class="tab-pane fade" id="Additional-info" role="tabpanel" aria-labelledby="Additional-info-tab">
                <?php
                if ($tech_spacification != "") {
                  echo '<h2>Technical Specifications</h2>';
                  echo($tech_spacification);
                } ?>
                <table class="table table-bordered">
                  <tr>
                    <td>Capacity</td>
                    <td>5 Kg</td>
                  </tr>
                  <tr>
                    <td>Color</td>
                    <td>Black, Brown, Red,</td>
                  </tr>
                  <tr>
                    <td>Water Resistant</td>
                    <td>Yes</td>
                  </tr>
                  <tr>
                    <td>Material</td>
                    <td>Artificial Leather</td>
                  </tr>
                </table>
              </div>
              <div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                <div class="comments">
                  <h5 class="product_tab_title"><?php echo $rated_user; ?> Review For <span><?= $name?></span></h5>
                  <ul class="list_none comment_list mt-4">
                    <?php
                    $review_list=select($con, "review",  ["pid"=>$id,"status"=>1]);
                    
                    if(count($review_list)){
                      foreach ($review_list as $list){
                    ?>
                    <li>
                      <div class="comment_img">
                        <img src="assets/images/user1.jpg" alt="user1" />
                      </div>
                      <div class="comment_block">
                        <div class="rating_wrap">
                          <div class="rating">
            <div class="product_rate" style="width:<?php echo ($list['ratting']*20);?>%"></div>
                          </div><br>
                          <?php 
                          if($list["is_purchase"]==1){
                            echo '  <strong class="text-success" style="font-size:12px">verified purchase</strong>';
                          }
                          ?>
                        
                        </div>
                        <p class="customer_meta">
                          <span class="review_author"><?php echo $list["name"];?></span>
                          <span class="comment-date"><?php echo date("M d, Y",strtotime($list["add_on"]));?></span>
                        </p>
                        <div class="description">
                          <p>
                            <?php echo $list["msg"];?>
                          </p>
                        </div>
                      </div>
                    </li>
                    <?php }}else{
                      echo "<h2>No Review Available";
                    }?>

                  </ul>
                </div>
                <div class="review_form field_form">
                  <h5>Add a review</h5>
                  <form class="row mt-3 " id="review_form" method="post" >
                    <div class="form-group col-12">
                      <div class="star_rating">
                        <span data-value="1"><i class="far fa-star"></i></span>
                        <span data-value="2"><i class="far fa-star"></i></span>
                        <span data-value="3"><i class="far fa-star"></i></span>
                        <span data-value="4"><i class="far fa-star"></i></span>
                        <span data-value="5"><i class="far fa-star"></i></span>
                      </div>
                      <input type="hidden" name="ratting" id="rate_p" value="">
                    </div>
                    <div class="form-group col-12">
                      <textarea required="required" placeholder="Your review *" class="form-control" name="message" rows="4"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <input required="required" placeholder="Enter Name *" class="form-control" name="name" type="text">
                    </div>
                    <div class="form-group col-md-6">
                      <input required="required" placeholder="Enter Email *" class="form-control" name="email" type="email">
                    </div>

                    <div class="form-group col-12">
                      <button type="button" class="btn btn-fill-out" name="submit" onclick="submitReview(<?php echo $id;?>);">Submit Review</button>
                    </div>
               <div class="form-output mt-3 alert  review_output">
                hhhjvbbbhhhh
              </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="small_divider"></div>
          <div class="divider"></div>
          <div class="medium_divider"></div>
        </div>
      </div>
      <!----   <div class="row">
              <div class="col-12">
                <div class="heading_s1">
                  <h3>Releted Products</h3>
                </div>
                <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                  <div class="item">
                    <div class="product">
                      <div class="product_img">
                        <a href="shop-product-detail.html">
                          <img src="assets/images/product_img1.jpg" alt="product_img1">
                        </a>
                        <div class="product_action_box">
                          <ul class="list_none pr_action_btn">
                            <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                            <li><a href="shop-compare.html"><i class="icon-shuffle"></i></a></li>
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
                          <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.
                          </p>
                        </div>
                        <div class="pr_switch_wrap">
                          <div class="product_color_switch">
                            <span class="active" data-color="#87554B"></span>
                            <span data-color="#333333"></span>
                            <span data-color="#DA323F"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>--->
    </div>
  </div>
  <!-- END SECTION SHOP -->
  <?php
  include("footer.php");
  ?>
<script>
  function submitReview(pid){
    formData=$("#review_form").serialize();
    
    $.ajax({
      url:"add_review.php",
      type:"post",
      data:formData+"&pid="+pid+"&type=review",
      success: function (response){
        alert(response);
      result= JSON.parse(response);
        if(result.error=="yes"){
             $(".review_output").removeClass("alert-success");
             $(".review_output").addClass("alert-danger");
             
        }else{
          $('#review_form')[0].reset();
           $(".review_output").removeClass("alert-danger");
             $(".review_output").addClass("alert-success");
             
        }
        $(".review_output").html("<strong>"+result.msg+"</strong>");
           $(".review_output").show();
        
       
      }
    })
  }
</script>