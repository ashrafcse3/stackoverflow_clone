<?php
  include_once "config/config.php";
  include_once "apps/mainmodel.php";
  include_once "config/load.php";
  include_once "config/maincontroller.php";
  require_once "vendor/autoload.php";
  include_once "config/facebook.php";
  include_once "config/mailtrap.php";
  
  $url = isset($_GET["url"]) ? $_GET["url"] : NULL;
  if ($url != NULL){
    $url = rtrim($url, '/');
    $url = explode('/', $url);
  }
  else { unset($url); }
  
  if (isset($url[0])) {
    include_once "apps/controllers/".$url[0].".php";
    $main = new $url[0]();
    if (isset($url[1])) {
      echo $main->{$url[1]}();
    }
  }
  else {
      include_once "apps/controllers/IndexController.php";
      $instance = new IndexController();
      $instance->login();
  }