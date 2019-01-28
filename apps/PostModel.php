<?php

  include_once "config/database.php";

  class PostModel extends database {
  
  	function __construct() {
  		parent::__construct();
  	}

  	public function insert($table, $data){
      return $this->db->insert($table, $data);
    }

    public function getPostData($post_table, $user_table, $category_table, $cond) {
      $sql = "SELECT $post_table.id, $user_table.name AS user_name, $category_table.cat_title AS category,  $post_table.title, $post_table.description 
        FROM $post_table
        INNER JOIN $user_table on $post_table.user_id = $user_table.id
        INNER JOIN $category_table on $post_table.cat_id = $category_table.id
        WHERE $cond
        ORDER BY $post_table.id DESC";
      return $this->db->selectUserData($sql);
    }

    public function getUserData($user_table, $cond){
      $sql="SELECT *  FROM $user_table where $cond ";
      return $this->db->selectUserData($sql);
    }

    public function update($table, $data, $cond){
      return $this->db->update($table, $data, $cond);
    }
  }