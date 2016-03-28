<p align="center"><img src="/app/webroot/img/logo.png"></p>
#Sistema para la Gestión de los Sacramentos de la Iglesia Jesús Nazareno

###Requerimientos:

- Git
- Composer
- Servidor LAMP (PHP 5.4 en adelante)

###Pasos para la instalación:

1. git clone https://github.com/naderst/jnazareno.git
2. composer install
3. Crear la BD jnazareno e importar el archivo jnazareno.sql
4. Copiar app/Config/database.php.default -> app/Config/database.php
5. Configurar la conexión a la BD en app/Config/database.php
6. Por defecto, el usuario y la contraseña del superusuario en el sistema es admin
