<?php 


/**
* 
*/
class User extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function  connector(){
	// echo "ok";
		require_once './public/ckfinder/core/connector/php/connector.php';
	}

	public function html(){
		$this->load->view('admin/ckfinder/user');
		// echo "ok";
	}
}