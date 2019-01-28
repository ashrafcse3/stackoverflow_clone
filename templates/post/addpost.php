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
      <form action="<?php echo BASE_URL; ?>/PostController/addNewPost" method="POST">
        <div class="form-group mt-3">
          <label for="category"><strong>Category</strong></label>
          <select name="category" class="custom-select" id="category" required>
            <option value="" selected>Choose...</option>
            <?php
            foreach ($allcategory as $category) {
              echo "<option value=".$category['id'].">".$category['cat_title']."</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group mt-3">
          <label for="title"><strong>Title</strong></label>
          <input type="name" class="form-control" name="title" id="title" placeholder="Enter title" required>
        </div>
        <div class="form-group mt-3">
          <label for="descriptoin"><strong>Description</strong></label>
          <textarea class="form-control" name="description" id="descriptoin" placeholder="Enter description" rows=4 required></textarea>
        </div>
        <button type="submit" name="add-post-submit" class="btn btn-primary mb-4">Add post</button>
        <button class="btn btn-danger mb-4 ml-2">Discard</button>
      </form>
    </div>
  </div>
</div>