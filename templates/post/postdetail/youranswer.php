<div class="your-answer">
  <h2 class="your-answer-subheader">Your answer</h2>
  <?php if(isset($_SESSION['ownUserData']) || isset($_SESSION['access_token'])) { 
    echo '
      <div class="post-comment-box">
        <form id="add-answer-to-post" action="'. BASE_URL .'/PostController/addAnswerToPost" method="POST">
          <div class="form-group">
            <textarea class="form-control" name="answer-box"    id="answer-box" rows=4 required></textarea>
            <input type="hidden" id="postid" name="postid" value="'.$_GET['id'].'">
            <button type="button" id="answer-submit" name="answer-submit" class="btn     btn-primary">Post your answer</button>
          </div>
        </form>
      </div>';
  } else {
    echo '<div class="post-menu mb-5">
            <a href="#">add your answer</a>
          </div>';
  } ?>
</div>

<script>
  function addAnswer() {
    console.log('addAnswer called');
    var answerForm = document.getElementById("add-answer-to-post");
    var action = answerForm.getAttribute("action");

    // gather form data
    var form_answer = new FormData(answerForm);

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
        // var ul = $("div#answer-comment-div > ul");
        // ul.append(str);
      }
    };
    xhr.send(form_answer);
  }

  var answerButton = document.getElementById("answer-submit");
  answerButton.addEventListener("click", addAnswer);

</script>