<?php
App::uses('AppModel', 'Model');
/**
 * Communion Model
 *
 * @property Common $Common
 */
class Communion extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'fecha' => array(
			'notempty' => array(
				'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,50}$/',
				'message' => 'Debe tener entre 2 y 50 caracteres',
			),
		),
		'ministro' => array(
			'notempty' => array(
				'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,50}$/',
				'message' => 'Debe tener entre 2 y 50 caracteres',
			),
		),
		'libro' => array(
			'notempty' => array(
				'rule' => '/^[0-9]{1,11}$/',
				'message' => 'Solo numeros',
            ),
		),
		'numero' => array(
			'notempty' => array(
				'rule' => '/^[0-9]{1,11}$/',
				'message' => 'Solo numeros',
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Common' => array(
			'className' => 'Common',
			'foreignKey' => 'communion_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
