<h2>Matrimonios</h2>
<?php
if (!count($matrimonios)) {
    echo '<center>No hay matrimonios registrados.</center>';
} else {
?>
<div id="tabla-wrapper">
<table class="tabla bigtable">
    <tr>
        <th>Fecha</th>
        <th>Nombre del novio</th>
        <th>Cédula del novio</th>
        <th>Nombre de la novia</th>
        <th>Cédula de la novia</th>
        <?php
        if($rol == 'A') {
        ?>
        <th>Acción</th>
        <?php } ?>
		<th>Certificado</th>
		<th>Expediente</th>
    </tr>
    <?php
        foreach($matrimonios as $e) {
    ?>
    <tr>
        <td><?php echo $e['Matrimonio']['fecha']; ?></td>
        <td><?php echo $e['Matrimonio']['nombres_novio']; ?> <?php echo $e['Matrimonio']['apellidos_novio']; ?></td>
        <td><?php echo $e['Matrimonio']['cedula_novio']; ?></td>
        <td><?php echo $e['Matrimonio']['nombres_novia']; ?> <?php echo $e['Matrimonio']['apellidos_novia']; ?></td>
        <td><?php echo $e['Matrimonio']['cedula_novia']; ?></td>
		<?php
		if($rol == 'A') {
		?>
		<td><a href="<?php echo Router::url(array('action' => 'modificar', $e['Matrimonio']['id'])); ?>"><i class="fa fa-edit"></i> Modificar</a><br><a href="<?php echo Router::url(array('action' => 'eliminar', $e['Matrimonio']['id'])); ?>" onclick="javascript: return confirm('¿Está seguro que desea eliminar el matriominio de <?php echo $e['Matrimonio']['nombres_novio'].' '.$e['Matrimonio']['apellidos_novio'];?> y <?php echo $e['Matrimonio']['nombres_novia'].' '.$e['Matrimonio']['apellidos_novia'];?>?');" alt="Eliminar"><i class="fa fa-times"></i> Eliminar</a></td>
		<?php } ?>
		<td><a href="javascript:void();" data-id="<?php echo $e['Matrimonio']['id']; ?>" class="certificado">Generar<br>certificado</a></td>
		<td><a href="<?php echo Router::url('/matrimonios/expediente/' . $e['Matrimonio']['id']); ?>" target="_blank">Generar<br>expediente</a></td>
    </tr>
    <?php } ?>
</table>
</div>
<?php } ?>
<br>
<center>
<?php
if(count($matrimonios)) {
	echo '<b>'.$this->Paginator->counter(array(
	    'format' => 'Página {:page} de {:pages}, mostrando {:current} matrimonio(s) de
	             {:count} totales'
	)).'</b><br><br>';
	echo $this->Paginator->first('<input type="button" value="<<">', array('escape' => false));
	echo $this->Paginator->prev('<input type="button" value="< Anterior">', array('escape' => false), ' ',array()).' ';
	echo $this->Paginator->next('<input type="button" value="Siguiente >">', array('escape' => false), ' ',array());
	echo $this->Paginator->last('<input type="button" value=">>">', array('escape' => false));
}
?>
    <input type="button" value="Nuevo matrimonio" onclick="javascript:document.location = '<?php echo Router::url('/matrimonios/agregar'); ?>';"><br><br>
<?php
echo $this->Paginator->numbers(array('before' => '<b>Ir a la página:</b> '));
?>
</center>