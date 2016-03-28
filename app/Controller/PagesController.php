<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');
App::import('Vendor', 'mpdf/mpdf/mpdf');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {
	public $name = 'Pages';
	public $uses = array();

	function beforeFilter() {
		if(!$this->Auth->loggedIn())
			$this->redirect('/usuarios/login');
	}
	
	function display() {
		$this->render('home');
	}

	private function edad($fnac, $fact = null) {
		if(!$fact)
			$fact = time();

		$fnac = strtotime($fnac);
		$edad = date('Y', $fact) - date('Y', $fnac);

		if(date('m', $fact) < date('m', $fnac)) {
			--$edad;
		} elseif((date('m', $fact) == date('m', $fnac)) && (date('d', $fact) < date('d', $fnac))) {
			--$edad;
		}

		return $edad;
	}
	
	function estadisticas($tipo='del', $param1='dia', $param2=null) {
		Configure::write('debug',0);

		$this->autoRender = false;
		$this->response->type('application/pdf');
		$this->loadModel('Configuracion');
		$this->loadModel('Bautizo');
        $this->loadModel('Comunion');
        $this->loadModel('Confirmacion');
		$this->loadModel('Matrimonio');

		if($tipo == 'del') {
			if($param1 == 'dia') {
				$time = time();
				$hoy = date('d', $time) . ' de ' . parent::month2string(date('m',$time)) . ' de ' . date('Y', $time);
				$title = 'Estadística del ' . $hoy;
				$totalbautizos = $this->Bautizo->find('count', array(
					'conditions' => array('Bautizo.fecha' => date('d/m/Y', $time))
				));
				$totalcomuniones = $this->Comunion->find('count', array(
					'conditions' => array('Comunion.fecha' => date('d/m/Y', $time))
				));              
				$totalconfirmaciones = $this->Confirmacion->find('count', array(
					'conditions' => array('Confirmacion.fecha' => date('d/m/Y', $time))
				));
				$totalmatrimonios = $this->Matrimonio->find('count', array(
					'conditions' => array('Matrimonio.fecha' => date('d/m/Y', $time))
				));
			} elseif($param1 == 'mes') {
				$time = time();
				$fecha = parent::month2string(date('m',$time)) . ' de ' . date('Y', $time);
				$title = 'Estadística del mes de ' . $fecha;
				$totalbautizos = $this->Bautizo->find('count', array(
					'conditions' => array('MONTH(STR_TO_DATE(REPLACE(Bautizo.fecha, \'/\', \'.\'), \'%d.%m.%Y\'))' => date('n', $time),
													'YEAR(STR_TO_DATE(REPLACE(Bautizo.fecha, \'/\', \'.\'), \'%d.%m.%Y\'))' => date('Y', $time)
				)));
				$totalcomuniones = $this->Comunion->find('count', array(
					'conditions' => array('MONTH(STR_TO_DATE(REPLACE(Comunion.fecha, \'/\', \'.\'), \'%d.%m.%Y\'))' => date('n', $time),
													'YEAR(STR_TO_DATE(REPLACE(Comunion.fecha, \'/\', \'.\'), \'%d.%m.%Y\'))' => date('Y', $time)
				)));
				$totalconfirmaciones = $this->Confirmacion->find('count', array(
					'conditions' => array('MONTH(STR_TO_DATE(REPLACE(Confirmacion.fecha, \'/\', \'.\'), \'%d.%m.%Y\'))' => date('n', $time),
													'YEAR(STR_TO_DATE(REPLACE(Confirmacion.fecha, \'/\', \'.\'), \'%d.%m.%Y\'))' => date('Y', $time)
				)));
				$totalmatrimonios = $this->Matrimonio->find('count', array(
					'conditions' => array('MONTH(STR_TO_DATE(REPLACE(Matrimonio.fecha, \'/\', \'.\'), \'%d.%m.%Y\'))' => date('n', $time),
													'YEAR(STR_TO_DATE(REPLACE(Matrimonio.fecha, \'/\', \'.\'), \'%d.%m.%Y\'))' => date('Y', $time)
				)));
			} elseif($param1 == 'ano') {
				$time = time();
				$fecha = date('Y', $time);
				$title = 'Estadística del año ' . $fecha;
				$totalbautizos = $this->Bautizo->find('count', array(
					'conditions' => array('YEAR(STR_TO_DATE(REPLACE(Bautizo.fecha, \'/\', \'.\'), \'%d.%m.%Y\'))' => $fecha)
				));
				$totalcomuniones = $this->Comunion->find('count', array(
					'conditions' => array('YEAR(STR_TO_DATE(REPLACE(Comunion.fecha, \'/\', \'.\'), \'%d.%m.%Y\'))' => $fecha)
				));
				$totalconfirmaciones = $this->Confirmacion->find('count', array(
					'conditions' => array('YEAR(STR_TO_DATE(REPLACE(Confirmacion.fecha, \'/\', \'.\'), \'%d.%m.%Y\'))' => $fecha)
				));
				$totalmatrimonios = $this->Matrimonio->find('count', array(
					'conditions' => array('YEAR(STR_TO_DATE(REPLACE(Matrimonio.fecha, \'/\', \'.\'), \'%d.%m.%Y\'))' => $fecha)
				));
			} elseif($param1 == 'todos') {
				$title = 'Estadística de todos los tiempos';
				$totalbautizos = $this->Bautizo->find('count');
                $totalcomuniones = $this->Comunion->find('count');
                $totalconfirmaciones = $this->Confirmacion->find('count');
				$totalmatrimonios = $this->Matrimonio->find('count');
			} else {
				return;
			}
		} elseif($tipo == 'rango') {
			$_param1 = strtotime($param1);
			$_param2 = strtotime($param2);
            
            $db = ConnectionManager::getDataSource('default');
            
            $totalmatrimonios = $db->query("
                SELECT COUNT(*) AS total FROM matrimonios AS Matrimonio WHERE STR_TO_DATE(REPLACE(Matrimonio.fecha, '/', '.'), '%d.%m.%Y') >= STR_TO_DATE(REPLACE('$param1', '-', '.'), '%d.%m.%Y') AND STR_TO_DATE(REPLACE(Matrimonio.fecha, '/', '.'), '%d.%m.%Y') <= STR_TO_DATE(REPLACE('$param2', '-', '.'), '%d.%m.%Y')
            ")[0][0]['total'];
            
            $totalbautizos = $db->query("
                SELECT COUNT(*) AS total FROM bautizos AS Bautizo WHERE STR_TO_DATE(REPLACE(Bautizo.fecha, '/', '.'), '%d.%m.%Y') >= STR_TO_DATE(REPLACE('$param1', '-', '.'), '%d.%m.%Y') AND STR_TO_DATE(REPLACE(Bautizo.fecha, '/', '.'), '%d.%m.%Y') <= STR_TO_DATE(REPLACE('$param2', '-', '.'), '%d.%m.%Y')
            ")[0][0]['total'];
          
            $totalconfirmaciones = $db->query("
                SELECT COUNT(*) AS total FROM confirmaciones AS Confirmacion WHERE STR_TO_DATE(REPLACE(Confirmacion.fecha, '/', '.'), '%d.%m.%Y') >= STR_TO_DATE(REPLACE('$param1', '-', '.'), '%d.%m.%Y') AND STR_TO_DATE(REPLACE(Confirmacion.fecha, '/', '.'), '%d.%m.%Y') <= STR_TO_DATE(REPLACE('$param2', '-', '.'), '%d.%m.%Y')
            ")[0][0]['total'];
          
            $totalcomuniones = $db->query("
                SELECT COUNT(*) AS total FROM comuniones AS Comunion WHERE STR_TO_DATE(REPLACE(Comunion.fecha, '/', '.'), '%d.%m.%Y') >= STR_TO_DATE(REPLACE('$param1', '-', '.'), '%d.%m.%Y') AND STR_TO_DATE(REPLACE(Comunion.fecha, '/', '.'), '%d.%m.%Y') <= STR_TO_DATE(REPLACE('$param2', '-', '.'), '%d.%m.%Y')
            ")[0][0]['total'];

			$diadesde = date('d', $_param1);
			$mesdesde = parent::month2string(date('m', $_param1));
			$anodesde = date('Y', $_param1);

			$diahasta = date('d', $_param2);
			$meshasta = parent::month2string(date('m', $_param2));
			$anohasta = date('Y', $_param2);

			$title = 'Estadística ';

			if($anodesde == $anohasta && $mesdesde == $meshasta && $diadesde == $diahasta) {
				$title .= 'del ' . $diadesde . ' de ' . $mesdesde . ' de ' . $anodesde;
			} elseif($anodesde == $anohasta && $mesdesde == $meshasta) {
				$title .= 'del ' . $diadesde . ' hasta ' . $diahasta . ' de ' . $mesdesde . ' de ' . $anodesde;
			} elseif($anodesde == $anohasta && $mesdesde != $meshasta) {
				$title .= 'del ' .$diadesde . ' de ' . $mesdesde . ' hasta el ' . $diahasta . ' de ' . $meshasta . ' de ' . $anodesde;
			} else {
				$title .= 'del ' .$diadesde . ' de ' . $mesdesde . ' de ' . $anodesde . ' hasta el ' . $diahasta . ' de ' . $meshasta . ' de ' . $anohasta;
			}
		} else {
			return;
		}

		$url = 'http://' . $_SERVER['HTTP_HOST'] . Router::url('/graficos/bautizosedades/' . $tipo . '/' . $param1 . '/' . $param2);
		$url2 = 'http://' . $_SERVER['HTTP_HOST'] . Router::url('/graficos/bautizosgenero/' . $tipo . '/' . $param1 . '/' . $param2);

		$time = time();
		$presbitero = '';

		$config = $this->Configuracion->find('all');

		foreach($config as $e)
			if($e['Configuracion']['parametro'] == 'presbitero') {
				$presbitero = $e['Configuracion']['valor'];
				break;
			}
		$html = '<div class="titulo">' . parent::strtoupper_utf8($title) . '</div><br><br>';
		
		if($totalbautizos)
			$html .= '<p align="center"><img src="'.$url.'"><img src="' . $url2 . '"></p>';
		
		$html .= '<br><table id="sacramentos"><tr><th>Sacramento</th><th>Total</th></tr><tr>
			<td>Bautizos</td>
			<td class="total">'.$totalbautizos.'</td>
		</tr>
			<tr>
			<td>Confirmaciones</td>
			<td class="total">'.$totalconfirmaciones.'</td>
			</tr>
			<tr>
			<td>Comuniones</td>
			<td class="total">'.$totalcomuniones.'</td>
			</tr>
			<tr>
			<td>Matrimonios</td>
			<td class="total">'.$totalmatrimonios.'</td>
			</tr>
		</table><br><br>';
		$html .= 'PUERTO ORDAZ, ' . date('d', $time) . ' DE ' . strtoupper(parent::month2string(date('m', $time))) .' DE ' . date('Y', $time) . '<br>Doy Fe.<br><br><div style="text-align:center;"><b>PRESBITERO ' . parent::strtoupper_utf8($presbitero) . '</b><br><br><br><br><br><b>PÁRROCO</b></div>';
		
		$mpdf = new mPDF('BLANK', 'Letter', '11', 'Arial', 10, 10, 35, 5, 3, 3);
		$mpdf->writeHTML('.total { text-align:center; } #sacramentos tr:nth-child(odd) {background-color: #F2F2EA} #sacramentos th {background-color: #9b59b6;text-align: center;color: #fff;text-shadow: 1px 1px 2px #000;} #sacramentos { width:400px; margin:auto; border-collapse: collapse; } #sacramentos, #sacramentos td, #sacramentos th { border: 1px solid #EBEBE1 }  #sacramentos td, #sacramentos th { padding: 10px; } #logo { text-align:center } #footer { text-align: center; font-size:12px; border-top: 1px solid #666; padding-top: 5px } .titulo { text-align: center; font-size: 17px; font-weight: bold; }', 1);
		$mpdf->setHTMLHeader('<div id="logo"><img src="http://localhost' . Router::url('/img/logo.png') . '"></div>');
		$mpdf->setHTMLFooter('<div id="footer">Urbanización Villa Brasil, Final Senda Curitiva. Puerto Ordaz, Estado Bolívar.<br><b>Telf.:</b> (0286) 923.27.85</div>');
		$mpdf->WriteHTML($html, 2);
		$mpdf->debug=true;
		$mpdf->Output($title, 'I');
	}
}
