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
      <div class="post">
        <div class="post-text">
          <p><?php echo $post[0]['description']; ?></p>
        </div>
        <div class="post-taglist">
          <a href="#" class="post-tag"><?php echo $post[0]['category']; ?></a>
        </div>
        <div class="row post-profile pt-4">
          <div class="col-md-8 post-menu">
            <a href="#" class="edit-post">improve this question</a>
          </div>
          <div class="col-md-4 user-info">
            <div class="user-action-time">
              asked 1 hour ago
            </div>
            <div class="user-picture">
              <img src="<?php echo BASE_URL; ?>/assets/images/user.png" alt="User" width="32" height="32">
            </div>
            <div class="user-details">
              <?php echo $post[0]['user_name']; ?>
            </div>
          </div>
        </div>
        <div class="post-comment mt-2">
          <div class="comments">
            <ul class="comment-list">
              <?php foreach ($postcomments as $postComment) {
              echo '<li class="comment-text">
                <span class="comment-body">'. $postComment['description'] .'</span>
                <a href="#">-'. $postComment['user_name'] .'</a>
                <span class="comment-date">'. $postComment['time'].' hours ago</span>
              </li>';
              } ?>
            </ul>
          </div>
        </div>
        <div class="post-comment-box">
          <form id="add-comment-to-post-form" action="<?php echo BASE_URL; ?>/PostController/addCommentFromPost" method="POST">
            <div class="form-group">
              <div class="row">
                <div class="col-md-1">
                </div>
                <?php if(isset($_SESSION['ownUserData']) || isset($_SESSION['access_token'])) { 
                  echo '
                <div class="col-md-9">
                  <input class="form-control" name="post-comment-box" id="post-comment-box"  placeholder="Write a comment" rows=1 required></input>
                  <input type="hidden" id="postid" name="postid" value="'.$_GET['id'].'">
                </div>
                <div class="col-md-2">
                  <button type="button" name="add-post-comment-submit" id="add-post-comment-submit" class="btn btn-primary">Add comment</button>
                </div>';
                } else {
                  echo '<div class="col-md-11 post-menu">
                      <a href="#">add a comment</a>
                    </div>';
                } ?>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="answers">
        <h2 class="answer-subheader"><?php echo count($answers); ?> Answers</h2>
        <?php foreach ($answers as $answer) { ?>
        <div class="post">
          <div class="post-id"><h5><?php echo $answer['id']; ?></h5></div>
          <div class="post-text">
            <p><?php echo $answer['description']; ?></p>
          </div>
          <div class="row post-profile pt-4">
            <div class="col-md-8 post-menu">
              <a href="#" class="edit-post">edit</a>
            </div>
            <div class="col-md-4 user-info">
              <div class="user-action-time">
                asked 1 hour ago
              </div>
              <div class="user-picture">
                <img src="<?php echo BASE_URL; ?>/assets/images/user.png" alt="User" width="32" height="32">
              </div>
              <div class="user-details">
                <?php echo $answer['name']; ?>
              </div>
            </div>
          </div>
          <div class="post-comment mt-2">
            <div class="comments">
              <ul class="comment-list">
                <?php foreach ($answercomments as $answerComment) {
                  if ($answerComment['answer_id'] == $answer['id']) {
                    echo '<li class="comment-text">
                      <span class="comment-body">'. $answerComment['description']       .'</span>
                      <a href="#">-'. $answerComment['user_name'] .'</a>
                      <span class="comment-date">'. $answerComment['time'].' hours ago</span>
                    </li>';
                  }
                } ?>
              </ul>
            </div>
          </div>
          <div class="post-comment-box">
            <form action="">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-1"></div>
                  <?php if(isset($_SESSION['ownUserData']) || isset($_SESSION['access_token'])) { 
                  echo '
                <div class="col-md-9">
                  <textarea class="form-control" name="post-comment-box" id="post-comment-box"  placeholder="Write a comment" rows=1 required></textarea>
                </div>
                <div class="col-md-2">
                  <button type="submit" name="add-comment-submit" class="btn btn-primary">Add comment</button>
                </div>';
                } else {
                  echo '<div class="col-md-11 post-menu">
                      <a href="#">add a comment</a>
                    </div>';
                } ?>
                </div>
              </div>
            </form>
          </div>
        </div>
        <?php } ?>
      </div>
      <div class="your-answer">
        <h2 class="your-answer-subheader">Your answer</h2>
        <?php if(isset($_SESSION['ownUserData']) || isset($_SESSION['access_token'])) { 
          echo '
            <div class="post-comment-box">
              <form action="">
                <div class="form-group">
                  <textarea class="form-control" name="answer-box"    id="answer-box" rows=4 required></textarea>
                  <button type="submit" name="answer-submit" class="btn     btn-primary">Post your answer</button>
                </div>
              </form>
            </div>';
        } else {
          echo '<div class="post-menu mb-5">
                  <a href="#">add your answer</a>
                </div>';
        } ?>
      </div>
    </div>
    <div class="col-md-4">
      
    </div>
  </div>
</div>

<script>
  function addPostComment() {
    console.log('addPostComment called');postCommentButton.innerText = 'hello';
    var postCommentForm = document.getElementById("add-comment-to-post-form");
    var action = postCommentForm.getAttribute("action");

    // gather form data
    var form_data = new FormData(postCommentForm);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', action, true);
    // xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
      if(xhr.readyState == 4 && xhr.status == 200) {
        var result = xhr.responseText;
        console.log('Result: ' + result);
      }
    };
    xhr.send(form_data);
  }

  var postCommentButton = document.getElementById("add-post-comment-submit");
  
  postCommentButton.addEventListener("click", addPostComment);

</script>