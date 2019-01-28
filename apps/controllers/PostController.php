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

    public function addPost() {
      if (isset($_SESSION['ownUserData'])) {
        $category_table = 'categories';
        $postModel = $this->load->model('PostModel');
        $cond = 1;
        $data['allcategory'] = $postModel->getUserData($category_table, $cond);
        $this->load->view('post/addpost', $data);
      }
      else {
        header('Location: '.BASE_URL.'/IndexController/login');
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
  }