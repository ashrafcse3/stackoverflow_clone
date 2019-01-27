<?php

  class maincontroller {

    protected $load = array();

    function __construct() {
      $this->load = new load();
    }
  }