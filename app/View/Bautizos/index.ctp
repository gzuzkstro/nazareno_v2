<div class="container">
<?php
echo '<h2>Bautizos</h2>';
echo $this->Form->create('Bautizo', array(
    'inputDefaults' => array(
        'between' => '<br>',
        'type' => 'text',
        'required' => 'false'
    )
));
?>
    <div class="row">
        <div class="col-sm-4">
            <?php echo $this->Form->input('nombres'); ?>
        </div>
        <div class="col-sm-4">
            <?php echo $this->Form->input('fecha_nacimiento_1', array('label' => 'Fecha de nacimiento(desde)', 'class' => 'date_time_picker')); ?>
        </div>
        <div class="col-sm-4">
            <?php echo $this->Form->input('fecha_nacimiento_2', array('label' => 'Fecha de nacimiento(hasta)', 'class' => 'date_time_picker')); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?php echo $this->Form->input('fecha_1', array('label' => 'Fecha de bautizo(desde)', 'class' => 'date_time_picker')); ?>
        </div>
        <div class="col-sm-3">
            <?php echo $this->Form->input('fecha_2', array('label' => 'Fecha de bautizo(hasta)', 'class' => 'date_time_picker')); ?>
        </div>
        <div class="col-sm-3">
            <?php echo $this->Form->input('folio'); ?>
        </div>
        <div class="col-sm-3">
            <?php echo $this->Form->input('numero'); ?>
        </div>
    </div>
<input type="submit" value="Buscar">
</div>
<?php
//echo $this->element('sql_dump');
echo '<p style="font-size:18px; text-align:center;"><i class="fa fa-eye"></i> = Ver detalles - ';
echo '<i class="fa fa-edit"></i> = Modificar registro - ';
echo '<i class="fa fa-times"></i> = Eliminar registro - ';
echo '<i class="fa fa-file-o"></i> = Generar certificado (pdf)</p>';

