<?php

class BaseModel
{
    protected BancoDeDados $banco;

    protected string $tabela = "";

    public function __construct(BancoDeDados $banco)
    {
        $this->banco = $banco;
    }

    public function listar(array $filtros = [], int $limite = 20, int $offset = 0): array
    {
        $this->validarTabela();

        $sql = "SELECT * FROM {$this->tabela}";
        $parametros = [];

        if (!empty($filtros)) {
            $where = [];

            foreach ($filtros as $campo => $valor) {
                $campo = $this->validarIdentificador($campo);

                $where[] = "{$campo} = ?";
                $parametros[] = $valor;
            }

            $sql .= " WHERE " . implode(" AND ", $where);
        }

        $sql .= " LIMIT ? OFFSET ?";

        $parametros[] = $limite;
        $parametros[] = $offset;

        return $this->banco->consultar($sql, $parametros);
    }

    public function listarPorId(int $id): array
    {
        $this->validarTabela();

        $sql = "SELECT * FROM {$this->tabela} WHERE id = ? LIMIT 1";

        return $this->banco->consultar($sql, [$id]);
    }

    public function criar(array $dados): int
    {
        $this->validarTabela();
        $this->validarDados($dados);

        $campos = array_keys($dados);
        $campos = array_map(function ($campo) {
            return $this->validarIdentificador($campo);
        }, $campos);

        $camposSql = implode(", ", $campos);
        $placeholders = implode(", ", array_fill(0, count($campos), "?"));

        $sql = "INSERT INTO {$this->tabela} ({$camposSql}) VALUES ({$placeholders})";

        return $this->banco->inserir($sql, array_values($dados));
    }

    public function atualizar(int $id, array $dados): int
    {
        $this->validarTabela();
        $this->validarDados($dados);

        $set = [];

        foreach ($dados as $campo => $valor) {
            $campo = $this->validarIdentificador($campo);

            $set[] = "{$campo} = ?";
        }

        $setSql = implode(", ", $set);
        $sql = "UPDATE {$this->tabela} SET {$setSql} WHERE id = ?";

        $parametros = array_values($dados);
        $parametros[] = $id;

        return $this->banco->executar($sql, $parametros);
    }

    public function excluir(int $id): int
    {
        $this->validarTabela();

        $sql = "DELETE FROM {$this->tabela} WHERE id = ?";

        return $this->banco->executar($sql, [$id]);
    }

    protected function validarTabela(): void
    {
        if (empty($this->tabela)) {
            throw new Exception("A tabela não foi definida na classe " . get_class($this));
        }

        $this->validarIdentificador($this->tabela);
    }

    private function validarDados(array $dados): void
    {
        if (empty($dados)) {
            throw new Exception("Nenhum dado foi informado para a operação.");
        }
    }

    private function validarIdentificador(string $identificador): string
    {
        $identificadorValido = preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $identificador);

        if (!$identificadorValido) {
            throw new Exception("Campo ou tabela inválida: {$identificador}");
        }

        return $identificador;
    }
}