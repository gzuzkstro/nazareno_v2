<?php
App::import('Vendor', 'mpdf/mpdf/mpdf');

class MatrimoniosController extends AppController {
	public $components = array('Paginator');
	public $helpers = array('Paginator');
	public $paginate = array(
		'limit' => 5,
		'order' => array('Matrimonio.id' => 'DESC')
	);

	function index() {
		$this->Paginator->settings = $this->paginate;
		$this->set('matrimonios', $this->Paginator->paginate('Matrimonio'));
	}

	function agregar() {
		$this->set('paises', parent::getPaises());
		$this->set('estados', parent::getEstados());

		if($this->request->is('post')) {
			$this->set('ciudades', parent::getCiudades($this->request->data('Matrimonio.estado_nacimiento_novio')));
			$this->set('estado_selected', $this->request->data('Matrimonio.estado_nacimiento_novio'));
			$this->set('ciudad_selected', $this->request->data('Matrimonio.ciudad_nacimiento_novio'));
			$this->set('pais_selected', $this->request->data('Matrimonio.pais_nacimiento_novio'));
			$this->set('ciudades_actual', parent::getCiudades($this->request->data('Matrimonio.estado_actual_novio')));
			$this->set('estado_actual_selected', $this->request->data('Matrimonio.estado_actual_novio'));
			$this->set('ciudad_actual_selected', $this->request->data('Matrimonio.ciudad_actual_novio'));
			$this->set('pais_actual_selected', $this->request->data('Matrimonio.pais_actual_novio'));

			$this->set('ciudades_novia', parent::getCiudades($this->request->data('Matrimonio.estado_nacimiento_novia')));
			$this->set('estado_selected_novia', $this->request->data('Matrimonio.estado_nacimiento_novia'));
			$this->set('ciudad_selected_novia', $this->request->data('Matrimonio.ciudad_nacimiento_novia'));
			$this->set('pais_selected_novia', $this->request->data('Matrimonio.pais_nacimiento_novia'));
			$this->set('ciudades_actual_novia', parent::getCiudades($this->request->data('Matrimonio.estado_actual_novia')));
			$this->set('estado_actual_selected_novia', $this->request->data('Matrimonio.estado_actual_novia'));
			$this->set('ciudad_actual_selected_novia', $this->request->data('Matrimonio.ciudad_actual_novia'));
			$this->set('pais_actual_selected_novia', $this->request->data('Matrimonio.pais_actual_novia'));


			if($this->request->data('Matrimonio.pais_nacimiento_novio') != 'Venezuela') {
				$this->request->data['Matrimonio']['estado_nacimiento_novio'] = $this->request->data['Matrimonio']['estado_nacimiento_novio_2'];
				$this->request->data['Matrimonio']['ciudad_nacimiento_novio'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novio_2'];
			}

			 if($this->request->data('Matrimonio.pais_actual_novio') != 'Venezuela') {
				$this->request->data['Matrimonio']['estado_actual_novio'] = $this->request->data['Matrimonio']['estado_actual_novio_2'];
				$this->request->data['Matrimonio']['ciudad_actual_novio'] = $this->request->data['Matrimonio']['ciudad_actual_novio_2'];
			}

			if($this->request->data('Matrimonio.pais_nacimiento_novia') != 'Venezuela') {
				$this->request->data['Matrimonio']['estado_nacimiento_novia'] = $this->request->data['Matrimonio']['estado_nacimiento_novia_2'];
				$this->request->data['Matrimonio']['ciudad_nacimiento_novia'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novia_2'];
			}

			if($this->request->data('Matrimonio.pais_actual_novia') != 'Venezuela') {
				$this->request->data['Matrimonio']['estado_actual_novia'] = $this->request->data['Matrimonio']['estado_actual_novia_2'];
				$this->request->data['Matrimonio']['ciudad_actual_novia'] = $this->request->data['Matrimonio']['ciudad_actual_novia_2'];
			}

			if($this->Matrimonio->save($this->request->data)) {
				$this->Session->setFlash('Matrimonio agregado con éxito', 'default', array(), 'good');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Ha ocurrido un error agregando el matrimonio', 'default', array(), 'bad');
			}


		} else {
				$this->set('ciudades', parent::getCiudades());
				$this->set('estado_selected', parent::getEstado());
				$this->set('ciudad_selected', parent::getCiudad());
				$this->set('pais_selected', 'Venezuela');
				$this->set('ciudades_actual', parent::getCiudades());
				$this->set('estado_actual_selected', parent::getEstado());
				$this->set('ciudad_actual_selected', parent::getCiudad());
				$this->set('pais_actual_selected', 'Venezuela');

				$this->set('ciudades_novia', parent::getCiudades());
				$this->set('estado_selected_novia', parent::getEstado());
				$this->set('ciudad_selected_novia', parent::getCiudad());
				$this->set('pais_selected_novia', 'Venezuela');
				$this->set('ciudades_actual_novia', parent::getCiudades());
				$this->set('estado_actual_selected_novia', parent::getEstado());
				$this->set('ciudad_actual_selected_novia', parent::getCiudad());
				$this->set('pais_actual_selected_novia', 'Venezuela');
		}
	}

	function eliminar($id) {
		if(parent::isAdmin()) {
			$this->Matrimonio->delete($id);
			$this->Session->setFlash('Matrimonio eliminado con éxito', 'default', array(), 'good');
			$this->redirect(array('action' => 'index'));
		} else {
			throw new NotFoundException('La página no existe');
		}
	}

	function modificar($id) {
		if(!parent::isAdmin())
			throw new NotFoundException('La página no existe');

		$this->Matrimonio->id = $id;

		if($this->request->is('put')) {
			if($this->request->data('Matrimonio.pais_nacimiento_novio') != 'Venezuela') {
				$this->request->data['Matrimonio']['estado_nacimiento_novio'] = $this->request->data['Matrimonio']['estado_nacimiento_novio_2'];
				$this->request->data['Matrimonio']['ciudad_nacimiento_novio'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novio_2'];
			}

			 if($this->request->data('Matrimonio.pais_actual_novio') != 'Venezuela') {
				$this->request->data['Matrimonio']['estado_actual_novio'] = $this->request->data['Matrimonio']['estado_actual_novio_2'];
				$this->request->data['Matrimonio']['ciudad_actual_novio'] = $this->request->data['Matrimonio']['ciudad_actual_novio_2'];
			}

			if($this->request->data('Matrimonio.pais_nacimiento_novia') != 'Venezuela') {
				$this->request->data['Matrimonio']['estado_nacimiento_novia'] = $this->request->data['Matrimonio']['estado_nacimiento_novia_2'];
				$this->request->data['Matrimonio']['ciudad_nacimiento_novia'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novia_2'];
			}

			if($this->request->data('Matrimonio.pais_actual_novia') != 'Venezuela') {
				$this->request->data['Matrimonio']['estado_actual_novia'] = $this->request->data['Matrimonio']['estado_actual_novia_2'];
				$this->request->data['Matrimonio']['ciudad_actual_novia'] = $this->request->data['Matrimonio']['ciudad_actual_novia_2'];
			}

			if($this->Matrimonio->save($this->request->data)) {
				$this->Session->setFlash('Se ha modificado el matrimonio con éxito', 'default', array(), 'good');
			} else {
				$this->Session->setFlash('Ha ocurrido un error modificando el matrimonio', 'default', array(), 'bad');
			}
		}

		$this->request->data = $this->Matrimonio->read();
		$this->set('paises', parent::getPaises());
		$this->set('estados', parent::getEstados());

		if($this->request->data('Matrimonio.pais_nacimiento_novio') != 'Venezuela') {
			$this->request->data['Matrimonio']['estado_nacimiento_novio_2'] = $this->request->data['Matrimonio']['estado_nacimiento_novio'];
			$this->request->data['Matrimonio']['ciudad_nacimiento_novio_2'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novio'];
			$this->set('ciudades', parent::getCiudades());
			$this->set('estado_selected', parent::getEstado());
			$this->set('ciudad_selected', parent::getCiudad());
		} else {
			$this->set('ciudades', parent::getCiudades($this->request->data('Matrimonio.estado_nacimiento_novio')));
			$this->set('estado_selected', $this->request->data('Matrimonio.estado_nacimiento_novio'));
			$this->set('ciudad_selected', $this->request->data('Matrimonio.ciudad_nacimiento_novio'));
		}

		if($this->request->data('Matrimonio.pais_actual_novio') != 'Venezuela') {
			$this->request->data['Matrimonio']['estado_actual_novio_2'] = $this->request->data['Matrimonio']['estado_actual_novio'];
			$this->request->data['Matrimonio']['ciudad_actual_novio_2'] = $this->request->data['Matrimonio']['ciudad_actual_novio'];
			$this->set('ciudades_actual', parent::getCiudades());
			$this->set('estado_actual_selected', parent::getEstado());
			$this->set('ciudad_actual_selected', parent::getCiudad());
		} else {
			$this->set('ciudades_actual', parent::getCiudades($this->request->data('Matrimonio.estado_actual_novio')));
			$this->set('estado_actual_selected', $this->request->data('Matrimonio.estado_actual_novio'));
			$this->set('ciudad_actual_selected', $this->request->data('Matrimonio.ciudad_actual_novio'));
		}

		// NOVIA

		if($this->request->data('Matrimonio.pais_nacimiento_novia') != 'Venezuela') {
			$this->request->data['Matrimonio']['estado_nacimiento_novia_2'] = $this->request->data['Matrimonio']['estado_nacimiento_novia'];
			$this->request->data['Matrimonio']['ciudad_nacimiento_novia_2'] = $this->request->data['Matrimonio']['ciudad_nacimiento_novia'];
			$this->set('ciudades_novia', parent::getCiudades());
			$this->set('estado_selected_novia', parent::getEstado());
			$this->set('ciudad_selected_novia', parent::getCiudad());
		} else {
			$this->set('ciudades_novia', parent::getCiudades($this->request->data('Matrimonio.estado_nacimiento_novia')));
			$this->set('estado_selected_novia', $this->request->data('Matrimonio.estado_nacimiento_novia'));
			$this->set('ciudad_selected_novia', $this->request->data('Matrimonio.ciudad_nacimiento_novia'));
		}

		if($this->request->data('Matrimonio.pais_actual_novia') != 'Venezuela') {
			$this->request->data['Matrimonio']['estado_actual_novia_2'] = $this->request->data['Matrimonio']['estado_actual_novia'];
			$this->request->data['Matrimonio']['ciudad_actual_novia_2'] = $this->request->data['Matrimonio']['ciudad_actual_novia'];
			$this->set('ciudades_actual_novia', parent::getCiudades());
			$this->set('estado_actual_selected_novia', parent::getEstado());
			$this->set('ciudad_actual_selected_novia', parent::getCiudad());
		} else {
			$this->set('ciudades_actual_novia', parent::getCiudades($this->request->data('Matrimonio.estado_actual_novia')));
			$this->set('estado_actual_selected_novia', $this->request->data('Matrimonio.estado_actual_novia'));
			$this->set('ciudad_actual_selected_novia', $this->request->data('Matrimonio.ciudad_actual_novia'));
		}


		$this->set('pais_selected', $this->request->data('Matrimonio.pais_nacimiento_novio'));
		$this->set('pais_actual_selected', $this->request->data('Matrimonio.pais_actual_novio'));
		$this->set('pais_selected_novia', $this->request->data('Matrimonio.pais_nacimiento_novia'));
		$this->set('pais_actual_selected_novia', $this->request->data('Matrimonio.pais_actual_novia'));

		$this->render('agregar');
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
				$like .= 'LOWER(nombres_novio) LIKE \'%' . $v . '%\' OR LOWER(apellidos_novio) LIKE \'%' . $v . '%\' OR LOWER(cedula_novio) LIKE \'%' . $v . '%\' OR LOWER(nombres_novia) LIKE \'%' . $v . '%\' OR LOWER(apellidos_novia) LIKE \'%' . $v . '%\' OR LOWER(cedula_novia) LIKE \'%' . $v . '%\' OR fecha LIKE \'%' . $v . '%\' OR ';
		}

		$like = substr($like, 0, strlen($like)-3);

		$this->paginate['conditions'] = ' ' . $like;
		$this->Paginator->settings = $this->paginate;

		$this->set('matrimonios', $this->Paginator->paginate('Matrimonio'));
		$this->set('q', $q);
	}

	function certificado($id, $motivo = null) {
		Configure::write('debug',0);

		$this->autoRender = false;
		$this->response->type('application/pdf');
		$this->loadModel('Configuracion');

		$config = $this->Configuracion->find('all');
		$this->Matrimonio->id = $id;
		$matrimonio = $this->Matrimonio->read();

		$presbitero = '';

		foreach($config as $e)
			if($e['Configuracion']['parametro'] == 'presbitero') {
				$presbitero = $e['Configuracion']['valor'];
				break;
			}

		$novio = $matrimonio['Matrimonio']['nombres_novio'] . ' ' . $matrimonio['Matrimonio']['apellidos_novio'];
		$novia = $matrimonio['Matrimonio']['nombres_novia'] . ' ' . $matrimonio['Matrimonio']['apellidos_novia'];

		$padres_novio = $matrimonio['Matrimonio']['padre_novio'] . ' y ' . $matrimonio['Matrimonio']['madre_novio'];
		$padres_novia = $matrimonio['Matrimonio']['padre_novia'] . ' y ' . $matrimonio['Matrimonio']['madre_novia'];

		$fecha = preg_split('/\//', $matrimonio['Matrimonio']['fecha']);

		$fecha_dia = $fecha[0];
		$fecha_mes = $fecha[1];
		$fecha_ano = $fecha[2];
		$fecha_mes = ucwords(parent::month2string($fecha_mes));
		$time = time();
		$hoy = parent::strtoupper_utf8(date('d', $time) . ' DE ' . parent::month2string(date('m',$time)) . ' DEL AÑO ' . date('Y', $time));

		$columna1 = '<table>';
		$columna1 .= '<tr><td><b>Libro:</b></td><td>'.$matrimonio['Matrimonio']['libro'] . '</td></tr>';
		$columna1 .= '<tr><td><b>Folio:</b></td><td>'.$matrimonio['Matrimonio']['folio'] . '</td></tr>';
		$columna1 .= '<tr><td><b>Número:</b></td><td>'.$matrimonio['Matrimonio']['numero'] . '</td></tr>';
		$columna1 .= '<tr><td colspan="2"><b>Nota marginal:</b></td></tr>';
		$columna1 .= '<tr><td colspan="2" style="height: 200px;text-align:justify;font-size:11px" valign="top">' . (empty($matrimonio['Matrimonio']['observaciones'])?'<img width="100%" height="200" src="' . Router::url('/img/diagonal.png') . '">':$matrimonio['Matrimonio']['observaciones']) . '</td></tr>';
		$columna1 .= '</table>';

		$columna2 = 'El presbitero <b>' . parent::strtoupper_utf8($presbitero) . '</b>,';
		$columna2 .= ' párroco encargado de esta Parroquia, certifica que según consta del acta reseñada al margen correspondiente al libro de Matrimonios: ';
		$columna2 .= '<br><br><br><div class="titulo">' . parent::strtoupper_utf8($novio) . '<br>y<br>' . parent::strtoupper_utf8($novia) . '</div><br><br>';
		$columna2 .= 'Recibieron Sacramento de Matrimonio Eclesiástico, en la Parroquia Jesús Nazareno, en Puerto Ordaz, Estado Bolívar, el ' . $fecha_dia . ' de ' . $fecha_mes . ' de ' . $fecha_ano . '.';
		$columna2 .= '<br><br><table>';
		$columna2 .= '<tr><td><b>Desposado hijo de: </b></td><td>' . $padres_novio . '</td></tr>';
		$columna2 .= '<tr><td><b>Desposada hija de: </b></td><td>' . $padres_novia . '</td></tr>';
		$columna2 .= '<tr><td><b>Testigos Eclesiásticos: </b></td><td>' . $matrimonio['Matrimonio']['nombre_testigo_novio'] . ' y ' . $matrimonio['Matrimonio']['nombre_testigo_novia'] . '</td></tr>';
		$columna2 .= '<tr><td><b>Ministro celebrante: </b></td><td>' . $matrimonio['Matrimonio']['ministro'] . '</td></tr>';
		$columna2 .= '<tr><td><b>Se pide este certificado para fines: </b></td><td>' . $motivo . '</td></tr>';
		$columna2 .= '</table>';

		$html = '<div class="titulo">CERTIFICADO DE MATRIMONIO</div><br><br>';
		$html .= '<div style="float:left;width:25%;line-height:1.5;border-right:1px solid #666;">' . $columna1 . '<br><br><br><br><br><br></div><div style="float:right;width:70%;text-align:justify;line-height:1.5">' . $columna2 . '</div><div style="clear:both"></div>';
		$html.= '<br><br>PUERTO ORDAZ, ' . $hoy . '<br>';
		$html .= 'Doy Fe.<br><br><div style="text-align:center;"><b>PRESBITERO ' . parent::strtoupper_utf8($presbitero) . '</b><br><br><br><br><br><b>PÁRROCO</b></div>';
		$html .= '<br><br><div style="text-align:center">Si este certificado va a ser usado fuera de la Diócesis debe ser autenticado en la Curia Diocesana</div>';

		$mpdf = new mPDF('BLANK', 'Letter', '11', 'Arial', 10, 10, 35, 5, 3, 3);
		$mpdf->writeHTML('td { width:50%; padding:5px; } #logo { text-align:center } #footer { text-align: center; font-size:12px; border-top: 1px solid #666; padding-top: 5px } .titulo { text-align: center; font-size: 17px; font-weight: bold; }', 1);
		$mpdf->setHTMLHeader('<div id="logo"><img src="' . Router::url('/img/logo.png') . '"></div>');
		$mpdf->setHTMLFooter('<div id="footer">Urbanización Villa Brasil, Final Senda Curitiva. Puerto Ordaz, Estado Bolívar.<br><b>Telf.:</b> (0286) 923.27.85</div>');
		$mpdf->WriteHTML($html, 2);
		$mpdf->Output('Certificado de Matrimonio de '.ucwords($novio) . ' y ' . ucwords($novia), 'I');
	}

	function expediente($id) {
		Configure::write('debug',0);
		$this->autoRender = false;
		$this->response->type('application/pdf');
		$this->loadModel('Configuracion');

		$this->Matrimonio->id = $id;
		$matrimonio = $this->Matrimonio->read();
		$config = $this->Configuracion->find('all');

		$presbitero = '';

		foreach($config as $e)
			if($e['Configuracion']['parametro'] == 'presbitero') {
				$presbitero = $e['Configuracion']['valor'];
				break;
			}

		$novio = $matrimonio['Matrimonio']['nombres_novio'] . ' ' . $matrimonio['Matrimonio']['apellidos_novio'];
		$novia = $matrimonio['Matrimonio']['nombres_novia'] . ' ' . $matrimonio['Matrimonio']['apellidos_novia'];
		$cedula_novio = $matrimonio['Matrimonio']['cedula_novio'];
		$cedula_novia = $matrimonio['Matrimonio']['cedula_novia'];
		$padre_novio = $matrimonio['Matrimonio']['padre_novio'];
		$padre_novia = $matrimonio['Matrimonio']['padre_novia'];
		$madre_novio = $matrimonio['Matrimonio']['madre_novio'];
		$madre_novia = $matrimonio['Matrimonio']['madre_novia'];
		$ciudad_nacimiento_novio = $matrimonio['Matrimonio']['ciudad_nacimiento_novio'];
		$ciudad_nacimiento_novia = $matrimonio['Matrimonio']['ciudad_nacimiento_novia'];
		$estado_nacimiento_novio = $matrimonio['Matrimonio']['estado_nacimiento_novio'];
		$estado_nacimiento_novia = $matrimonio['Matrimonio']['estado_nacimiento_novia'];
		$pais_nacimiento_novio = $matrimonio['Matrimonio']['pais_nacimiento_novio'];
		$pais_nacimiento_novia = $matrimonio['Matrimonio']['pais_nacimiento_novia'];
		$fecha_nacimiento_novio = str_replace('/', '.', $matrimonio['Matrimonio']['fecha_nacimiento_novio']);
		$fecha_nacimiento_novia = str_replace('/', '.', $matrimonio['Matrimonio']['fecha_nacimiento_novia']);
		$dia_novio = date('d', strtotime($fecha_nacimiento_novio));
		$dia_novia = date('d', strtotime($fecha_nacimiento_novia));
		$mes_novio = parent::month2string(date('m', strtotime($fecha_nacimiento_novio)));
		$mes_novia = parent::month2string(date('m', strtotime($fecha_nacimiento_novia)));
		$ano_novio = date('Y', strtotime($fecha_nacimiento_novio));
		$ano_novia = date('Y', strtotime($fecha_nacimiento_novia));
		$direccion_novio = $matrimonio['Matrimonio']['direccion_novio'];
		$direccion_novia = $matrimonio['Matrimonio']['direccion_novia'];
		$ciudad_novio = $matrimonio['Matrimonio']['ciudad_actual_novio'];
		$ciudad_novia = $matrimonio['Matrimonio']['ciudad_actual_novia'];
		$estado_novio = $matrimonio['Matrimonio']['estado_actual_novio'];
		$estado_novia = $matrimonio['Matrimonio']['estado_actual_novia'];
		$pais_novio = $matrimonio['Matrimonio']['pais_actual_novio'];
		$pais_novia = $matrimonio['Matrimonio']['pais_actual_novia'];
		$nombre_testigo_novio = $matrimonio['Matrimonio']['nombre_testigo_novio'];
		$nombre_testigo_novia = $matrimonio['Matrimonio']['nombre_testigo_novia'];
		$cedula_testigo_novio = $matrimonio['Matrimonio']['cedula_testigo_novio'];
		$cedula_testigo_novia = $matrimonio['Matrimonio']['cedula_testigo_novia'];
		$direccion_testigo_novio = $matrimonio['Matrimonio']['direccion_testigo_novio'];
		$direccion_testigo_novia = $matrimonio['Matrimonio']['direccion_testigo_novia'];
		$tnovio_testigo_novio = $matrimonio['Matrimonio']['tnovio_testigo_novio'];
		$tnovio_testigo_novia = $matrimonio['Matrimonio']['tnovio_testigo_novia'];
		$tnovia_testigo_novio = $matrimonio['Matrimonio']['tnovia_testigo_novio'];
		$tnovia_testigo_novia = $matrimonio['Matrimonio']['tnovia_testigo_novia'];
		$bautizo_libro_novio = $matrimonio['Matrimonio']['bautizo_libro_novio'];
		$bautizo_libro_novia = $matrimonio['Matrimonio']['bautizo_libro_novia'];
		$bautizo_folio_novio = $matrimonio['Matrimonio']['bautizo_folio_novio'];
		$bautizo_folio_novia = $matrimonio['Matrimonio']['bautizo_folio_novia'];
		$bautizo_numero_novio = $matrimonio['Matrimonio']['bautizo_numero_novio'];
		$bautizo_numero_novia = $matrimonio['Matrimonio']['bautizo_numero_novia'];
		$bautizo_parroquia_novio = $matrimonio['Matrimonio']['bautizo_parroquia_novio'];
		$bautizo_parroquia_novia = $matrimonio['Matrimonio']['bautizo_parroquia_novia'];
		$nombre_testigo_novio = $matrimonio['Matrimonio']['nombre_testigo_novio'];
		$nombre_testigo_novia = $matrimonio['Matrimonio']['nombre_testigo_novia'];

		$fecha_proclamas = $matrimonio['Matrimonio']['fecha_proclamas'];
		$fecha_declaracion = str_replace('/', '.', $matrimonio['Matrimonio']['fecha_declaracion']);
		$declaracion_dia = date('d', strtotime($fecha_declaracion));
		$declaracion_mes = parent::month2string(date('m', strtotime($fecha_declaracion)));
		$declaracion_ano = date('Y', strtotime($fecha_declaracion));
		$parroquia_proclamas = $matrimonio['Matrimonio']['parroquia_proclamas'];
		$fecha_constancia_curso_prematrimonial = $matrimonio['Matrimonio']['fecha_constancia_curso_prematrimonial'];
		$certificado_matrimonio_civil = $matrimonio['Matrimonio']['certificado_matrimonio_civil'];
		$documentos_curia = $matrimonio['Matrimonio']['documentos_curia'];
		$fecha = str_replace('/', '.', $matrimonio['Matrimonio']['fecha']);
		$fecha_dia = date('d', strtotime($fecha));
		$fecha_mes = parent::month2string(date('m', strtotime($fecha)));
		$fecha_ano = date('Y', strtotime($fecha));
		$libro = $matrimonio['Matrimonio']['libro'];
		$folio = $matrimonio['Matrimonio']['folio'];
		$numero = $matrimonio['Matrimonio']['numero'];
		$fecha_fijacion = strtotime(str_replace('/', '.', $matrimonio['Matrimonio']['fecha_fijacion']));
		$dia_fijacion = date('d', $fecha_fijacion);
		$mes_fijacion = parent::month2string(date('m', $fecha_fijacion));
		$ano_fijacion = date('Y', $fecha_fijacion);
		$hora_fijacion = date('h:i a', $fecha_fijacion);

		// Titulo del documento
		$titulo = $novio . '<br>' . $novia;

		// Página principal con los documentos
		$html = '<div class="titulo">' . parent::strtoupper_utf8($titulo) . '</div><br><br>';
		$html .= '<b>DOCUMENTOS QUE PERTENECEN A ESTE EXPEDIENTE</b><br><br>';
		$html .= '<ul style="list-style-type:upper-alpha;">';
		$html .= '<li>Partida de Bautismo de los novios</li>';
		$html .= '<li>Certificado de Proclamas de la Parroquía de '.$parroquia_proclamas.'</li>';
		$html .= '<li>Constancia de Curso Prematrimonial de fecha: '.$fecha_constancia_curso_prematrimonial.'</li>';
		$html .= '<li>Certificado del Matrimonio Civil '.$certificado_matrimonio_civil.'</li>';
		$html .= '<li>Documentos de la Curia Parroquia: '.$documentos_curia.'</li>';
		$html .= '<li>La partida de bautismo de la novia se encuentra en el Libro '.$bautizo_libro_novia.', Folio '.$bautizo_folio_novia;
		$html .= ', Nro. '.$bautizo_numero_novia.' del archivo parroquial de la Parroquia '.$bautizo_parroquia_novia.'</li>';
		$html .= '<li>La partida de bautismo del novio se encuentra en el Libro '.$bautizo_libro_novio.', Folio '.$bautizo_folio_novio;
		$html .= ', Nro. '.$bautizo_numero_novio.' del archivo parroquial de la Parroquia '.$bautizo_parroquia_novio.'</li>';		$html .= '</ul>';
		$html .= '<br><br><div class="subtitulo">OBSERVACIONES</div><br>';
		$html .= '<ul style="list-style-type:decimal;">';
		$html .= '<li>Fecha de Proclamas: '.$fecha_proclamas.'</li>';
		$html .= '<li>El Matrimonio se efectuó el día: '.$fecha.'</li>';
		$html .= '<li>Fueron testigos: '.$nombre_testigo_novio.' y '.$nombre_testigo_novia.'</li>';
		$html .= '<li>Su partida se encuentra en el Libro: '.$libro.' de Matrimonio, Folio '.$folio.' Nro '.$numero.'</li>';
		$html .= '<li>Para los efectos de la nota marginal fue participado el Matrimonio a X y a X</li>';
		$html .= '</ul>';
		$html .= '<br><br><br><br><p align="center"><b>Firma del Párroco</b></p>';
		$html .= '<p align="center"><b>FÓRMULA PARA LOS NOVIOS Y LOS TESTIGOS</b><br>
		Yo, NN, con mi mano sobre los Santos Evangelios, y teniendo como testigo a Jesucristo Crucificado,
		que me ha de juzgar, juro que diré toda y sólo la verdad acerca de lo que se me pregunte.
		</p>';

		// Declaración del novio
		$html2  = '<div class="subtitulo">ACTA DE EXPLORACIÓN DE VOLUNTADES<br>DECLARACIÓN DEL NOVIO</div><br>';
		$html2 .= '<div class="just">';
		$html2 .= 'El día '.$declaracion_dia.' del mes de '.$declaracion_mes.' del año '.$declaracion_ano.' compareció ante el infrascrito párroco ';
		$html2 .= '<b>Pbro. ' . $presbitero . '</b> de la Parroquia Jesús Nazareno, de la Diócesis de Ciudad Guayana, Venezuela, ';
		$html2 .= 'el señor <b>' . $novio . '</b> con cédula de identidad <b>' . $cedula_novio . '</b>';
		$html2 .= ' soltero, nacido en <b>' . $ciudad_nacimiento_novio . ', Estado ' . $estado_nacimiento_novio . ', '.$pais_nacimiento_novio.'</b>';
		$html2 .= ' el día <b>' . $dia_novio . ' de ' . $mes_novio . ' de ' . $ano_novio . '</b>,';
		$html2 .= ' de ' . parent::age(strtotime($fecha_nacimiento_novio)) . ' años de edad,';
		$html2 .= ' vecino de '.$direccion_novio.', ' . $ciudad_novio . ', ' . $estado_novio . ', ' . $pais_novio . '.';
		$html2 .= ' Hijo de ' . $padre_novio . ' y de ' . $madre_novio . ' y declaró bajo juramento';
		$html2 .= ' que hizo en nombre de Dios:<br><br>';
		$html2 .= '<ul style="list-style-type:upper-alpha;">';
		$html2 .= '<li>Que consiente y libremente desea contraer Matrimonio con la Srta. ' . $novia . '.</li>';
		$html2 .= '<li>Que libremente acepta las propiedades esenciales del Matrimonio:';
		$html2 .= ' Unidad e Indisolubilidad, procreación y obligación de educar en la Doctrina';
		$html2 .= ' Católica a los hijos.</li>';
		$html2 .= '<li>Que ha residido, después de la pubertad, por seis meses o más en '.$ciudad_novio.', Estado '.$estado_novio.'.</li>';
		$html2 .= '<li>Que no tiene impedimento de NINGÚN TIPO que obstaculice la Celebración del Matrimonio.</li>';
		$html2 .= '<li>¿Procede libremente a su Matrimonio? SÍ</li>';
		$html2 .= '<li>¿Pone condición al Matrimonio? NO</li>';
		$html2 .= '<li>¿Conoce las obligaciones y derechos de Matrimonio? SÍ</li>';
		$html2 .= '</ul>';
		$html2 .= 'Le instruí convenientemente y le advertí sobre el deber de recibir el';
		$html2 .= ' Sacramento en gracia de Dios y participar en la Eucaristía.<br>';
		$html2 .= 'En fe de lo anteriormente expuesto firmamos esta declaración.<br><br><br><br><br>';
		$html2 .= '<table style="width:80%;margin:auto;text-align:center"><tr><td></td><td></td></tr>';
		$html2 .= '<tr><td><b>Firma del Novio</b></td><td><b>Firma del Párroco</b></td></tr>';
		$html2 .= '</table>';
		$html2 .= '</div>';
		$html2 .= '<br><br><div class="subtitulo">DECLARACIÓN DEL PRIMER TESTIGO</div><br>';
		$html2 .= '<div class="just">';
		$html2 .= 'Ante mí compareció <b>' . $nombre_testigo_novio . '</b> C.I. <b>' . $cedula_testigo_novio;
		$html2 .= '</b> mayor de edad y vecino(a) de ' . $direccion_testigo_novio . ', quien bajo';
		$html2 .= ' juramento que hizo en nombre de Dios, declaró: que conoce perfectamente al novio';
		$html2 .= ' desde hace ' . parent::number2word($tnovio_testigo_novio) . ' (' . $tnovio_testigo_novio . ')';
		$html2 .= ' años y a la novia desde hace ' . parent::number2word($tnovia_testigo_novio) . ' (' . $tnovia_testigo_novio . ')';
		$html2 .= ' años y le consta que son solteros;';
		$html2 .= ' que han residido después de la pubertad, por seis meses o más, en '.$ciudad_novio.' y que NO tienen impedimento';
		$html2 .= ' de NINGÚN TIPO que obstaculice a la celebración del Matrimonio. Y para que conste firma la presente declaración.<br><br><br><br><br>';
		$html2 .= '<p align="center"><b>Firma del Testigo</b></p>';
		$html2 .= '</div>';

		// Declaración de la novia
		$html3  = '<div class="subtitulo">ACTA DE EXPLORACIÓN DE VOLUNTADES<br>DECLARACIÓN DE LA NOVIA</div><br>';
		$html3 .= '<div class="just">';
		$html3 .= 'El día '.$declaracion_dia.' del mes de '.$declaracion_mes.' del año '.$declaracion_ano.' compareció ante el infrascrito párroco ';
		$html3 .= '<b>Pbro. ' . $presbitero . '</b> de la Parroquia Jesús Nazareno, de la Diócesis de Ciudad Guayana, Venezuela, ';
		$html3 .= 'la señorita <b>' . $novia . '</b> con cédula de identidad <b>' . $cedula_novia . '</b>';
		$html3 .= ' soltera, nacida en <b>' . $ciudad_nacimiento_novia . ', Estado ' . $estado_nacimiento_novia . ', '.$pais_nacimiento_novia.'</b>';
		$html3 .= ' el día <b>' . $dia_novia . ' de ' . $mes_novia . ' de ' . $ano_novia . '</b>,';
		$html3 .= ' de ' . parent::age(strtotime($fecha_nacimiento_novia)) . ' años de edad,';
		$html3 .= ' vecina de '.$direccion_novia.', ' . $ciudad_novia . ', ' . $estado_novia . ', ' . $pais_novia . '.';
		$html3 .= ' Hija de ' . $padre_novia . ' y de ' . $madre_novia . ' y declaró bajo juramento';
		$html3 .= ' que hizo en nombre de Dios:<br><br>';
		$html3 .= '<ul style="list-style-type:upper-alpha;">';
		$html3 .= '<li>Que consiente y libremente desea contraer Matrimonio con el Sr. ' . $novio . '.</li>';
		$html3 .= '<li>Que libremente acepta las propiedades esenciales del Matrimonio:';
		$html3 .= ' Unidad e Indisolubilidad, procreación y obligación de educar en la Doctrina';
		$html3 .= ' Católica a los hijos.</li>';
		$html3 .= '<li>Que ha residido, después de la pubertad, por seis meses o más en '.$ciudad_novia.', Estado '.$estado_novia.'.</li>';
		$html3 .= '<li>Que no tiene impedimento de NINGÚN TIPO que obstaculice la Celebración del Matrimonio.</li>';
		$html3 .= '<li>¿Procede libremente a su Matrimonio? SÍ</li>';
		$html3 .= '<li>¿Pone condición al Matrimonio? NO</li>';
		$html3 .= '<li>¿Conoce las obligaciones y derechos de Matrimonio? SÍ</li>';
		$html3 .= '</ul>';
		$html3 .= 'Le instruí convenientemente y le advertí sobre el deber de recibir el';
		$html3 .= ' Sacramento en gracia de Dios y participar en la Eucaristía.<br>';
		$html3 .= 'En fe de lo anteriormente expuesto firmamos esta declaración.<br><br><br><br><br>';
		$html3 .= '<table style="width:80%;margin:auto;text-align:center"><tr><td></td><td></td></tr>';
		$html3 .= '<tr><td><b>Firma de la Novia</b></td><td><b>Firma del Párroco</b></td></tr>';
		$html3 .= '</table>';
		$html3 .= '</div>';
		$html3 .= '<br><br><div class="subtitulo">DECLARACIÓN DEL PRIMER TESTIGO</div><br>';
		$html3 .= '<div class="just">';
		$html3 .= 'Ante mí compareció <b>' . $nombre_testigo_novia . '</b> C.I. <b>' . $cedula_testigo_novia;
		$html3 .= '</b> mayor de edad y vecino(a) de ' . $direccion_testigo_novia . ', quien bajo';
		$html3 .= ' juramento que hizo en nombre de Dios, declaró: que conoce perfectamente a la novia';
		$html3 .= ' desde hace ' . parent::number2word($tnovia_testigo_novia) . ' (' . $tnovia_testigo_novia . ')';
		$html3 .= ' años y al novio desde hace ' . parent::number2word($tnovio_testigo_novia) . ' (' . $tnovio_testigo_novia . ')';
		$html3 .= ' años y le consta que son solteros;';
		$html3 .= ' que han residido después de la pubertad, por seis meses o más, en '.$ciudad_novia.' y que NO tienen impedimento';
		$html3 .= ' de NINGÚN TIPO que obstaculice a la celebración del Matrimonio. Y para que conste firma la presente declaración.<br><br><br><br><br>';
		$html3 .= '<p align="center"><b>Firma del Testigo</b></p>';
		$html3 .= '</div>';

		// Fijación del día y fecha
		$html4  = '<div class="just">';
		$html4 .= '<div class="subtitulo">FIJACIÓN DEL DÍA Y FECHA</div>';
		$html4 .= 'Hacemos constar que nosotros ' . $novio . ' y ' . $novia;
		$html4 .= ' hemos convenido contraer Matrimonio en la Iglesia Parroquial Jesús Nazareno el día ';
		$html4 .= $dia_fijacion . ' de ' . $mes_fijacion . ' del año ' . $ano_fijacion . ' a las '.$hora_fijacion.'<br><br><br>';
		$html4 .= '<table style="width:80%;margin:auto;text-align:center"><tr><td></td><td></td></tr>';
		$html4 .= '<tr><td><b>Firma del Novio</b></td><td><b>Firma de la Novia</b></td></tr>';
		$html4 .= '<tr><td colspan="2"><br><br><br><b>Firma del Párroco</b></td></tr>';
		$html4 .= '</table><br>';
		$html4 .= '<div class="subtitulo">DELEGACIÓN PARA PRESENCIAR EL MATRIMONIO OTRO SACERDO</div>';
		$html4 .= 'Yo, ____________________________________________ Párroco de la Parroquia Jesús Nazareno, de la';
		$html4 .= ' diócesis de Ciudad Guayana, Venezuela, delego en él ____________________________________________ para';
		$html4 .= ' que presencie el presente Matrimonio de ' . $novio . ' y ' . $novia . ' en la Parroquia Jesús Nazareno.';
		$html4 .= '<br>L.S.<p align="right"><b>Firma del Párroco</b></p>';
		$html4 .= '<br><div class="subtitulo">AUTENTICACIÓN DE LA CANCILLERÍA DE LA DIÓCESIS</div>';
		$html4 .= 'El infrascrito, ______________________________________________________________________________________________ ';
		$html4 .= 'Canciller de la Diócesis de Ciudad Guayana, certifica que la firma del Párroco que aparece en este documento';
		$html4 .= 'es autentica.';
		$html4 .= '<br>L.S.<p align="right"><b>Firma del Secretario Canciller</b></p>';
		$html4 .= '<p align="center"><b>ACTA DEL MATRIMONIO</b></p>';
		$html4 .= 'En Puerto Ordaz, Parroquia Jesús Nazareno, después de haber recabado todos los documentos ';
		$html4 .= 'canónicos y llenadas las distintas instancias establecidas por la Santa Madre Iglesia, se efectuó';
		$html4 .= ' el matrimonio al que se refiere este expediente entre ' . $novia . ' y ' . $novia . ' y fueron testigos';
		$html4 .= ' ' . $nombre_testigo_novio . ' C.I. '.$cedula_testigo_novio.' y ' . $nombre_testigo_novia . ' C.I. ' . $cedula_testigo_novia;
		$html4 .= ' lo que doy fe con mi firma, la de los contrayentes y testigos.<br>';
		$html4 .= 'En Ciudad Guayana, a ' . $fecha_dia . ' días del mes de ' . $fecha_mes . ', del año ' . $fecha_ano;
		$html4 .= '<br><br><table style="width:100%;margin:auto;text-align:center"><tr><td></td><td></td></tr>';
		$html4 .= '<tr><td><br><b>Firma del Novio</b></td><td><br><b>Firma de la Novia</b></td></tr>';
		$html4 .= '<tr><td style="text-align:left;"><br><b>Firma del Testigo</b></td><td style="text-align:right;"><br><b>Firma del Testigo</b></td></tr>';
		$html4 .= '<tr><td colspan="2"><b>Firma del Párroco</b></td></tr>';
		$html4 .= '</table><br>';
		$html4 .= '</div>';

		$mpdf = new mPDF('BLANK', 'Letter', '11', 'Arial', 10, 10, 35, 5, 3, 3);
		$mpdf->writeHTML('.just { text-align: justify; } .documentos td { padding: 8px; border-bottom: #ccc 1px solid } #logo { text-align:center } #footer { text-align: center; font-size:12px; border-top: 1px solid #666; padding-top: 5px } .titulo { text-align: center; font-size: 17px; font-weight: bold; } .subtitulo { text-align: left; font-size: 14px; font-weight: bold; }', 1);
		$mpdf->setHTMLHeader('<div id="logo"><img src="' . Router::url('/img/logo.png') . '"></div>');
		$mpdf->setHTMLFooter('<div id="footer">Urbanización Villa Brasil, Final Senda Curitiva. Puerto Ordaz, Estado Bolívar.<br><b>Telf.:</b> (0286) 923.27.85</div>');
		$mpdf->writeHTML($html, 2);
		$mpdf->AddPage();
		$mpdf->writeHTML($html2, 2);
		$mpdf->AddPage();
		$mpdf->writeHTML($html3, 2);
		$mpdf->AddPage();
		$mpdf->writeHTML($html4, 2);
		$mpdf->Output('Expediente Matrimonial de ' . $novio . ' y ' . $novia, 'I');
	}
}
?>