function showcartproduct(){
  //alert(999666);
  $.ajax({
    url:"manage_cart.php",
    type:"post",
    data:"type=show",
    success: function (response){
    //alert (response);
      data= JSON.parse(response);
   //alert(data.cart_total);
      if(data.msg=="show"){
      $(".cart_count").html(data.cart_count);
      $(".cart_box").html(data.cart_box);
      $("#cart_table").html(data.cart_table);
      $(".cart_sub_total").html("$"+data.cart_total);
      $("#final_price").val(data.cart_total);
      
      //document.getElementById("final_price").value=data.cart_total;
      $("#checkout_table").html(data.Checkout_table);
      }else{
      $(".cart_count").html(0);
      $("#cart_table").html(data.cart_table);
      $("#checkout_table").html(data.Checkout_table);
      $(".cart_list").html("<li><strong>Cart is Empty ....</strong></li>");
      }
      
    }
  });
}
showcartproduct();
function deleteCartProduct(cartid){
  $.ajax({
    url:"manage_cart.php",
    type:"post",
    data:"type=remove&cartId="+cartid,
    success: function (response){
      data= JSON.parse(response);
      if(data.error=="yes"){
        $("#all_massage").addClass("alert-danger");
      }else{
       $("#all_massage").addClass("alert-info");
      }
    $("#all_massage").html(`<strong>${data.msg}</strong>`);
     $("#all_massage").show();
    setTimeout(function(){$("#all_massage").slideUp(); }, 5000);
     showcartproduct();
    }
  });
  
}

function add_toCart(pid,qty=""){
 // alert(qty);
  //  $(".add_cart_btn_"+pid).html('<span class="spinner-border text-danger"></span>');
  // alert(pid);
  if(qty==""){
  cart_qty=$("#cart_qty").val();
  }else{
    cart_qty=qty;
  }
$.ajax({
    url:"manage_cart.php",
    type:"post",
    data:{type:"add", product_id:pid,qty:cart_qty},
    success: function (response){
     //alert(response);
     data= JSON.parse(response);
     if(data.error=="yes"){
        $("#all_massage").removeClass("alert-info alert-success");
        $("#all_massage").addClass("alert-danger");
      }else if(data.error=="already"){
        $("#all_massage").removeClass("alert-danger alert-success");
       $("#all_massage").addClass("alert-info");
      }else{
        $("#all_massage").removeClass("alert-info alert-danger");
      $("#all_massage").addClass("alert-success");
       }
     $(".add_cart_btn_"+pid).html( `<i class="icon-basket-loaded"></i> Add to cart`);
     $("#all_massage").html(`<strong>${data.msg}</strong>`);
     $("#all_massage").show();
    setTimeout(function(){$("#all_massage").slideUp(); }, 5000);
     showcartproduct();
    }
  })
}
$("#update_cart_btn").on("click", function (){

   formdata=$("#cart_form").serialize();

   //  alert(formdata);
    $.ajax({
      url:"manage_cart.php",
      type:"post",
      data:formdata,
      success:function(response){
        //$("#all_massage").html(response);
        if(response=="update"){
        $("#all_massage").addClass("alert-info");
        $("#all_massage").html("<strong> Cart data update successful</strong>");
        }else{
          $("#all_massage").addClass("alert-danger");
       
         $("#all_massage").html("<strong> Try After few moments </strong>");
        }
        $("#all_massage").show();
       setTimeout(function(){$("#all_massage").slideUp(); }, 5000);
        showcartproduct();
      }
    });
  });





  /******* login form ****/
    function login_user(){
    //  alert(9999);
     
     $(".login_btn").html('<span class="spinner-border text-danger"></span>');
    
      formdata = $(".loginForm").serialize();
     
      $.ajax({
        url: "ajax_login.php",
        type: "post",
        data: formdata,
        success: function (response) {
         //alert(response);
          data = JSON.parse(response);

          if (data.error == "yes") {
            $(".login_btn").html("Register");
            $(".login_output").removeClass("alert-success");
            $(".login_output").addClass("alert-danger");
            $(".login_btn").html('Log In');
               $(".login_output").html(`<strong>${data.msg}</strong>`);
          $(".login_output").show();
          }
          if (data.error == "no") {
            window.location=window.location;
          }
       
        }
      });
    
    }
    
    
/****** checkout page ****/
  
  function  applyCoupanCode(){
      //alert(999);
      coupon_code=$("#coupon_code").val();
      if(coupon_code!=""){
        $.ajax({
          url:"apply_coupan_code.php",
          type:"post",
          data:"code="+coupon_code,
          success: function (response){
            data= JSON.parse(response);
            if(data.error=="no"){
           $(".coupon_code").html(data.coupon);
              $("#couponCode").val(data.coupon);
              $("#discount").html("$"+data.discount);
              $("#coupon_value").val(data.discount);
              $(".coupon_output").removeClass("alert-danger");
              $(".coupon_output").addClass("alert-success");
              $(".coupon_d").show();
            }else{
              $(".coupon_d").hide();
              $("#couponCode").val("");
              $("#coupon_value").val("");
              $(".coupon_output").addClass("alert-danger");
              $(".coupon_output").removeClass("alert-success");
     
            }
           $(".final_price").html("$"+data.final_price);
           $("#final_price").val(data.final_price);
           $(".coupon_output").html("<strong>"+data.msg+"</strong>");
           $(".coupon_output").show();
          }
        });
      }else{
        $(".coupon_output").addClass("alert-danger");
        $(".coupon_output").html("<b>Enter Coupon code</b>");
        $(".coupon_output").show();
      }
    }
    
