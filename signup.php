<?php
include("top.php");
if(isset($_SESSION["login"]) && $_SESSION["login"]===true){
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
          <h1>Register</h1>
        </div>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb justify-content-md-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Pages</a></li>
          <li class="breadcrumb-item active">Register</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

  <!-- START LOGIN SECTION -->
  <div class="login_register_wrap section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-6 col-md-10">
          <div class="login_wrap">
          
           
            <div class="padding_eight_all bg-white">
              <div class="heading_s1">
                <h3>Create an Account</h3>
              </div>
              <form method="post" class="reg_form" id="signup_form">
                <input type="hidden" name="type" id="type" value="signup" />
                <div class="form-row">
                  <div class="col-md-6 col-sm-12 col-12">
                    <div class="form-group">
                  <input type="text" required="" class="form-control" name="fname" id="fname" placeholder="Enter First Name">
                       <span class="field_error" id="fname_msg"></span>
                </div>
                  </div>
                  <div class="col-md-6 col-sm-12 col-12">
                       <div class="form-group">
                  <input type="text" required="" class="form-control" name="lname" id="lname" placeholder="Enter Last Name">
     <span class="field_error" id="lname_msg"></span>
                </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <input type="email" required="" class="form-control" name="email" placeholder="Enter Your Email" id="reg_email">
                  <span class="field_error" id="email_msg"></span>
                </div>
                   <div class="form-group">
                  <input type="number" required="" class="form-control" name="mobile" id="mobile" placeholder="Enter Your Mobile no" id="reg_mobile">
                  <span class="field_error" id="mobile_msg"></span>
                </div>
                <div class="form-group">
                  <input class="form-control" required="" type="password" name="password" placeholder="Password" id="reg_pass">
                  <span class="field_msg" id="pass_msg"></span>
                </div>
                <div class="form-group">
                  <input class="form-control" required="" type="password" name="confirmpassword" placeholder="Confirm Password" id="confirm_pass">
                  <span class="field_error" id="confirm_pass_msg"></span>
                </div>
                <div class="login_footer form-group">
                  <div class="chek-form">
                    <div class="custome-checkbox">
                      <input class="form-check-input" type="checkbox" name="terms" id="termsCondition" value="true">
                      <label class="form-check-label" for="termsCondition"><span>I agree to terms &amp; Policy.</span></label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button type="button" class="btn btn-fill-out btn-block" name="register" id="register_btn">Register
                 </button>
                </div>
              </form>
              <div class="different_login">
                <span> or</span>
              </div>
              <ul class="btn-login list_none text-center">
                <li><a href="#" class="btn btn-facebook"><i class="ion-social-facebook"></i>Facebook</a></li>
                <li><a href="#" class="btn btn-google"><i class="ion-social-googleplus"></i>Google</a></li>
              </ul>
              <div class="form-note text-center">
                Already have an account? <a href="login.php">Log in</a>
              </div>
              <div class="form-output mt-3 alert  register_output">
                hhhj
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- END LOGIN SECTION -->
  <?php
  include("footer.php");
  ?>
  <script type="text/javascript" charset="utf-8">
  /*----------------------------------------------
       Register form process 
   ----------------------------------------------*/
    let email_validate=false;
    let confirm_pass_check=false;
$("#reg_email").on("input", function () {
  email = $("#reg_email").val();
  mailformat = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  if (email.match(mailformat)) {
     $("#email_msg").removeClass("field_error");
     $("#email_msg").addClass("field_msg");
    $("#email_msg").html("Done");
    email_validate= true;
  } else {
    $("#email_msg").html("Enter valid email");
  }
  if(email==""){
    $("#email_msg").hide();
  }
});

$("#reg_pass").on("input", function () {
  password = $("#reg_pass").val();
  number = /([0-9])/;
  alphabets = /([a-zA-Z])/;
  special_characters = /([~,!,@,#,$,%,^,&,*,,_,+,=,?,>,<])/;
  if (password.length < 8) {
    $("#pass_msg").removeClass();
    $("#pass_msg").addClass("weak-password");
    $("#pass_msg").html("Weak (should be atleast 8 characters.)");
  } else if (password.match(number) && password.match(alphabets) && password.match(special_characters)) {
    $("#pass_msg").removeClass();
    $("#pass_msg").addClass("strong-password");
    $("#pass_msg").html("Strong");
  } else {
    $('#pass_msg').removeClass();
    $('#pass_msg').addClass('medium-password');
    $('#pass_msg').html("Medium (should include alphabets, numbers and special characters.)");
  }
  if(password==""){
    $("#pass_msg").hide();
  }
   
  });
  
  $("#confirm_pass").on("input", function (){
  password=  $("#reg_pass").val();
  confirm_pass= $("#confirm_pass").val();
  if(confirm_pass == password){
    $("#confirm_pass_msg").removeClass();
    $("#confirm_pass_msg").addClass("field_msg");
    $("#confirm_pass_msg").html("Done");
  
  }else{
    confirm_pass_check=true;
    $("#confirm_pass_msg").html("password not match");
  }
 if(confirm_pass==""){
    $("#confirm_pass_msg").hide();
  }

  });

  
  
  

  $("#register_btn").on("click",function register(){
    
   // alert(confirm_pass_check);
   // alert(email_validate);
    fname=$("#fname").val();
    lname=$("#lname").val();
    email=$("#reg_email").val();
    password=$("#reg_pass").val();
    mobile=$("#mobile").val();
    error=true;
    if(fname==""){
      $("#fname_msg").html("Enter your First name");
    }else if(lname==""){
      $("#lname_msg").html("Enter your Last name");
    }else if(email==""){
         $("#email_msg").html("Enter your Email");
    }else if(email_validate==false){
        $("#email_msg").html("Enter Valid Email");
    }else if(mobile==""){
      $("#mobile_msg").html("Enter your mobile no");
    }else if(password==""){
      $("#pass_msg").removeClass();
      $("#pass_msg").addClass("field_error");
      $("#pass_msg").html("Enter password");
    }else if(confirm_pass_check==false){
        $("#confirm_pass_msg").html("Confirm password not match");
    }else{
      error= false;
      $(".field_error").html("");
    }
    if(error==false){
      fromdata=$("#signup_form").serialize();
      //alert(fromdata);
      $("#register_btn").html('<span class="spinner-border text-danger"></span>');
    
      $.ajax({
        url:"ajax_signup.php",
        type:"post",
        data:fromdata,
        success: function (response){
         //alert (response);
         data = JSON.parse(response);
	            if (data.error =="yes") {
	              $("#register_btn").html("Register");
	                $(".register_output").removeClass("alert-success");
	                $(".register_output").addClass("alert-danger");
	            $(".register_output").html(`<strong>${data.msg}</strong>`);
	            $(".register_output").show();
	            }
	            if(data.error == "no"){
	               //$(".register_output").removeClass("alert-danger");
	              //  $(".register_output").addClass("alert-success");
	              
	              window.location="email_verification.php";
	            }
	           
	        }

      });
      
    }
  });
  </script>