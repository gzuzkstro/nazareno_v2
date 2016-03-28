<?php
$total = count($usuarios);

if($total == 1)
    $total_usuarios = 'usuario';
else
    $total_usuarios = 'usuarios';
?>
<h2>Usuarios del sistema (<?php echo $total.' '.$total_usuarios; ?>)</h2>
<table class="tabla">
    <tr>
        <th></th>
        <th>Nombre de usuario</th>
        <th>Tipo de usuario</th>
        <th>Acción</th>
    </tr>
<?php
foreach($usuarios as $e) {    
    $rol = '';
    
    switch($e['Usuario']['rol']) {
        case 'A':
            $rol = 'Administrador';
            break;
        case 'N':
            $rol = 'Normal';
            break;
    }
?>
    <tr>
        <td width="20"><i class="fa fa-user" style="color:#6f6f6f;"></i></td>
        <td width="150"><?php echo $e['Usuario']['usuario']; ?></td>
        <td width="100"><?php echo $rol; ?></td>
        <td width="200"><a href="<?php echo Router::url(array('action' => 'modificar', $e['Usuario']['id'])); ?>"><i class="fa fa-edit"></i> Modificar</a> / <a href="<?php echo Router::url(array('action' => 'eliminar', $e['Usuario']['id'])); ?>" onclick="javascript: return confirm('¿Está seguro que desea eliminar el usuario <?php echo $e['Usuario']['usuario'];?>?');" alt="Eliminar"><i class="fa fa-times"></i> Eliminar</a></td>
    </tr>
<?php } ?>
</table>
<p align="center"><input type="button" value="Nuevo usuario" onclick="javascript:document.location='<?php echo Router::url('/usuarios/agregar'); ?>';"></p>