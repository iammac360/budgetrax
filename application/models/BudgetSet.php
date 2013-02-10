<?php
class BudgetSet extends ActiveRecord\Model {

	// Relations

	static $has_many = array(
		array('budget_set_lists')
	);

	static $belongs_to = array(
		array('user')
	);
}