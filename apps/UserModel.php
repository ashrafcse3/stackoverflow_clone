<?php

  include_once "config/database.php";

  class UserModel extends database {
  
  	function __construct() {
  		parent::__construct();
  	}

  	public function insert($table, $data){
      return $this->db->insert($table, $data);
    }

    public function getUserData($user_table, $cond){
      $sql="SELECT *  FROM $user_table where $cond ";
      return $this->db->selectUserData($sql);
    }

    public function update($table, $data, $cond){
      return $this->db->update($table, $data, $cond);
    }
  }