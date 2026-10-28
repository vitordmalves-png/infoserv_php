<?php

class BancoDeDados
{
    private mysqli $conexao;

    public function __construct(mysqli $conexao)
    {
        $this->conexao = $conexao;
    }

    public function consultar(string $sql, array $parametros = []): array
    {
        $statement = $this->preparar($sql, $parametros);

        $resultado = $statement->get_result();

        $dados = [];

        while ($registro = $resultado->fetch_assoc()) {
            $dados[] = (object) $registro;
        }

        $statement->close();

        return $dados;
    }

    public function inserir(string $sql, array $parametros = []): int
    {
        $statement = $this->preparar($sql, $parametros);

        $idInserido = $this->conexao->insert_id;

        $statement->close();

        return $idInserido;
    }

    public function executar(string $sql, array $parametros = []): int
    {
        $statement = $this->preparar($sql, $parametros);

        $linhasAfetadas = $statement->affected_rows;

        $statement->close();

        return $linhasAfetadas;
    }

    public function fecharConexao(): void
    {
        $this->conexao->close();
    }

    private function preparar(string $sql, array $parametros = []): mysqli_stmt
    {
        $statement = $this->conexao->prepare($sql);

        if ($statement === false) {
            throw new Exception("Erro ao preparar SQL: " . $this->conexao->error);
        }

        if (!empty($parametros)) {
            $tipos = $this->obterTiposDosParametros($parametros);
            $referencias = [];

            foreach ($parametros as $indice => $valor) {
                $referencias[$indice] = &$parametros[$indice];
            }

            $statement->bind_param($tipos, ...$referencias);
        }

        $executou = $statement->execute();

        if (!$executou) {
            throw new Exception("Erro ao executar SQL: " . $statement->error);
        }

        return $statement;
    }

    private function obterTiposDosParametros(array $parametros): string
    {
        $tipos = "";

        foreach ($parametros as $parametro) {
            if (is_int($parametro)) {
                $tipos .= "i";
                continue;
            }

            if (is_float($parametro)) {
                $tipos .= "d";
                continue;
            }

            $tipos .= "s";
        }

        return $tipos;
    }
}