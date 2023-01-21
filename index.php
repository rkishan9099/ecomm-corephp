<?php
include("top.php");
$prodct_img = product_path;
$product =get_product($con,"new");
//pr($product);
$featured_p=get_product($con,"new","","",["is_featured"=>1]);
$tranding_p=get_product($con,"new","","",["is_tranding"=>1]);
$top_rated=get_product($con,"ratting_high",6);

?>
<!-- START SECTION BANNER -->
<div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap">
  <div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active background_bg" data-img-src="assets/images/banner1.jpg">
        <div class="banner_slide_content">
          <div class="container">
            <!-- STRART CONTAINER -->
            <div class="row">
              <div class="col-lg-7 col-9">
                <div class="banner_content overflow-hidden">
                  <h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="0.5s">Get up to 50% off Today Only!</h5>
                  <h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="1s">Woman Fashion</h2>
                  <a class="btn btn-fill-out rounded-0 staggered-animation text-uppercase" href="shop-left-sidebar.php" data-animation="slideInLeft" data-animation-delay="1.5s">Shop Now</a>
                </div>
              </div>
            </div>
          </div>
          <!-- END CONTAINER-->
        </div>
      </div>
      <div class="carousel-item background_bg" data-img-src="assets/images/banner2.jpg">
        <div class="banner_slide_content">
          <div class="container">
            <!-- STRART CONTAINER -->
            <div class="row">
              <div class="col-lg-6">
                <div class="banner_content overflow-hidden">
                  <h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="0.5s">50% off in all products</h5>
                  <h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="1s">Man Fashion</h2>
                  <a class="btn btn-fill-out rounded-0 staggered-animation text-uppercase" href="shop-left-sidebar.php" data-animation="slideInLeft" data-animation-delay="1.5s">Shop Now</a>
                </div>
              </div>
            </div>
          </div>
          <!-- END CONTAINER-->
        </div>
      </div>
      <div class="carousel-item background_bg" data-img-src="assets/images/banner3.jpg">
        <div class="banner_slide_content">
          <div class="container">
            <!-- STRART CONTAINER -->
            <div class="row">
              <div class="col-lg-6">
                <div class="banner_content overflow-hidden">
                  <h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="0.5s">Taking your Viewing Experience to Next Level</h5>
                  <h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="1s">Summer Sale</h2>
                  <a class="btn btn-fill-out rounded-0 staggered-animation text-uppercase" href="shop-left-sidebar.php" data-animation="slideInLeft" data-animation-delay="1.5s">Shop Now</a>
                </div>
              </div>
            </div>
          </div>
          <!-- END CONTAINER-->
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
  </div>
</div>
<!-- END SECTION BANNER -->

