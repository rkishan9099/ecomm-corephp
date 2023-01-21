<?php
include ("top.php");
$email = "";
$password = "";
$checked = "";
if (isset($_COOKIE["login_pass"]) && $_COOKIE["login_email"]) {
  $password = $_COOKIE["login_pass"];
  $email = $_COOKIE["login_email"];
  $checked = "checked";
}
$cartitem=getcartitem($con);
if($cartitem["cart_total"]==0){
  header("location:index.php");
}
?>
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
  <div class="container">
    <!-- STRART CONTAINER -->
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="page-title">
          <h1>Checkout</h1>
        </div>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb justify-content-md-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Pages</a></li>
          <li class="breadcrumb-item active">Checkout</li>
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
   <?php if(!isset($_SESSION["login"])){
   $col_size=6;?>
        <div class="col-lg-6">
          <div class="toggle_info">
            <span><i class="fas fa-user"></i>Returning customer? <a href="#loginform" data-toggle="collapse" class="collapsed" aria-expanded="false">Click here to login</a></span>
          </div>
          <div class="panel-collapse collapse login_form" id="loginform">
            <div class="panel-body">
              <p>
                If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.
              </p>
              <form method="post" class="loginForm">
                <input type="hidden" name="type" value="login">
                <div class="form-group">
                  <input type="text" class="form-control" name="email" placeholder="Your Email" value="<?php echo $email; ?>">
                </div>
                <div class="form-group">
                  <input class="form-control" required type="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
                </div>
                <div class="login_footer form-group">
                  <div class="chek-form">
                    <div class="custome-checkbox">
                      <input class="form-check-input" type="checkbox" name="rememberMe" id="exampleCheckbox1" value="true" <?php echo $checked; ?>>
                      <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                    </div>
                  </div>
                  <a href="forgot_password.php">Forgot password?</a>
                </div>
                <div class="form-group">
                  <button type="button" class="btn login_btn btn-fill-out btn-block" name="login"  onclick="login_user()">Log in</button>
                </div>
              </form>
                <div class="form-output mt-3 alert  login_output">
                hhhjvbbbhhhh
              </div>
            </div>
          </div>
        </div>
        <?php }else{
          $col_size=12;
        }
        ?>
       <div class="col-lg-<?php echo $col_size;?>">
          <div class="toggle_info">
            <span><i class="fas fa-tag"></i>Have a coupon? <a href="#coupon" data-toggle="collapse" class="collapsed" aria-expanded="false">Click here to enter your code</a></span>
          </div>
          <div class="panel-collapse collapse coupon_form" id="coupon">
            <div class="panel-body">
              <p>
                If you have a coupon code, please apply it below.
              </p>
              <div class="coupon field_form input-group">
                <input type="text" value="" class="form-control" placeholder="Enter Coupon Code.." id="coupon_code">
                <div class="input-group-append">
                  <button class="btn btn-fill-out btn-sm" type="submit" onclick="applyCoupanCode()">Apply Coupon</button>
                </div>
              </div>
                  <div class="form-output mt-3 alert  coupon_output">
            
              </div>
            </div>
          </div>
        </div>
       
      </div>
      <div class="row">
        <div class="col-12">
          <div class="medium_divider"></div>
          <div class="divider center_icon">
            <i class="linearicons-credit-card"></i>
          </div>
          <div class="medium_divider"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="heading_s1">
            <h4>Shipping Details</h4>
          </div>
          <form method="post" id="checkout_form">
            <div class="form-group">
              <input type="text"  class="form-control c_fname" name="fname" placeholder="First name *" >
            </div>
            <div class="form-group">
              <input type="text"  class="form-control c_lname" name="lname" placeholder="Last name *">
            </div>
              <div class="form-group">
              <input class="form-control c_phone"  type="text" name="phone" placeholder="Phone *" required>
            </div>
            <div class="form-group">
              <input class="form-control c_email"  type="text" name="email" placeholder="Email address *" required>
            </div>
      
            <div class="form-group">
                <input type="text"  class="form-control c_country" name="country" placeholder="Country Name *">
            </div>
            <div class="form-group">
             <input type="text" required class="form-control c_state" name="state" placeholder="State Name *">
           
            </div>
            <div class="form-group">
          <input type="text" class="form-control c_city" name="city" placeholder="City Name *">
             
            </div>

            <div class="form-group">
              <input type="text" class="form-control c_address" name="billing_address" required="" placeholder="Address *" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="billing_address2" placeholder="Address line2">
            </div>

            <div class="form-group">
              <input class="form-control c_postcode" required type="text" name="zipcode" placeholder="Postcode / ZIP *" required>
            </div>
          
            <!----<div class="form-group">
              <div class="chek-form">
                <div class="custome-checkbox">
                  <input class="form-check-input" type="checkbox" name="checkbox" id="createaccount">
                  <label class="form-check-label label_info" for="createaccount"><span>Create an account?</span></label>
                </div>
              </div>
            </div>-
            <div class="form-group create-account">
              <input class="form-control" required type="password" placeholder="Password" name="password">
            </div>--->
          
             <div class="form-output mt-3 alert  checkout_output">
              
              </div>
        </div>
        <div class="col-md-6">
          <div class="order_review">
            <div class="heading_s1">
              <h4>Your Orders</h4>
            </div>
            <div class="table-responsive order_table">
              <table class="table">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody id="checkout_table">
                 <!---- <tr>
                    <td>woman full sliv dress <span class="product-qty">x 3</span></td>
                    <td>$204.00</td>
                  </tr>-->
                </tbody>
                <tfoot>
                  <tr>
                    <th>SubTotal</th>
                    <td class="product-subtotal cart_sub_total">$00.00</td>
                  </tr>
                  <tr>
                    <th>Shipping</th>
                    <td>Free Shipping</td>
                  </tr>
                 <tr class="coupon_de" style="display:none">
                    <th>Coupon Code</th>
                    <td class="coupon_code">Rk50</td>
                  </tr>
                  <tr class="coupon_d" style="display:none">
                    <th>Discount</th>
                    <td id="discount">$50</td>
                  </tr>
                  <tr>
                    <th>Total</th>
                    <td class="product-subtotal cart_sub_total final_price">$00.00</td>
                <input type="number" name="final_price" id="final_price" value="" hidden>
                <input type="text" name="coupon_code" id="couponCode" hidden>
                <input type="number" name="coupon_value" id="coupon_value" value="0" hidden>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="payment_method">
        
              <div class="heading_s1">
                <h4>Payment</h4>
              </div>
              <div class="payment_option">
                    <div class="custome-radio">
                  <input class="form-check-input" type="radio" name="payment_option" id="cod" value="cod" checked>
                  <label class="form-check-label" for="cod">COD</label>
                  <p data-method="cod" class="payment-text">
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.
                  </p>
                </div>
                <div class="custome-radio">
                  <input class="form-check-input"  type="radio" name="payment_option" id="instamojo" value="instamojo" >
                  <label class="form-check-label" for="instamojo">IntstaMojo</label>
                  <p data-method="instamojo" class="payment-text">
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.
                  </p>
                </div>
                <!----
                <div class="custome-radio">
                  <input class="form-check-input" type="radio" name="payment_option" id="exampleRadios4" value="payU">
                  <label class="form-check-label" for="exampleRadios4">PayU</label>
                  <p data-method="option4" class="payment-text">
                    Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.
                  </p>
                </div>
                <div class="custome-radio">
                  <input class="form-check-input" type="radio" name="payment_option" id="exampleRadios5" value="paytm">
                  <label class="form-check-label" for="exampleRadios5">Paytm</label>
                  <p data-method="option5" class="payment-text">
                    Pay via PayPal; you can pay with your credit card if you don't have a PayPal account.
                  </p>
                </div>
                --->
              </div>
            </div>
              </form>
            <a href="javascript:void(0)" class="btn btn-fill-out btn-block" onclick="placeOrder()">Place Order</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END SECTION SHOP -->


  <?php
  include ("footer.php");
  ?>
