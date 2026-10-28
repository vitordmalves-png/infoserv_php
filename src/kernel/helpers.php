<?php

function url(string $caminho = ""): string
{
    $baseUrl = rtrim(BASE_URL, "/");
    $caminho = "/" . ltrim($caminho, "/");

    if ($baseUrl === "") {
        return $caminho;
    }

    return $baseUrl . $caminho;
}

function view(string $caminho, array $dados = []): void
{
    extract($dados);

    require APP_PATH . "/views/" . trim($caminho, "/") . ".php";
}

function escapar(mixed $valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
}

function adicionarFlashMessage(string $tipo, string $mensagem): void
{
    $_SESSION["flash"][$tipo][] = $mensagem;
}

function adicionarMensagemSucesso(string $mensagem): void
{
    adicionarFlashMessage("sucesso", $mensagem);
}

function adicionarMensagemErro(string $mensagem): void
{
    adicionarFlashMessage("erro", $mensagem);
}

function obterFlashMessages(): array
{
    $mensagens = $_SESSION["flash"] ?? [];

    unset($_SESSION["flash"]);

    return $mensagens;
}

function renderizarFlashMessages(): void
{
    $mensagens = obterFlashMessages();

    if (empty($mensagens)) {
        return;
    }

    foreach ($mensagens as $tipo => $listaMensagens) {
        foreach ($listaMensagens as $mensagem) {
            $corFundo = $tipo === "sucesso" ? "#d4edda" : "#f8d7da";
            $corTexto = $tipo === "sucesso" ? "#155724" : "#721c24";
            $borda = $tipo === "sucesso" ? "#c3e6cb" : "#f5c6cb";

            echo "
                <div style='
                    padding: 10px;
                    margin-bottom: 10px;
                    border: 1px solid {$borda};
                    background-color: {$corFundo};
                    color: {$corTexto};
                '>
                    " . escapar($mensagem) . "
                </div>
            ";
        }
    }
}