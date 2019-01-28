<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Custom MVC</a>
    <button class="navbar-toggler" type="button"  data-toggle="collapse" data-target="#navbar-supported-content"   aria-controls="navbar-supported-content" aria-expanded="false"  aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse"   id="navbar-supported-content">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo BASE_URL; ?>/PostController/allPost">Home <span class="sr-only">  (current)</span></a>
        </li>
      </ul>
      <?php if(!isset($_SESSION['ownUserData']) && !isset($_SESSION['access_token'])) { ?>
        <a href="<?php echo BASE_URL; ?>/IndexController/login"><button class="btn btn-outline-light my-2 my-sm-0  btn-design">Login</button></a>
        <a href="<?php echo BASE_URL; ?>/IndexController/signup"><button class="btn btn-outline-light my-2 my-sm-0 ml-2   btn-design">Sign Up</button></a>
      <?php } else if(isset($_SESSION['access_token']) || isset($_SESSION['ownUserData'])) {
        echo '<a href="'.BASE_URL.'/UserController/profile"><button class="btn btn-outline-light m-2 my-sm-0 btn-design">'.$_SESSION['ownUserData'][0]['name'].'</button></a>
        <a href="'.BASE_URL.'/UserController/logout"><button class="btn btn-outline-light my-2 my-sm-0 btn-design">Logout</button></a>';
      } ?>
    </div>
  </div>  
</nav>