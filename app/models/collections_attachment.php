<?php
class CollectionsAttachment extends AppModel {
	var $name = 'CollectionsAttachment';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Collection' => array(
			'className' => 'Collection',
			'foreignKey' => 'collection_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'attachment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
