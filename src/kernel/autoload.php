<?php

spl_autoload_register(function (string $nomeDaClasse): void {
    $pastas = [
        APP_PATH . "/kernel",
        APP_PATH . "/database",

        APP_PATH . "/controllers/",
        APP_PATH . "/controllers/funcionario",
        APP_PATH . "/controllers/pessoa",

        APP_PATH . "/entities/funcionario",
        APP_PATH . "/entities/pessoa",

        APP_PATH . "/models/funcionario",
        APP_PATH . "/models/pessoa",
    ];

    foreach ($pastas as $pasta) {
        $caminhoArquivo = $pasta . "/" . $nomeDaClasse . ".php";

        if (file_exists($caminhoArquivo)) {
            require_once $caminhoArquivo;
            return;
        }
    }
});