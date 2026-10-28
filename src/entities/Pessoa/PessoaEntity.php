<?php

class PessoaEntity
{
    private ?int $id = null;
    private string $nome = "";
    private string $email = "";
    private int $telefone = 0;

    public static function criarPorDados(object|array $dados): self
    {
        $pessoa = new self();

        $pessoa->preencher($dados);

        return $pessoa;
    }

    public function preencher(object|array $dados): void
    {
        $dados = (object) $dados;

        $this->id = isset($dados->id) ? (int) $dados->id : $this->id;
        $this->nome = $dados->nome ?? $this->nome;
        $this->email = $dados->email ?? $this->email;
        $this->telefone = isset($dados->telefone) && $dados->telefone !== "" ? (int) $dados->telefone : $this->telefone;
    }

    public function toArrayParaBanco(): array
    {
        return [
            "nome" => $this->nome,
            "email" => $this->email,
            "telefone" => $this->telefone,
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTelefone(): float
    {
        return $this->telefone;
    }
}