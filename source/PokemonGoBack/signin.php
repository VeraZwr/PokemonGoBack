<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="image/favicon.ico" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <style type="text/css">
      body {
          padding-top: 90px;
      }
      .panel-login {
          border-color: #ccc;
          -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
          -moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
          box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
      }
      .panel-login>.panel-heading {
          color: #00415d;
          background-color: #fff;
          border-color: #fff;
          text-align:center;
      }
      .panel-login>.panel-heading a{
          text-decoration: none;
          color: #666;
          font-weight: bold;
          font-size: 15px;
          -webkit-transition: all 0.1s linear;
          -moz-transition: all 0.1s linear;
          transition: all 0.1s linear;
      }
      .panel-login>.panel-heading a.active{
          color: #029f5b;
          font-size: 18px;
      }
      .panel-login>.panel-heading hr{
          margin-top: 10px;
          margin-bottom: 0px;
          clear: both;
          border: 0;
          height: 1px;
          background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
          background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
          background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
          background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
      }
      .panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
          height: 45px;
          border: 1px solid #ddd;
          font-size: 16px;
          -webkit-transition: all 0.1s linear;
          -moz-transition: all 0.1s linear;
          transition: all 0.1s linear;
      }
      .panel-login input:hover,
      .panel-login input:focus {
          outline:none;
          -webkit-box-shadow: none;
          -moz-box-shadow: none;
          box-shadow: none;
          border-color: #ccc;
      }
      .btn-login {
          background-color: #59B2E0;
          outline: none;
          color: #fff;
          font-size: 14px;
          height: auto;
          font-weight: normal;
          padding: 14px 0;
          text-transform: uppercase;
          border-color: #59B2E6;
      }
      .btn-login:hover,
      .btn-login:focus {
          color: #fff;
          background-color: #53A3CD;
          border-color: #53A3CD;
      }
      .forgot-password {
          text-decoration: underline;
          color: #888;
      }
      .forgot-password:hover,
      .forgot-password:focus {
          text-decoration: underline;
          color: #666;
      }

      .btn-register {
          background-color: #1CB94E;
          outline: none;
          color: #fff;
          font-size: 14px;
          height: auto;
          font-weight: normal;
          padding: 14px 0;
          text-transform: uppercase;
          border-color: #1CB94A;
      }
      .btn-register:hover,
      .btn-register:focus {
          color: #fff;
          background-color: #1CA347;
          border-color: #1CA347;
      }

    </style>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <title>Sign in</title>
  </head>
  <body>

  <?php
      require_once( 'util.php');
      require_once( 'db.php');

      $user_name = "";
      $user_pwd = "";

      if (getenv('REQUEST_METHOD') == 'POST') {
          if(isset($_POST["login-submit"])){
              $user_name = test_input($_POST["username"]);
              $user_pwd = test_input($_POST["password"]);
              $query = new pokemongoback_db();
              if($query->user_query($user_name, $user_pwd)){
                  if(!isset($_SESSION)){
                      session_start();
                  }
                  $_SESSION['user_name'] = $user_name;
                  $_SESSION['logged_in'] = true;
                  $sign_error = "";
                  header('Location: /');
              }else{
                  $sign_error = "Invalid Username or Password.";
              }
          }else if(isset($_POST["register-submit"])){
              $user_name = test_input($_POST["username"]);
              $user_pwd = test_input($_POST["password"]);
              $user_pwd2 = test_input($_POST["confirm-password"]);
              if($user_pwd != $user_pwd2){
                  $sign_error =  "Passwords do not match.";
              }else{
                  $query = new pokemongoback_db();
                  if($query->user_query_id($user_name)){
                      $sign_error = "Your username has been occupied.";
                  }else{
                      if($query->user_insert($user_name, $user_pwd)){
                          if(!isset($_SESSION)){
                              session_start();
                          }
                          $_SESSION['user_name'] = $user_name;
                          $_SESSION['logged_in'] = true;
                          $sign_error = "";
                          header('Location: /');
                      }else{
                          $sign_error = "Internal error.";
                      }
                  }
              }
          }
      }
  ?>
  <div class="container">
      <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <div class="panel panel-login">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-6">
                              <a href="#" class="active" id="login-form-link">Sign In</a>
                          </div>
                          <div class="col-xs-6">
                              <a href="#" id="register-form-link">Sign up</a>
                          </div>
                      </div>
                      <hr>
                  </div>
                  <div class="panel-body">
                      <div class="row">
                          <?php
                            if(!empty($sign_error)){
                               echo '<div class="col-lg-12 alert alert-danger">' . $sign_error . '</div>';
                            }
                          ?>

                      </div>
                      <div class="row">
                          <div class="col-lg-12">
                              <form id="login-form" action="signin.php" method="post" role="form" style="display: block;">
                                  <div class="form-group">
                                      <input type="text" name="username"  tabindex="1" class="form-control" placeholder="Username: test" required autofocus>
                                  </div>
                                  <div class="form-group">
                                      <input type="password" name="password"  tabindex="2" class="form-control" placeholder="Password: COMP354" required>
                                  </div>
                                  <div class="form-group">
                                      <div class="row">
                                          <div class="col-sm-6 col-sm-offset-3">
                                              <input type="submit" name="login-submit" tabindex="4" class="form-control btn btn-login" value="Sign In">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="row">
                                          <div class="col-lg-12">
                                              <div class="text-center">
                                                  <a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </form>
                              <form id="register-form" action="signin.php" method="post" role="form" style="display: none;">
                                  <div class="form-group">
                                      <input type="text" name="username"  tabindex="1" class="form-control" placeholder="Username" required autofocus>
                                  </div>
                                  <div class="form-group">
                                      <input type="password" name="password" tabindex="2" class="form-control" placeholder="Password" required>
                                  </div>
                                  <div class="form-group">
                                      <input type="password" name="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password" required>
                                  </div>
                                  <div class="form-group">
                                      <div class="row">
                                          <div class="col-sm-6 col-sm-offset-3">
                                              <input type="submit" name="register-submit" tabindex="4" class="form-control btn btn-register" value="Sign up Now">
                                          </div>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <script type="text/javascript">
        $(function() {

            $('#login-form-link').click(function(e) {
              $("#login-form").delay(100).fadeIn(100);
              $("#register-form").fadeOut(100);
              $('#register-form-link').removeClass('active');
              $(this).addClass('active');
              // e.preventDefault();
            });
            $('#register-form-link').click(function(e) {
              $("#register-form").delay(100).fadeIn(100);
              $("#login-form").fadeOut(100);
              $('#login-form-link').removeClass('active');
              $(this).addClass('active');
              // e.preventDefault();
            });

        });

        <?php if(isset($_POST["register-submit"])){ ?>
            $(document).ready(function() {
                $('#register-form-link').click();
            });

        <?php }?>

  </script>
  </body>
</html>