if(!count($bautizos)) {
    echo '<center>No hay bautizos registrados.</center>';
} else {
?>
<center>
<?php
if(count($bautizos)) {
    echo'<br><span style="font-size:18px">';
	echo $this->Paginator->first('<i class="fa fa-angle-double-left"></i>', array('escape' => false));
	echo'  ';
    echo $this->Paginator->prev('<i class="fa fa-chevron-left"></i>', array('escape' => false), ' ',array()).' ';
	echo $this->Paginator->numbers(array('before' => ' ', 'after' => ' '));
    echo $this->Paginator->next('<i class="fa fa-chevron-right"></i>', array('escape' => false), ' ',array());
	echo' ';
    echo $this->Paginator->last('<i class="fa fa-angle-double-right"></i>', array('escape' => false));
    echo'</span><br>';

    echo '<br><b>'.$this->Paginator->counter(array(
	    'format' => 'Página {:page} de {:pages}, mostrando {:current} bautizo(s) de
	             {:count} totales'
	)).'</b><br><br>';
}
?>
</center>
<div id="tabla-wrapper">
<table class="tabla bigtable">
	<tr>
		<th>Nombre</th>
		<th>Fecha de Nac.</th>
		<th>Lugar de Nac.</th>
        <th>Fecha de bautizo</th>
		<th>Libro</th>
		<?php
		if ($rol == 'A') {
		?>
		<th width="70">Acción</th>
		<?php } ?>
		<!--
        <th>Observaciones</th>
		<th>Nota</th>
        -->
	</tr>
<?php
foreach($bautizos as $e) {
    
    $modalContent1 = "<b>Nro </b>".$e['Bautizo']['numero'];
    $modalContent1 .= "<br><br><b>Nota marginal</b><br>".$e['Bautizo']['nota_marginal'];
    $modalContent2 = "<p><b>Nombre </b>".$e['Bautizo']['nombres']." ".$e['Bautizo']['apellidos']."</p>";
    $modalContent2 .= "<p><b>Padres </b>".$e['Bautizo']['padre']." y ".$e['Bautizo']['madre']."</p>";
    $modalContent2 .= "<p><b>Nacido en </b>".$e['Bautizo']['ciudad_nacimiento']." , ".$e['Bautizo']['estado_nacimiento']." , "
        .$e['Bautizo']['pais_nacimiento']." <b>el día </b>".$e['Bautizo']['fecha_nacimiento']."</p>";
    $modalContent2 .= "<p><b>Bautizado el día </b>".$e['Bautizo']['fecha']."</p>";
    $modalContent2 .= "<p><b>Padrinos </b>".$e['Bautizo']['padrino']." y ".$e['Bautizo']['madrina']."</p>";
    $modalContent2 .= "<p><b>Ministros </b>".$e['Bautizo']['ministro']." , <b>Observaciones </b>".($e['Bautizo']['observaciones']?$e['Bautizo']['observaciones']:"No tiene observaciones")."</p>";
    $modalContent2 .= "<p><b>Notas </b>".($e['Bautizo']['nota']?$e['Bautizo']['nota']:"No tiene nota")."</p>";
    $modalContent2 .= "<p><b>Registro Civil </b>".$e['Bautizo']['prefectura_numero']." - folio ".$e['Bautizo']['prefectura_folio']
        ." - libro ".$e['Bautizo']['prefectura_libro']." - año ".$e['Bautizo']['prefectura_fecha']."</p>";
    //$modalContent3 = "<br><p><b>Lo que certifico - El párroco</b></p><p>Rafael María Calvo, diác</p>";
    $modalContent3 = "";
    
    
    $nombre = preg_replace('/ (.+)$/', '', $e['Bautizo']['nombres']);
    $apellido = preg_replace('/ (.+)$/', '', $e['Bautizo']['apellidos']);
?>
	<tr>
        <td><?php echo $nombre; ?> <?php echo $apellido; ?></td>
        <td><?php echo $e['Bautizo']['fecha_nacimiento']; ?></td>
        <td><?php echo $e['Bautizo']['ciudad_nacimiento'] == 'Otra' ? $e['Bautizo']['ciudad_nacimiento_otra'] : $e['Bautizo']['ciudad_nacimiento']; ?>, <?php echo $e['Bautizo']['estado_nacimiento']; ?><br><?php echo $e['Bautizo']['pais_nacimiento']; ?></td>
		<td><?php echo $e['Bautizo']['fecha']; ?></td>
		<!-- <td><b><?php echo $e['Bautizo']['padre']; ?></b> y<br><b><?php echo $e['Bautizo']['madre']; ?></b></td> -->
		<!-- <td><b><?php echo $e['Bautizo']['padrino']; ?></b> y<br><b><?php echo $e['Bautizo']['madrina']; ?></b></td>-->
		<!-- <td><?php echo $e['Bautizo']['ministro']; ?></td> -->
		<td><b>Libro: </b><?php echo $e['Bautizo']['libro']; ?>, <b>Folio: </b><?php echo $e['Bautizo']['folio']; ?><br><b>Número: </b><?php echo $e['Bautizo']['numero']; ?></td>
		<td class="actions_buttons">
            <a href="#openModal" onclick="fillModal(' <?php echo  $modalContent1."','".$modalContent2."','".$modalContent3; ?> ');"><i class="fa fa-eye"></i></a>
            &nbsp&nbsp
        <?php
		if($rol == 'A') {
		?>
            <a href="<?php echo Router::url(array('action' => 'modificar', $e['Bautizo']['id'])); ?>"><i class="fa fa-edit"></i></a>
            &nbsp&nbsp
            <a href="<?php echo Router::url(array('action' => 'eliminar', $e['Bautizo']['id'])); ?>" onclick="javascript: return confirm('¿Está seguro que desea eliminar el bautizo de <?php echo $e['Bautizo']['nombres'].' '.$e['Bautizo']['apellidos'];?>?');" alt="Eliminar"><i class="fa fa-times"></i></a><?php } ?>
            &nbsp&nbsp
            <a href="<?php echo Router::url('/bautizos/certificado/' . $e['Bautizo']['id']); ?>" target="_blank"><i class="fa fa-file-o"></i> </a></td>
        <!--
		<td><?php echo empty($e['Bautizo']['observaciones']) ? 'Ninguna' : $e['Bautizo']['observaciones']; ?></td>
		<td><?php echo empty($e['Bautizo']['nota']) ? 'Ninguna' : $e['Bautizo']['nota']; ?></td>
        -->
	</tr>
<?php } ?>
</table>
</div>
<?php } ?>
<br>
<center>
<?php
    if(count($bautizos)) {
        echo'<br><span style="font-size:18px">';
        echo $this->Paginator->first('<i class="fa fa-angle-double-left"></i>', array('escape' => false));
        echo'  ';
        echo $this->Paginator->prev('<i class="fa fa-chevron-left"></i>', array('escape' => false), ' ',array()).' ';
        echo $this->Paginator->numbers(array('before' => ' ', 'after' => ' '));
        echo $this->Paginator->next('<i class="fa fa-chevron-right"></i>', array('escape' => false), ' ',array());
        echo' ';
        echo $this->Paginator->last('<i class="fa fa-angle-double-right"></i>', array('escape' => false));
        echo'</span><br>';

        echo '<br><b>'.$this->Paginator->counter(array(
            'format' => 'Página {:page} de {:pages}, mostrando {:current} bautizo(s) de
                     {:count} totales'
        )).'</b><br><br>';
    }
/*
if(count($bautizos)) {
	echo '<b>'.$this->Paginator->counter(array(
	    'format' => 'Página {:page} de {:pages}, mostrando {:current} bautizo(s) de
	             {:count} totales'
	)).'</b><br><br>';
	echo $this->Paginator->first('<input type="button" value="<<">', array('escape' => false));
	echo $this->Paginator->prev('<input type="button" value="< Anterior">', array('escape' => false), ' ',array()).' ';
	echo $this->Paginator->next('<input type="button" value="Siguiente >">', array('escape' => false), ' ',array());
	echo $this->Paginator->last('<input type="button" value=">>">', array('escape' => false));
}
    <input type="button" value="Nuevo bautizo" onclick="javascript:document.location='<?php echo Router::url('/bautizos/agregar'); ?>';"><br><br>
<?php
echo $this->Paginator->numbers(array('before' => '<b>Ir a la página:</b> '));
*/?>
</center>