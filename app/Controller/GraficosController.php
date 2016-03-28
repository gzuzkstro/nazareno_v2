<?php
App::import('Vendor', 'jpgraph/jpgraph/lib/JpGraph/src/jpgraph');
App::import('Vendor', 'jpgraph/jpgraph/lib/JpGraph/src/jpgraph_pie');

class GraficosController extends AppController {
	public $uses = array();

	function bautizosEdades($tipo='del', $param1='dia', $param2=null) {
        Configure::write('debug',0);
        
        $this->autoRender = false;
        $this->response->type('image/png');
        
        $this->loadModel('Bautizo');
        
        $fechas = $this->Bautizo->find('all');
        
        $hoy = time();
        $unanyo = 31536000;
        $sieteanyos = 220752000;
        
        $hasta = $entre = $mayor = 0;
        
        foreach($fechas as $e) {
            $fechabautizo = strtotime(str_replace('/', '-', $e['Bautizo']['fecha']));
            
            if($tipo == 'del') {
                if($param1 == 'dia') {
                    if(date('d/m/Y', time()) != date('d/m/Y', $fechabautizo))
                        continue;
                } elseif($param1 == 'mes') {
                    if(date('m/Y', time()) != date('m/Y', $fechabautizo))
                        continue;
                } elseif($param1 == 'ano') {
                    if(date('Y', time()) != date('Y', $fechabautizo))
                        continue;
                } elseif($param1 == 'todos') {
                       
                } else {
                    break;   
                }
            } elseif($tipo == 'rango') {
                $param1 = strtotime($param1);
                $param2 = strtotime($param2);
                if($fechabautizo < $param1 || $fechabautizo > $param2)
                    continue;
            } else {
                break;   
            }
            
            $timestamp = strtotime(str_replace('/', '-', $e['Bautizo']['fecha_nacimiento']));
            $bautizo_timestamp = strtotime(str_replace('/', '-', $e['Bautizo']['fecha']));
            $edad = $bautizo_timestamp - $timestamp;
            
            if($edad < $unanyo)
                ++$hasta;
            elseif($edad >= $unanyo && $edad <= $sieteanyos)
                ++$entre;
            elseif($edad > $sieteanyos)
                ++$mayor;
        }

		$data = array($hasta,$entre,$mayor);

		$legends = array('Hasta 1 año (' . $hasta . ')','De 1 a 7 años (' . $entre . ')','Mayores de 7 años (' . $mayor . ')'); 
		 
		$graph = new PieGraph(300,300);
		$graph->SetShadow();
		$graph->title->Set('Cantidad de bautizos por edades');
        $graph->legend->SetLayout(LEGEND_VERT);
		 
		$p1 = new PiePlot($data);
		

		$p1->SetLegends($legends); 
		$p1->SetLabels(array());
		$graph->Add($p1);
        $p1->SetSliceColors(array('#3498db', '#9b59b6', '#2ecc71'));
        $p1->value->SetColor('white');
		$graph->Stroke();
	}

	function bautizosGenero($tipo='del', $param1='dia', $param2=null) {
        Configure::write('debug',0);
        
        $this->autoRender = false;
        $this->response->type('image/png');
        
		$this->loadModel('Bautizo');
        
        if($tipo == 'del') {
            if($param1 == 'dia') {
                $condition = date('d/m/Y', time());
            } elseif($param1 == 'mes') {
                $condition = '%/' . date('m/Y', time());
            } elseif($param1 == 'ano') {
                $condition = '%/%/' . date('Y', time());
            } elseif($param1 == 'todos') {
                $condition = '%';
            } else {
                return;
            }
            
            $cantidad_m = $this->Bautizo->find('count', array('conditions' => array('Bautizo.sexo' => 'M', 'Bautizo.fecha LIKE' => $condition)));
            $cantidad_f = $this->Bautizo->find('count', array('conditions' => array('Bautizo.sexo' => 'F', 'Bautizo.fecha LIKE' => $condition)));
        } elseif($tipo == 'rango') { 
            $param1 = date('Y-m-d',strtotime($param1));
            $param2 = date('Y-m-d',strtotime($param2));
            $cantidad_m = $this->Bautizo->find('count', array('conditions' => array('Bautizo.sexo' => 'M', 'STR_TO_DATE(REPLACE(Bautizo.fecha, \'/\', \'.\'), \'%d.%m.%Y\') >=' => $param1, 'STR_TO_DATE(REPLACE(Bautizo.fecha, \'/\', \'.\'), \'%d.%m.%Y\') <=' => $param2)));
            $cantidad_f = $this->Bautizo->find('count', array('conditions' => array('Bautizo.sexo' => 'F', 'STR_TO_DATE(REPLACE(Bautizo.fecha, \'/\', \'.\'), \'%d.%m.%Y\') >=' => $param1, 'STR_TO_DATE(REPLACE(Bautizo.fecha, \'/\', \'.\'), \'%d.%m.%Y\') <=' => $param2)));
        } else {
            return;
        }
        
		$data = array($cantidad_m, $cantidad_f);
		$legends = array('Masculino ('.$cantidad_m.')', 'Femenino ('.$cantidad_f.')'); 
		 
		$graph = new PieGraph(300,300);
		$graph->SetShadow();
		$graph->title->Set('Cantidad de bautizos por género');
        $graph->legend->SetLayout(LEGEND_VERT);
		 
		$p1 = new PiePlot($data);

		$p1->SetLegends($legends); 
		$p1->SetLabels(array());
		$graph->Add($p1);
        $p1->SetSliceColors(array('#3498db', '#9b59b6'));
        $p1->value->SetColor('white');
		$graph->Stroke();
	}
    
    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('bautizosedades');
        $this->Auth->allow('bautizosgenero');
    }
}
?>