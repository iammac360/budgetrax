<?php
class Category extends ActiveRecord\Model {

	// Relations

	static $has_many = array(
		array('budgets')
	);
}