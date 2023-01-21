<?php
include("top.php");
if (isset($_GET["oid"])) {
  $oid = get_safe_value($con, $_GET["oid"]);

  $join = " LEFT JOIN orders on order_details.oid = orders.order_id
        LEFT JOIN order_status on  orders.order_status = order_status.id
        LEFT JOIN products on order_details.pid= products.id";
  $order_list = select($con, 'order_details', ["oid" => $oid], $join);
 $order_date = date("d M, Y", strtotime($order_list[0]["add_on"]));

  $order_status = $order_list[0]["status"];
  $fname = $order_list[0]["fname"];
  $lname = $order_list[0]["lname"];
  $mobile = $order_list[0]["mobile"];
  $email = $order_list[0]["email"];
  $total_price = $order_list[0]["total_price"];
  $final_price = $order_list[0]["final_price"];
  $payment_method = $order_list[0]["payment_method"];
  $payment_id = $order_list[0]["payment_id"];
  $payment_status = $order_list[0]["payment_status"];
  $coupons_code = $order_list[0]["coupons_code"];
  $coupon_value = $order_list[0]["coupon_value"];
  $city = $order_list[0]["city"];
  $address = $order_list[0]["address"];
  $country = $order_list[0]["country"];
  $state = $order_list[0]["state"];
  $pincode = $order_list[0]["pincode"];
  $payment_method=$order_list[0]["payment_method"];

}
//pr($order_list);
$site_url = site_url;
$product_img_path = product_path;

?>
<!-- START SECTION BREADCRUMB -->

<div class="breadcrumb_section bg_gray page-title-mini">

  <div class="container">
    <!-- STRART CONTAINER -->
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="page-title">
          <h1>Order Details</h1>
        </div>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb justify-content-md-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Pages</a></li>
          <li class="breadcrumb-item active">Order Details</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->
<!-- START SECTION SHOP -->
<div class="section">
  <div class="container">
    <div class="row pr-3 pl-3">
      <div class="col-12">

        <p class="d-md-inline-block">
          Order on <strong><?php echo $order_date;?></strong> &nbsp;<span class="text-dark">|</span> Order# <?= $oid; ?>
        </p>
        <a href="#" class="float-right">Invoice</a>
      </div>
      <div class="card w-100 ">
        <div class="row orders_details p-2">
          <div class="col-md-6 col-sm-12 mb-2">
            <h5>Shipping Address</h5>
            <?php 
            echo $fname ." ".$lname."<br>".$address."<br>".$city.", ".$state." ".$pincode."<br>".$country;
            ?>
            
          </div>
          <div class="col-md-6 col-sm-12">
            <h5>Payment Details</h5>
            payment method:- <?php echo $payment_method;?><br>
           <?php if($payment_method !="cod"){
             echo "Payment id : ".$payment_id."<br>";
           }
           echo "Payment Status: ".$payment_status;
           ?>
            
            
            <div class="mt-2">
              <h5>order Summary</h5>
              <table class=" w-100">
                <tr>
                  <td>Item(s) Subtotal:</td>
                  <td>$<?php echo($total_price)?></td>
                </tr>
                <tr>
                  <td>Shipping:</td>
                  <td>$00.00</td>
                </tr>
                <tr>
                  <td>Total:</td>
                  <td>$<?= $total_price?></td>
                </tr>
                <?php
                if($coupons_code !=""){
                  echo "<tr>
                          <td>Coupon Code: </td>
                          <td>".$coupons_code."</td>
                         </tr>
                         <tr>
                         <td>Coupon Value</td>
                         <td>$".$coupon_value."</td></tr>";
                          
                }
                ?>
                <tr>
                  <th>Grand Total:</th>
                  <th>$<?= $final_price; ?></th>
                </tr>

              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 mt-4">
      <div class="table-responsive wishlist_table">
        <table class="table">
          <thead>
            <tr>
              <th class="product-thumbnail">&nbsp;</th>
              <th class="product-name">Product</th>
              <th class="product-stock-status">Quantity</th>

              <th class="product-price">Price</th>
              <th class="product-add-to-cart"></th>

            </tr>
          </thead>
          <tbody>
            <?php foreach ($order_list as $list) {
              ?>
              <tr>
                <td class="product-thumbnail">
                  <a href="#">
                    <img src="<?php echo $site_url.$product_img_path.$list["image"]; ?>" alt="product1"></a></td>
                <td class="product-name" data-title="Product"><a href="#"><?php echo $list["name"]; ?></a></td>
                <td class="product-price" data-title="Price"><?php echo $list["product_qty"]; ?></td>
                <td class="product-stock-status" data-title="Stock Status">$
                  <?php echo $list["product_price"]; ?>
                </td>
                <td class="product-add-to-cart"><a href="#" class="btn btn-fill-out">Buy it Again</a></td>

              </tr>
              <?php
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
<?php
include("footer.php");
?>
<style>
.division {
color: rgba(0,0,0,0.6);
}
.orders_details {
font-size: 14px;
}
</style>