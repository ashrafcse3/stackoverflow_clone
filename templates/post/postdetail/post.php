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
    <div class="comments" id="post-comment-div">
      <ul class="comment-list" id="add-post-comment-js">
        <?php foreach ($postcomments as $postComment) {
        echo '<li class="comment-text">
          <span class="comment-body">'. $postComment['description'] .' – </span>
          <a href="#">'. $postComment['user_name'] .'</a>
          <span class="comment-date">'. $postComment['time'].' hours ago</span>
        </li>';
        } ?>
      </ul>
    </div>
  </div>
  <div class="post-comment-box">
    <form id="add-comment-to-post-form" action="<?php echo BASE_URL; ?>/PostController/addCommentToPost" method="POST">
      <div class="form-group">
        <div class="row">
          <div class="col-md-1">
          </div>
          <?php if(isset($_SESSION['ownUserData']) || isset($_SESSION['access_token'])) { 
            echo '
          <div class="col-md-9">
            <textarea class="form-control" name="post-comment-box" id="post-comment-box"  placeholder="Write a comment" rows=1 required></textarea>
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

<script>
  function addPostComment() {
    console.log('addPostComment called');
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
        console.log('Result: ' + xhr.responseText);
        var result = JSON.parse(xhr.responseText);
        console.log('Result: ' + result);
        var str = '<li class="comment-text"><span class="comment-body">' + result[0].description+' – </span><a href="#">'+ result[0].user_name + ' </a><span class="comment-date">' + result[0].time + ' hours ago</span></li>';
        var ul = $("div#post-comment-div > ul");
        ul.append(str);
      }
    };
    xhr.send(form_data);
  }

  var postCommentButton = document.getElementById("add-post-comment-submit");
  
  postCommentButton.addEventListener("click", addPostComment);

</script>