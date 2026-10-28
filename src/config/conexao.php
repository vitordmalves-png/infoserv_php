<?php

$host = "localhost";
$usuario = "aluno";
$senha = "1234";
$bancoDados = "infoserv";

$conexao = new mysqli ($host, $usuario, $senha, $bancoDados);

if($conexao->connect_error) {
    die("Erro ao conectar");
}
$conexao->set_charset("utf8mb4");