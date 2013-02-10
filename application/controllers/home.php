<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->_facebook_auth($this->facebook->getUser());
		$budget_types = BudgetType::all(); 
		$budget_types_name = array();
		$budget_types_name[0] = '---Select---';
		foreach($budget_types as $key => $budget_type)
		{
			$hash[$key] = $budget_type->name;
			array_push($budget_types_name, $hash[$key]);
		}
		$categories = Category::all();
		$categories_name = array();
		$categories_name[0] = '---Select---';
		foreach($categories as $key => $category)
		{
			$hash[$key] = $category->name;
			array_push($categories_name, $hash[$key]);
		}
		$this->data = array(
			'user_id'		=> $this->user_id,
			'login_url'		=> $this->facebook->getLoginURL(),
			'user_name'		=> he($this->user_info['name']),
			'profile_pic'	=> $this->graph_url.$this->user_id.'/picture?width=140&height=140',
			'budget_types'	=> $budget_types_name,
			'categories' 	=> $categories_name
		);

	}
	
	public function index()
	{	
		$this->title = "Budgetrax";
		$this->keywords = "Budgetrax, budget, budget tracking, money, time";

		$this->userFBjs = TRUE;
		$this->css = array('custom-style.css');

		$this->_render('pages/home');
		
	}

	private function check_if_value_zero($data)
	{
		if($data === 0 || empty($data))
		{
			$this->form_validation->set_message("check_if_value_zero", "You must select from the dropdown selection.");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
}