Registro de Eventos de Intendencia
========================

1) Configuracion de la Base de Datos
----------------------------------

app/config/parameters.yml
git add .
git reset HEAD app/config/parameters.yml 

2) Instalacion de la Base de Datos
----------------------------------

php app/console doctrine:schema:update --force
 

