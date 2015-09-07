<?php
class CollectionsFundAccount extends AppModel {
	var $name = 'CollectionsFundAccount';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'FundAccount' => array(
			'className' => 'FundAccount',
			'foreignKey' => 'fund_account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Collection' => array(
			'className' => 'Collection',
			'foreignKey' => 'collection_id',
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

	function afterSave(){
		$this->query("UPDATE collections SET amount = (SELECT sum(amount) FROM collections_fund_accounts WHERE collections_fund_accounts.collection_id = collections.id) where id = ".$this->Collection->id);
	}
}
