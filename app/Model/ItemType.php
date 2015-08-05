<?php

class ItemType extends AppModel {

	var $hasMany = array(
		'ItemCategory' => array(
			'className' => 'ItemCategory', 
			'conditions'=> array('ItemCategory.is_active' => '1'),
			'order' => array('ItemCategory.sort_order ASC', 'ItemCategory.name')
			)
		);
}

?>