<?php

class FuncionarioController extends BaseController
{
    private FuncionarioModel $funcionarioModel;
    private string $entity = FuncionarioEntity::class;

    public function __construct(FuncionarioModel $funcionarioModel)
    {
        $this->funcionarioModel = $funcionarioModel;
    }

    public function listar(): void
    {
        try {
            $registros = $this->funcionarioModel->listar();
            $funcionarios = $this->criarEntidades($this->entity, $registros);
        } catch (Exception $erro) {
            $funcionarios = [];

            $this->mensagemErro("Erro ao listar funcionários: " . $erro->getMessage());
        }

        $this->view("funcionario/listar", [
            "funcionarios" => $funcionarios,
        ]);
    }

    public function novo(): void
    {
        $this->view("funcionario/form", [
            "titulo" => "Novo funcionário",
            "action" => url("/funcionarios"),
            "funcionario" => new FuncionarioEntity(),
        ]);
    }

    public function criar(): void
    {
        try {
            $funcionario = $this->criarEntidadePeloPost($this->entity);

            $this->salvarEntidade($this->funcionarioModel, $funcionario);

            $this->mensagemSucesso("Funcionário cadastrado com sucesso!");

            $this->redirecionar("/funcionarios");
        } catch (Exception $erro) {
            $this->mensagemErro("Erro ao cadastrar funcionário: " . $erro->getMessage());

            $this->redirecionar("/funcionarios/novo");
        }
    }

    public function editar(int|string $id): void
    {
        try {
            $registros = $this->funcionarioModel->listarPorId((int) $id);

            if (empty($registros)) {
                $this->mensagemErro("Funcionário não encontrado.");

                $this->redirecionar("/funcionarios");
            }

            $funcionario = $this->criarEntidade($this->entity, $registros[0]);

            $this->view("funcionario/form", [
                "titulo" => "Editar funcionário",
                "action" => url("/funcionarios/{$id}"),
                "funcionario" => $funcionario,
            ]);
        } catch (Exception $erro) {
            $this->mensagemErro("Erro ao buscar funcionário: " . $erro->getMessage());

            $this->redirecionar("/funcionarios");
        }
    }

    public function atualizar(int|string $id): void
    {
        try {
            $funcionario = $this->criarEntidadePeloPost($this->entity);

            $this->atualizarEntidade($this->funcionarioModel, $id, $funcionario);

            $this->mensagemSucesso("Funcionário atualizado com sucesso!");

            $this->redirecionar("/funcionarios");
        } catch (Exception $erro) {
            $this->mensagemErro("Erro ao atualizar funcionário: " . $erro->getMessage());

            $this->redirecionar("/funcionarios/{$id}/editar");
        }
    }

    public function deletar(int|string $id): void
    {
        try {
            $this->funcionarioModel->excluir((int) $id);

            $this->mensagemSucesso("Funcionário excluído com sucesso!");
        } catch (Exception $erro) {
            $this->mensagemErro("Erro ao excluir funcionário: " . $erro->getMessage());
        }

        $this->redirecionar("/funcionarios");
    }
}