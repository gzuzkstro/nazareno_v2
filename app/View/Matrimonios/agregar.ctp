<h2>Nuevo matrimonio</h2>
<?php
echo $this->Form->create('Matrimonio', array(
    'inputDefaults' => array(
        'between' => '<br>',
        'type' => 'text'
    )
));
?>

<table class="tform">
    <tr>
        <td colspan="2"><h3>Datos del matrimonio</h3></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('fecha', array('label' => 'Fecha del matrimonio', 'id' => 'datetimepicker3')); ?></td>
        <td><?php echo $this->Form->input('ministro', array('label' => 'Ministro')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('fecha_declaracion', array('label' => 'Fecha de la declaración jurada', 'class' => 'datetimepicker4')); ?></td>
        <td><?php echo $this->Form->input('fecha_fijacion', array('label' => 'Fecha de fijación', 'class' => 'datetimepicker5')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('padrino_cedula', array('label' => 'Cédula del padrino')); ?></td>
        <td><?php echo $this->Form->input('padrino_nombre', array('label' => 'Nombre del padrino')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('madrina_cedula', array('label' => 'Cédula de la madrina')); ?></td>
        <td><?php echo $this->Form->input('madrina_nombre', array('label' => 'Nombre de la madrina')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('fecha_proclamas', array('label' => 'Fecha de proclamas')); ?></td>
		<td><?php echo $this->Form->input('parroquia_proclamas', array('label' => 'Certificado de proclamas de la Parroquia de')); ?></td>
    </tr>
	<tr>
    	<td><?php echo $this->Form->input('fecha_constancia_curso_prematrimonial', array('label' => 'Constancia de Curso Prematrimonial de fecha')); ?></td>
    	<td><?php echo $this->Form->input('certificado_matrimonio_civil', array('label' => 'Certificado del Matrimonio Civil')); ?></td>
	</tr>
	<tr>
    	<td><?php echo $this->Form->input('documentos_curia', array('label' => 'Documentos de la Curia Parroquia')); ?></td>
		<td><?php echo $this->Form->input('libro'); ?></td>
	</tr>
	<tr>
    	<td><?php echo $this->Form->input('folio'); ?></td>
		<td><?php echo $this->Form->input('numero', array('label' => 'Número')); ?></td>
	</tr>
	<tr>
        <td colspan="2"><?php echo $this->Form->input('observaciones', array('type' => 'textarea', 'label' => 'Nota marginal', 'style' => 'width:100%')); ?></td>
	</tr>
    <tr>
        <td colspan="2"><h3>Datos del novio</h3></td>
    </tr>
    <tr>
        <td colspan="2"><h4>Información personal</h4></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('nombres_novio', array('label' => 'Nombres')); ?></td>
        <td><?php echo $this->Form->input('apellidos_novio', array('label' => 'Apellidos')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('cedula_novio', array('label' => 'Cédula')); ?></td>
        <td><?php echo $this->Form->input('estado_civil_novio', array('label' => 'Estado civil', 'type' => 'select', 'options' => array('Soltero' => 'Soltero', 'Divorciado' => 'Divorciado', 'Viudo' => 'Viudo'))); ?></td>
    </tr>
    <tr>
        <td colspan="2"><h4>Información de bautizo</h4></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('bautizo_libro_novio', array('label' => 'Libro')); ?></td>
        <td><?php echo $this->Form->input('bautizo_folio_novio', array('label' => 'Folio')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('bautizo_numero_novio', array('label' => 'Número')); ?></td>
        <td><?php echo $this->Form->input('bautizo_parroquia_novio', array('label' => 'Parroquia')); ?></td>
    </tr>
    <tr>
        <td colspan="2"><h4>Información de nacimiento</h4></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('padre_novio', array('label' => 'Nombre completo del padre')); ?></td>
        <td><?php echo $this->Form->input('madre_novio', array('label' => 'Nombre completo de la madre')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('fecha_nacimiento_novio', array('label' => 'Fecha de nacimiento', 'type' => 'text', 'id' => 'datetimepicker')); ?></td>
        <td><?php echo $this->Form->input('pais_nacimiento_novio', array('label' => 'País de nacimiento', 'type' => 'select', 'options' => $paises, 'selected' => $pais_selected)); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('estado_nacimiento_novio', array('label' => 'Estado de nacimiento', 'type' => 'select', 'options' => $estados, 'selected' => $estado_selected)); ?><?php echo $this->Form->input('estado_nacimiento_novio_2', array('label' => 'Estado de nacimiento')); ?></td>
        <td><?php echo $this->Form->input('ciudad_nacimiento_novio', array('label' => 'Ciudad de nacimiento', 'type' => 'select', 'options' => $ciudades, 'selected' => $ciudad_selected)); ?><?php echo $this->Form->input('ciudad_nacimiento_novio_2', array('label' => 'Ciudad de nacimiento')); ?><div id="loading">Cargando ciudades...</div></td>
    </tr>
    <tr>
        <td colspan="2"><h4>Información de ubicación actual</h4></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('pais_actual_novio', array('label' => 'País actual', 'type' => 'select', 'options' => $paises, 'selected' => $pais_actual_selected)); ?></td>
        <td><?php echo $this->Form->input('estado_actual_novio', array('label' => 'Estado actual', 'type' => 'select', 'options' => $estados, 'selected' => $estado_actual_selected)); ?><?php echo $this->Form->input('estado_actual_novio_2', array('label' => 'Estado actual')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('ciudad_actual_novio', array('label' => 'Ciudad actual', 'type' => 'select', 'options' => $ciudades_actual, 'selected' => $ciudad_actual_selected)); ?><?php echo $this->Form->input('ciudad_actual_novio_2', array('label' => 'Ciudad actual')); ?><div id="loading_actual">Cargando ciudades...</div></td>
        <td><?php echo $this->Form->input('telefono_novio', array('label' => 'Teléfono')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('direccion_novio', array('label' => 'Dirección')); ?></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2"><h4>Información de testigo</h4></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('cedula_testigo_novio', array('label' => 'Cédula')); ?></td>
        <td><?php echo $this->Form->input('nombre_testigo_novio', array('label' => 'Nombre')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('direccion_testigo_novio', array('label' => 'Dirección')); ?></td>
        <td><?php echo $this->Form->input('tnovio_testigo_novio', array('label' => 'Tiempo que conoce al novio (años)')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('tnovia_testigo_novio', array('label' => 'Tiempo que conoce a la novia (años)')); ?></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2"><h3>Datos de la novia</h3></td>
    </tr>
    <tr>
        <td colspan="2"><h4>Información personal</h4></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('nombres_novia', array('label' => 'Nombres')); ?></td>
        <td><?php echo $this->Form->input('apellidos_novia', array('label' => 'Apellidos')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('cedula_novia', array('label' => 'Cédula')); ?></td>
        <td><?php echo $this->Form->input('estado_civil_novia', array('label' => 'Estado civil', 'type' => 'select', 'options' => array('Soltero' => 'Soltero', 'Divorciado' => 'Divorciado', 'Viudo' => 'Viudo'))); ?></td>
    </tr>
    <tr>
        <td colspan="2"><h4>Información de bautizo</h4></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('bautizo_libro_novia', array('label' => 'Libro')); ?></td>
        <td><?php echo $this->Form->input('bautizo_folio_novia', array('label' => 'Folio')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('bautizo_numero_novia', array('label' => 'Número')); ?></td>
        <td><?php echo $this->Form->input('bautizo_parroquia_novia', array('label' => 'Parroquia')); ?></td>
    </tr>
    <tr>
        <td colspan="2"><h4>Información de nacimiento</h4></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('padre_novia', array('label' => 'Nombre completo del padre')); ?></td>
        <td><?php echo $this->Form->input('madre_novia', array('label' => 'Nombre completo de la madre')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('fecha_nacimiento_novia', array('label' => 'Fecha de nacimiento', 'type' => 'text', 'id' => 'datetimepicker2')); ?></td>
        <td><?php echo $this->Form->input('pais_nacimiento_novia', array('label' => 'País de nacimiento', 'type' => 'select', 'options' => $paises, 'selected' => $pais_selected_novia)); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('estado_nacimiento_novia', array('label' => 'Estado de nacimiento', 'type' => 'select', 'options' => $estados, 'selected' => $estado_selected_novia)); ?><?php echo $this->Form->input('estado_nacimiento_novia_2', array('label' => 'Estado de nacimiento')); ?></td>
        <td><?php echo $this->Form->input('ciudad_nacimiento_novia', array('label' => 'Ciudad de nacimiento', 'type' => 'select', 'options' => $ciudades_novia, 'selected' => $ciudad_selected_novia)); ?><?php echo $this->Form->input('ciudad_nacimiento_novia_2', array('label' => 'Ciudad de nacimiento')); ?><div id="loading_novia">Cargando ciudades...</div></td>
    </tr>
    <tr>
        <td colspan="2"><h4>Información de ubicación actual</h4></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('pais_actual_novia', array('label' => 'País actual', 'type' => 'select', 'options' => $paises, 'selected' => $pais_actual_selected_novia)); ?></td>
        <td><?php echo $this->Form->input('estado_actual_novia', array('label' => 'Estado actual', 'type' => 'select', 'options' => $estados, 'selected' => $estado_actual_selected_novia)); ?><?php echo $this->Form->input('estado_actual_novia_2', array('label' => 'Estado actual')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('ciudad_actual_novia', array('label' => 'Ciudad actual', 'type' => 'select', 'options' => $ciudades_actual_novia, 'selected' => $ciudad_actual_selected_novia)); ?><?php echo $this->Form->input('ciudad_actual_novia_2', array('label' => 'Ciudad actual')); ?><div id="loading_actual_novia">Cargando ciudades...</div></td>
        <td><?php echo $this->Form->input('telefono_novia', array('label' => 'Teléfono')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('direccion_novia', array('label' => 'Dirección')); ?></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2"><h4>Información de testigo</h4></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('cedula_testigo_novia', array('label' => 'Cédula')); ?></td>
        <td><?php echo $this->Form->input('nombre_testigo_novia', array('label' => 'Nombre')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('direccion_testigo_novia', array('label' => 'Dirección')); ?></td>
        <td><?php echo $this->Form->input('tnovia_testigo_novia', array('label' => 'Tiempo que conoce a la novia (años)')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('tnovio_testigo_novia', array('label' => 'Tiempo que conoce al novio (años)')); ?></td>
        <td></td>
    </tr>
</table>
<?php
if ($this->action == 'modificar') {
    $submit = 'Guardar';
} else {
    $submit = 'Agregar';
}
?>
<br>
<center><input type="button" value="Cancelar" class="cancel" data-location="<?php echo Router::url('/matrimonios'); ?>"><input type="submit" value="<?php echo $submit; ?>"></center>
</form>