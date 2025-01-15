<?php
require_once("../include/initialize.php");

 ?>
  <?php
 // login confirmation
  if(isset($_SESSION['ADMIN_USERID'])){
    redirect(web_root."admin/index.php");
  }
  ?>
   
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JCRI | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo web_root;?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo web_root;?>plugins/font-awesome/css/font-awesome.min.css"> 
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo web_root;?>dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo web_root;?>plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; background-color: rgba(0,0,0,0.3);">
    <div style="position:fixed;top:0;left:0;width:100%;height:100%;background:url('slide3.jpg') center/cover no-repeat;filter:blur(5px);z-index:-1;"></div>
    <div class="login-box" style="background-color: rgba(255, 255, 255, 0.9); padding: 40px; border-radius: 10px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); width: 450px; max-width: 90%;">
        <div style="text-align: center; margin-bottom: 10px;"> <img src="logohire2.png" alt="HireVantage Logo" style="max-width: 100px; height: auto;"> </div>
        <h2 class="login-box-msg" style="text-align: center; margin-bottom: 30px; color: #333; font-size: 2em; font-weight: 600; margin-top: 0;">Login to HireVantage RMS</h2>
        <hr style="border-top: 2px solid #eee; margin-bottom: 35px;">
        <p style="color: #d9534f; text-align: center; margin-bottom: 20px;"><?php check_message(); ?></p>
        <form action="" method="post">
            <div class="form-group has-feedback" style="margin-bottom: 25px;">
                <input type="text" class="form-control" placeholder="Username" name="user_email" style="padding: 12px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; width: 100%; font-size: 16px;">
                <span class="glyphicon glyphicon-user form-control-feedback" style="right: 15px; top: 50%; transform: translateY(-50%); color: #aaa;"></span>
            </div>
            <div class="form-group has-feedback" style="margin-bottom: 30px;">
                <input type="password" class="form-control" placeholder="Password" name="user_pass" style="padding: 12px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; width: 100%; font-size: 16px;">
                <span class="glyphicon glyphicon-lock form-control-feedback" style="right: 15px; top: 50%; transform: translateY(-50%); color: #aaa;"></span>
            </div>
            <div class="row">
                <div class="col-xs-12" style="text-align: center;">
                    <button type="submit" name="btnLogin" class="btn btn-primary btn-block btn-flat" style="background-color: #007bff; border-color: #007bff; padding: 12px 25px; border-radius: 5px; width: auto; display: inline-block; font-size: 16px; font-weight: 500; transition: background-color 0.3s ease;">Sign In</button>
                </div>
            </div>
        </form>

   <!--  <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

 <!--    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php 

if(isset($_POST['btnLogin'])){
  $email = trim($_POST['user_email']);
  $upass  = trim($_POST['user_pass']);
  $h_upass = sha1($upass);
  
   if ($email == '' OR $upass == '') {

      message("Invalid Username and Password!", "error");
      redirect("login.php");
         
    } else {  
  //it creates a new objects of member
    $user = new User();
    //make use of the static function, and we passed to parameters
    $res = $user->userAuthentication($email, $h_upass);
    if ($res==true) { 
       message("You login as ".$_SESSION['ROLE'].".","success");
      // if ($_SESSION['ROLE']=='Administrator' || $_SESSION['ROLE']=='Cashier'){

        $_SESSION['ADMIN_USERID'] = $_SESSION['USERID'];
        $_SESSION['ADMIN_FULLNAME'] = $_SESSION['FULLNAME'] ;
        $_SESSION['ADMIN_USERNAME'] =$_SESSION['USERNAME'];
        $_SESSION['ADMIN_ROLE'] = $_SESSION['ROLE'];
        $_SESSION['ADMIN_PICLOCATION'] = $_SESSION['PICLOCATION'];

        unset( $_SESSION['USERID'] );
        unset( $_SESSION['FULLNAME'] );
        unset( $_SESSION['USERNAME'] );
        unset( $_SESSION['PASS'] );
        unset( $_SESSION['ROLE'] );
        unset($_SESSION['PICLOCATION']);

         redirect(web_root."admin/index.php");
      // } 
    }else{
      message("Account does not exist! Please contact Administrator.", "error");
       redirect(web_root."admin/login.php"); 
    }
 }
 } 
 ?> 


<!-- jQuery 2.1.4 -->
<script src="<?php echo web_root;?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo web_root;?>bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo web_root;?>plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>

 


 


