<?php
class UserDefinedCategory extends ActiveRecord\Model {

	// Relations

	static $has_many = array(
		array('budgets')
	);

	static $belongs_to = array(
		array('user')
	);
}