<script>

   function placeOrder(){
  // alert(999);
  let formdata= $("#checkout_form").serialize();
  
  let error = true;
     if($(".c_fname").val()==""){
    msg="Enter your first name ";
    error= true;
     }else  if($(".c_lname").val()==""){
       msg= "Enter your Last name ";
       error=true;
     }else if($(".c_phone").val()==""){
       msg="Enter your phone number";
       error=true;
     }else if($(".c_email").val()==""){
       msg="Enter your Email address";
       error=true;
     }else if($(".c_country").val()==""){
       msg="Enter your Country ";
       error=true;
     }else if($(".c_state").val()==""){
       msg="Enter your State ";
       error=true;
     }else if($(".c_city").val()==""){
       msg="Enter your city ";
       error=true;
     }else if($(".c_address").val()==""){
       msg= "Enter your Address ";
       error=true;
     }else if($(".c_postcode").val()==""){
       msg="Enter your Postcode";
       error=true;
     }else{
       error=false;
     }
    // alert(formdata);
   if(error==true){
     $(".checkout_output").removeClass("alert-info");
      $(".checkout_output").addClass("alert-danger");
      $(".checkout_output").html("<strong>"+msg+"</strong>");
      $(".checkout_output").show();
   }else{
     //$(".checkout_output").hide();
     //alert(formdata);
     $.ajax({
        url:"place_order.php",
        type:"post",
        data:formdata,
        success: function (response){
          //alert(response);
          
         result=JSON.parse(response);
         if(result.status=="success"){
           showcartproduct();
            $(".checkout_output").removeClass("alert-danger");
            $(".checkout_output").addClass("alert-info");
            
            $("#checkout_form")[0].reset();
         }else{
           
           $(".checkout_output").removeClass("alert-info");
            $(".checkout_output").addClass("alert-danger");
            
         }
          $(".checkout_output").html("<strong>"+result.msg+"</strong>");
          $(".checkout_output").show();
        }
      });
      
   }

   }
</script>