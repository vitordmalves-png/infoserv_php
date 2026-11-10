<?php

session_start();

require_once APP_PATH . "/config/app.php";
require_once APP_PATH . "/config/conexao.php";

require_once APP_PATH . "/kernel/autoload.php";
require_once APP_PATH . "/kernel/helpers.php";

$homeController = new HomeController();

$bancoDeDados = new BancoDeDados($conexao);

$funcionarioModel = new FuncionarioModel($bancoDeDados);
$funcionarioController = new FuncionarioController($funcionarioModel);

$pessoaModel = new PessoaModel($bancoDeDados);
$pessoaController = new PessoaController($pessoaModel);
$loginController = new LoginController();

$pessoaModel = new PessoaModel($bancoDeDados);
$pessoaController = new PessoaController($pessoaModel);