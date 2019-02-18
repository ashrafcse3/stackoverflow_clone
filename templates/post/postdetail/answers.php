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
      <div class="comments" id="answer-comment-div">
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
      <form id="add-comment-to-answer-form" action="<?php echo BASE_URL; ?>/PostController/addCommentToAnswers" method="POST">
        <div class="form-group">
          <div class="row">
            <div class="col-md-1"></div>
            <?php if(isset($_SESSION['ownUserData']) || isset($_SESSION['access_token'])) { 
            echo '
          <div class="col-md-9">
            <textarea class="form-control" name="answer-comment-box" id="answer-comment-box"  placeholder="Write a comment" rows=1 required></textarea>
            <input type="hidden" id="answerid" name="answerid" value="'.$answer['id'].'">
          </div>
          <div class="col-md-2">
            <button type="button" name="add-answer-comment-submit" class="btn btn-primary">Add comment</button>
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
<script>
  function addAnswerComment() {
    console.log('addAnswerComment called');
    var answerCommentForm = document.getElementById("add-comment-to-answer-form");
    var action = answerCommentForm.getAttribute("action");

    // gather form data
    var form_data = new FormData(answerCommentForm);

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
        var ul = $("div#answer-comment-div > ul");
        ul.append(str);
      }
    };
    xhr.send(form_data);
  }

  // var answerCommentButton = document.getElementById("add-answer-comment-submit");
  // postCommentButton.addEventListener("click", addAnswerComment);
  $("#add-answer-comment-submit").click(function() {
    addAnswerComment();
});

</script>