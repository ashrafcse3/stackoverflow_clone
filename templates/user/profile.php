<?php include('templates/main.php'); ?>

<?php
    if (isset($_SESSION['ownUserData'])) {
        $id = $_SESSION['ownUserData']['0']['id'];
        $name = $_SESSION['ownUserData']['0']['name'];
        $email = $_SESSION['ownUserData']['0']['email'];
        //var_dump($_SESSION['ownUserData']);
    }
    else if (isset($_SESSION['access_token'])) {
        $id = $_SESSION['userData']['id'];
        $name = $_SESSION['userData']['name'];
        $email = $_SESSION['userData']['email'];
    }
    else if (!isset($_SESSION['access_token']) || !isset($_SESSION['ownUserData'])) {
        header('Location: ' . BASE_URL . '/IndexController/login');
    }
?>
<div class="container emp-profile">
  <form method="post">
    <div class="row">
      <div class="col-md-4">
          <div class="profile-img">
            <img src="http://www.freeimageslive.com/galleries/nature/coastline/preview/dead_starfish.jpg" alt=""/>
            <div class="file btn btn-lg btn-primary">
                Change Photo
                <input type="file" name="file"/>
            </div>
          </div>
      </div>
      <div class="col-md-6">
        <div class="profile-head">
          <h5>
              <?php echo $name; ?>
          </h5>
          <h6>
            Web Developer and Designer
          </h6>
          <p class="proile-rating">RANKINGS : <span>8/10</span></p>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
            </li>
            <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-2">
        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="profile-work">
            <p>WORK LINK</p>
            <a href="">Website Link</a><br/>
            <a href="">Bootsnipp Profile</a><br/>
            <a href="">Bootply Profile</a>
            <p>SKILLS</p>
            <a href="">Web Designer</a><br/>
            <a href="">Web Developer</a><br/>
            <a href="">WordPress</a><br/>
            <a href="">WooCommerce</a><br/>
            <a href="">PHP, .Net</a><br/>
        </div>
      </div>
      <div class="col-md-8">
              <div class="tab-content profile-tab" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                              <div class="row">
                                <div class="col-md-6">
                                    <label>Id</label>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $id; ?></p>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <label>Name</label>
                                  </div>
                                  <div class="col-md-6">
                                      <p><?php echo $name; ?></p>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <label>Email</label>
                                  </div>
                                  <div class="col-md-6">
                                      <p><?php echo $email; ?></p>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <label>Phone</label>
                                  </div>
                                  <div class="col-md-6">
                                      <p>123 456 7890</p>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <label>Profession</label>
                                  </div>
                                  <div class="col-md-6">
                                      <p>Web Developer and Designer</p>
                                  </div>
                              </div>
                  </div>
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                              <div class="row">
                                  <div class="col-md-6">
                                      <label>Experience</label>
                                  </div>
                                  <div class="col-md-6">
                                      <p>Expert</p>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <label>Hourly Rate</label>
                                  </div>
                                  <div class="col-md-6">
                                      <p>10$/hr</p>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <label>Total Projects</label>
                                  </div>
                                  <div class="col-md-6">
                                      <p>230</p>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <label>English Level</label>
                                  </div>
                                  <div class="col-md-6">
                                      <p>Expert</p>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <label>Availability</label>
                                  </div>
                                  <div class="col-md-6">
                                      <p>6 months</p>
                                  </div>
                              </div>
                      <div class="row">
                          <div class="col-md-12">
                              <label>Your Bio</label><br/>
                              <p>Your detail description</p>
                          </div>
                      </div>
                  </div>
              </div>
      </div>
    </div>
  </form>           
</div>