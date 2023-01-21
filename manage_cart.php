<?php
require("config.php");
require("function.inc.php");

/********* add to cart *****/
if (isset($_POST["type"]) && $_POST["type"] == "add") {
  $product_id = get_safe_value($con, $_POST["product_id"]);
  $qty = get_safe_value($con, $_POST["qty"]);
     $product_qty=select($con, "products", ["id"=>$product_id],  "","sum(qty) as qty");
    $product_qty=$product_qty[0]["qty"];
   $available_qty=$product_qty - productSellQty($con,$product_id);
   if($available_qty > $qty){
  /*** checking login or not ***/
  if (isset($_SESSION["login"]) && isset($_SESSION["userid"]) && $_SESSION["login"] == true) {
    $uid = $_SESSION["userid"];
    $account_type = "Register";
  } else {
    if (isset($_SESSION["cart_userId"])) {
      $uid = $_SESSION["cart_userId"];
      $account_type = "Non register";
    } else {
      $genrate_uid = rand(1111, 9999);
      $_SESSION["cart_userId"] = $genrate_uid;
      $uid = $_SESSION["cart_userId"];
      $account_type = "Non register";
    }
  
  }
  /**** check product already exists or not **/
  $product_check = select($con, "cart", ["product_id" => $product_id, "user_id" => $uid]);
  if (count($product_check) == 0) {
    /**** insert data in to cart table ****/
    $added_on = date("Y-m-d h:i:s");
    $data = [
      "user_id" => $uid,
      "account_type" => $account_type,
      "product_id" => $product_id,
      "cart_qty" => $qty,
      "added_on" => $added_on
    ];
    $insert = insertData($con, "cart", $data);
    if ($insert) {
      $error = "no";
      $msg = "Product successful add to Cart";
    } else {
      $error = "yes";
      $msg = "Try After few moments";
    }
  } else {
    $error = "already";
    $msg = "Product Already exists in cart";
  }
   }else{
     $error="yes";
     $msg= "Product Quantity not available  ";
   }
  $result = ["error" => $error,
    "msg" => $msg];
  $result=json_encode($result);
  echo($result);
}




/**** update cart ****/
 if(isset($_POST["quantity"]) && isset($_POST["cartId"])){
  // pr($_POST);
  $result='';
   $cartid=$_POST["cartId"];
   $cartqty=$_POST["quantity"];
   $count= count($cartid);
   for($i=0;$i<$count;$i++){
     $qty=$cartqty[$i];
    $id=$cartid[$i];
    $update=updateData($con,"cart",["cart_qty"=>$qty],["cart_id"=>$id]);
    if($update){
      $result="update";
    }else{
      $result="failed";
    }
   }
   echo($result);
 }

/**** Delete cart product ****/
if(isset($_POST["type"]) && $_POST["type"]=="remove" && isset($_POST["cartId"])){
  //pr($_POST);
  $cartid=get_safe_value($con,$_POST["cartId"]);
  $deleteProduct=deleteData($con,"cart",["cart_id"=>$cartid]);
  if($deleteProduct){
    $msg="Product Remove from Cart successful";
    $error="no";
  }else{
    $msg="Try After few moments";
    $error="yes";
  }
  $result=["error"=>$error,"msg"=>$msg];
  echo(json_encode($result));
}

