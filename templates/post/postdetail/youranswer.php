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