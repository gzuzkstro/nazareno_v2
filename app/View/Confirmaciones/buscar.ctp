<h2>Confirmaciones</h2>

<b>Resultado de búsqueda para: </b><?php echo $q; ?><br><br>
<?php
if(!count($confirmaciones)) {
    echo '<center>No se encontraron bautizos.</center>';
} else {
?>
<div id="tabla-wrapper">
<table class="tabla bigtable">
	<tr>
		<th>Fecha</th>
		<th width="100">Nombre</th>
		<th>Padres</th>
		<th>Padrino / Madrina</th>
		<th>Ministro celebrante</th>
		<th width="80">Lote</th>
		<?php
		if ($rol == 'A') {
		?>
		<th width="70">Acción</th>
		<?php } ?>
		<th width="70">Certificado</th>
		<th>Observaciones</th>
		<th>Nota</th>
	</tr>
<?php
foreach($confirmaciones as $e) {
    $nombre = preg_replace('/ (.+)$/', '', $e['Confirmacion']['nombres']);
    $apellido = preg_replace('/ (.+)$/', '', $e['Confirmacion']['apellidos']);
?>
	<tr>
		<td><?php echo $e['Confirmacion']['fecha']; ?></td>
		<td><?php echo $nombre; ?> <?php echo $apellido; ?></td>
		<td><b><?php echo $e['Confirmacion']['padre']; ?></b> y<br><b><?php echo $e['Confirmacion']['madre']; ?></b></td>
		<td><?php echo $e['Confirmacion']['padrino']; ?></td>
		<td><?php echo $e['Confirmacion']['ministro']; ?></td>
		<td><b>Lote: </b><?php echo $e['Confirmacion']['lote']; ?><br><b>Número: </b><?php echo $e['Confirmacion']['numero']; ?></td>
		<?php
		if($rol == 'A') {
		?>
		<td><a href="<?php echo Router::url(array('action' => 'modificar', $e['Confirmacion']['id'])); ?>"><i class="fa fa-edit"></i> Modificar</a><br><a href="<?php echo Router::url(array('action' => 'eliminar', $e['Confirmacion']['id'])); ?>" onclick="javascript: return confirm('¿Está seguro que desea eliminar el confirmacion de <?php echo $e['Confirmacion']['nombres'].' '.$e['Confirmacion']['apellidos'];?>?');" alt="Eliminar"><i class="fa fa-times"></i> Eliminar</a></td>
		<?php } ?>
		<td><a href="<?php echo Router::url('/confirmaciones/certificado/' . $e['Confirmacion']['id']); ?>" target="_blank">Generar<br>certificado</a></td>
		<td><?php echo empty($e['Confirmacion']['observaciones']) ? 'Ninguna' : $e['Confirmacion']['observaciones']; ?></td>
		<td><?php echo empty($e['Confirmacion']['nota']) ? 'Ninguna' : $e['Confirmacion']['nota']; ?></td>
	</tr>
<?php } ?>
</table>
</div>
<?php } ?>
<br>
<center>
<?php
if(count($confirmaciones)) {
	echo '<b>'.$this->Paginator->counter(array(
	    'format' => 'Página {:page} de {:pages}, mostrando {:current} confirmacion(es) de
	             {:count} totales'
	)).'</b><br><br>';
	echo $this->Paginator->first('<input type="button" value="<<">', array('escape' => false));
	echo $this->Paginator->prev('<input type="button" value="< Anterior">', array('escape' => false), ' ',array()).' ';
	echo $this->Paginator->next('<input type="button" value="Siguiente >">', array('escape' => false), ' ',array());
	echo $this->Paginator->last('<input type="button" value=">>">', array('escape' => false));
}
?>
    <input type="button" value="Nueva confirmación" onclick="javascript:document.location='<?php echo Router::url('/confirmaciones/agregar'); ?>';"><br><br>
<?php
echo $this->Paginator->numbers(array('before' => '<b>Ir a la página:</b> '));
?>
</center>