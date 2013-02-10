<?php
class BudgetSetList extends ActiveRecord\Model {

	// Relations

	static $belongs_to = array(
		array('budget_set'),
		array('budget')
	);
}