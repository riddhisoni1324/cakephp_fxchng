<?php
App::uses('AuthComponent', 'Controller/Component/Auth');
class Admin extends AppModel
{	 

	// This is executed before inserting/saving to database
	public function beforeSave($options = array()) {
	
	// Hash the password
	if (isset($this->data[$this->alias]['password'])) {
	$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	}

	// Fallback to our parent
	return parent::beforeSave($options);
	}

	// Cardinality mapping
    var $belongsTo = array('AdminType');

}
?>