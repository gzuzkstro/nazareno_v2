<!DOCTYPE HTML>
<html lang="es">
    <head>
        <title>Parroquia Jesús Nazareno</title>
        <?php
		echo $this->Html->meta('icon')."\n";
		echo "\t".$this->Html->css('estilo')."\n";
		echo "\t".$this->Html->css('font-awesome')."\n";
                echo "\t".$this->Html->css('jquery.datetimepicker')."\n";
        ?>
        <meta charset="utf-8">
    </head>
    <body>
        <header id="cabecera">

        </header>
        <nav id="nav">
            <form id="buscador">
                    <input type="text" id="buscar" placeholder="Buscar">
                    <i class="fa fa-search"></i>
            </form>
            <ul>
                <li><a href="<?php echo Router::url('/'); ?>"<?php echo $this->name == 'Pages'?'class="active"':'' ?>><i class="fa fa-home"></i> INICIO</a></li>
                <li><a href="<?php echo Router::url('/bautizos'); ?>"<?php echo $this->name == 'Bautizos'?'class="active"':'' ?>><i class="fa fa-angle-double-right"></i> BAUTIZOS</a></li>
                <li><a href="<?php echo Router::url('/comuniones'); ?>"<?php echo $this->name == 'Comuniones'?'class="active"':'' ?>><i class="fa fa-angle-double-right"></i> COMUNIONES</a></li>
                <li><a href="<?php echo Router::url('/confirmaciones'); ?>"<?php echo $this->name == 'Confirmaciones'?'class="active"':'' ?>><i class="fa fa-angle-double-right"></i> CONFIRMACIONES</a></li>
                <li><a href="<?php echo Router::url('/matrimonios'); ?>"<?php echo $this->name == 'Matrimonios'?'class="active"':'' ?>><i class="fa fa-angle-double-right"></i> MATRIMONIOS</a></li>
                <li><a href="<?php echo Router::url('/documentos'); ?>"<?php echo $this->name == 'Documentos'?'class="active"':'' ?>><i class="fa fa-file-text-o"></i> DOCUMENTOS</a></li>
                <?php
                    if($rol == 'A') {
                        /* Admin stuff */
                ?>
                <li><a href="<?php echo Router::url('/usuarios'); ?>"<?php echo $this->name == 'Usuarios'?'class="active"':'' ?>><i class="fa fa-user"></i> USUARIOS</a></li>
                <li><a href="<?php echo Router::url('/configuracion'); ?>"<?php echo $this->name == 'Configuracion'?'class="active"':'' ?>><i class="fa fa-cog"></i>CONFIGURACIÓN</a></li>
                <?php } ?>
                
                <li><a href="<?php echo Router::url('/usuarios/logout'); ?>"><i class="fa fa-power-off"></i> CERRAR SESIÓN</a></li>
            </ul>
        </nav>
        <section id="contenido">
            <?php echo $this->Session->flash('good'); ?>
            <?php echo $this->Session->flash('bad'); ?>
            <?php echo $this->fetch('content'); ?>
            <?php #echo $this->element('sql_dump'); ?>
        </section>
        <script type="text/javascript">
            baseDir = '<?php echo Router::url('/') == '/' ? '' : Router::url('/'); ?>';
            controller = '<?php echo strtolower($this->name); ?>';
        </script>
        <?php echo $this->Html->script('jquery-1.10.2.min')."\n"; ?>
        <?php echo $this->Html->script('jquery.datetimepicker')."\n"; ?>
        <?php echo $this->Html->script('functions')."\n"; ?>
        <?php
            if($this->name == 'Pages')
                echo $this->Html->script('pages')."\n";
            if($this->name == 'Bautizos')
                echo $this->Html->script('bautizos')."\n";
            if($this->name == 'Comuniones')
                echo $this->Html->script('comuniones')."\n";
            if($this->name == 'Confirmaciones')
                echo $this->Html->script('confirmaciones')."\n";
            if($this->name == 'Documentos')
                echo $this->Html->script('documentos')."\n";
            if($this->name == 'Matrimonios')
                echo $this->Html->script('matrimonios')."\n";
        ?>
    </body>
</html>