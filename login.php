<?php
include("top.php");
$email = "";
$password = "";
$checked = "";
if (isset($_COOKIE["login_pass"]) && $_COOKIE["login_email"]) {
  $password = $_COOKIE["login_pass"];
  $email = $_COOKIE["login_email"];
  $checked = "checked";
}
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
          <h1>Login</h1>
        </div>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb justify-content-md-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Pages</a></li>
          <li class="breadcrumb-item active">Login</li>
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
                <h3>Login</h3>
              </div>
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
              <div class="different_login">
                <span> or</span>
              </div>
              <ul class="btn-login list_none text-center">
                <li><a href="#" class="btn btn-facebook"><i class="ion-social-facebook"></i>Facebook</a></li>
                <li><a href="#" class="btn btn-google"><i class="ion-social-googleplus"></i>Google</a></li>
              </ul>
              <div class="form-note text-center">
                Don't Have an Account? <a href="signup.php">Sign up now</a>
              </div>
              <div class="form-output mt-3 alert  login_output">
                hhhjvbbbhhhh
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END LOGIN SECTION -->

  <?php
  include("footer.php"); ?>
