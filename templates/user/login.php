<?php include('templates/main.php');

  if (isset($_SESSION['access_token']) || isset($_SESSION['ownUserData'])) {
    header('Location: ' . BASE_URL . '/UserController/profile');
  }
  global $helper;
  $redirectUrl = "http://localhost/custom-login2/UserController/loginWithFB";
  $permissions = ['email'];
  $loginUrl    = $helper->getLoginUrl($redirectUrl, $permissions);
?>

<div class="container">
  <div class="row mt-4">
    <div class="col-md-8 offset-md-2">
      <?php 
        if (isset($_SESSION['error'])) {
          foreach ($_SESSION['error'] as $value) {
            echo '<div class="alert alert-warning" role="alert">'.$value.'</div>';
          }
          unset($_SESSION['error']);
        } 
        else if (isset($_SESSION['mdata'])) {
          foreach ($_SESSION['mdata'] as $value) {
            echo '<div class="alert alert-success" role="alert">'.$value.'</div>';
          }
          unset($_SESSION['mdata']);
        }
      ?>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-md-8 shadow">
      <h2 class="mt-3">Login</h2>
      <hr>
      <form action="<?php echo BASE_URL; ?>/UserController/login" method="POST" >
        <div class="form-group">
          <label for="exampleInputEmail1"><strong>Email address</strong></label>
          <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1"><strong>Password</strong></label>
          <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" required>
        </div>
        <div class="d-flex flex-row-reverse">
          <div class="p-2"><a href="<?php echo BASE_URL; ?>/IndexController/forgotPassword">Forgot password</a></div>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Login</button>
      </form>
    </div>
    <div class="col-md-1 d-flex justify-content-center align-items-center">
      <h3>Or</h3>
    </div>
    <div class="col-md-3 d-flex justify-content-center align-items-center shadow">
      <button class="btn btn-primary btn-design" onclick="window.location = '<?php echo $loginUrl; ?>'">Login with Facebook</button>
    </div>
  </div>
</div>