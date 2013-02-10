<?php
class Budget extends ActiveRecord\Model {

	private $errors_array = array();

	// Relations
	static $has_many = array(
		array('categories'),
		array('budget_set_lists')
	);

	static $belongs_to =  array(
		array('user'),
		array('budget_set'),
		array('user_defined_category'),
		array('budget_type')
	);

	// validations
	static $validates_presence_of = array(
		array('name', 'message' => 'Budget Name cannot be blank.', 'on' => 'create'),
		array('budget_type_id', 'message' => 'You must select a budget type', 'on' => 'create'),
		array('category_id', 'message' => 'You must select a category', 'on' => 'create'),
		array('amount', 'message' => 'Amount cannot be blank', 'on' => 'create')
    );

    static $validates_numericality_of = array(
    	array('amount', 'message' => 'Amount must be a number', 'on' => 'create')
	);

	public function add_budget($data = array())
	{
		try
		{
			$budget = new Budget($data);
			$budget->save();
		}
		catch(\ActiveRecord\UndefinedPropertyException $e)
		{
			echo $e;
		}
		
		(strlen($budget->errors->on('name')) > 0) ? array_push($this->errors_array, $budget->errors->on('name')) : "";
		(strlen($budget->errors->on('budget_type_id')) > 0) ? array_push($this->errors_array, $budget->errors->on('budget_type_id')) : "";
		(strlen($budget->errors->on('category_id')) > 0) ? array_push($this->errors_array, $budget->errors->on('category_id')) : "";
		(strlen($budget->errors->on('amount')) > 0) ? array_push($this->errors_array, $budget->errors->on('amount')) : "";
	}

	public function get_errors()
	{
		return $this->errors_array;
	} 
}