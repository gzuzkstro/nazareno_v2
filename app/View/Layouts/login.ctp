<!DOCTYPE HTML>
<html lang="es">
    <head>
        <title>Parroquia Jesús Nazareno</title>
        <?php
		echo $this->Html->meta('icon')."\n";
		echo "\t".$this->Html->css('estilo')."\n";
        echo "\t".$this->Html->css('login')."\n";
        echo "\t".$this->Html->css('font-awesome')."\n";
        ?>
        <meta charset="utf-8">
    </head>
    <body>
        <header id="cabecera">
        </header>
        <?php echo $this->Session->flash('auth'); ?>
        <section id="login-area">
            <?php echo $this->fetch('content'); ?>
        </section>
        <?php echo $this->Html->script('jquery-1.10.2.min')."\n"; ?>
    </body>
</html>
