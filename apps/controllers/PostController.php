<?php

  class PostController extends maincontroller {
    
    function __construct(){
      parent::__construct();
    }

    public function allPost() {
      $post_table = 'posts';
      $user_table = 'users';
      $category_table = 'categories';
      $postModel = $this->load->model('PostModel');
      $cond = 1;
      $data['allposts'] = $postModel->getPostData($post_table, $user_table,  $category_table, $cond);
      $this->load->view('post/allpost', $data);
    }

    public function postDetails() {
      if (isset($_GET['id'])) {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;

        $post_table = 'posts';
        $user_table = 'users';
        $category_table = 'categories';
        $comment_table = 'comments';
        $answer_table = 'answers';
        $post_comments = 'post';
        $answer_comments = 'answer';
        $postModel = $this->load->model('PostModel');

        $cond = "$post_table.id = $id";
        $data['post'] = $postModel->getPostData($post_table, $user_table,   $category_table, $cond);
        
        $postCommentCond = "$comment_table.source = '$post_comments' AND $comment_table.source_id = $id";
        $data['postcomments'] = $postModel->getPostCommentData($comment_table, $user_table, $postCommentCond);

        $answerCommentCond = "$comment_table.source = '$answer_comments' AND $answer_table.post_id = $id";
        $data['answercomments'] = $postModel->getAnswerCommentData($comment_table, $user_table, $answer_table, $answerCommentCond);

        $answerCond = "$answer_table.post_id = $id";
        $data['answers'] = $postModel->getAnswerData($answer_table, $user_table, $answerCond);
        //print_r($data);
        $this->load->view('post/postdetails', $data);
      }
      else {
        header('Location: '.BASE_URL.'/PostController/allPost');
      }
    }

    public function addPost() {
      if (isset($_SESSION['ownUserData'])) {
        $category_table = 'categories';
        $postModel = $this->load->model('PostModel');
        $cond = 1;
        $data['allcategory'] = $postModel->getUserData($category_table, $cond);
        $this->load->view('post/addpost', $data);
      }
      else {
        header('Location: '.BASE_URL.'/IndexController/login?location='.urldecode($_SERVER['REQUEST_URI']));
      }
    }

    public function addNewPost() {
      if (isset($_POST['add-post-submit'])) {
        $category = isset($_POST['category']) ? $_POST['category'] : NULL;
        $title = isset($_POST['title']) ? $_POST['title'] : NULL;
        $description = isset($_POST['description']) ? $_POST['description'] : NULL;
        $user_id = '23';
        $title_max = 29;
        $description_max = 1499;
        $error = [];
        $mdata = [];
        $post_table = 'posts';
        $postModel = $this->load->model('PostModel');

        if (empty($category)) {
          $error[] = 'You have to select a category.';
        }
        if (empty($title)) {
          $error[] = 'You have to write your question title.';
        }
        if (empty($description)) {
          $error[] = 'You have to write your question description.';
        }
        if (strlen($title) > $title_max) {
          $error[] = "Your title should be in $title_max character";
        }
        if (strlen($description) > $description_max) {
          $error[] = "Your description should be in $description_max character";
        }

        if (empty($error)) {
          $data = array(
            'user_id' => $user_id,
            'cat_id'  => $category,
            'title'   => $title,
            'description' => $description
          );
          $result = $postModel->insert($post_table, $data);
          if ($result == 1) {
            $mdata['msg'] ='Your post is inserted.';
            $_SESSION['mdata'] = $mdata;
            header('Location: '.BASE_URL.'/PostController/index');
          }
          else {
            $error[] = 'Your post is not inserted. Some problem has occurred.';
            $_SESSION['error'] = $error;
            header('Location: '.BASE_URL.'/PostController/addPost');
          }
        }
        else {
          $_SESSION['error'] = $error;
          header('Location: '.BASE_URL.'/PostController/addPost');
        }
      }
      else {
        echo 'submit not set.';
      }
    }

    public function addCommentFromPost() {
      $user_id = $_SESSION['ownUserData'][0]['id'];
      $source = 'post';
      $source_id = isset($_POST['postid']) ? $_POST['postid'] : NULL;
      $comment = isset($_POST['post-comment-box']) ? $_POST['post-comment-box'] : NULL;
      $time = time();
      echo $time;
      $error = [];
      $mdata = [];
      $comment_table = 'comments';
      $postModel = $this->load->model('PostModel');

      if (empty($comment)) {
        $error[] = 'You have to write a comment.';
      }

      if (empty($error)) {
        $data = array(
          'user_id' => $user_id,
          'source'  => $source,
          'source_id'   => $source_id,
          'description' => $comment,
          'time'    => $time
        );
        $result = $postModel->insert($comment_table, $data);
        if ($result == 1) {
          $mdata['msg'] ='Your comment is inserted.';
          $_SESSION['mdata'] = $mdata;
          print_r($mdata);
          //header('Location: '.BASE_URL.'/PostController/index');
        }
        else {
          $error[] = 'Your post is not inserted. Some problem has occurred.';
          $_SESSION['error'] = $error;
          //header('Location: '.BASE_URL.'/PostController/addPost');
        }
      }
      else {
        $_SESSION['error'] = $error;
        echo 'i am on error';
        //header('Location: '.BASE_URL."/PostController/postDetails?id=$source_id");
      }
    }
  }