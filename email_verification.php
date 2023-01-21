<?php
include("top.php");
if(isset($_SESSION["email_verify"])){
?>
<div class="verification d-flex justify-content-between align-items-center">
  <div class="container content ">
    <div class="row justify-content-between">

      <div class="col-10  m-auto">
        <h1 class="text-center">EMAIL VERIFICATION</h1>
        <div class="verification_card">
          <div class="verify_img text-center">
            <img src="assets/images/email_verification.svg" alt="" />
          </div>
          <div class="msg">
            <h5>Thank you for signing up for a Shopwise account</h5>

            <p>
              Please verify your email address in order to access your Cloudinary account.
            </p>
            <p>
              We sent an email to <strong>
                <?php echo $_SESSION["email_verify"];?></strong>
              To continue, please check your inbox and verify your email address.
            </p>

            <p>
              Email resent. <a class="text-resend" href="javascript:void(0)" id="resend_email"  onclick="resendEmail('emailVerify','<?php echo $_SESSION["email_verify"];?>')">Resend</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
}else{
  header("location:signup.php");
}
include("footer.php");
?>
<style type="text/css" media="all">
  .verification {
    width: 100%;
    background: #f5f5f5;

    padding: 150px 0;
  }
  .verification .verification_card {
    background: #fff;
    margin-top: 50px;
    padding: 50px 25px;
  }
  .verify_img {
    margin: 25px 0;
  }
  .verify_img img {
    width: 50%;
  }
  .msg {}
  .msg h5 {
    font-size: 20px;
    font-weight: 600;
  }
  .msg a {
    font-weight: 800;
  }
.text-resend{
  color: #fc7121;
}
</style>
<script>
  function resendEmail(type, email){
    $("#resend_email").removeClass("text-resend");
    $("#resend_email").addClass("text-primary");
    $("#resend_email").html("Sending Email...");
   $.ajax({
      url:"resendOtp.php",
      type:"post",
      data:"type="+type+"&email="+email,
      success: function (response){
       // alert(response);
        result = JSON.parse(response);
        if(result.error=="yes"){
          $("#resend_email").addClass("text-danger");
           $("#resend_email").removeClass("text-primary");
        }else{
            $("#resend_email").addClass("text-success");
           $("#resend_email").removeClass("text-primary");
        }
        $("#resend_email").html(result.msg);
      }
    });
  }
</script>