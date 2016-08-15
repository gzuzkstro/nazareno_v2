<?php
App::uses('AppModel', 'Model');
/**
 * Common Model
 *
 * @property Communion $Communion
 */
class Common extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'nombres' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'apellidos' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Communion' => array(
			'className' => 'Communion',
			'foreignKey' => 'communion_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
