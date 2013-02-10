<?php
class User extends ActiveRecord\Model {

	// Relations
	static $has_many = array(
		array('budgets'),
		array('budget_sets'),
		array('user_defined_categories')
	);

	public static function create_user_if_not_exists($fb_user)
	{
		$user = User::all(array('conditions' => 'fb_id ='.$fb_user['id']));
		if(empty($user))
		{
			$user = new User();
			$user->fb_id = $fb_user['id'];
			$user->name  = $fb_user['name'];
			$user->save();
		}
	}
}