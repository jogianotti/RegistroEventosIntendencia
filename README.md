Registro de Eventos de Intendencia

NECESARIOS PARA LA INSTALACIÓN

	1) COMPOSER
 		
 		https://getcomposer.org/
    
    2) GIT (Opcional altamente recomendado)
    
    	http://git-scm.com/
    	
PROCESO DE INSTALACIÓN

	1) Base de Datos y Usuario
	
	Se debe crear una base de datos para el proyecto con el nombre que se desee.
		
		CREATE DATABASE {base};
		
	Seguidamente se debe crear un usuario asignado a esa base de datos con
	privilegios sobre esa base de datos.
	
		CREATE USER '{usuario}'@'localhost' IDENTIFIED BY '{clave}';

		GRANT USAGE ON * . * TO '{usuario}'@'localhost' IDENTIFIED BY '{clave}' WITH MAX_QUERIES_PER_HOUR 0 				MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;

		GRANT ALL PRIVILEGES ON `{base}` . * TO '{usuario}'@'localhost';
		
	2) Clonar el proyecto
	
	La url del proyecto en GitHub
	
		https://github.com/jogianotti/RegistroEventosIntendencia
	
	Ubicados en el directorio web (o el directorio donde se desee instalar el sistema)
	clonamos el proyecto desde GitHub usando git.
	
		git clone https://github.com/jogianotti/RegistroEventosIntendencia.git
		
	Esto creara la carpeta RegistroEventosIntendencia con el contenido del sistema.

	Si no se dispone de GIT instalado se puede descargar el contenido en un paquete
	comprimido (ej. ZIP), descomprimiendolo en el directorio que se desee.
	
		https://github.com/jogianotti/RegistroEventosIntendencia/archive/master.zip

	3) Instalación del proyecto y dependencias utilizando Composer
	
	Se procede a instalar las dependencias e inicializar el sistema utilizando composer
	Ubicados dentro del directorio del proyecto (RegistroEventosIntendencia/) ejecutamos
	
		php /path/hasta/composer.phar install
		
	Si se encuentra instalado como comando
	
		composer install
	
	Esta ejecucion descargará e instalará todos los paquetes necesarios para el funcionamiento
	del sistema. Actualizara el archivo de configuración con los dato que le proporcionemos,
	creará el esquema de la base de datos e insertara un primer usuario administrador
		
		Usuario: admin
		Clave: admin
	
	Llegado el momento nos pedira ingresar los datos para acceder a la base de datos que creamos
	anteriormente, los datos del servidor de mail (si se dispone de uno), y una frase secreta que
	utilizara para el proceso de encriptado.

    	database_driver: pdo_mysql
    	database_host: 127.0.0.1
    	database_port: null
    	database_name: {base}
    	database_user: {usuario}
    	database_password: {clave}
    	
    	mailer_transport: smtp
		mailer_host: 127.0.0.1
		mailer_user: ~
		mailer_password: ~
		
		locale: en
		secret: {UnaFraseSecretaDeExtensionYComplejidadConsiderable}

	Una vez finalizado el proceso sin registrarse ningún error ya se esta en condiciones de acceder al sistema.
	
		http://localhost/RegistroEventosIntendencia/web/
		
	O al dominio correspondiente si se creo alguno para el sistema.
	
EN CASO DE ERROR

	Estos comandos pueden se utiles en caso de error. Ubicados dentro del directorio del proyecto:
	
	-Actualiza el esquema de la base de datos. Si no esta creado lo crea.
	
		php app/console doctrine:schema:update --force
		
	-Crea y registra al usuario administrador 'admin'
	
		php app/console registro_eventos_core:crear:usuario_admin
		
		

		
	
