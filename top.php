<?php
include("config.php");
include("function.inc.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="Anil z" name="author">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Shopwise is Powerful features and You Can Use The Perfect Build this Template For Any eCommerce Website. The template is built for sell Fashion Products, Shoes, Bags, Cosmetics, Clothes, Sunglasses, Furniture, Kids Products, Electronics, Stationery Products and Sporting Goods.">
    <meta name="keywords" content="ecommerce, electronics store, Fashion store, furniture store,  bootstrap 4, clean, minimal, modern, online store, responsive, retail, shopping, ecommerce store">

    <!-- SITE TITLE -->
    <title>Shopwise - eCommerce Bootstrap 4 HTML Template</title>
    <!-- Favicon Icon -->

    <!-- Animation CSS -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/linearicons.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/simple-line-icons.css">
    <!--- owl carousel CSS-->
    <link rel="stylesheet" href="assets/owlcarousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.css">
    <link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.default.min.css">
        <!-- jquery-ui CSS -->
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/slick-theme.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
   <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
   

</head>

<body>

    <!-- LOADER -
  <div class="preloader">
        <div class="lds-ellipsis">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div> 
    <!-- END LOADER -->

    <!-- Home Popup Section -->
  
    
    <!---<div class="modal fade subscribe_popup" id="onload-popup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                </button>
                    <div class="row no-gutters">
                        <div class="col-sm-5">
                            <div class="background_bg h-100" data-img-src="assets/images/popup_img.jpg"></div>
                        </div>
                        <div class="col-sm-7">
                            <div class="popup_content">
                                <div class="popup-text">
                                    <div class="heading_s1">
                                        <h4>Subscribe and Get 25% Discount!</h4>
                                    </div>
                                    <p>Subscribe to the newsletter to receive updates about new products.</p>
                                </div>
                                <form method="post">
                                    <div class="form-group">
                                        <input name="email" required type="email" class="form-control rounded-0" placeholder="Enter Your Email">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-fill-line btn-block text-uppercase rounded-0" title="Subscribe" type="submit">Subscribe</button>
                                    </div>
                                </form>
                                <div class="chek-form">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                        <label class="form-check-label" for="exampleCheckbox3"><span>Don't show this popup again!</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->
    <!-- End Screen Load Popup Section -->

    <!-- START HEADER -->
    <header class="header_wrap fixed-top header_with_topbar">
        <div class="top-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <div class="lng_dropdown mr-2">
                                <select name="countries" class="custome_select">
                                <option value='en' data-image="assets/images/eng.png" data-title="English">English</option>
                                <option value='fn' data-image="assets/images/fn.png" data-title="France">France</option>
                                <option value='us' data-image="assets/images/us.png" data-title="United States">United States</option>
                            </select>
                            </div>
                            <div class="mr-3">
                                <select name="countries" class="custome_select">
                                <option value='USD' data-title="USD">USD</option>
                                <option value='EUR' data-title="EUR">EUR</option>
                                <option value='GBR' data-title="GBR">GBR</option>
                            </select>
                            </div>
                            <ul class="contact_detail text-center text-lg-left">
                                <li><i class="ti-mobile"></i><span>123-456-7890</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center text-md-right">
                            <ul class="header_list">
                                <li><a href="compare.php"><i class="ti-control-shuffle"></i><span>Compare</span></a></li>
                                <li><a href="wishlist.php"><i class="ti-heart"></i><span>Wishlist</span></a></li>
                                <li>
                                  <?php 
                                  if(isset($_SESSION["login"]) && $_SESSION["login"]===true){
                   echo '<a href="my-account.php"><i class="ti-user"></i><span>My Account</span></a>';
}else{
                echo ' <a href="login.php"><i class="ti-user"></i><span>Login</span></a>';
}?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom_header dark_skin main_menu_uppercase">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="index.php">
                        <img class="logo_light" src="assets/images/logo_light.png" alt="logo" />
                        <img class="logo_dark" src="assets/images/logo_dark.png" alt="logo" />
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false"> 
                    <span class="ion-android-menu"></span>
                </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="nav-link dropdown-toggle active" href="#">Home</a>
                                <div class="dropdown-menu">
                                    <ul>
                                        <li><a class="dropdown-item nav-link nav_item active" href="index.php">Fashion 1</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="index-2.php">Fashion 2</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="index-3.php">Furniture 1</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="index-4.php">Furniture 2</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="index-5.php">Electronics 1</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="index-6.php">Electronics 2</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu">
                                    <ul>
                                        <li><a class="dropdown-item nav-link nav_item" href="about.php">About Us</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="contact.php">Contact Us</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="faq.php">Faq</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="404.php">404 Error Page</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="login.php">Login</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="signup.php">Register</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="term-condition.php">Terms and Conditions</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="dropdown dropdown-mega-menu">
                                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Products</a>
                                <div class="dropdown-menu">
                                    <ul class="mega-menu d-lg-flex">
                                        <li class="mega-menu-col col-lg-3">
                                            <ul>
                                                <li class="dropdown-header">Woman's</li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-list-left-sidebar.php">Vestibulum sed</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-left-sidebar.php">Donec porttitor</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-right-sidebar.php">Donec vitae facilisis</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-list.php">Curabitur tempus</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-load-more.php">Vivamus in tortor</a></li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-col col-lg-3">
                                            <ul>
                                                <li class="dropdown-header">Men's</li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-cart.php">Donec vitae ante ante</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="checkout.php">Etiam ac rutrum</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="wishlist.php">Quisque condimentum</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="compare.php">Curabitur laoreet</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="order-completed.php">Vivamus in tortor</a></li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-col col-lg-3">
                                            <ul>
                                                <li class="dropdown-header">Kid's</li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail.php">Donec vitae facilisis</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-left-sidebar.php">Quisque condimentum</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-right-sidebar.php">Etiam ac rutrum</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.php">Donec vitae ante ante</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.php">Donec porttitor</a></li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-col col-lg-3">
                                            <ul>
                                                <li class="dropdown-header">Accessories</li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail.php">Donec vitae facilisis</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-left-sidebar.php">Quisque condimentum</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-right-sidebar.php">Etiam ac rutrum</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.php">Donec vitae ante ante</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.php">Donec porttitor</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <div class="d-lg-flex menu_banners">
                                        <div class="col-sm-4">
                                            <div class="header-banner">
                                                <img src="assets/images/menu_banner1.jpg" alt="menu_banner1">
                                                <div class="banne_info">
                                                    <h6>10% Off</h6>
                                                    <h4>New Arrival</h4>
                                                    <a href="#">Shop now</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="header-banner">
                                                <img src="assets/images/menu_banner2.jpg" alt="menu_banner2">
                                                <div class="banne_info">
                                                    <h6>15% Off</h6>
                                                    <h4>Men's Fashion</h4>
                                                    <a href="#">Shop now</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="header-banner">
                                                <img src="assets/images/menu_banner3.jpg" alt="menu_banner3">
                                                <div class="banne_info">
                                                    <h6>23% Off</h6>
                                                    <h4>Kids Fashion</h4>
                                                    <a href="#">Shop now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Blog</a>
                                <div class="dropdown-menu dropdown-reverse">
                                    <ul>
                                        <li>
                                            <a class="dropdown-item menu-link dropdown-toggler" href="#">Grids</a>
                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-three-columns.php">3 columns</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-four-columns.php">4 columns</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-left-sidebar.php">Left Sidebar</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-right-sidebar.php">right Sidebar</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-standard-left-sidebar.php">Standard Left Sidebar</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-standard-right-sidebar.php">Standard right Sidebar</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="dropdown-item menu-link dropdown-toggler" href="#">Masonry</a>
                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-three-columns.php">3 columns</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-four-columns.php">4 columns</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-left-sidebar.php">Left Sidebar</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-right-sidebar.php">right Sidebar</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="dropdown-item menu-link dropdown-toggler" href="#">Single Post</a>
                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-single.php">Default</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-single-left-sidebar.php">left sidebar</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-single-slider.php">slider post</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-single-video.php">video post</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-single-audio.php">audio post</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="dropdown-item menu-link dropdown-toggler" href="#">List</a>
                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-list-left-sidebar.php">left sidebar</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-list-right-sidebar.php">right sidebar</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="dropdown dropdown-mega-menu">
                                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Shop</a>
                                <div class="dropdown-menu">
                                    <ul class="mega-menu d-lg-flex">
                                        <li class="mega-menu-col col-lg-9">
                                            <ul class="d-lg-flex">
                                                <li class="mega-menu-col col-lg-4">
                                                    <ul>
                                                        <li class="dropdown-header">Shop Page Layout</li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-list.php">shop List view</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-list-left-sidebar.php">shop List Left Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-list-right-sidebar.php">shop List Right Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-left-sidebar.php">Left Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-right-sidebar.php">Right Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-load-more.php">Shop Load More</a></li>
                                                    </ul>
                                                </li>
                                                <li class="mega-menu-col col-lg-4">
                                                    <ul>
                                                        <li class="dropdown-header">Other Pages</li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-cart.php">Cart</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="checkout.php">Checkout</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="my-account.php">My Account</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="wishlist.php">Wishlist</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="compare.php">compare</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="order-completed.php">Order Completed</a></li>
                                                    </ul>
                                                </li>
                                                <li class="mega-menu-col col-lg-4">
                                                    <ul>
                                                        <li class="dropdown-header">Product Pages</li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail.php">Default</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-left-sidebar.php">Left Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-right-sidebar.php">Right Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.php">Thumbnails Left</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-col col-lg-3">
                                            <div class="header_banner">
                                                <div class="header_banner_content">
                                                    <div class="shop_banner">
                                                        <div class="banner_img overlay_bg_40">
                                                            <img src="assets/images/shop_banner.jpg" alt="shop_banner" />
                                                        </div>
                                                        <div class="shop_bn_content">
                                                            <h5 class="text-uppercase shop_subtitle">New Collection</h5>
                                                            <h3 class="text-uppercase shop_title">Sale 30% Off</h3>
                                                            <a href="#" class="btn btn-white rounded-0 btn-sm text-uppercase">Shop Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li><a class="nav-link nav_item" href="contact.php">Contact Us</a></li>
                        </ul>
                    </div>
                    <ul class="navbar-nav attr-nav align-items-center">
                        <li><a href="javascript:void(0);" class="nav-link search_trigger"><i class="linearicons-magnifier"></i></a>
                            <div class="search_wrap">
                                <span class="close-search"><i class="ion-ios-close-empty"></i></span>
                                <form method="Post" id="search_form" action="shop.php">
                                    <input type="text" name="search" placeholder="Search" class="form-control" id="search_input">
                                    <button type="submit" id="search_btn" class="search_icon"><i class="ion-ios-search-strong"></i></button>
                                </form>
                            </div>
                            <div class="search_overlay"></div>
                        </li>
                        <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#" data-toggle="dropdown"><i class="linearicons-cart"></i><span class="cart_count">0</span></a>
                            <div class="cart_box dropdown-menu dropdown-menu-right">
                            
                               <ul class="cart_list">
                                    <li>
                                        <a href="#" class="item_remove"><i class="ion-close"></i></a>
                                        <a href="#"><img src="assets/images/cart_thamb1.jpg" alt="cart_thumb1">Variable product 001</a>
                                        <span class="cart_quantity"> 1 x <span class="cart_amount"> <span class="price_symbole">$</span></span>78.00</span>
                                    </li>
                                    <li>
                                        <a href="#" class="item_remove"><i class="ion-close"></i></a>
                                        <a href="#"><img src="assets/images/cart_thamb2.jpg" alt="cart_thumb2">Ornare sed consequat</a>
                                        <span class="cart_quantity"> 1 x <span class="cart_amount"> <span class="price_symbole">$</span></span>81.00</span>
                                    </li>
                                </ul>
                                <div class="cart_footer">
                                    <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span class="price_symbole">$</span></span>00.00</p>
                                    <p class="cart_buttons"><a href="shop-cart.php" class="btn btn-fill-line rounded-0 view-cart">View Cart</a><a href="checkout.php" class="btn btn-fill-out rounded-0 checkout">Checkout</a></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
            <!---- massage show ---->
    <div class="alert  alert-dismissible text-center" id="all_massage">
  
    </div>
    </header>
    <!-- END HEADER -->
