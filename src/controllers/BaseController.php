<?php

class BaseController
{
    protected function view(string $caminho, array $dados = []): void
    {
        view($caminho, $dados);
    }

    protected function redirecionar(string $caminho): void
    {
        header("Location: " . url($caminho));
        exit;
    }

    protected function mensagemSucesso(string $mensagem): void
    {
        adicionarMensagemSucesso($mensagem);
    }

    protected function mensagemErro(string $mensagem): void
    {
        adicionarMensagemErro($mensagem);
    }

    protected function criarEntidade(string $classeEntity, object|array $dados): object
    {
        $this->validarClasseEntity($classeEntity);

        return $classeEntity::criarPorDados($dados);
    }

    protected function criarEntidadePeloPost(string $classeEntity): object
    {
        return $this->criarEntidade($classeEntity, $_POST);
    }

    protected function criarEntidades(string $classeEntity, array $registros): array
    {
        $this->validarClasseEntity($classeEntity);

        return array_map(function ($registro) use ($classeEntity) {
            return $classeEntity::criarPorDados($registro);
        }, $registros);
    }

    protected function salvarEntidade(BaseModel $model, object $entidade): int
    {
        $this->validarEntidadeParaBanco($entidade);

        return $model->criar($entidade->toArrayParaBanco());
    }

    protected function atualizarEntidade(BaseModel $model, int|string $id, object $entidade): int
    {
        $this->validarEntidadeParaBanco($entidade);

        return $model->atualizar((int) $id, $entidade->toArrayParaBanco());
    }

    private function validarClasseEntity(string $classeEntity): void
    {
        if (!class_exists($classeEntity)) {
            throw new Exception("A classe {$classeEntity} não existe.");
        }

        if (!method_exists($classeEntity, "criarPorDados")) {
            throw new Exception("A classe {$classeEntity} precisa ter o método criarPorDados.");
        }
    }

    private function validarEntidadeParaBanco(object $entidade): void
    {
        if (!method_exists($entidade, "toArrayParaBanco")) {
            $classe = get_class($entidade);

            throw new Exception("A classe {$classe} precisa ter o método toArrayParaBanco.");
        }
    }
}
