<?php

  class UserController extends maincontroller {
    
    function __construct(){
      parent::__construct();
    }

    public function login() {
      $user_table = 'users';
      $userModel = $this->load->model('UserModel');
      $error = [];
		  $email = isset($_POST["email"])? $_POST["email"]: NULL;
		  $password = isset($_POST["password"])? $_POST["password"]:  NULL;
      $cond = "email='$email'";
      $result = $userModel->getUserData($user_table, $cond);

      if (count($result) == 1) {
        if (password_verify($password, $result[0]['password'])) {
          if ($result[0]['active'] == 1) {
            $_SESSION['ownUserData'] = $result;
            header('Location: ' . BASE_URL . '/PostController/allPost');
            exit();
          }
          else {
            $error[] = 'Your account is not activated yet. Check your email.';
            $_SESSION['error'] = $error;
            print_r($error);
            header('Location: ' . BASE_URL . '/IndexController/login');
          }
        }
        else {
          $error[] = 'You password is incorrect.';
          $_SESSION['error'] = $error;
          print_r($error);
          header('Location: ' . BASE_URL . '/IndexController/login');
          exit();
        }
      }
      else {
        $error[] = 'You are not a registered user.';
        $_SESSION['error'] = $error;
        print_r($error);
        header('Location: ' . BASE_URL . '/IndexController/login');
        exit();
      }
    }

    public function loginWithFB() {
      
      try {
        global $helper;
        $accessToken = $helper->getAccessToken();
      } catch (\Facebook\Exceptions\FacebookResponseException $e) {
        echo  'Graph returned an error: ' . $e->getMessage();
      } catch (\Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
      }
      
      if(!$accessToken) {
        header('location: ' . BASE_URL . '/IndexController/login');
      }

      global $fb;
      $oAuth2Client = $fb->getOAuth2Client();
      if (!$accessToken->isLongLived()) {
        $accessToken = $oAuth2Client->getLongLivedAccessToken       ($accessToken);
      }

      $response = $fb->get("/me?fields= id, name, email, picture.type(large)", $accessToken);
      $userData = $response->getGraphNode()->asArray();
      $_SESSION['userData'] = $userData;
      $_SESSION['access_token'] = (string) $accessToken;
      header('Location: ' . BASE_URL . '/UserController/profile');
      exit();
    }

    public function signup() {
      // catch all of the information that are submitted from signup page
      $name = isset($_POST["name"])? $_POST["name"]: NULL;
		  $email = isset($_POST["email"])? $_POST["email"]: NULL;
		  $password = isset($_POST["password"])? $_POST["password"]: NULL;
      $confirm_password = isset($_POST["confirm_password"])? $_POST["confirm_password"] : NULL;
      $error = [];
      $mdata = [];
      $user_table = 'users';
      $userModel = $this->load->model('UserModel');

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'The Email structure is not right';
      }
      $cond = "email='$email'";
      if($userModel->getUserData($user_table, $cond)) {
        $error[] = 'This Email is already taken';
      }
      if ($password !== $confirm_password) {
        $error[] = "Password doesn't match!";
      }

      if(empty($error)) {
        $hash = $this->sendVerificationEmail($name, $email);
        $data  = array(
          'name' => $name,
          'email' => $email,
          'password' => password_hash($password, PASSWORD_DEFAULT),
          'hash' => $hash,
          'active' => 0
        );
        //print_r($data);
        $result = $userModel->insert($user_table, $data);
        if ($result == 1) {
          $mdata['msg'] = 'You are registered. Check your email for verification.';
          $_SESSION['mdata'] = $mdata;
        } else {
          $mdata['msg'] = 'You are not registered. Some problem occurred during registration.';
          $_SESSION['mdata'] = $mdata;
        }
        header('Location: '.BASE_URL.'/IndexController/signup');
      }
      else {
        $_SESSION['error'] = $error;
        //print_r($error);
        header('Location: '.BASE_URL.'/IndexController/signup');
      }
    }

    public function sendVerificationEmail($name, $email) {
      global $mailer;
      $hash = md5(random_int(pow(10, 5 -1), pow(10, 5) - 1));
      $link = BASE_URL . "/UserController/checkVerificationEmail?email=".$email."&hash=".$hash;

      $message = (new Swift_Message('Verification link'))
          ->setFrom(['ashrafcse3@gmail.com' => 'ashraf'])
          ->setTo(["$email" => "$name"])
          ->setBody("<h1>Here is your verification link. click here:</h1><br><a href=".$link.">".$link."</a>", 'text/html');
      $result = $mailer->send($message);
      //var_dump($result);
      return $hash;
    }

    public function checkVerificationEmail() {
      $email = isset($_GET['email']) ? $_GET['email'] : NULL;
      $hash = isset($_GET['hash']) ? $_GET['hash'] : NULL;
      $error = [];
      $mdata = [];
      $user_table = 'users';
      $userModel = $this->load->model('UserModel');
      $cond = "email='$email' AND hash='$hash'";
      if(!$userModel->getUserData($user_table, $cond)) {
        $error[] = 'Your are not a registered user.';
      }

      if (empty($error)) {
        $data = array('active' => '1');
        $result = $userModel->update($user_table, $data, $cond);
        if ($result == 1) {
          $mdata['msg'] = 'Your account is activated. Now you can login.';
          $_SESSION['mdata'] = $mdata;
          header('Location: '.BASE_URL.'/IndexController/login');
        }
        else {
          $mdata['msg'] = 'Your account is not actived. Check your email inbox again.';
          $_SESSION['mdata'] = $mdata;
          header('Location: '.BASE_URL.'/IndexController/signup');
        }
      }
      else {
        $_SESSION['error'] = $error;
        //print_r($error);
        header('Location: '.BASE_URL.'/IndexController/signup');
      }
    }

    public function profile() {
      $this->load->view('user/profile');
    }

    public function logout() {
      if (isset($_SESSION['ownUserData'])) {
        unset($_SESSION['ownUserData']);
      }
      header('Location: ' .BASE_URL.'/IndexController/login');
    }

    public function forgotPassword() {
      $email = isset($_POST["email"]) ? $_POST["email"] : NULL;
      $error = [];
      $mdata = [];
      $user_table = 'users';
      $userModel = $this->load->model('UserModel');
      $cond = "email='$email'";
      $result = $userModel->getUserData($user_table, $cond);
      if (count($result) == 1) {
        $password = $this->sendForgotPasswordToEmail($result[0]['name'],$email);
        $data = array('password' => password_hash($password, PASSWORD_DEFAULT));
        echo $password;
        $result1 = $userModel->update($user_table, $data, $cond);

        if ($result1 == 1) {
          $mdata['msg'] = 'Your reset password is successfull. Check your email.';
          $_SESSION['mdata'] = $mdata;
          header('Location: '.BASE_URL.'/IndexController/forgotPassword');
        }
        else {
          $mdata['msg'] = 'Some problems occured. Try again.';
          $_SESSION['mdata'] = $mdata;
          header('Location: '.BASE_URL.'/IndexController/forgotPassword');
        }
      }
      else {
        $error[] = 'You are not a registered user.';
        $_SESSION['error'] = $error;
        header('Location: '.BASE_URL.'/IndexController/forgotPassword');
      }
    }

    public function sendForgotPasswordToEmail($name, $email) {
      global $mailer;
      $password = random_int(1, 1000000);
      $link = "<h5>Email: $email</h5><br><h5>Password: $password</h5>";
      $senderEmail = 'ashrafcse3@gmail.com';
      $senderName = 'Ashraf';

      $message = (new Swift_Message('Forgot Password link'))
          ->setFrom([$senderEmail => $senderName])
          ->setTo([$email => $name])
          ->setBody("<h1>Here is your new password:</h1><br>$link", 'text/html');
      $mailer->send($message);

      return $password;
    }
  }