/******** contact page *****/
$("#submitButtonContact").on("click", function(event) {



	    event.preventDefault();

	    var mydata = $("#contact_form").serialize();
	    //alert(mydata)
	    $.ajax({
	        type: "POST",
	        url: "ajax_contact.php",
	        data: mydata,
	        success: function(data) {
	          //alert(data);
	          data = JSON.parse(data);
	            if (data.error =="yes") {
	                $("#alert-msg").removeClass("alert, alert-success");
	                $("#alert-msg").addClass("alert, alert-danger");
	            } else {
	                $("#alert-msg").addClass("alert, alert-success");
	                $("#alert-msg").removeClass("alert, alert-danger");
	                $("#first-name").val("Enter Name");
	                $("#email").val("Enter Email");
				        	$("#phone").val("Enter Phone Number");
	                $("#subject").val("Enter Subject");
	                $("#description").val("Enter Message");

	            }
	            $("#alert-msg").html(`<strong>${data.msg}</strong>`);
	            $("#alert-msg").show();
	        }

	    });
	});
	/****** product details page ******/
	    	  $('.star_rating span').on('click', function(){
			var onStar = parseFloat($(this).data('value'), 10); // The star currently selected
			$("#rate_p").val(onStar);
			var stars = $(this).parent().children('.star_rating span');
			for (var i = 0; i < stars.length; i++) {
				$(stars[i]).removeClass('selected');
			}
			for (i = 0; i < onStar; i++) {
				$(stars[i]).addClass('selected');
			}
			
		});
		
		
		/********** shop.page ******/
   
    $(".apply_filters").on("click", function () {
     //alert(99);
      let brandname = $(this).attr("id");
      let className = brandname.replace(/ /g, "_");
      let brandid = $(this).val();
      //alert(className);
      let html = `<button class="filter_${className} added_filter" data-brand="${brandname}" style="background:rgba(0,0,0,0.3); padding:5px 16px; outline:none; border:none; margin:5px 5px; border-radius:5px">X ${brandname}</button>`;
      if ($(this).is(':checked')) {
        $(".filters").append(html);
      } else {
        $('.filter_'+className).remove();
      }
      ajax_shop_product();
    });
    
    $(document).on("click", ".added_filter", function () {
      brand = $(this).data("brand");
      className = brand.replace(/ /g, "_");
      if($(this).hasClass("filter_price_filter")){
        $("#price_first").val("");
      $("#price_second").val("");
       $("#price_first").val("");
      $("#price_second").val("");
      }
      $(this).remove();
      //alert(brand);
      $(".brand_"+className).attr("checked", false);
      ajax_shop_product();
    });


    $(".category_link").on("click", function () {
      $("#category_id_val").val($(this).data("catid"));
      $(".category_link").removeClass("active_link");
         $(this).addClass("active_link");
      if($("#category_id_val").val()==""){
        $("#search").val("");
      }
      ajax_shop_product();
    });
    
    $("#price_filter").on("click", function() {
    ajax_shop_product();
      min=  $("#price_first").val();
      max=   $("#price_second").val();
     let html = `<button class="filter_price_filter added_filter" data-brand="price" style="background:rgba(0,0,0,0.3); padding:5px 16px; outline:none; border:none; margin:5px 5px; border-radius:5px">X ${min} - ${max}</button>`;
    $(".filter_price_filter").remove();
    $(".filters").append(html);
   });
   
   $("#short").change(function (){
    $("#short_product").val($("#short").val());
    ajax_shop_product();
   });
   
   $("#show_number").change(function (){
     $("#product_limit").val($("#show_number").val());
     ajax_shop_product();
   });
   
   function ajax_shop_product(){
    // alert(999);
     formdata= $("#filter_form").serialize();
    // alert(formdata);
     if($(document).on("load")){
     loading_animation=`<div class="lds-ellipsis">
            <span></span>
            <span></span>
            <span></span>
        </div>`; 
        $("#product_list").html(loading_animation);
     }
    $.ajax({
       url:"ajax_shop_product.php",
       type:"post",
       data:formdata,
       success: function (response){
        //alert(response)
       // console.log(response);
         let result = JSON.parse(response);
         //alert (response);
       if(result.msg=="done"){
          $(".product_shorting").show();
           $("#product_list").html(result.product);
         }
         if(result.msg=="no"){
           $("#product_list").html(`<h1 style="margin:100px 0;">${result.product}</h1>`);
           $(".product_shorting").hide();
              $("#search").val("");
         }
       }
     });
   }
   ajax_shop_product();
   if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
