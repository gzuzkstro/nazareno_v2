<?php
if($this->action == 'modificar') {
?>
<h2>Modificar usuario <?php echo $this->request->data('Usuario.usuario'); ?></h2>
<?php } else { ?>
<h2>Agregar nuevo usuario</h2>
<?php } ?>
<?php
    echo $this->Form->create('Usuario', array(
        'style' => 'width:30%;'
    ));
    if($this->action != 'modificar') {
        echo $this->Form->input('usuario', array('label' => 'Usuario'));
        echo '<br>';
    }
    if($this->action == 'modificar')
        echo $this->Form->input('password', array('label' => 'Nueva contraseña (Solo si se va a modificar)'));
    else
        echo $this->Form->input('password', array('label' => 'Contraseña'));
    echo '<br>';
    echo $this->Form->input('rol', array('label' => 'Tipo de usuario', 'type' => 'select', 'options' => array(
        'N' => 'Normal',
        'A' => 'Administrador'
    )));
    echo '<br>';
    echo '<center>';
    echo '<input type="button" value="Cancelar" class="cancel" data-location="'.Router::url(array('action' => 'index')).'">';
    echo $this->Form->end(array('div' => false, 'label' => $this->action == 'modificar'?'Guardar':'Agregar'));
    echo '</center>'
?>