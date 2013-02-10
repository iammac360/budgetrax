<?php
class BudgetType extends ActiveRecord\Model {

	// Relations

	static $has_many = array(
		array('budgets')
	);
}