/***** show cart product *****/
if ($_POST["type"] && $_POST["type"]=="show") {
  if (isset($_SESSION["login"]) && isset($_SESSION["userid"]) && $_SESSION["login"] == true) {
    $uid = $_SESSION["userid"];
  } else {
    if (isset($_SESSION["cart_userId"])) {
      $uid = $_SESSION["cart_userId"];
    } else {
      $uid = 0;
    }
  }
  if ($uid != 0) {
    $join = " LEFT JOIN products on cart.product_id = products.id ";
    $column = " products.name, products.id, products.price, products.image, cart.cart_qty,cart.cart_id";
    $cart_product = select($con, "cart", ["user_id" => $uid], $join, $column);
     $cart_count = count($cart_product);
     if($cart_count>0){
    // pr($cart_product);
    /******** show cart product in front end  ********/
    
   $cart_total = 0;
   $product_img_path = product_path;
   $cart_box_html = ' <ul class="cart_list">';
   $cart_table_html="";
   $checkout_table_html="";
    foreach ($cart_product as $list) {
      //pr($list);
      $pid= $list["id"];
      $qty= $list["cart_qty"];
      $name= $list["name"];
      $price=$list["price"];
      $image=$list["image"];
      $cart_id=$list["cart_id"];
      $cart_total = $cart_total + ($list["price"] * $list["cart_qty"]);
      /******** cart box ******/
       $cart_box_html .='<li>
                       <a href="javascript:void(0)"
             onclick="deleteCartProduct('.$list["cart_id"].')"
                       class="item_remove"><i class="ion-close"></i></a>
                           <a href="shop-product-detail.php?id='.$pid.'">
                                 <img src="'.$product_img_path.$image.'" alt="cart_thumb1">'.$name.'</a>
                            <span class="cart_quantity"> '.$qty.' x <span class="cart_amount"> <span class="price_symbole">$</span></span>'.$price.'</span>
                          </li>';
     /******""* cart table *******/
     $cart_table_html.= '  
             <tr>
         
                <td class="product-thumbnail">
                   <a href="shop-product-detail.php?id='.$pid.'">
                  <img src="'.$product_img_path.$image.'" alt="cart_thumb1"></a>
               </td>
               <td class="product-name" data-title="Product">
               <a href="shop-product-detail.php?id='.$pid.'">'.$name.'</a>
               </td>
             <td class="product-price" data-title="Price">$'.$price.'</td>
             <td class="product-quantity" data-title="Quantity">
                 <input type="hidden" name="cartId[]" value="'.$cart_id.'">
               <div class="quantity">
                    <input type="button" value="-" class="minus">
                      <input type="text" name="quantity[]" value="'.$qty.'" title="Qty" class="qty" size="4">
                     <input type="button" value="+" class="plus">
                 </div>
              </td>
             <td class="product-subtotal" data-title="Total">$'.($price*$qty).'</td>
             <td class="product-remove" data-title="Remove">
             <a href="javascript:void(0)"
             onclick="deleteCartProduct('.$list["cart_id"].')"
             ><i class="ti-close"></i></a></td>
            </tr>';
   /*************** checkout cart table ****/
   $checkout_table_html.='<tr>
                    <td>'.$name.'<span class="product-qty">x '.$qty.'</span></td>
                    <td>$'.$price.'</td>
                  </tr>';
    }
    $cart_box_html .= '
            </ul>
              <div class="cart_footer">
                   <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span class="price_symbole">$</span></span>'.$cart_total.'</p>
                    <p class="cart_buttons"><a href="shop-cart.php" class="btn btn-fill-line rounded-0 view-cart">View Cart</a><a href="checkout.php" class="btn btn-fill-out rounded-0 checkout">Checkout</a></p>
              </div>';
              
      $msg="show";
     }else{
       $msg="empty";
       $cart_box_html="<h2 class='text-center p-3'> Empty Cart </h2> <hr>
                        please add to Product ";
        $cart_table_html="<tr>
                     <td class='text-center' colspan='6'>Cart is Empty...</td>
                      </tr>";
        $cart_total=0;
        $cart_box_html="<tr>
                          <td class='text-center'> <strong>Cart is empty</strong></td>
                         </tr>";
     }
 
  }else{
    $msg="empty";
    $cart_box_html="<h2 class='text-center p-3'> Empty Cart </h2> <hr>
                        please add to Product ";
    $cart_table_html="<tr>
                     <td class='text-center' colspan='6'>Cart is Empty...</td>
                      </tr>";
    $cart_total=0;
 
   $cart_box_html="<tr>
                          <td class='text-center'> <strong>Cart is empty</strong></td>
                         </tr>";
  }
  $result= ["msg"=>$msg,"cart_count"=>$cart_count,"cart_box"=>$cart_box_html,"cart_table"=>$cart_table_html,"cart_total"=>$cart_total,"Checkout_table"=>$checkout_table_html];
  echo json_encode($result);
}














?>