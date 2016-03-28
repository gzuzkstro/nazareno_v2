<?php
class Usuario extends AppModel {
    public $validate = array(
        'usuario' => array(
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'message' => 'Solo números y letras',
                'required' => true
            ),
            'between' => array(
                'rule' => array('between', 4, 20),
                'message' => 'Debe tener entre 4 y 20 caracteres'
            ),
            'checkUser' => array(
                'rule' => 'checkUser',
                'message' => 'Ya existe un usuario con este nombre'
            )
        ),
        'password' => 'notEmpty'
    );
    
    function checkUser($check) {
        return !($this->find('count', array('conditions' => array('Usuario.usuario' => $check))) == 1);
    }
}
?>