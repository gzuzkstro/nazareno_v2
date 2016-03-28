<?php
App::import('Vendor', 'mpdf/mpdf/mpdf');

class ConfirmacionesController extends AppController {
  public $uses = 'Confirmacion';
  public $components = array('Paginator');
  public $helpers = array('Paginator');
  public $paginate = array(
    'limit' => 5,
    'order' => 'Confirmacion.numero ASC'
  );

  function index() {
    $this->Paginator->settings = $this->paginate;
    $this->set('confirmaciones', $this->Paginator->paginate('Confirmacion'));
  }
  
  function agregar() {
    if($this->request->is('post')) {

      $existeConfirmacion = $this->Confirmacion->find('first', array(
        'conditions' => array(
          'Confirmacion.lote' => $this->request->data('Confirmacion.lote'),
          'Confirmacion.numero' => $this->request->data('Confirmacion.numero')
        )
      ));

      if($existeConfirmacion) {
        $this->Session->setFlash('Ya existe una confirmación con el mismo lote y número', 'default', array(), 'bad');
      } elseif($this->Confirmacion->save($this->request->data)) {
        $this->Session->setFlash('Confirmación agregada con éxito', 'default', array(), 'good');
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash('Ha ocurrido un error agregando la confirmación', 'default', array(), 'bad');
      }

    } 
  }
  
  function modificar($id) {
    $this->Confirmacion->id = $id;
    
    if ($this->request->is('put')) {
      $existeConfirmacion = $this->Confirmacion->find('first', array(
        'conditions' => array(
          'Confirmacion.lote' => $this->request->data('Confirmacion.lote'),
          'Confirmacion.numero' => $this->request->data('Confirmacion.numero')
        )
      ));
      
      if ($existeConfirmacion && $existeConfirmacion['Confirmacion']['id'] != $id) {
         $this->Session->setFlash('Ya existe una confirmación con el mismo lote y número', 'default', array(), 'bad');
      } elseif ($this->Confirmacion->save($this->request->data)) {
        $this->Session->setFlash('Se ha modificado la confirmación con éxito', 'default', array(), 'good');
      } else {
        $this->Session->setFlash('Ha ocurrido un error modificando la confirmación', 'default', array(), 'bad');
      }
    }
    
    $this->request->data = $this->Confirmacion->read();
    $this->render('agregar');
  }

  function eliminar($id) {
    if(parent::isAdmin() && $id != null) {
      $this->Confirmacion->delete($id);
      $this->Session->setFlash('Confirmación eliminada con éxito', 'default', array(), 'good');
      $this->redirect(array('action' => 'index'));
    } else {
      throw new NotFoundException('La página no existe');
    }
  }


