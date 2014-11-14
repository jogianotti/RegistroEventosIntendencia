Registro de Eventos de Intendencia

1) Configuracion de la Base de Datos
----------------------------------

app/config/parameters.yml
git add .
git reset HEAD app/config/parameters.yml 

2) Instalacion de la Base de Datos
----------------------------------

php app/console doctrine:schema:update --force
 
    /* Descripción */


PROCESO DE INSTALACIÓN

1) Crear en MySQL una base de datos, con un usuario y clave
    que será usada por el sistema. Por defecto estos valores son:

    database_driver: pdo_mysql
    database_host: 127.0.0.1
    database_port: null
    database_name: registro_eventos
    database_user: eventos
    database_password: 123456

2) Clonar el repositorio dentro del directorio de trabajo

    git clone https://github.com/jogianotti/RegistroEventosIntendencia.git

3) Ubicarnos dentro del directorio "RegistroEventosIntendencia" creado e 
    instalar las dependencias

    cd RegistroEventosIntendencia
    composer install

  Si la instalación solicita ingresar los datos de la base de datos ingresarlos.
  Si no actualizar el archivo app/config/parameters.yml con sus valores.

4) Crear el esquema de la base de datos

    php app/console doctrine:schema:update --force

5) Aplicar los permisos necesarios a los directorios app/cache y app/logs
    siguiendo la explicación en el siguiente enlace de acuerdo el sistema
    operativo.

    http://symfony.es/documentacion/como-solucionar-el-problema-de-los-permisos-de-symfony2/

6) Vaciar la cache

    php app/console cache:clear

7) En el directorio root se encuentra una copia de la base de datos "registro_eventos.sql".

8) Comprobar que se se haya instalado correctamente ingresando a

    {dominio o path}/app_dev.php/login

