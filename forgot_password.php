<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="" content="">
  <title></title>
  <!-- Latest Bootstrap min CSS -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">

  <style type="text/css" media="all">
    html,body {
      height: 100%;
    }

    body {
      display: -ms-flexbox;
      display: -webkit-box;
      display: flex;
      -ms-flex-align: center;
      -ms-flex-pack: center;
      -webkit-box-align: center;
      align-items: center;
      -webkit-box-pack: center;
      justify-content: center;
      background-color: #f5f5f5;
    }

    form {
      padding-top: 10px;
      font-size: 13px;
      margin-top: 30px;
    }

    .card-title {
      font-weight: 300;
    }

    .btn {
      font-size: 13px;
    }

    .login-form {
      width: 320px;
      margin: 20px;
    }

    .sign-up {
      text-align: center;
      padding: 20px 0 0;
    }

    span {
      font-size: 14px;
    }

    .submit-btn {
      margin-top: 20px;
    }
    .change_pass{
      display: none;
    }
    .output_f{
      display: none;
      z-index: 9999;
    }
  </style>
</head>
<body>
  <div class="card login-form">
    <div class="card-body">
      <h3 class="card-title text-center">Forgot Password</h3>

      <!--Password must contain one lowercase letter, one number, and be at least 7 characters long.-->
      <div class="card-text">
        <form>
          <div class="alert output_f  alert-danger alert-dismissible fade " role="alert">
hhh
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Enter your email</label>
            <input type="email" class="form-control form-control-sm" id="email">
          </div>
         
          <button type="button" class="btn btn-primary btn-block submit-btn" id="button_f">Continue</button>
        </form>
      </div>
      
      <div class="card-text change_pass">
        <form>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
            <a class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </a>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Your new password</label>
            <input type="password" class="form-control form-control-sm">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Repeat password</label>
            <input type="password" class="form-control form-control-sm">
          </div>
          <button type="submit" class="btn btn-primary btn-block submit-btn">Confirm</button>
        </form>
      </div>
    </div>
  </div>
      <!-- Latest compiled and minified Bootstrap -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery-1.12.4.min.js"></script>
  <script type="text/javascript" charset="utf-8">
    $("#button_f").on("click", function (){
      email= $("#email").val();
      if(email==""){
        $(".output_f").show();
        
      }
    });
  </script>
</body>
</html>