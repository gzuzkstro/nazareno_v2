<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'mpdf/mpdf/mpdf');
/**
 * Communions Controller
 *
 */
class CommunionsController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
public $scaffold;

public $uses = array('Communion','Common');
  public $components = array('Paginator');
  public $helpers = array('Paginator');
  public $paginate = array(
    'limit' => 10,
    'order' => 'Communion.libro ASC'
  );
  
  function index() {
      
      $where_options = array();
      
      //Filtrar por nombre
      if(isset($this->request->data['Common']['nombres']) && $this->request->data['Common']['nombres']!=""){
          $where_options['Common.nombres LIKE'] = $this->request->data['Common']['nombres'].'%';
      }
      
      //Filtrar por nombre del catequista
      if(isset($this->request->data['Common']['catequista']) && $this->request->data['Common']['catequista']!=""){
          $where_options['Communion.catequista LIKE'] = $this->request->data['Common']['catequista'].'%';
      }
      
      $this->Paginator->settings = array(
        'limit' => 10,
        'conditions' => $where_options,
        'contain' => array('Communion')
      );
    
    $this->set('comuniones', $this->Paginator->paginate('Common'));
  }
  
  function agregar() {
    if($this->request->is('post')) {

      if($this->Communion->saveAll($this->request->data)) {
        $this->Session->setFlash('Comunión agregada con éxito', 'default', array(), 'good');
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash('Ha ocurrido un error agregando la comunión', 'default', array(), 'bad');
      }

    } 
  }
  
  /*
  function modificar($id) {
    $this->Communion->id = $id;
    
    if ($this->request->is('put')) {
      
      $existeCommunion = $this->Communion->find('first', array(
        'conditions' => array(
          'Communion.libro' => $this->request->data('Communion.libro')
        )
      ));
      
    if ($existeCommunion && $existeCommunion['Communion']['id'] != $id) {
         $this->Session->setFlash('Ya existe una comunión con el mismo libro, folio y número', 'default', array(), 'bad');
      } elseif ($this->Communion->save($this->request->data)) {
        $this->Session->setFlash('Se ha modificado la comunión con éxito', 'default', array(), 'good');
      } else {
        $this->Session->setFlash('Ha ocurrido un error modificando la comunión', 'default', array(), 'bad');
      }
    }
    
    $this->request->data = $this->Communion->read();
    $this->render('agregar');
  }
  */
    /*
  function eliminar($id) {
    if(parent::isAdmin() && $id != null) {
      $this->Communion->delete($id);
      $this->Session->setFlash('Comunión eliminada con éxito', 'default', array(), 'good');
      $this->redirect(array('action' => 'index'));
    } else {
      throw new NotFoundException('La página no existe');
    }
  }*/
  
  function certificado($id, $motivo = null) {
    Configure::write('debug',0);

    $this->autoRender = false;
    $this->response->type('application/pdf');
    $this->loadModel('Configuracion');

    $config = $this->Configuracion->find('all');
    $Communion = $this->Common->find('first',
        [
            'contain' => array('Communion'),
            'conditions' => array('Common.id' => $id)
        ]
    );
    echo var_dump($Communion);
      
    $presbitero = '';

    foreach($config as $e)
      if($e['Configuracion']['parametro'] == 'presbitero') {
        $presbitero = $e['Configuracion']['valor'];
        break;
      }

    $comulgado = $Communion['Common']['nombres'] . ' ' . $Communion['Common']['apellidos'];
    $fecha = preg_split('/\//', $Communion['Communion']['fecha']);

    $fecha_dia = $fecha[0];
    $fecha_mes = $fecha[1];
    $fecha_ano = $fecha[2];
    $fecha_mes = strtoupper(parent::month2string($fecha_mes));

    $padre = $Communion['Common']['padre'];
    $madre = $Communion['Common']['madre'];
    $ministro = $Communion['Communion']['ministro'];
    $catequista = $Communion['Communion']['catequista'];
    $time = time();
    $hoy = parent::strtoupper_utf8(date('d', $time) . ' DE ' . parent::month2string(date('m',$time)) . ' DEL AÑO ' . date('Y', $time));

    $columna1 = '<table>';
    $columna1 .= '<tr><td><b>Libro:</b></td><td>'.$Communion['Communion']['libro'] . '</td></tr>';
    //$columna1 .= '<tr><td><b>Folio:</b></td><td>'.$Communion['Communion']['folio'] . '</td></tr>';
    $columna1 .= '<tr><td><b>Número:</b></td><td>'.$Communion['Communion']['numero'] . '</td></tr>';
    //$columna1 .= '<tr><td colspan="2"><b>Nota marginal:</b></td></tr>';
    //$columna1 .= '<tr><td colspan="2" style="height: 200px;text-align:justify;font-size:11px" valign="top">' . (empty($Communion['Communion']['nota_marginal'])?'<img width="100%" height="200" src="' . Router::url('/img/diagonal.png') . '">':$Communion['Communion']['nota_marginal']) . '</td></tr>';
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
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '<tr><td colspan="2"></td></tr>';
    $columna1 .= '</table>';

    $columna2 = 'El presbitero <b>' . parent::strtoupper_utf8($presbitero) . '</b>,';
    $columna2 .= ' Cura Párroco encargado de esta Parroquia, certifica que consta en el acta reseñada al margen correspondiente al libro de Communiones:';
    $columna2 .= '<br><br><br><div class="titulo">' . parent::strtoupper_utf8($comulgado) . '</div><br><br>';
    $columna2 .= '<table>';
    $columna2 .= '<tr><td><b>Recibió Sacramento de la Eucaristía el:</b></td><td>' . $fecha_dia . ' DE ' . $fecha_mes . ' DE ' . $fecha_ano . '</td></tr>';
    $columna2 .= '<tr><td><b>Padre:</b></td><td>' . parent::strtoupper_utf8($padre) . '</b></td></tr>';
    $columna2 .= '<tr><td><b>Madre:</b></td><td>' . parent::strtoupper_utf8($madre) . '</b></td></tr>';
    $columna2 .= '<tr><td><b>Ministro:</b></td><td>' . parent::strtoupper_utf8($ministro) . '</b></td></tr>';
    $columna2 .= '<tr><td><b>Catequista:</b></td><td>' . parent::strtoupper_utf8($catequista) . '</b></td></tr>';  
    //$columna2 .= '<tr><td><b>Se pide este certificado para fines: </b></td><td>' . parent::strtoupper_utf8($motivo) . '</b></td></tr>';
    $columna2 .= '</table>';

    $html = '<div class="titulo">CERTIFICADO DE COMUNIÓN</div><br><br>';
    $html .= '<div style="float:left;width:25%;line-height:1.5;border-right:1px solid #666;">' . $columna1 . '</div><div style="float:right;width:70%;text-align:justify;line-height:1.5">' . $columna2 . '</div><div style="clear:both"></div>';
    $html.= '<br><br>PUERTO ORDAZ, ' . $hoy . '<br>';
    $html .= 'Doy Fe.<br><br><div style="text-align:center;"><b>PRESBITERO ' . parent::strtoupper_utf8($presbitero) . '</b><br><br><br><br><br><b>PÁRROCO</b></div>';
    $html .= '<br><br><div style="text-align:center">Si este certificado va a ser usado fuera de la Diócesis debe ser autenticado en la Curia Diocesana</div>';

    $mpdf = new mPDF('BLANK', 'Letter', '11', 'Arial', 10, 10, 35, 5, 3, 3);
    $mpdf->writeHTML('td { width:50%; padding:5px; } #logo { text-align:center } #footer { text-align: center; font-size:12px; border-top: 1px solid #666; padding-top: 5px } .titulo { text-align: center; font-size: 17px; font-weight: bold; }', 1);
    $mpdf->setHTMLHeader('<div id="logo"><img src="' . Router::url('/img/logo.png') . '"></div>');
    $mpdf->setHTMLFooter('<div id="footer">Urbanización Villa Brasil, Final Senda Curitiva. Puerto Ordaz, Estado Bolívar.<br><b>Telf.:</b> (0286) 923.27.85</div>');
    $mpdf->WriteHTML($html, 2);
    $mpdf->Output('Certificado de Comunión de '.ucwords($comulgado), 'I');
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

    $this->set('Communiones', $this->Paginator->paginate('Communion'));
    $this->set('q', $q);
  }

}