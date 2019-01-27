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
    <div class="col-md-8 offset-md-2 shadow">
      <form action="<?php echo BASE_URL; ?>/UserController/signup" method="POST" >
        <div class="form-group mt-3">
          <label for="exampleInputName"><strong>Name</strong></label>
          <input type="name" class="form-control" name="name" id="exampleInputName" aria-describedby="NameHelp" placeholder="Enter name">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1"><strong>Email address</strong></label>
          <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1"><strong>Password</strong></label>
          <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
          <label for="exampleInputConfirmPassword1"><strong>Confirm Password</strong></label>
          <input type="password" class="form-control" name="confirm_password" id="exampleInputConfirmPassword1" placeholder="Confirm Password">
        </div>
        <button type="submit" class="btn btn-primary mb-4">Submit</button>
      </form>
    </div>
  </div>
</div>