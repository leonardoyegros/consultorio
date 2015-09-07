<?php
class UsersAssignedUser extends AppModel {
	var $name = 'UsersAssignedUser';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Assigned' => array(
			'className' => 'User',
			'foreignKey' => 'assigned_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Master' => array(
			'className' => 'User',
			'foreignKey' => 'master_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
