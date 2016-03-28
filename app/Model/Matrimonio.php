<?php
class Matrimonio extends AppModel {
    public $validate = array(
        'fecha' => array(
            'rule' => array('date', 'dmy'),
            'message' => 'El formato de la fecha es inválido debe ser dd/mm/aaaa'
        ),
        'padrino_nombre' => array(
            'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,100}$/',
            'message' => 'El nombre solo puede contener letras y tener entre 2 y 100 caracteres'
        ),
        'padrino_cedula' => array(
            'rule' => '/^[V|E]-[0-9]{1,10}$/',
            'message' => 'La cédula debe tener el siguiente formato V-12345678 o E-12345678 segun sea el caso'
        ),
        'madrina_nombre' => array(
            'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,100}$/',
            'message' => 'El nombre solo puede contener letras y tener entre 2 y 100 caracteres'
        ),
        'madrina_cedula' => array(
            'rule' => '/^[V|E]-[0-9]{1,10}$/',
            'message' => 'La cédula debe tener el siguiente formato V-12345678 o E-12345678 segun sea el caso'
        ),
        'ministro' => array(
            'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,100}$/',
            'message' => 'El nombre solo puede contener letras y tener entre 2 y 100 caracteres'
        ),
        'fecha_proclamas' => array(
            'rule' => '/^([0-9]{2}\/(0[1-9]|1[012])\/[0-9]{4}){1}(,\s?[0-9]{2}\/(0[1-9]|1[012])\/[0-9]{4})*$/',
            'message' => 'Las fechas deben estar separadas por comas en el formato dd/mm/aaaa'
        ),
        'nombres_novio' => array(
            'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,50}$/',
            'message' => 'El nombre solo puede contener letras y tener entre 2 y 50 caracteres'
        ),
        'apellidos_novio' => array(
            'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,50}$/',
            'message' => 'El nombre solo puede contener letras y tener entre 2 y 50 caracteres'
        ),
        'cedula_novio' => array(
            'rule' => '/^[V|E]-[0-9]{1,10}$/',
            'message' => 'La cédula debe tener el siguiente formato V-12345678 o E-12345678 segun sea el caso'
        ),
        'bautizo_libro_novio' => array(
    		'rule' => '/^(\w){2,20}$/',
    		'message' => 'Solo caracteres de 2 a 20 alfanuméricos'
    	),
        'bautizo_folio_novio' => array(
    		'rule' => '/^(\w){2,20}$/',
    		'message' => 'Solo caracteres de 2 a 20 alfanuméricos'
    	),
        'bautizo_numero_novio' => array(
    		'rule' => '/^(\w){2,20}$/',
    		'message' => 'Solo caracteres de 2 a 20 alfanuméricos'
    	),
        'bautizo_parroquia_novio' => array(
    		'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,100}$/',
    		'message' => 'Solo de 2 a 100 caracteres'
    	),
        'padre_novio' => array(
            'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,100}$/',
            'message' => 'El nombre solo puede contener letras y tener entre 2 y 100 caracteres'
        ),
        'madre_novio' => array(
            'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,100}$/',
            'message' => 'El nombre solo puede contener letras y tener entre 2 y 100 caracteres'
        ),
        'fecha_nacimiento_novio' => array(
            'rule' => array('date', 'dmy'),
            'message' => 'El formato de la fecha es inválido debe ser dd/mm/aaaa'
        ),
        'telefono_novio' => array(
            'rule' => '/^[0-9]{10,14}$/',
            'message' => 'Solo números de 10 a 14 digitos'
        ),
        'cedula_testigo_novio' => array(
            'rule' => '/^[V|E]-[0-9]{1,10}$/',
            'message' => 'La cédula debe tener el siguiente formato V-12345678 o E-12345678 segun sea el caso'
        ),
        'nombre_testigo_novio' => array(
            'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,100}$/',
            'message' => 'El nombre solo puede contener letras y tener entre 2 y 100 caracteres'
        ),
        'direccion_testigo_novio' => array(
            'rule' => 'notEmpty',
            'message' => 'Debe completar este campo'
        ),
        'tnovio_testigo_novio' => array(
            'rule' => 'numeric',
            'message' => 'Solo números'
        ),
        'tnovia_testigo_novio' => array(
            'rule' => 'numeric',
            'message' => 'Solo números'
        ),
        	'nombres_novia' => array(
            'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,50}$/',
            'message' => 'El nombre solo puede contener letras y tener entre 2 y 50 caracteres'
        ),
        'apellidos_novia' => array(
            'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,50}$/',
            'message' => 'El nombre solo puede contener letras y tener entre 2 y 50 caracteres'
        ),
        'cedula_novia' => array(
            'rule' => '/^[V|E]-[0-9]{1,10}$/',
            'message' => 'La cédula debe tener el siguiente formato V-12345678 o E-12345678 segun sea el caso'
        ),
        'bautizo_libro_novia' => array(
    		'rule' => '/^(\w){2,20}$/',
    		'message' => 'Solo caracteres de 2 a 20 alfanuméricos'
    	),
        'bautizo_folio_novia' => array(
    		'rule' => '/^(\w){2,20}$/',
    		'message' => 'Solo caracteres de 2 a 20 alfanuméricos'
    	),
        'bautizo_numero_novia' => array(
    		'rule' => '/^(\w){2,20}$/',
    		'message' => 'Solo caracteres de 2 a 20 alfanuméricos'
    	),
        'bautizo_parroquia_novia' => array(
    		'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,100}$/',
    		'message' => 'Solo de 2 a 100 caracteres'
    	),
        'padre_novia' => array(
            'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,100}$/',
            'message' => 'El nombre solo puede contener letras y tener entre 2 y 100 caracteres'
        ),
        'madre_novia' => array(
            'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,100}$/',
            'message' => 'El nombre solo puede contener letras y tener entre 2 y 100 caracteres'
        ),
        'fecha_nacimiento_novia' => array(
            'rule' => array('date', 'dmy'),
            'message' => 'El formato de la fecha es inválido debe ser dd/mm/aaaa'
        ),
        'telefono_novia' => array(
            'rule' => '/^[0-9]{10,14}$/',
            'message' => 'Solo números de 10 a 14 digitos'
        ),
        'cedula_testigo_novia' => array(
            'rule' => '/^[V|E]-[0-9]{1,10}$/',
            'message' => 'La cédula debe tener el siguiente formato V-12345678 o E-12345678 segun sea el caso'
        ),
        'nombre_testigo_novia' => array(
            'rule' => '/^[A-Za-zá-úÁ-ÚñÑ ]{2,100}$/',
            'message' => 'El nombre solo puede contener letras y tener entre 2 y 100 caracteres'
        ),
        'direccion_testigo_novia' => array(
            'rule' => 'notEmpty',
            'message' => 'Debe completar este campo'
        ),
        'tnovio_testigo_novia' => array(
            'rule' => 'numeric',
            'message' => 'Solo números'
        ),
        'tnovia_testigo_novia' => array(
            'rule' => 'numeric',
            'message' => 'Solo números'
        )
    );
}
?>