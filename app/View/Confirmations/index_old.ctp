<?php
echo '<h2>Comuniones</h2>';
if(!count($comuniones)) {
    echo '<center>No hay comuniones registradas.</center>';
} else {
?>
<div id="tabla-wrapper">
<table class="tabla bigtable">
	<tr>
		<th>Fecha</th>
		<th width="100">Nombre</th>
		<th>Padres</th>
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
foreach($comuniones as $e) {
    $nombre = preg_replace('/ (.+)$/', '', $e['Comunion']['nombres']);
    $apellido = preg_replace('/ (.+)$/', '', $e['Comunion']['apellidos']);
?>
	<tr>
		<td><?php echo $e['Comunion']['fecha']; ?></td>
		<td><?php echo $nombre; ?> <?php echo $apellido; ?></td>
		<td><b><?php echo $e['Comunion']['padre']; ?></b> y<br><b><?php echo $e['Comunion']['madre']; ?></b></td>
		<td><?php echo $e['Comunion']['ministro']; ?></td>
		<td><b>Libro: </b><?php echo $e['Comunion']['libro']; ?><br><b>Folio: </b><?php echo $e['Comunion']['folio']; ?><br><b>Número: </b><?php echo $e['Comunion']['numero']; ?></td>
		<?php
		if($rol == 'A') {
		?>
		<td><a href="<?php echo Router::url(array('action' => 'modificar', $e['Comunion']['id'])); ?>"><i class="fa fa-edit"></i> Modificar</a><br><a href="<?php echo Router::url(array('action' => 'eliminar', $e['Comunion']['id'])); ?>" onclick="javascript: return confirm('¿Está seguro que desea eliminar la comunión de <?php echo $e['Comunion']['nombres'].' '.$e['Comunion']['apellidos'];?>?');" alt="Eliminar"><i class="fa fa-times"></i> Eliminar</a></td>
		<?php } ?>
		<td><a href="javascript:void();" data-id="<?php echo $e['Comunion']['id']; ?>" class="certificado">Generar<br>certificado</a></td>
		<td><?php echo empty($e['Comunion']['observaciones']) ? 'Ninguna' : $e['Comunion']['observaciones']; ?></td>
		<td><?php echo empty($e['Comunion']['nota']) ? 'Ninguna' : $e['Comunion']['nota']; ?></td>
	</tr>
<?php } ?>
</table>
</div>
<?php } ?>
<br>
<center>
<?php
if(count($comuniones)) {
	echo '<b>'.$this->Paginator->counter(array(
	    'format' => 'Página {:page} de {:pages}, mostrando {:current} comunion(es) de
	             {:count} totales'
	)).'</b><br><br>';
	echo $this->Paginator->first('<input type="button" value="<<">', array('escape' => false));
	echo $this->Paginator->prev('<input type="button" value="< Anterior">', array('escape' => false), ' ',array()).' ';
	echo $this->Paginator->next('<input type="button" value="Siguiente >">', array('escape' => false), ' ',array());
	echo $this->Paginator->last('<input type="button" value=">>">', array('escape' => false));
}
?>
    <input type="button" value="Nueva comunión" onclick="javascript:document.location='<?php echo Router::url('/comuniones/agregar'); ?>';"><br><br>
<?php
echo $this->Paginator->numbers(array('before' => '<b>Ir a la página:</b> '));
?>
</center>