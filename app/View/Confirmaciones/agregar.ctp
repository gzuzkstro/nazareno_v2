<h2>Nueva confirmación</h2>
<?php
echo $this->Form->create('Confirmacion', array(
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
        <td><?php echo $this->Form->input('padre'); ?></td>
        <td><?php echo $this->Form->input('madre'); ?></td>
    </tr>
    <tr>
        <td colspan="2"><h3>Datos de la confirmación</h3></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('lote'); ?></td>
        <td><?php echo $this->Form->input('numero'); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('fecha', array('id' => 'datetimepicker')); ?></td>
        <td><?php echo $this->Form->input('ministro', array('label' => 'Ministro celebrante')); ?></td>
    </tr>
    <tr>
      <td><?php echo $this->Form->input('padrino', array('label' => 'Padrino / Madrina')); ?></td>
      <td></td>
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
    <center><input type="button" value="Cancelar" class="cancel" data-location="<?php echo Router::url('/confirmaciones'); ?>"><input type="submit" value="<?php echo $submit; ?>"></center>
</form>