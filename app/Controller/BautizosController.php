<?php
App::import('Vendor', 'mpdf/mpdf/mpdf');

class BautizosController extends AppController {
    public $components = array('Paginator');
    public $helpers = array('Paginator');
    public $paginate = array(
        'limit' => 5,
        'order' => 'Bautizo.numero ASC'
    );

    function index() {
        $this->Paginator->settings = $this->paginate;
        $this->set('bautizos', $this->Paginator->paginate('Bautizo'));
    }
    
    function agregar() {
    	if(parent::isAdmin() || 1) {
    		$this->Bautizo->validator()
    		->remove('prefectura_libro')
    		->remove('prefectura_folio')
    		->remove('prefectura_numero');
    	}

    	$this->set('paises', parent::getPaises());
    	$this->set('estados', parent::getEstados());

    	if($this->request->is('post')) {
    		$this->set('ciudades', parent::getCiudades($this->request->data('Bautizo.estado_nacimiento')));
	    	$this->set('estado_selected', $this->request->data('Bautizo.estado_nacimiento'));
	    	$this->set('ciudad_selected', $this->request->data('Bautizo.ciudad_nacimiento'));
	    	$this->set('sexo_selected', $this->request->data('Bautizo.sexo'));
            $this->set('pais_selected', $this->request->data('Bautizo.pais_nacimiento'));

            if($this->request->data('Bautizo.pais_nacimiento') != 'Venezuela') {
                $this->request->data['Bautizo']['estado_nacimiento'] = $this->request->data['Bautizo']['estado_nacimiento_2'];
                $this->request->data['Bautizo']['ciudad_nacimiento'] = $this->request->data['Bautizo']['ciudad_nacimiento_2'];
            }

            $existeBautizo = $this->Bautizo->find('first', array(
                'conditions' => array(
                    'Bautizo.libro' => $this->request->data('Bautizo.libro'),
                    'Bautizo.folio' => $this->request->data('Bautizo.folio'),
                    'Bautizo.numero' => $this->request->data('Bautizo.numero')
                )
            ));

            if($existeBautizo) {
                $this->Session->setFlash('Ya existe un bautizo con el mismo Libro, Folio y número', 'default', array(), 'bad');
	    	} elseif($this->Bautizo->save($this->request->data)) {
	    		$this->Session->setFlash('Bautizo agregado con éxito', 'default', array(), 'good');
	    		$this->redirect(array('action' => 'index'));
	    	} else {
	    		$this->Session->setFlash('Ha ocurrido un error agregando el bautizo', 'default', array(), 'bad');
	    	}

    	} else {
    		$this->set('ciudades', parent::getCiudades());
    		$this->set('estado_selected', parent::getEstado());
    		$this->set('ciudad_selected', parent::getCiudad());
            $this->set('sexo_selected', 'M');
    		$this->set('pais_selected', 'Venezuela');
    	}
    }

    function modificar($id = null) {
        if(parent::isAdmin()) {
            $this->Bautizo->validator()
            ->remove('prefectura_libro')
            ->remove('prefectura_folio')
            ->remove('prefectura_numero');
        } else {
            throw new NotFoundException('La página no existe');
        }

        $this->Bautizo->id = $id;

    	if($this->request->is('put')) {
            if($this->request->data('Bautizo.pais_nacimiento') != 'Venezuela') {
                $this->request->data['Bautizo']['estado_nacimiento'] = $this->request->data['Bautizo']['estado_nacimiento_2'];
                $this->request->data['Bautizo']['ciudad_nacimiento'] = $this->request->data['Bautizo']['ciudad_nacimiento_2'];
            }

            $existeBautizo = $this->Bautizo->find('first', array(
                'conditions' => array(
                    'Bautizo.libro' => $this->request->data('Bautizo.libro'),
                    'Bautizo.folio' => $this->request->data('Bautizo.folio'),
                    'Bautizo.numero' => $this->request->data('Bautizo.numero')
                )
            ));

            if($existeBautizo && $existeBautizo['Bautizo']['id'] != $id)
                $this->Session->setFlash('Ya existe un bautizo con el mismo Libro, Folio y número', 'default', array(), 'bad');
            elseif($this->Bautizo->save($this->request->data)) {
                $this->Session->setFlash('Se ha modificado el bautizo con éxito', 'default', array(), 'good');
            } else {
                $this->Session->setFlash('Ha ocurrido un error modificando el bautizo', 'default', array(), 'bad');
            }
    	}

    	$this->request->data = $this->Bautizo->read();
        $this->set('paises', parent::getPaises());
        $this->set('estados', parent::getEstados());

        if($this->request->data('Bautizo.pais_nacimiento') != 'Venezuela') {
            $this->request->data['Bautizo']['estado_nacimiento_2'] = $this->request->data['Bautizo']['estado_nacimiento'];
            $this->request->data['Bautizo']['ciudad_nacimiento_2'] = $this->request->data['Bautizo']['ciudad_nacimiento'];
            $this->set('ciudades', parent::getCiudades());
            $this->set('estado_selected', parent::getEstado());
            $this->set('ciudad_selected', parent::getCiudad());
        } else {
            $this->set('ciudades', parent::getCiudades($this->request->data('Bautizo.estado_nacimiento')));
            $this->set('estado_selected', $this->request->data('Bautizo.estado_nacimiento'));
            $this->set('ciudad_selected', $this->request->data('Bautizo.ciudad_nacimiento'));
        }

        $this->set('pais_selected', $this->request->data('Bautizo.pais_nacimiento'));
        $this->set('sexo_selected', $this->request->data('Bautizo.sexo'));
    	$this->render('agregar');
    }

