<?php
class Confirmacion extends AppModel {
  public $useTable = 'confirmaciones';
  public $validate = array(
    'fecha' => array(
      'rule' => array('date', 'dmy'),
      'message' => 'El formato de la fecha es inválido debe ser dd/mm/aaaa'
    ),
    'nombres' => array(
      'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,50}$/',
      'message' => 'Los nombres deben tener entre 2 y 50 caracteres'
    ),
    'apellidos' => array(
      'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,50}$/',
      'message' => 'Los apellidos deben tener entre 2 y 50 caracteres'
    ),
    'padre' => array(
      'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,100}$/',
      'message' => 'El nombre completo del padre debe tener entre 5 y 100 caracteres'
    ),
    'madre' => array(
      'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,100}$/',
      'message' => 'El nombre completo de la madre debe tener entre 5 y 100 caracteres'
    ),
    'padrino' => array(
      'rule' => array('between', 5, 100),
      'message' => 'El nombre completo del padrino / madrina debe tener entre 5 y 100 caracteres',
      'required' => false,
      'allowEmpty' => true
    ),
    'ministro' => array(
      'rule' => array('between', 5, 50),
      'message' => 'El nombre del ministro debe tener entre 5 y 50 caracteres'
    )
  );
}
?>