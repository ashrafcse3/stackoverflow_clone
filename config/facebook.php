<?php
  if(!session_id()) {
    session_start();
  }
  // Step 1: Enter Credentials
  $fb = new \Facebook\Facebook([
    'app_id' => '208825246674594',
    'app_secret' => '8afb25a9e82da16ee891b86c7ae5cbc8',
    'default_graph_version' => 'v2.10',
    //'default_access_token' => '{access-token}', // optional
  ]);
  $helper = $fb->getRedirectLoginHelper();