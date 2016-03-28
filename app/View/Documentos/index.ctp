<?php
	if($rol == 'A') { 
?>
<h2>Subir documento</h2>
<form name="uploadDocument" id="uploadDocument" enctype="multipart/form-data" action="<?php echo Router::url('/documentos/subir/' . $cat); ?>" method="POST">
    <input type="file" name="documento" id="fdocumento">
</form>
<?php } ?>
<h2>Seleccione la sección</h2>
<select name="cat" id="cat">
    <option value="bautizos"<?php if($cat == 'bautizos') echo 'selected="selected"'; ?>>Bautizos</option>
    <option value="comuniones"<?php if($cat == 'comuniones') echo 'selected="selected"'; ?>>Comuniones</option>
    <option value="confirmaciones"<?php if($cat == 'confirmaciones') echo 'selected="selected"'; ?>>Confirmaciones</option>
    <option value="matrimonios"<?php if($cat == 'matrimonios') echo 'selected="selected"'; ?>>Matrimonios</option>
</select>
<h2>Documentos</h2>

<?php
	if(!count($files)) {
?>
<center>No hay ningún archivo</center>
<?php } else { ?>
Para descargar los documentos debe hacer click en el nombre del mismo.<br><br>
<table class="tabla">
	<tr>
		<th>Documento</th>
		<?php
			if($rol == 'A') {
		?>
		<th>Acción</th>
		<?php } ?>
	</tr>
	<?php
		$i = 1;
		foreach($files as $f) {
	?>
	<tr>
		<td>
			<?php echo '<a href="'.Router::url('/documents/'.$cat.'/'.$f).'" id="ad-'.$i.'" target="_blank">'.$f.'</a>'; ?>
			<?php echo '<input data-cat="' . $cat . '" type="text" class="dname" id="id-'.$i.'" value="'.$f.'">'; ?>
			<span class="loading">Cargando...</span>
		</td>
		<?php
			if($rol == 'A') {
		?>
		<td width="240"><a href="javascript:void(0);" class="rename" data-id="<?php echo $i; ?>"><i class="fa fa-edit"></i> Cambiar nombre</a> / <a href="javascript:void(0);" alt="Eliminar" class="delete" data-cat="<?php echo $cat; ?>"><i class="fa fa-times"></i> Eliminar</a></td>
		<?php } ?>
	</tr>
	<?php ++$i; } ?>
</table>

<?php } ?>