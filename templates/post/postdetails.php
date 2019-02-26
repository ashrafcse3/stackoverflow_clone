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
  <div class="row mt-4 post-head-section">
    <div class="col-md-8">
      <div class="">
        <a href="<?php echo BASE_URL."/PostController/addPost" ?>"><h1 class="post-header"><?php echo $post[0]['title']; ?></h1></a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="d-flex flex-row-reverse">
        <a href="<?php echo BASE_URL."/PostController/addPost" ?>"><button class="btn btn-primary mb-4">Ask Question</button></a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <!-- add post and his reply -->
      <?php include('templates/post/postdetail/post.php'); ?>

      <!-- add comments and his reply -->
      <?php include('templates/post/postdetail/answers.php'); ?>

      <!-- add your_comment -->
      <?php include('templates/post/postdetail/youranswer.php'); ?>
      
    </div>
    <div class="col-md-4">
      
    </div>
  </div>
</div>

<?php include('templates/partials/_footer.php'); ?>