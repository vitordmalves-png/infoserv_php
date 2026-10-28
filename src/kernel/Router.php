<?php

class Router
{
    private array $rotas;

    public function __construct(array $rotas)
    {
        $this->rotas = $rotas;
    }

    public function executar(): void
    {
        $uri = $this->obterUri();
        $metodo = $this->obterMetodo();

        foreach ($this->rotas as $rota) {
            [$metodoRota, $caminhoRota, $acao] = $rota;

            $padrao = $this->converterRotaParaRegex($caminhoRota);

            if ($metodo === $metodoRota && preg_match($padrao, $uri, $parametros)) {
                array_shift($parametros);

                call_user_func_array($acao, $parametros);
                return;
            }
        }

        http_response_code(404);

        echo "Página não encontrada";
    }

    private function obterUri(): string
    {
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

        if (BASE_URL !== "" && strpos($uri, BASE_URL) === 0) {
            $uri = substr($uri, strlen(BASE_URL));
        }

        $uri = "/" . trim($uri, "/");

        return $uri === "/" ? "/" : $uri;
    }

    private function obterMetodo(): string
    {
        $metodo = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"];

        return strtoupper($metodo);
    }

    private function converterRotaParaRegex(string $rota): string
    {
        $padrao = preg_replace('/\{([a-zA-Z]+)\}/', '([0-9]+)', $rota);

        return "#^{$padrao}$#";
    }
}