<script type="text/template" id="add-comunion">
	<fieldset>
        <legend></legend>
        <div class="row">
            <div class="col-sm-3">
                <?php echo $this->Form->input('Common.::num.nombres'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('Common.::num.apellidos'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('Common.::num.padre'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('Common.::num.madre'); ?>
            </div>
        </div>
    </fieldset>
</script>

<div class="container">
<h2>Nueva comunión</h2>
<?php
echo $this->Form->create('Communion', array(
    'inputDefaults' => array(
        'between' => '<br>',
        'type' => 'text'
    )
));
?>

    <div class="row">
        <div class="col-sm-3">
            <?php echo $this->Form->input('ministro'); ?>
        </div>
        <div class="col-sm-3">
            <?php echo $this->Form->input('fecha', array('label' => 'Fecha', 'class' => 'date_time_picker')); ?>
        </div>
        <div class="col-sm-3">
            <?php echo $this->Form->input('libro'); ?>
        </div>
        <div class="col-sm-3">
            <?php echo $this->Form->input('nota'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?php echo $this->Form->input('catequista'); ?>
        </div>
    </div>
    
<h2>Datos de las personas que comulgaron</h2>
<div id="personas-comunion">
    <fieldset id="comunion-pivote">
    <legend>Personas</legend>
    <div class="row">
        <div class="col-sm-3">
            <?php echo $this->Form->input('Common.0.nombres'); ?>
        </div>
        <div class="col-sm-3">
            <?php echo $this->Form->input('Common.0.apellidos'); ?>
        </div>
        <div class="col-sm-3">
            <?php echo $this->Form->input('Common.0.padre'); ?>
        </div>
        <div class="col-sm-3">
            <?php echo $this->Form->input('Common.0.madre'); ?>
        </div>
    </div>
</fieldset>
</div>

    <?php
    
    if ($this->action == 'modificar') {
        $submit = 'Guardar';
    } else {
        $submit = 'Agregar';
    }
    ?>
    <center>
        <input type="button" value="Cancelar" class="cancel" data-location="<?php echo Router::url('/comuniones'); ?>">
        <input type="submit" value="<?php echo $submit; ?>">
        <input type="button" value="Otra persona" id="add-comunion-boton">
    </center>
</div>