  function certificado($id, $motivo = null) {
    Configure::write('debug',0);

    $this->autoRender = false;
    $this->response->type('application/pdf');
    $this->loadModel('Configuracion');

    $config = $this->Configuracion->find('all');
    $this->Confirmacion->id = $id;
    $confirmacion = $this->Confirmacion->read();

    $presbitero = '';

    foreach($config as $e)
      if($e['Configuracion']['parametro'] == 'presbitero') {
        $presbitero = $e['Configuracion']['valor'];
        break;
      }

    $confirmado = $confirmacion['Confirmacion']['nombres'] . ' ' . $confirmacion['Confirmacion']['apellidos'];
    $fecha = preg_split('/\//', $confirmacion['Confirmacion']['fecha']);

    $fecha_dia = $fecha[0];
    $fecha_mes = $fecha[1];
    $fecha_ano = $fecha[2];
    $fecha_mes = strtoupper(parent::month2string($fecha_mes));

    $padre = $confirmacion['Confirmacion']['padre'];
    $madre = $confirmacion['Confirmacion']['madre'];
    $padrino = $confirmacion['Confirmacion']['padrino'];
    $ministro = $confirmacion['Confirmacion']['ministro'];
    $time = time();
    $hoy = parent::strtoupper_utf8(date('d', $time) . ' DE ' . parent::month2string(date('m',$time)) . ' DEL AÑO ' . date('Y', $time));

    $columna1 = '<table>';
    $columna1 .= '<tr><td><b>Lote:</b></td><td>'.$confirmacion['Confirmacion']['lote'] . '</td></tr>';
    $columna1 .= '<tr><td><b>Número:</b></td><td>'.$confirmacion['Confirmacion']['numero'] . '</td></tr>';
    $columna1 .= '<tr><td colspan="2"><b>Nota marginal:</b></td></tr>';
    $columna1 .= '<tr><td colspan="2" style="height: 200px;text-align:justify;font-size:11px" valign="top">' . (empty($confirmacion['Confirmacion']['nota_marginal'])?'<img width="100%" height="200" src="' . Router::url('/img/diagonal.png') . '">':$confirmacion['Confirmacion']['nota_marginal']) . '</td></tr>';
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '</table>';

    $columna2 = 'El presbitero <b>' . parent::strtoupper_utf8($presbitero) . '</b>,';
    $columna2 .= ' Cura Párroco encargado de esta Parroquia, certifica que consta en el acta reseñada al margen correspondiente al libro de Confirmaciones:';
    $columna2 .= '<br><br><br><div class="titulo">' . parent::strtoupper_utf8($confirmado) . '</div><br><br>';
    $columna2 .= '<table>';
    $columna2 .= '<tr><td><b>Fue confirmado(a) el:</b></td><td>' . $fecha_dia . ' DE ' . $fecha_mes . ' DE ' . $fecha_ano . '</td></tr>';
    $columna2 .= '<tr><td><b>Padre:</b></td><td>' . parent::strtoupper_utf8($padre) . '</b></td></tr>';
    $columna2 .= '<tr><td><b>Madre:</b></td><td>' . parent::strtoupper_utf8($madre) . '</b></td></tr>';
    $columna2 .= '<tr><td><b>Padrino / Madrina:</b></td><td>' . parent::strtoupper_utf8($padrino) . '</b></td></tr>';
    $columna2 .= '<tr><td><b>Ministro:</b></td><td>' . parent::strtoupper_utf8($ministro) . '</b></td></tr>';
    $columna2 .= '<tr><td><b>Se pide este certificado para fines: </b></td><td>' . parent::strtoupper_utf8($motivo) . '</b></td></tr>';
    $columna2 .= '</table>';

    $html = '<div class="titulo">CERTIFICADO DE CONFIRMACIÓN</div><br><br>';
    $html .= '<div style="float:left;width:25%;line-height:1.5;border-right:1px solid #666;">' . $columna1 . '</div><div style="float:right;width:70%;text-align:justify;line-height:1.5">' . $columna2 . '</div><div style="clear:both"></div>';
    $html.= '<br><br>PUERTO ORDAZ, ' . $hoy . '<br>';
    $html .= 'Doy Fe.<br><br><div style="text-align:center;"><b>PRESBITERO ' . parent::strtoupper_utf8($presbitero) . '</b><br><br><br><br><br><b>PÁRROCO</b></div>';
    $html .= '<br><br><div style="text-align:center">Si este certificado va a ser usado fuera de la Diócesis debe ser autenticado en la Curia Diocesana</div>';

    $mpdf = new mPDF('BLANK', 'Letter', '11', 'Arial', 10, 10, 35, 5, 3, 3);
    $mpdf->writeHTML('td { width:50%; padding:5px; } #logo { text-align:center } #footer { text-align: center; font-size:12px; border-top: 1px solid #666; padding-top: 5px } .titulo { text-align: center; font-size: 17px; font-weight: bold; }', 1);
    $mpdf->setHTMLHeader('<div id="logo"><img src="' . Router::url('/img/logo.png') . '"></div>');
    $mpdf->setHTMLFooter('<div id="footer">Urbanización Villa Brasil, Final Senda Curitiva. Puerto Ordaz, Estado Bolívar.<br><b>Telf.:</b> (0286) 923.27.85</div>');
    $mpdf->WriteHTML($html, 2);
    $mpdf->Output('Certificado de Confirmación de '.ucwords($confirmado), 'I');
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
        $like .= 'LOWER(nombres) LIKE \'%' . $v . '%\' OR LOWER(apellidos) LIKE \'%' . $v . '%\' OR ';
    }

    $like = substr($like, 0, strlen($like)-3);

    $this->paginate['conditions'] = ' ' . $like;
    $this->Paginator->settings = $this->paginate;

    $this->set('confirmaciones', $this->Paginator->paginate('Confirmacion'));
    $this->set('q', $q);
  }
}
?>