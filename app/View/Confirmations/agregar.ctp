<script type="text/template" id="add-comunion">
	<fieldset>
        <legend></legend>
        <div class="row">
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.::num.nombres'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.::num.apellidos'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.::num.padre'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.::num.madre'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.::num.padrino'); ?>
            </div>
        </div>
    </fieldset>
</script>

<div class="container">
<h2>Nueva confirmación</h2>
<?php
    
echo $this->Form->create('Confirmation', array(
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
    
<h2>Datos de las personas que se confirmaron</h2>
<div id="personas-comunion">
    <!--
    <fieldset id="comunion-pivote">
        <legend>Personas</legend>
        <div class="row">
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.0.nombres'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.0.apellidos'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.0.padre'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.0.madre'); ?>
            </div>
        </div>
    </fieldset>
</div>-->

    <?php
    
    if(isset($comunion) && count($comunion['ConfirmationParticipant'])>1){
        foreach($comunion['ConfirmationParticipant'] as $ind=>$ConfirmationParticipant){
        ?>
    <fieldset <?php if($ind==0) echo 'id="comunion-pivote"'; ?>>
        <legend><?php if($ind==0) echo 'Personas'; ?></legend>
        <div class="row">
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.'.$ind.'.nombres'); echo $this->Form->hidden('ConfirmationParticipant.'.$ind.'.id'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.'.$ind.'.apellidos'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.'.$ind.'.padre'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.'.$ind.'.madre'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.'.$ind.'.padrino'); ?>
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
                <?php echo $this->Form->input('ConfirmationParticipant.0.nombres'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.0.apellidos'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.0.padre'); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.0.madre'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <?php echo $this->Form->input('ConfirmationParticipant.0.padrino'); ?>
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
    </div> <!-- Wrap form for ConfirmationParticipant elements -->
    
    <center>
        <input type="button" value="Cancelar" class="cancel" data-location="<?php echo Router::url('/comuniones'); ?>">
        <input type="submit" value="<?php echo $submit; ?>">
        <input type="button" value="Otra persona" id="add-comunion-boton">
        <input type="button" value="Quitar persona" id="remove-comunion-boton">
    </center>
</div>