<?php
class Bautizo extends AppModel {
    public $validate = array(
    	'nombres' => array(
			'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,50}$/',
			'message' => 'Los nombres deben tener entre 2 y 50 caracteres'
    	),
    	'apellidos' => array(
			'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,50}$/',
			'message' => 'Los apellidos deben tener entre 2 y 50 caracteres'
    	),
    	'fecha_nacimniento' => array(
    		'rule' => array('date', 'dmy')
    	),
    	'padre' => array(
    		'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,100}$/',
    		'message' => 'El nombre completo del padre debe tener entre 5 y 100 caracteres'
    	),
    	'madre' => array(
    		'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,100}$/',
    		'message' => 'El nombre completo de la madre debe tener entre 5 y 100 caracteres'
    	),
    	'estado_nacimiento' => array(
    		'rule' => array('between', 2, 30),
    		'message' => 'Debe completar este campo'
    	),
    	'ciudad_nacimiento' => array(
    		'rule' => array('between', 2, 30),
    		'message' => 'Debe completar este campo'
    	),
    	'pais_nacimiento' => array(
    		'rule' => array('between', 2, 30),
    		'message' => 'Debe completar este campo'
    	),
    	'sexo' => array(
    		'rule' => '/[M|F]{1}/',
    		'message' => 'El sexo debe ser M o F'
    	),
    	'libro' => array(
    		'rule' => '/^[0-9]{1,11}$/',
    		'message' => 'Solo números'
    	),
    	'folio' => array(
    		'rule' => '/^[0-9]{1,11}$/',
    		'message' => 'Solo números'
    	),
    	'numero' => array(
    		'rule' => '/^[0-9]{1,11}$/',
    		'message' => 'Solo números'
    	),
    	'padrino' => array(
    		'rule' => array('between', 5, 100),
    		'message' => 'El nombre completo del padrino debe tener entre 5 y 100 caracteres',
    		'required' => false,
    		'allowEmpty' => true
    	),
    	'madrina' => array(
    		'rule' => array('between', 5, 100),
    		'message' => 'El nombre completo de la madrina debe tener entre 5 y 100 caracteres',
    		'required' => false,
    		'allowEmpty' => true
    	),
    	'ministro' => array(
    		'rule' => array('between', 5, 50),
    		'message' => 'El nombre del ministro debe tener entre 5 y 50 caracteres'
    	),
    	'prefectura_estado' => array(
    		'rule' => array('between', 2, 20),
    		'message' => 'Debe completar este campo'
    	),
    	'prefectura_libro' => array(
    		'rule' => 'alphaNumeric',
    		'message' => 'Solo caracteres alfanuméricos'
    	),
    	'prefectura_folio' => array(
    		'rule' => '/^[0-9]{1,11}$/',
    		'message' => 'Solo números'
    	),
    	'prefectura_numero' => array(
    		'rule' => '/^[0-9]{1,11}$/',
    		'message' => 'Solo números'
    	)
    );
}
?>