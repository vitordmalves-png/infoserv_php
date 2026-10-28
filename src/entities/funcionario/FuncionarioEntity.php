<?php

class FuncionarioEntity
{
    private ?int $id = null;
    private string $nome = "";
    private string $sobrenome = "";
    private float $salario = 0;
    private string $cargo = "";
    private string $setor = "";
    private string $cracha = "";
    private ?int $idPessoa = null;

    public static function criarPorDados(object|array $dados): self
    {
        $funcionario = new self();

        $funcionario->preencher($dados);

        return $funcionario;
    }

    public function preencher(object|array $dados): void
    {
        $dados = (object) $dados;

        $this->id = isset($dados->id) ? (int) $dados->id : $this->id;
        $this->nome = $dados->nome ?? $this->nome;
        $this->sobrenome = $dados->sobrenome ?? $this->sobrenome;
        $this->salario = isset($dados->salario) && $dados->salario !== "" ? (float) $dados->salario : $this->salario;
        $this->cargo = $dados->cargo ?? $this->cargo;
        $this->setor = $dados->setor ?? $this->setor;
        $this->cracha = $dados->cracha ?? $this->cracha;
        $this->idPessoa = isset($dados->idPessoa) && $dados->idPessoa !== "" ? (int) $dados->idPessoa : $this->idPessoa;
    }

    public function toArrayParaBanco(): array
    {
        return [
            "nome" => $this->nome,
            "sobrenome" => $this->sobrenome,
            "salario" => $this->salario,
            "cargo" => $this->cargo,
            "setor" => $this->setor,
            "cracha" => $this->cracha,
            "idPessoa" => $this->idPessoa,
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getSobrenome(): string
    {
        return $this->sobrenome;
    }

    public function getSalario(): float
    {
        return $this->salario;
    }

    public function getCargo(): string
    {
        return $this->cargo;
    }

    public function getSetor(): string
    {
        return $this->setor;
    }

    public function getCracha(): string
    {
        return $this->cracha;
    }

    public function getIdPessoa(): ?int
    {
        return $this->idPessoa;
    }
}