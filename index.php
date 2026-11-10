<?php

define("ROOT_PATH", __DIR__); // /var/www/html/infoserv
define("APP_PATH", ROOT_PATH . "/src"); // /var/www/html/infoserv/src

require_once APP_PATH . "/kernel/bootstrap.php";

$rotas = require_once APP_PATH . "/rotas/web/rotas.php";

$router = new Router($rotas);

$router->executar();