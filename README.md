# Inforserv_php

/var/www/html/

sudo service mariadb start

sudo mysql -uroot -p

create database infoserv;

show databases;

create user 'aluno'@localhost identified by '1234';

grant all privileges on *. * to 'aluno'@localhost identified by '1234';

flush privileges;

   <VirtualHost *:80>
      ServerName localhost
      ServerAlias localhost
      DocumentRoot "/var/www/html"
      <Directory "/var/www/html/">
         Options +Indexes +Includes +FollowSymLinks +MultiViews
         AllowOverride All
         Require all granted
      </Directory>
   </VirtualHost>