    function eliminar($id = null) {
    	if(parent::isAdmin() && $id != null) {
    		$this->Bautizo->delete($id);
	        $this->Session->setFlash('Bautizo eliminado con éxito', 'default', array(), 'good');
	        $this->redirect(array('action' => 'index'));
    	} else {
    		throw new NotFoundException('La página no existe');
    	}
    }

    function ciudades($estado) {
        $this->layout = 'ajax';

        $ciudades = parent::getRawEstados();
		$ciudades[$estado][] = 'Otra';
        $this->set('ciudades', $ciudades[$estado]);
    }

    function certificado($id) {
        Configure::write('debug',0);
        
        $this->autoRender = false;
        $this->response->type('application/pdf');
        $this->loadModel('Configuracion');

        $config = $this->Configuracion->find('all');
        $this->Bautizo->id = $id;
        $bautizo = $this->Bautizo->read();

        $presbitero = '';

        foreach($config as $e)
            if($e['Configuracion']['parametro'] == 'presbitero') {
                $presbitero = $e['Configuracion']['valor'];
                break;
            }

        $bautizado = $bautizo['Bautizo']['nombres'] . ' ' . $bautizo['Bautizo']['apellidos'];
        $fecha = preg_split('/\//', $bautizo['Bautizo']['fecha']);
        $fecha_nac = preg_split('/\//', $bautizo['Bautizo']['fecha_nacimiento']);

        $fecha_dia = $fecha[0];
        $fecha_mes = $fecha[1];
        $fecha_ano = $fecha[2];
        $fecha_mes = strtoupper(parent::month2string($fecha_mes));

        $fecha_nac_dia = $fecha_nac[0];
        $fecha_nac_mes = $fecha_nac[1];
        $fecha_nac_ano = $fecha_nac[2];
        $fecha_nac_mes = strtoupper(parent::month2string($fecha_nac_mes));
        $lugarnac = $bautizo['Bautizo']['ciudad_nacimiento'] . ', Estado ' . $bautizo['Bautizo']['estado_nacimiento'];
        $sexo = $bautizo['Bautizo']['sexo'];
        $padre = $bautizo['Bautizo']['padre'];
        $madre = $bautizo['Bautizo']['madre'];
        $padrino = $bautizo['Bautizo']['padrino'];
        $madrina = $bautizo['Bautizo']['madrina'];
        $ministro = $bautizo['Bautizo']['ministro'];
        $time = time();
        $hoy = parent::strtoupper_utf8(date('d', $time) . ' DE ' . parent::month2string(date('m',$time)) . ' DEL AÑO ' . date('Y', $time));

        $columna1 = '<table>';
        $columna1 .= '<tr><td><b>Libro:</b></td><td>'.$bautizo['Bautizo']['libro'] . '</td></tr>';
        $columna1 .= '<tr><td><b>Folio:</b></td><td>'.$bautizo['Bautizo']['folio'] . '</td></tr>';
        $columna1 .= '<tr><td><b>Número:</b></td><td>'.$bautizo['Bautizo']['numero'] . '</td></tr>';
        $columna1 .= '<tr><td colspan="2"><b>Nota marginal:</b></td></tr>';
        $columna1 .= '<tr><td colspan="2" style="height: 200px;text-align:justify;font-size:11px" valign="top">' . (empty($bautizo['Bautizo']['nota_marginal'])?'<img width="100%" height="200" src="' . Router::url('/img/diagonal.png') . '">':$bautizo['Bautizo']['nota_marginal']) . '</td></tr>';
        $columna1 .= '<tr><td colspan="2"><b>Registro Civil<br><b>Fue presentado</b></td></tr>';
        $columna1 .= '<tr><td><b>Número:</b></td><td>'.$bautizo['Bautizo']['prefectura_numero'] . '</td></tr>';
        $columna1 .= '<tr><td><b>Folio:</b></td><td>'.$bautizo['Bautizo']['prefectura_folio'] . '</td></tr>';
        $columna1 .= '<tr><td><b>Año:</b></td><td>'.$bautizo['Bautizo']['prefectura_fecha'] . '</td></tr>';
        $columna1 .= '<tr><td><b>Libro:</b></td><td>'.$bautizo['Bautizo']['prefectura_libro'] . '</td></tr>';
        $columna1 .= '</table>';

        $columna2 = 'El presbitero <b>' . parent::strtoupper_utf8($presbitero) . '</b>,';
        $columna2 .= ' Cura Párroco encargado de esta Parroquia, certifica que consta en el acta reseñada al margen correspondiente al libro de Bautizos:';
        $columna2 .= '<br><br><br><div class="titulo">' . parent::strtoupper_utf8($bautizado) . '</div><br><br>';
        $columna2 .= '<table>';
        $columna2 .= '<tr><td><b>Fue ' . ($sexo == 'M'?'bautizado':'bautizada') . ' el:</b></td><td>' . $fecha_dia . ' DE ' . $fecha_mes . ' DE ' . $fecha_ano . '</td></tr>';
        $columna2 .= '<tr><td><b>Nació en:</b></td><td>' . parent::strtoupper_utf8($lugarnac) . '</b></td></tr>';
        $columna2 .= '<tr><td><b>El dia:</b></td><td>' . $fecha_nac_dia . ' DE ' . $fecha_nac_mes . ' DEL AÑO ' . $fecha_nac_ano . '</td></tr>';
        $columna2 .= '<tr><td><b>Padre:</b></td><td>' . parent::strtoupper_utf8($padre) . '</b></td></tr>';
        $columna2 .= '<tr><td><b>Madre:</b></td><td>' . parent::strtoupper_utf8($madre) . '</b></td></tr>';
        $columna2 .= '<tr><td><b>Padrino:</b></td><td>' . parent::strtoupper_utf8($padrino) . '</b></td></tr>';
        $columna2 .= '<tr><td><b>Madrina:</b></td><td>' . parent::strtoupper_utf8($madrina) . '</b></td></tr>';
        $columna2 .= '<tr><td><b>Ministro:</b></td><td>' . parent::strtoupper_utf8($ministro) . '</b></td></tr>';
        $columna2 .= '</table>';

        $html = '<div class="titulo">CERTIFICADO DE BAUTIZO</div><br><br>';
        $html .= '<div style="float:left;width:25%;line-height:1.5;border-right:1px solid #666;">' . $columna1 . '</div><div style="float:right;width:70%;text-align:justify;line-height:1.5">' . $columna2 . '</div><div style="clear:both"></div>';
        $html.= '<br><br>PUERTO ORDAZ, ' . $hoy . '<br>';
        $html .= 'Doy Fe.<br><br><div style="text-align:center;"><b>PRESBITERO ' . parent::strtoupper_utf8($presbitero) . '</b><br><br><br><br><br><b>PÁRROCO</b></div>';
        $html .= '<br><br><div style="text-align:center">Si este certificado va a ser usado fuera de la Diócesis debe ser autenticado en la Curia Diocesana</div>';

        $mpdf = new mPDF('BLANK', 'Letter', '11', 'Arial', 10, 10, 35, 5, 3, 3);
        $mpdf->writeHTML('td { width:50%; padding:5px; } #logo { text-align:center } #footer { text-align: center; font-size:12px; border-top: 1px solid #666; padding-top: 5px } .titulo { text-align: center; font-size: 17px; font-weight: bold; }', 1);
        $mpdf->setHTMLHeader('<div id="logo"><img src="' . Router::url('/img/logo.png') . '"></div>');
        $mpdf->setHTMLFooter('<div id="footer">Urbanización Villa Brasil, Final Senda Curitiva. Puerto Ordaz, Estado Bolívar.<br><b>Telf.:</b> (0286) 923.27.85</div>');
        $mpdf->WriteHTML($html, 2);
        $mpdf->Output('Certificado de Bautizo de '.ucwords($bautizado), 'I');
    }

    function buscar() {
        $q = $_GET['q'];

        if(empty($q))
            $keywords = array();
        else
            $keywords = preg_split('/ /', $q);

        $like = '';

        foreach($keywords as $k => $v) {
            $v = trim($v);

            if(!empty($v))
                $like .= 'LOWER(nombres) LIKE \'%' . $v . '%\' OR LOWER(apellidos) LIKE \'%' . $v . '%\' OR fecha_nacimiento LIKE \'%' . $v . '%\' OR ';
        }

        $like = substr($like, 0, strlen($like)-3);

        $this->paginate['conditions'] = ' ' . $like;
        $this->Paginator->settings = $this->paginate;

        $this->set('bautizos', $this->Paginator->paginate('Bautizo'));
        $this->set('q', $q);
    }
}
?>