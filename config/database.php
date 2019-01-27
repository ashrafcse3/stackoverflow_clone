<?php
  class database{
  	protected $db = array();
  
  	public function __construct(){
      $dbname = 'login';
      $host = 'localhost';
  		$username = 'root';
  		$password = '';
      $dsn = "mysql:dbname=$dbname; host=$host";
			$this->db= new mainmodel($dsn, $username, $password);
  	}
  }