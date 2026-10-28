<?php

session_start();

define("ROOT_PATH", dirname(__DIR__, 2));
define("APP_PATH", ROOT_PATH . "/src");

require_once APP_PATH . "/config/app.php";
require_once APP_PATH . "/kernel/helpers.php";
require_once APP_PATH . "/kernel/autoload.php";
require_once APP_PATH . "/config/conexao.php";
require_once APP_PATH . "/database/BancoDeDados.php";
require_once APP_PATH . "/database/BaseModel.php";
require_once APP_PATH . "/models/funcionario/FuncionarioModel.php";
require_once APP_PATH . "/controllers/funcionario/FuncionarioController.php";

$bancoDeDados = new BancoDeDados($conexao);
$funcionarioModel = new FuncionarioModel($bancoDeDados);
$funcionarioController = new FuncionarioController($funcionarioModel);