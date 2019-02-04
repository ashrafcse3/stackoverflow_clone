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
      <div class="d-flex flex-row-reverse">
        <a href="<?php echo BASE_URL."/PostController/addPost" ?>"><button class="btn btn-primary mb-4">Ask Question</button></a>
      </div>
      <?php foreach ($allposts as $post) {
      echo '<div class="row border bg-light mb-2">
          <div class="col-2 border">
            <div id="vote">0</div>
            <div id="vote-text">answers</div>
          </div>
          <div class="col-2 border">
            <div id="vote">0</div>
            <div id="vote-text">views</div>
          </div>
          <div class="col-8 border">
            <div id="vote"><a href="'.BASE_URL.'/PostController/postDetails?id='.$post['id'].'">'.$post['title'].'</a></div>
            <div id="vote-text">
              <a href="#">'.$post['category'].'</a>
              asked by <a href="#">'.$post['user_name'].'</a>
            </div>
          </div>
        </div>';
      }
      ?>  
    </div>
  </div>
</div>