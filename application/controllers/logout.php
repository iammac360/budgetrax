<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends MY_Controller {
	
	public function index()
	{	
		$this->facebook->destroySession();
		$this->_facebook_auth($this->facebook->getUser());
	}
}