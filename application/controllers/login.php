<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{	
		$this->useHeader = FALSE;
		$this->title = "Budgetrax";
		$this->keywords = "Budgetrax, budget, budget tracking, money, time";

		$this->userFBjs = TRUE;
		$this->css = array('custom-style.css');

		$this->data = array(
			'login_url'		=> $this->login_url,
			'hasNav'		=> $this->hasNav
		);

		$this->_render('pages/login');
	}
	
}