# Consejo-Comunal
Sistema para el registro de habitantes.

Este sistema permitirá llevar el control de los habtantes de los cosejos comunales, emitir constancias a través de búsqueda de datos y generales, está desarrollado en PHP, haciendo uso del framework Codeigniter, motor de datos, postgreSQL, el diseño de interfaz esta basado en HTML5, CSS3 Y BOOTSTRAP.

1. Dependencias necesarias para la instalación del sistema.

aptitude install apache2 libapache2-mod-php5 php5 php5-pgsql php5-gd php5-mcrypt mcrypt postgresql-9.4 pgadmin3

2. Crear el sitio.

touch /etc/apache2/sites-available/consejocomunal.conf
La extensión .conf del sitio sólo se utiliza para versiones de apache2 superiores a Debian Wheezy

3. Abrir el archivo con nano o el editor ded su preferencia y copiar el texto 

nano /etc/apache2/sites-available/consejocomunal.conf

<VirtualHost *:80>
        ServerAdmin webmaster@localhost
        ServerName consejocomunal
        DocumentRoot /var/www/consejocomunal

        <Directory /var/www/consejocomunal>
                AllowOverride All
                Order deny,allow
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

4. Guardar el archivo y habilitar el sitio.
a2ensite armadillo.conf

5. Deshabilitar el sitio por defecto de apache, a2dissite default o cualquier otro existente
6. Habilitar el modulo rewrite de apache, a través del comando
a2enmod rewrite
7. Por ultimo reiniciar el servicio de apache, 
service apache2 restart
8. Crear el hosts en el archivo /etc/hosts asignando la IP 

	127.0.1.2      consejocomunal


Nota. Si el equipo a utilizar no tiene los paquetes configurados, deben realizar los siguientes pasos adicionales.
Como super usuario escribir los siguientes comandos.

1. su postgres
2. psql
3. ALTER ROLE postgres password'contraseña del usuario';
4. \q
5. exit
6. service postgresql restart
7. Crear la BD consejocomunal en el pgadmin o por consola
8. Restaurar la BD
9. Descomprimir el proyecto en /var/www/
10. Asignar los permisos chmod -R 777 en consejocomunal
11. Abrir el navegador con la url consejocomunal/ 

