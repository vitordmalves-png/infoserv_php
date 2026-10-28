<?php

require_once __DIR__ . "/src/kernel/bootstrap.php";

$rotas = require APP_PATH . "/rotas/web/rotas.php";

$router = new Router($rotas);

$router->executar();