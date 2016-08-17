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
            <?php echo $this->Form->input('ministro'); echo $this->Form->hidden('id');  ?>
        </div>
        <div class="col-sm-3">
            <?php echo $this->Form->input('fecha', array('label' => 'Fecha', 'class' => 'date_time_picker')); ?>
        </div>
        <div class="col-sm-3">
            <?php echo $this->Form->input('libro'); ?>
        </div>
        <div class="col-sm-3">
            <?php echo $this->Form->input('numero'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?php echo $this->Form->input('catequista'); ?>
        </div>
    </div>
    
<h2>Datos de las personas que comulgaron</h2>
<div id="personas-comunion">
    <!--
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
</div>-->

    <?php
    
    if(isset($comunion) && count($comunion['Common'])>1){
        foreach($comunion['Common'] as $ind=>$common){
        ?>
    <fieldset <?php if($ind==0) echo 'id="comunion-pivote"'; ?>>
        <legend><?php if($ind==0) echo 'Personas'; ?></legend>
        <div class="row">
            <div class="col-sm-3">
                <?php echo $this->Form->input('Common.'.$ind.'.nombres'); echo $this->Form->hidden('Common.'.$ind.'.id'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('Common.'.$ind.'.apellidos'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('Common.'.$ind.'.padre'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('Common.'.$ind.'.madre'); ?>
            </div>
        </div>
    </fieldset>
    
    
    <?php
        }}else{
            ?>
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
    
    <?php
        }
    
    
    
    if ($this->action == 'modificar') {
        $submit = 'Guardar';
    } else {
        $submit = 'Agregar';
    }
    ?>
    </div> <!-- Wrap form for Common elements -->
    
    <center>
        <input type="button" value="Cancelar" class="cancel" data-location="<?php echo Router::url('/comuniones'); ?>">
        <input type="submit" value="<?php echo $submit; ?>">
        <input type="button" value="Otra persona" id="add-comunion-boton">
        <input type="button" value="Quitar persona" id="remove-comunion-boton">
    </center>
</div>