<!-- END MAIN CONTENT -->
<div class="main_content">

  <!-- START SECTION BANNER -->
  <div class="section pb_20">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="single_banner">
            <img src="assets/images/shop_banner_img1.jpg" alt="shop_banner_img1" />
            <div class="single_banner_info">
              <h5 class="single_bn_title1">Super Sale</h5>
              <h3 class="single_bn_title">New Collection</h3>
              <a href="shop-left-sidebar.php" class="single_bn_link">Shop Now</a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="single_banner">
            <img src="assets/images/shop_banner_img2.jpg" alt="shop_banner_img2" />
            <div class="single_banner_info">
              <h3 class="single_bn_title">New Season</h3>
              <h4 class="single_bn_title1">Sale 40% Off</h4>
              <a href="shop-left-sidebar.php" class="single_bn_link">Shop Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END SECTION BANNER -->

  <!-- START SECTION SHOP -->
  <div class="section small_pt pb_70">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="heading_s1 text-center">
            <h2>Exclusive Products</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="tab-style1">
            <ul class="nav nav-tabs justify-content-center" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="arrival-tab" data-toggle="tab" href="#arrival" role="tab" aria-controls="arrival" aria-selected="true">New Arrival</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="Featured-tab" data-toggle="tab" href="#Featured" role="tab" aria-controls="Featured" aria-selected="false">Featured</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="topRated-tab" data-toggle="tab" href="#topRated" role="tab" aria-controls="topRated" aria-selected="false">Top Rated</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="Trading-tab" data-toggle="tab" href="#Trading" role="tab" aria-controls="Trading" aria-selected="false">Trading
                </a>
              </li>


            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="arrival" role="tabpanel" aria-labelledby="arrival-tab">
              <div class="row shop_container">
                <?php
                foreach ($product["products"] as $list) {
                $pid =$list["id"];
                  

?>
                  <div class="col-lg-3 col-md-4 col-6">
                    <div class="product">
                      <div class="product_img">
                        <a href="shop-product-detail.php?id=<?php echo $list["id"]; ?>">
                          <img src="<?php echo $prodct_img.$list["image"]; ?>" alt="product_img1">
                        </a>
                        <div class="product_action_box">
                          <ul class="list_none pr_action_btn">
                            <li class="add-to-cart"><a href="javascript:void(0)"
                            onclick="add_toCart(<?php echo $pid;?>,1)"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                            <li><a href="shop-compare.php" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                            <li><a href="shop-quick-view.php" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                            <li><a href="#"><i class="icon-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="product_info">
                        <h6 class="product_title">
                   <a href="shop-product-detail.php?id=<?php echo $list["id"]; ?>">
                            <?php echo $list["name"]; ?>
                          </a></h6>
                        <div class="product_price">
                          <span class="price">$<?php echo $list["price"];?>
                        </span>
                          <del>
                            $<?php echo $list["mrp"];?></del>
                          <div class="on_sale">
                            <span>35% Off</span>
                          </div>
                        </div>
                        <div class="rating_wrap">
                          <div class="rating">
                  <div class="product_rate" style="width:<?php echo ($list["product_ratting"]*20); ?>%"></div>
                          </div>
                          <span class="rating_num">(<?php echo $list["rated_user"];?>)</span>
                        </div>
                        <div class="pr_desc">
                         <?php echo substr($list["short_desc"],0,150); ?>
                         
                           
                        </div>
                        <div class="pr_switch_wrap">
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                } ?>
              </div>
  </div>
            <div class="tab-pane fade" id="Featured" role="tabpanel" aria-labelledby="Featured-tab">
              
              <div class="row shop_container">
                <?php
                foreach ($featured_p["products"] as $list) {
                  $pid =$list["id"];

                ?>
                  <div class="col-lg-3 col-md-4 col-6">
                    <div class="product">
                      <div class="product_img">
                        <a href="shop-product-detail.php?id=<?php echo $list["id"]; ?>">
                          <img src="<?php echo $prodct_img.$list["image"]; ?>" alt="product_img1">
                        </a>
                        <div class="product_action_box">
                          <ul class="list_none pr_action_btn">
                            <li class="add-to-cart"><a href="javascript:void(0)"
                            onclick="add_toCart(<?php echo $pid;?>,1)"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                            <li><a href="shop-compare.php" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                            <li><a href="shop-quick-view.php" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                            <li><a href="#"><i class="icon-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="product_info">
                        <h6 class="product_title">
                   <a href="shop-product-detail.php?id=<?php echo $list["id"]; ?>">
                            <?php echo $list["name"]; ?>
                          </a></h6>
                        <div class="product_price">
                          <span class="price">$<?php echo $list["price"];?>
                        </span>
                          <del>
                            $<?php echo $list["mrp"];?></del>
                          <div class="on_sale">
                            <span>35% Off</span>
                          </div>
                        </div>
                        <div class="rating_wrap">
                          <div class="rating">
                  <div class="product_rate" style="width:<?php echo ($list["product_ratting"]*20); ?>%"></div>
                          </div>
                          <span class="rating_num">(<?php echo $list["rated_user"];?>)</span>
                        </div>
                        <div class="pr_desc">
                      <?php echo substr($list["short_desc"],0,150);?>
                        </div>
                        <div class="pr_switch_wrap">
                        
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                } ?>
              </div>
              
            </div>
            <div class="tab-pane fade" id="topRated" role="tabpanel" aria-labelledby="topRated-tab">
              <div class="row shop_container">
                <?php
                foreach ($top_rated["products"] as $list) {
                  $pid =$list["id"];

                ?>
                  <div class="col-lg-3 col-md-4 col-6">
                    <div class="product">
                      <div class="product_img">
                        <a href="shop-product-detail.php?id=<?php echo $list["id"]; ?>">
                          <img src="<?php echo $prodct_img.$list["image"]; ?>" alt="product_img1">
                        </a>
                        <div class="product_action_box">
                          <ul class="list_none pr_action_btn">
                            <li class="add-to-cart"><a href="javascript:void(0)"
                            onclick="add_toCart(<?php echo $pid;?>,1)"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                            <li><a href="shop-compare.php" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                            <li><a href="shop-quick-view.php" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                            <li><a href="#"><i class="icon-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="product_info">
                        <h6 class="product_title">
                   <a href="shop-product-detail.php?id=<?php echo $list["id"]; ?>">
                            <?php echo $list["name"]; ?>
                          </a></h6>
                        <div class="product_price">
                          <span class="price">$<?php echo $list["price"];?>
                        </span>
                          <del>
                            $<?php echo $list["mrp"];?></del>
                          <div class="on_sale">
                            <span>35% Off</span>
                          </div>
                        </div>
                        <div class="rating_wrap">
                          <div class="rating">
                  <div class="product_rate" style="width:<?php echo ($list["product_ratting"]*20); ?>%"></div>
                          </div>
                          <span class="rating_num">(<?php echo $list["rated_user"];?>)</span>
                        </div>
                        <div class="pr_desc">
                      <?php echo substr($list["short_desc"],0,150);?>
                        </div>
                        <div class="pr_switch_wrap">
                        
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                } ?>
              </div>
            </div>
            <div class="tab-pane fade" id="Trading" role="tabpanel" aria-labelledby="Trading-tab">
                       <div class="row shop_container">
                <?php
                foreach ($tranding_p["products"] as $list) {
                  $pid =$list["id"];
                  $rated_product=getproductRatting($con,$pid);
$product_ratting=$rated_product["ratting"];
$rated_user=$rated_product["count"];
                ?>
                  <div class="col-lg-3 col-md-4 col-6">
                    <div class="product">
                      <div class="product_img">
                        <a href="shop-product-detail.php?id=<?php echo $list["id"]; ?>">
                          <img src="<?php echo $prodct_img.$list["image"]; ?>" alt="product_img1">
                        </a>
                        <div class="product_action_box">
                          <ul class="list_none pr_action_btn">
                           <li class="add-to-cart"><a href="javascript:void(0)"
                            onclick="add_toCart(<?php echo $pid;?>,1)"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                            <li><a href="shop-compare.php" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                            <li><a href="shop-quick-view.php" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                            <li><a href="#"><i class="icon-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="product_info">
                        <h6 class="product_title">
                   <a href="shop-product-detail.php?id=<?php echo $list["id"]; ?>">
                            <?php echo $list["name"]; ?>
                          </a></h6>
                        <div class="product_price">
                          <span class="price">$<?php echo $list["price"];?>
                        </span>
                          <del>
                            $<?php echo $list["mrp"];?></del>
                          <div class="on_sale">
                            <span>35% Off</span>
                          </div>
                        </div>
                        <div class="rating_wrap">
                          <div class="rating">
                  <div class="product_rate" style="width:<?php echo ($list["product_ratting"]*20); ?>%"></div>
                          </div>
                          <span class="rating_num">(<?php echo $list["rated_user"];?>)</span>
                        </div>
                        <div class="pr_desc">
                        <?php echo substr($list["short_desc"],0,150);?>
                        </div>
                        <div class="pr_switch_wrap">
                      
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                } ?>
              </div>
          
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END SECTION SHOP -->

  <!-- START SECTION SINGLE BANNER -->
  <div class="section bg_light_blue2 pb-0 pt-md-0">
    <div class="container">
      <div class="row align-items-center flex-row-reverse">
        <div class="col-md-6 offset-md-1">
          <div class="medium_divider d-none d-md-block clearfix"></div>
          <div class="trand_banner_text text-center text-md-left">
            <div class="heading_s1 mb-3">
              <span class="sub_heading">New season trends!</span>
              <h2>Best Summer Collection</h2>
            </div>
            <h5 class="mb-4">Sale Get up to 50% Off</h5>
            <a href="shop-left-sidebar.php" class="btn btn-fill-out rounded-0">Shop Now</a>
          </div>
          <div class="medium_divider clearfix"></div>
        </div>
        <div class="col-md-5">
          <div class="text-center trading_img">
            <img src="assets//images/tranding_img.png" alt="tranding_img" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END SECTION SINGLE BANNER -->

  <!-- START SECTION SHOP -->
  <div class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="heading_s1 text-center">
            <h2>Best Sellers</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="product_slider carousel_slider owl-carousel owl-theme nav_style1" data-loop="true" data-dots="false" data-nav="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
            <div class="item">
              <div class="product">
                <div class="product_img">
                  <a href="shop-product-detail.php">
                    <img src="assets/images/product_img1.jpg" alt="product_img1">
                  </a>
                  <div class="product_action_box">
                    <ul class="list_none pr_action_btn">
                      <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                      <li><a href="shop-compare.php" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                      <li><a href="shop-quick-view.php" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                      <li><a href="#"><i class="icon-heart"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="product_info">
                  <h6 class="product_title"><a href="shop-product-detail.php">Blue Dress For Woman</a></h6>
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
      </div>
    </div>
  </div>
  <!-- END SECTION SHOP -->

  <!-- START SECTION TESTIMONIAL -->
  <div class="section bg_redon">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="heading_s1 text-center">
            <h2>Our Client Say!</h2>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-9">
          <div class="testimonial_wrap testimonial_style1 carousel_slider owl-carousel owl-theme nav_style2" data-nav="true" data-dots="false" data-center="true" data-loop="true" data-autoplay="true" data-items='1'>
            <div class="testimonial_box">
              <div class="testimonial_desc">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquam amet animi blanditiis consequatur debitis dicta distinctio, enim error eum iste libero modi nam natus perferendis possimus quasi sint sit tempora voluptatem.
                </p>
              </div>
              <div class="author_wrap">
                <div class="author_img">
                  <img src="assets/images/user_img1.jpg" alt="user_img1" />
                </div>
                <div class="author_name">
                  <h6>Lissa Castro</h6>
                  <span>Designer</span>
                </div>
              </div>
            </div>
            <div class="testimonial_box">
              <div class="testimonial_desc">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquam amet animi blanditiis consequatur debitis dicta distinctio, enim error eum iste libero modi nam natus perferendis possimus quasi sint sit tempora voluptatem.
                </p>
              </div>
              <div class="author_wrap">
                <div class="author_img">
                  <img src="assets/images/user_img2.jpg" alt="user_img2" />
                </div>
                <div class="author_name">
                  <h6>Alden Smith</h6>
                  <span>Designer</span>
                </div>
              </div>
            </div>
            <div class="testimonial_box">
              <div class="testimonial_desc">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquam amet animi blanditiis consequatur debitis dicta distinctio, enim error eum iste libero modi nam natus perferendis possimus quasi sint sit tempora voluptatem.
                </p>
              </div>
              <div class="author_wrap">
                <div class="author_img">
                  <img src="assets/images/user_img3.jpg" alt="user_img3" />
                </div>
                <div class="author_name">
                  <h6>Daisy Lana</h6>
                  <span>Designer</span>
                </div>
              </div>
            </div>
            <div class="testimonial_box">
              <div class="testimonial_desc">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquam amet animi blanditiis consequatur debitis dicta distinctio, enim error eum iste libero modi nam natus perferendis possimus quasi sint sit tempora voluptatem.
                </p>
              </div>
              <div class="author_wrap">
                <div class="author_img">
                  <img src="assets/images/user_img4.jpg" alt="user_img4" />
                </div>
                <div class="author_name">
                  <h6>John Becker</h6>
                  <span>Designer</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END SECTION TESTIMONIAL -->

  <!-- START SECTION SHOP INFO -->
  <div class="section pb_70">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-lg-4">
          <div class="icon_box icon_box_style1">
            <div class="icon">
              <i class="flaticon-shipped"></i>
            </div>
            <div class="icon_box_content">
              <h5>Free Delivery</h5>
              <p>
                If you are going to use of Lorem, you need to be sure there anything
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="icon_box icon_box_style1">
            <div class="icon">
              <i class="flaticon-money-back"></i>
            </div>
            <div class="icon_box_content">
              <h5>30 Day Return</h5>
              <p>
                If you are going to use of Lorem, you need to be sure there anything
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="icon_box icon_box_style1">
            <div class="icon">
              <i class="flaticon-support"></i>
            </div>
            <div class="icon_box_content">
              <h5>27/4 Support</h5>
              <p>
                If you are going to use of Lorem, you need to be sure there anything
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END SECTION SHOP INFO -->


  <?php
  include ("footer.php");
  ?>
