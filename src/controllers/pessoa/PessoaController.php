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

            $this->mensagemErro("Erro ao listar pessoas: " . $erro->getMessage());
        }

        $dados["pagina"] = "pessoa/listar";
        $dados["titulo"] = "Sistema Infoserv - Pessoas";
        $dados["dados"] = $pessoas;

        $this->view("principal", $dados);

        // $this->view("pessoa/listar", [
        //     "pessoas" => $pessoas,
        // ]);
    }

    public function novo(): void
    {
        $this->view("pessoa/form", [
            "titulo" => "Nova Pessoa",
            "action" => url("/pessoas"),
            "pessoa" => new PessoaEntity(),
        ]);
    }

    public function criar(): void
    {
        try {
            $pessoa = $this->criarEntidadePeloPost($this->entity);

            $this->salvarEntidade($this->pessoaModel, $pessoa);

            $this->mensagemSucesso("Pessoa cadastrada com sucesso!");

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
                $this->mensagemErro("Pessoa não encontrada.");

                $this->redirecionar("/pessoas");
            }

            $pessoa = $this->criarEntidade($this->entity, $registros[0]);

            $this->view("pessoa/form", [
                "titulo" => "Editar pessoa",
                "action" => url("/pessoas/{$id}"),
                "pessoa" => $pessoa,
            ]);
        } catch (Exception $erro) {
            $this->mensagemErro("Erro ao buscar pessoa: " . $erro->getMessage());

            $this->redirecionar("/pessoas");
        }
    }

    public function atualizar(int|string $id): void
    {
        try {
            $pessoa = $this->criarEntidadePeloPost($this->entity);

            $this->atualizarEntidade($this->pessoaModel, $id, $pessoa);

            $this->mensagemSucesso("Pessoa atualizada com sucesso!");

            $this->redirecionar("/pessoas");
        } catch (Exception $erro) {
            $this->mensagemErro("Erro ao atualizar pessoa: " . $erro->getMessage());

            $this->redirecionar("/pessoas/{$id}/editar");
        }
    }

    public function deletar(int|string $id): void
    {
        try {
            $this->pessoaModel->excluir((int) $id);

            $this->mensagemSucesso("Pessoa excluída com sucesso!");
        } catch (Exception $erro) {
            $this->mensagemErro("Erro ao excluir pessoa: " . $erro->getMessage());
        }

        $this->redirecionar("/pessoas");
    }
}