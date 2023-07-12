<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: index.php');
  }
?>

<style>
  html, body {
    height: 100%;
    overflow: hidden;
  }
  .login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    background-image: url('./images/WELCOME.png');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
  }
</style>

<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page" style="background-color: #F2BC57;">
<div class="login-container">
  <div class="login-box">
    <?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
      if(isset($_SESSION['success'])){
        echo "
          <div class='callout callout-success text-center'>
            <p>".$_SESSION['success']."</p> 
          </div>
        ";
        unset($_SESSION['success']);
      }
    ?>
    <center><img src="images/chandelier_logo.png" alt="Logo" style="width: 150px; height: 150px;"></center>
    <br>
    <div class="login-box-body" style="border-radius: 2px;">
      <p class="login-box-msg"><b>Sign in</b></p>

      <form action="verify.php" method="POST">
        <div class="form-group has-feedback">
          <input type="email" class="form-control" name="email" placeholder="Email" required>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat text-right" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
          </div>
        </div>
      </form>
      <br>
      <a href="index.php"><i class="fa fa-home"></i> Home</a>
    </div>
  </div>
</div>

<?php include 'includes/scripts.php' ?>
</body>
</html>
