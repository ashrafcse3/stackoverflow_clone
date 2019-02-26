<div class="answers">
  <h2 class="answer-subheader"><?php echo count($answers); ?> Answers</h2>
  <?php
  $answerId = 1;
  foreach ($answers as $answer) { ?>
  <div class="post">
    <div class="post-id"><h5><?php echo $answerId; ?></h5></div>
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
      <div class="comments" id="answer-comment-div<?php echo $answer['id'] ?>">
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
      <form id="add-comment-to-answer-form<?php echo $answer['id'] ?>" action="<?php echo BASE_URL; ?>/PostController/addCommentToAnswers" method="POST">
        <div class="form-group">
          <div class="row">
            <div class="col-md-1"></div>
            <?php if(isset($_SESSION['ownUserData']) || isset($_SESSION['access_token'])) { 
            echo '
          <div class="col-md-9">
            <textarea class="form-control" name="answer-comment-box" id="answer-comment-box'.$answer['id'].'"  placeholder="Write a comment" rows=1 required></textarea>
            <input type="hidden" id="answerid" name="answerid" value="'.$answer['id'].'">
          </div>
          <div class="col-md-2">
            <button type="button" name="add-answer-comment-submit" id="add-answer-comment-submit" class="btn btn-primary">Add comment</button>
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
  <?php 
  $answerId++;
}
 ?>
</div>

<script>
  $(document).ready(function() {
    $("button#add-answer-comment-submit").click(function(event) {

        var parent = '#'+$(this).parent().parent().parent().parent().attr('id');
        console.log(parent);
        event.preventDefault(); 
        var form = $(parent);
        var action = form.attr("action");
        console.log(action);
        var formData = $(form).serialize();
        console.log(formData);
        var parentLastChar = parent.slice(-1);
        var answerCommentBox = $('#answer-comment-box'+parentLastChar).val();
        console.log('answerCommentBox '+answerCommentBox)

        if (answerCommentBox !== '') {
          $.ajax({
              method: 'POST',
              url: action,
              data: formData,
              success: function (response) {
                console.log('parentComment ' + parentLastChar);
                resultPaste(response, parentLastChar);
              }
          });

        }
    });
  });

  function resultPaste (response, parentLastChar) {
    console.log(response);
    var result = JSON.parse(response);
    console.log('Result: ' + result);
    var str = '<li class="comment-text"><span class="comment-body">' + result[0].description+' – </span><a href="#">'+ result[0].user_name + ' </a><span class="comment-date">' + result[0].time + ' hours ago</span></li>';
    var ul = $("div#answer-comment-div"+parentLastChar+" > ul");
    ul.append(str);
  }
  // function addAnswerComment() {
  //   console.log('addAnswerComment called');
  //   var answerCommentForm = document.getElementById("add-comment-to-answer-form");
  //   var action = answerCommentForm.getAttribute("action");

  //   // gather form data
  //   var form_data_answer = new FormData(answerCommentForm);

  //   var xhr = new XMLHttpRequest();
  //   xhr.open('POST', action, true);
  //   // xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  //   xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  //   xhr.onreadystatechange = function () {
  //     if(xhr.readyState == 4 && xhr.status == 200) {
  //       console.log('Result: ' + xhr.responseText);
  //       var result = JSON.parse(xhr.responseText);
  //       console.log('Result: ' + result);
  //       var str = '<li class="comment-text"><span class="comment-body">' + result[0].description+' – </span><a href="#">'+ result[0].user_name + ' </a><span class="comment-date">' + result[0].time + ' hours ago</span></li>';
  //       var ul = $("div#answer-comment-div > ul");
  //       ul.append(str);
  //     }
  //   };
  //   xhr.send(form_data_answer);
  // }

  // var answerCommentButton = document.getElementById("add-answer-comment-submit");
  // answerCommentButton.addEventListener("click", addAnswerComment);
</script>