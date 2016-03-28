<h2>Nuevo bautizo</h2>
<?php
echo $this->Form->create('Bautizo', array(
    'inputDefaults' => array(
        'between' => '<br>',
        'type' => 'text'
    )
));
?>
<table class="tform">
    <tr>
        <td colspan="2"><h3>Datos personales</h3></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('nombres'); ?></td>
        <td><?php echo $this->Form->input('apellidos'); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('sexo', array('type' => 'radio', 'options' => array('M' => 'Masculino', 'F' => 'Femenino'), 'value' => $sexo_selected)); ?></td>
        <td><?php echo $this->Form->input('fecha_nacimiento', array('label' => 'Fecha de nacimiento', 'id' => 'datetimepicker1')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('pais_nacimiento', array('label' => 'País de nacimiento', 'type' => 'select', 'options' => $paises, 'selected' => $pais_selected)); ?></td>
        <td><?php echo $this->Form->input('estado_nacimiento', array('label' => 'Estado de nacimiento', 'type' => 'select', 'options' => $estados, 'selected' => $estado_selected)); ?><?php echo $this->Form->input('estado_nacimiento_2', array('label' => 'Estado de nacimiento')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('ciudad_nacimiento', array('label' => 'Ciudad de nacimiento', 'type' => 'select', 'options' => $ciudades, 'selected' => $ciudad_selected)); ?><?php echo $this->Form->input('ciudad_nacimiento_2', array('label' => 'Ciudad de nacimiento')); ?><?php echo $this->Form->input('ciudad_nacimiento_otra', array('label' => 'Especifíque...')); ?><div id="loading">Cargando ciudades...</div></td>
        <td><?php echo $this->Form->input('padre'); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('madre'); ?></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2"><h3>Datos del bautizo</h3></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('libro'); ?></td>
        <td><?php echo $this->Form->input('folio'); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('numero', array('label' => 'Número')); ?></td>
        <td><?php echo $this->Form->input('fecha', array('id' => 'datetimepicker2')); ?></td>
    </tr>
    <tr>
      <td><?php echo $this->Form->input('padrino'); ?></td>
      <td><?php echo $this->Form->input('madrina'); ?></td>
    </tr>
    <tr>
      <td><?php echo $this->Form->input('ministro', array('label' => 'Ministro celebrante')); ?></td>
      <td></td>
    </tr>
    <tr>
      <td colspan="2"><h3>Datos de la prefectura</h3></td>
    </tr>
    <tr>
      <td><?php echo $this->Form->input('prefectura_fecha', array('label' => 'Fecha')); ?></td>
        <td><?php echo $this->Form->input('prefectura_numero', array('label' => 'Número')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('prefectura_folio', array('label' => 'Folio')); ?></td>
        <td><?php echo $this->Form->input('prefectura_libro', array('label' => 'Libro')); ?></td>
    </tr>
    <tr>
      <td colspan="2"><h3>Notas y observaciones</h3></td>
    </tr>
    <tr>
      <td colspan="2"><?php echo $this->Form->input('nota_marginal', array('type' => 'textarea', 'style' => 'width:100%')); ?></td>
    </tr>
    <tr>
      <td colspan="2"><?php echo $this->Form->input('observaciones', array('type' => 'textarea', 'style' => 'width:100%')); ?></td>
    </tr>
    <tr>
      <td colspan="2"><?php echo $this->Form->input('nota', array('type' => 'textarea', 'style' => 'width:100%')); ?></td>
    </tr>
</table><br>
    <?php
    if ($this->action == 'modificar') {
        $submit = 'Guardar';
    } else {
        $submit = 'Agregar';
    }
    ?>
    <center><input type="button" value="Cancelar" class="cancel" data-location="<?php echo Router::url('/bautizos'); ?>"><input type="submit" value="<?php echo $submit; ?>"></center>
</form>