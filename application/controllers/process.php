<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Process extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->_facebook_auth($this->facebook->getUser());
		// $this->output->enable_profiler(TRUE); 
	}
	
	public function index()
	{	
		
	}

	public function add_budget()
	{
		$data = $this->input->post(NULL, TRUE);

		if(empty($data))
		{
			echo "Please fill all the required fields";
		}
		else
		{
			array_pop($data);
			$user = User::first(array('conditions' => 'fb_id ='.$this->user_id));
			// echo '<pre>';
			// var_dump(($user->id));
			// echo '</pre>';
			$data['user_id'] = $user->id;
			$data['category_id'] = (int)$data['category_id'];
			$data['budget_type_id'] = (int)$data['budget_type_id'];
			$data['amount']	= (float)$data['amount'];
			// var_dump($data);
			$budget = new Budget();
			$budget->add_budget($data);
			if(count($budget->get_errors()) > 0)
			{
				// echo '<pre>';
				// var_dump($budget->has_errors());
				// echo '</pre>';
				$response = array('errrors' => $budget->get_errors());
				echo json_encode($response);
			}
			else
			{
				$response = array('sucesss' => 'true');
				echo json_encode($response);
				redirect('home');
			}
		}
	}
	
}