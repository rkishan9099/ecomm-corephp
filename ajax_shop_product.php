<?php
include("config.php");
include("function.inc.php");
$where=[];
$brand_list="";
$prodct_img = product_path;
$brand_arg="";
$price_filter=[];
$short="new";
$limit="";
$search="";
//pr($_POST);
$limit= get_safe_value($con,$_POST["product_limit"]);
$short= get_safe_value($con,$_POST["short"]);
 $catid= get_safe_value($con,$_POST["catid"]);
 $price_min= get_safe_value($con,$_POST["min"]);
 $price_max=get_safe_value($con,$_POST["max"]);
 $search=get_safe_value($con,$_POST["search"]);
 if($price_max!="" && $price_min !="" && $price_min<$price_max){
   $price_filter=["min"=>$price_min,"max"=>$price_max];
 }
$brand_list=$_POST["brand"];
if(isset($_POST["brand"])){
 $brand_arg = "products.brand IN (" . implode(",",$brand_list).")";
}
if($catid != ""){
$where=["products.category_id"=>$catid];
}
$product=get_product($con,$short,$limit,0,$where,$brand_arg,$search,$price_filter);
//pr($product);
if(count($product)>0){
$html .='<div class="row shop_container">';
          
              foreach ($product["products"] as $list) {
              $pid = $list["id"];
 $rated_product=getproductRatting($con,$pid);
$product_ratting=$rated_product["ratting"];
$rated_user=$rated_product["count"];
              $html .= '<div class="col-lg-3 col-md-4 col-6">
                  <div class="product">
                    <div class="product_img">
                      <a href="shop-product-detail.php?id='. $list["id"].'">
                        <img src="'. $prodct_img.$list["image"].'" alt="product_img1">
                      </a>
                      <div class="product_action_box">
                        <ul class="list_none pr_action_btn">
                           <li class="add-to-cart"><a href="javascript:void(0)"
                            onclick="add_toCart('.$pid.',1)"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                          <li><a href="shop-compare.php" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                          <li><a href="shop-quick-view.php" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                          <li><a href="#"><i class="icon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="product_info">
                      <h6 class="product_title">
                        <a href="shop-product-detail.php?id='.$list["id"].'">
                          '. $list["name"].'
                        </a></h6>
                      <div class="product_price">
                        <span class="price">$'.$list["price"].'</span>
                        <del>
                          $'.$list["mrp"].'</del>
                        <div class="on_sale">
                          <span>35% Off</span>
                        </div>
                      </div>
                <div class="rating_wrap">
                          <div class="rating">
                  <div class="product_rate" style="width:'. ($list["product_ratting"]*20).'%"></div>
                          </div>
                          <span class="rating_num">('. $list["rated_user"].')</span>
                        </div>
                      <div class="pr_switch_wrap">


                      </div>
                      <div class="list_product_action_box">

                        <ul class="list_none pr_action_btn">

                          <li class="add-to-cart"><a href="javascript:void(0)"
                          class="add_cart_btn_'.$pid.'" type="button" onclick="add_toCart('.$pid.',1)"
                          ><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                          <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                          <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                          <li><a href="#"><i class="icon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>';
              } 

$result=["msg"=>"done","product"=>$html];
}else{
  $result=["msg"=>"no","product"=>"No product available"];
}

//echo($html);
echo json_encode($result);

?>