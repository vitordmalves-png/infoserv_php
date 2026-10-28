<?php

class PessoaController extends BaseController
{
    private PessoaModel $pessoaModel;
    private string $entity = PessoaEntity::class;

    public function __construct(PessoaModel $pessoaModel)
    {
        $this->pessoaModel = $pessoaModel;
    }

    public function listar(): void
    {
        try {
            $registros = $this->pessoaModel->listar();
            $pessoas = $this->criarEntidades($this->entity, $registros);
        } catch (Exception $erro) {
            $pessoas = [];

            $this->mensagemErro("Erro ao listar funcionários: " . $erro->getMessage());
        }

        $this->view("pessoas/listar", [
            "pessoas" => $pessoas,
        ]);
    }

    public function novo(): void
    {
        $this->view("pessoa/form", [
            "titulo" => "Novo funcionário",
            "action" => url("/pessoas"),
            "funcionario" => new PessoaEntity(),
        ]);
    }

    public function criar(): void
    {
        try {
            $pessoa = $this->criarEntidadePeloPost($this->entity);

            $this->salvarEntidade($this->pessoaModel, $pessoa);

            $this->mensagemSucesso("Pessoa cadastrado com sucesso!");

            $this->redirecionar("/pessoas");
        } catch (Exception $erro) {
            $this->mensagemErro("Erro ao cadastrar pessoa: " . $erro->getMessage());

            $this->redirecionar("/pessoas/novo");
        }
    }

    public function editar(int|string $id): void
    {
        try {
            $registros = $this->pessoaModel->listarPorId((int) $id);

            if (empty($registros)) {
                $this->mensagemErro("Funcionário não encontrado.");

                $this->redirecionar("/pessoas");
            }

            $pessoa = $this->criarEntidade($this->entity, $registros[0]);

            $this->view("pessoa/form", [
                "titulo" => "Editar funcionário",
                "action" => url("/pessoa/{$id}"),
                "pessoa" => $pessoa,
            ]);
        } catch (Exception $erro) {
            $this->mensagemErro("Erro ao buscar funcionário: " . $erro->getMessage());

            $this->redirecionar("/pessoas");
        }
    }

    public function atualizar(int|string $id): void
    {
        try {
            $pessoa = $this->criarEntidadePeloPost($this->entity);

            $this->atualizarEntidade($this->pessoaModel, $id, $pessoa);

            $this->mensagemSucesso("Pessoa atualizado com sucesso!");

            $this->redirecionar("/pessoas");
        } catch (Exception $erro) {
            $this->mensagemErro("Erro ao atualizar funcionário: " . $erro->getMessage());

            $this->redirecionar("/pessoas/{$id}/editar");
        }
    }

    public function deletar(int|string $id): void
    {
        try {
            $this->pessoaModel->excluir((int) $id);

            $this->mensagemSucesso("Funcionário excluído com sucesso!");
        } catch (Exception $erro) {
            $this->mensagemErro("Erro ao excluir funcionário: " . $erro->getMessage());
        }

        $this->redirecionar("/pessoas");
    }
}