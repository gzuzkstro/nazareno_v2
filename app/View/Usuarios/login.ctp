<?php
echo $this->Form->create('Usuario');
echo '<div class="form-group">';
echo $this->Form->input('usuario', array('label' => false, 'div' => false, 'placeholder' => 'Nombre de usuario', 'id' => 'username'));
echo '<i class="fa fa-user"></i></div><br>';
echo '<div class="form-group">';
echo $this->Form->input('password', array('label' => false, 'div' => false, 'placeholder' => 'Contraseña', 'id' => 'password', 'class' => 'login-password'));
echo '<i class="fa fa-lock"></i></div><br>';
echo $this->Form->end('Iniciar sesión');
?>