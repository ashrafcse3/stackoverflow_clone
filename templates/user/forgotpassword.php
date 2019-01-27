<?php include('templates/main.php'); ?>

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
    <div class="col-md-8 offset-md-2">
      <form action="<?php echo BASE_URL; ?>/UserController/forgotPassword" method="POST" >
        <div class="form-group">
          <label for="exampleInputEmail1" class="d-flex justify-content-center"><strong>Enter your email</strong></label>
          <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email" required>
        </div>
        <div class="d-flex justify-content-center align-items-center">
          <button type="submit" class="btn btn-primary ">Reset password</button>
        </div>
      </form>
    </div>
  </div>
</div>