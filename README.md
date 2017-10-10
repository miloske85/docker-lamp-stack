# Docker LAMP stack

This project includes two versions of LAMP stack. Legacy is built with PHP 5.6 and MySQL 5.6. New version has PHP 7.1 and MySQL 5.7. PHP is built from official php-apache image with gd and mysqli extensions installed, custom php.ini files. Mod_rewrite is enabled for apache, as well as .htaccess files. MySQL is also built from official image.

## Setup

Edit lines 25 in each docker-compose.yml file to set the volume location. Then run:

`docker-compose up -d`

MySQL will be available in the web application on host `db`, user is `dbuser`, password `dbpass` and database is `test`. Root password is `124`

## Tear down

`docker-compose down`

Database uses named volumes, data will be preserved.
