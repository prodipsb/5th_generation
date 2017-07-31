<?php
session_start();
// print_r($_SESSION);
// die();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  

  <title>Login |Users story </title>

  <!-- Bootstrap core CSS -->

  <link href="css/bootstrap/bootstrap.css" rel="stylesheet">

  <link href="css/libs/font-awesome.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">


  <script src="js/jquery.js"></script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">

  <div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content">
            <h4 style="color: green;">
            <?php
                if(isset($_SESSION['s_mgs'])){
                    echo $_SESSION['s_mgs'];
                    unset($_SESSION['s_mgs']);
                }
            ?>
            </h4>
            <h4 style="color: red;">
            <?php
                if(isset($_SESSION['login_failed_mgs'])){
                    echo $_SESSION['login_failed_mgs'];
                    unset($_SESSION['login_failed_mgs']);
                }
            ?>
            </h4>
            <form action="login_check.php" method="POST">
            <h1>Login Form</h1>
            <div>
                <input type="text" name="username" value="<?php if(isset($_COOKIE['username'])){echo $_COOKIE['username'];}?>" class="form-control" placeholder="Username" required="" />
            </div>
            <div>
              <input type="password" name="password" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}?>" class="form-control" placeholder="Password" required="" />
            </div>
            <div>
              <input type="submit" class="btn btn-default submit" value="Log in">
              <div style="font-size: 18px;">
              <input type="checkbox" name="remember"> Remember me
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="separator">

              <p class="change_link">New to site?
                <a href="#toregister" class="to_register"> Create Account </a><br />
                <a  href="index.php">Back To The Home Page</a>
              </p>
              <div class="clearfix"></div>
              
              <div>
                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> 5th Generation!</h1>

                <p>©2016 All Rights Reserved. </p>
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
      <div id="register" class="animate form">
        <section class="login_content">
            <form action="register.php" method="POST">
            <h1>Create Account</h1>
            <div>
                <input type="text" name="username" class="form-control" placeholder="Username" required="" />
            </div>
            <div>
                <input type="email" name="email" class="form-control" placeholder="Email" required="" />
            </div>
            <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
            </div>
            <div>
                <input type="submit" class="btn btn-default submit" value="Save"  style="margin-left: 150px;">
            </div>
            <div class="clearfix"></div>
            <div class="separator">

              <p class="change_link">Already a member ?
                <a href="#tologin" class="to_register"> Log in </a>
              </p>
              <div class="clearfix"></div>
              <br />
              <div>
                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
    </div>
  </div>

</body>

</html>
