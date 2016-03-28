<h2>Configuración del sistema</h2>
<?php
	echo $this->Form->create('Configuracion');
	$i = 0;
	echo '<table class="tabla">';
	echo '<tr><th width="50%">Parámetro</th><th>Valor</th></tr>';
	foreach($params as $p) {
		echo '<tr>';
		echo '<td>'.$p['Configuracion']['parametro'].'</td>';
		echo '<td>'.$this->Form->input($i.'.Configuracion.valor', array('label' => '', 'value' => $p['Configuracion']['valor'], 'style' => 'width: 400px')).$this->FOrm->input($i++.'.Configuracion.id', array('type' => 'hidden', 'value' => $p['Configuracion']['id'])).'</td>';
		echo '</tr>';
	}
	echo '</table><br>';
	echo '<center>'.$this->Form->end('Guardar').'</center>';
?>