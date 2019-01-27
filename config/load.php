<?php

class load {
	
	public function view ($name, $data = false) {
		if ( $data == true){
			extract($data);
		}
		include_once "templates/" . $name . ".php";
	}

	public function model ($name) {
		include_once 'apps/' . $name . '.php';
		return new $name();
	}

}