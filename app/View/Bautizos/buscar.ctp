<h2>Bautizos</h2>

<b>Resultado de búsqueda para: </b><?php echo $q; ?><br><br>
<?php
if(!count($bautizos)) {
    echo '<center>No se encontraron bautizos.</center>';
} else {
?>
<div id="tabla-wrapper">
<table class="tabla bigtable">
	<tr>
		<th>Fecha de bautizo</th>
		<th width="100">Nombre</th>
		<th>Fecha de Nac.</th>
		<th width="90">Lugar de Nac.</th>
		<th>Padres</th>
		<th>Padrinos</th>
		<th>Ministro celebrante</th>
		<th width="80">Libro</th>
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
foreach($bautizos as $e) {
    $nombre = preg_replace('/ (.+)$/', '', $e['Bautizo']['nombres']);
    $apellido = preg_replace('/ (.+)$/', '', $e['Bautizo']['apellidos']);
?>
	<tr>
		<td><?php echo $e['Bautizo']['fecha']; ?></td>
		<td><?php echo $nombre; ?> <?php echo $apellido; ?></td>
		<td><?php echo $e['Bautizo']['fecha_nacimiento']; ?></td>
		<td><?php echo $e['Bautizo']['ciudad_nacimiento'] == 'Otra' ? $e['Bautizo']['ciudad_nacimiento_otra'] : $e['Bautizo']['ciudad_nacimiento']; ?><br><?php echo $e['Bautizo']['estado_nacimiento']; ?><br><?php echo $e['Bautizo']['pais_nacimiento']; ?></td>
		<td><b><?php echo $e['Bautizo']['padre']; ?></b> y<br><b><?php echo $e['Bautizo']['madre']; ?></b></td>
		<td><b><?php echo $e['Bautizo']['padrino']; ?></b> y<br><b><?php echo $e['Bautizo']['madrina']; ?></b></td>
		<td><?php echo $e['Bautizo']['ministro']; ?></td>
		<td><b>Libro: </b><?php echo $e['Bautizo']['libro']; ?><br><b>Folio: </b><?php echo $e['Bautizo']['folio']; ?><br><b>Número: </b><?php echo $e['Bautizo']['numero']; ?></td>
		<?php
		if($rol == 'A') {
		?>
		<td><a href="<?php echo Router::url(array('action' => 'modificar', $e['Bautizo']['id'])); ?>"><i class="fa fa-edit"></i> Modificar</a><br><a href="<?php echo Router::url(array('action' => 'eliminar', $e['Bautizo']['id'])); ?>" onclick="javascript: return confirm('¿Está seguro que desea eliminar el bautizo de <?php echo $e['Bautizo']['nombres'].' '.$e['Bautizo']['apellidos'];?>?');" alt="Eliminar"><i class="fa fa-times"></i> Eliminar</a></td>
		<?php } ?>
		<td><a href="<?php echo Router::url('/bautizos/certificado/' . $e['Bautizo']['id']); ?>" target="_blank">Generar<br>certificado</a></td>
		<td><?php echo empty($e['Bautizo']['observaciones']) ? 'Ninguna' : $e['Bautizo']['observaciones']; ?></td>
		<td><?php echo empty($e['Bautizo']['nota']) ? 'Ninguna' : $e['Bautizo']['nota']; ?></td>
	</tr>
<?php } ?>
</table>
</div>
<?php } ?>
<br>
<center>
<?php
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
?>
    <input type="button" value="Nuevo bautizo" onclick="javascript:document.location='<?php echo Router::url('/bautizos/agregar'); ?>';"><br><br>
<?php
echo $this->Paginator->numbers(array('before' => '<b>Ir a la página:</b> '));
?>
</center>