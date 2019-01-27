<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Custom MVC</a>
    <button class="navbar-toggler" type="button"  data-toggle="collapse" data-target="#navbar-supported-content"   aria-controls="navbar-supported-content" aria-expanded="false"  aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse"   id="navbar-supported-content">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo BASE_URL; ?>/IndexController/login">Home <span class="sr-only">  (current)</span></a>
        </li>
      </ul>
      <?php if(!isset($_SESSION['ownUserData']) && !isset($_SESSION['access_token'])) { ?>
        <button class="btn btn-outline-info my-2 my-sm-0  btn-design" type="submit"><a href="<?php echo BASE_URL; ?>/IndexController/login">Login</a></button>
        <button class="btn btn-outline-info my-2 my-sm-0 ml-2   btn-design" type="submit"><a href="<?php echo BASE_URL; ?>/IndexController/signup">Sign Up</a></button>
      <?php } else if(isset($_SESSION['access_token']) || isset($_SESSION['ownUserData'])) { ?>
        <button class="btn btn-outline-info my-2 my-sm-0  btn-design" type="submit"><a href="<?php echo BASE_URL; ?>/UserController/logout">Logout</a></button>
      <?php } ?>
    </div>
  </div>  
</nav>