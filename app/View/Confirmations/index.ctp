<div class="container">
<?php
echo '<h2>Confirmaciones</h2>';
echo $this->Form->create('ConfirmationParticipant', array(
    'inputDefaults' => array(
        'between' => '<br>',
        'type' => 'text',
        'required' => 'false'
    )
));
?>
    <div class="row">
        <div class="col-sm-6">
            <?php echo $this->Form->input('nombres'); ?>
        </div>
        <div class="col-sm-6">
            <?php echo $this->Form->input('catequista'); ?>
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

if(!count($comuniones)) {
    echo '<center>No hay comuniones registradas.</center>';
} else {
?>
<center>
<?php
if(count($comuniones)) {
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
	    'format' => 'Página {:page} de {:pages}, mostrando {:current} comunion(es) de
	             {:count} totales'
	)).'</b><br><br>';
}
?>
</center>
<div id="tabla-wrapper">
<table class="tabla bigtable">
	<tr>
		<th>Nombres</th>
        <th>Apellidos</th>
		<th>Catequista</th>
		<th>Libro</th>
		<?php
		if ($rol == 'A') {
		?>
        <th width="75">Acción</th>
		<?php } ?>
	</tr>
<?php
foreach($comuniones as $e) {
    
    
    $modalContent1 = "<b>Nro </b>".$e['Confirmation']['numero'];
    $modalContent2 = "<p><b>Nombre </b>".$e['ConfirmationParticipant']['nombres']." ".$e['ConfirmationParticipant']['apellidos']."</p>";
    $modalContent2 .= "<p><b>Padres </b>".$e['ConfirmationParticipant']['padre']." y ".$e['ConfirmationParticipant']['madre']."</p>";
    $modalContent2 .= "<p><b>Realiza su comunión el día </b>".$e['Confirmation']['fecha']."</p>";
    $modalContent2 .= "<p><b>Catequista </b>".$e['Confirmation']['catequista']."</p>";
    $modalContent2 .= "<p><b>Ministro </b>".$e['Confirmation']['ministro']."</p>";
    $modalContent2 .= "<p><b>Padrino </b>".$e['ConfirmationParticipant']['padrino'];
    $modalContent3 = "<br><p><b>Lo que certifico - El párroco</b></p><p>Rafael María Calvo, diác</p>";
    $modalContent3 = "";
    
    /*
    $nombre = preg_replace('/ (.+)$/', '', $e['Bautizo']['nombres']);
    $apellido = preg_replace('/ (.+)$/', '', $e['Bautizo']['apellidos']);*/
?>
	<tr>
        <td><?php echo $e['ConfirmationParticipant']['nombres']; ?></td>
        <td><?php echo $e['ConfirmationParticipant']['apellidos']; ?></td>
        <td><?php echo $e['Confirmation']['catequista']; ?></td>
        <td><?php echo '<b>Libro:</b>'.$e['Confirmation']['libro'].', <b>Numero:</b>'.$e['Confirmation']['numero']; ?></td>
		<td class="actions_buttons">
            <a href="#openModal" onclick="fillModal(' <?php echo  $modalContent1."','".$modalContent2."','".$modalContent3; ?> ');"><i class="fa fa-eye"></i></a>
            &nbsp&nbsp
        <?php
		if($rol == 'A') {
		?>    
        <a href="<?php echo Router::url(array('action' => 'modificar', $e['Confirmation']['id'])); ?>"><i class="fa fa-edit"></i></a>
            &nbsp&nbsp
            <a href="<?php echo Router::url(array('action' => 'eliminar', $e['ConfirmationParticipant']['id'])); ?>" onclick="javascript: return confirm('¿Está seguro que desea eliminar?');" alt="Eliminar"><i class="fa fa-times"></i></a><?php } ?>
            &nbsp&nbsp
            
            <a href="<?php echo Router::url('/Confirmations/certificado/' . $e['ConfirmationParticipant']['id']); ?>" target="_blank"><i class="fa fa-file-o"></i> </a>
        </td>
	</tr>
<?php } ?>
</table>
</div>
<?php } ?>
<br>
<center>
<?php
    if(count($comuniones)) {
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
            'format' => 'Página {:page} de {:pages}, mostrando {:current} comunion(s) de
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