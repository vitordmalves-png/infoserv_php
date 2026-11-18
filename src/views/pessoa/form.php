<h1><?= escapar($titulo) ?></h1>

<?php renderizarFlashMessages(); ?>

<form method="POST" action="<?= escapar($action) ?>">
    <div>
        <label>Nome</label>
        <input
            type="text"
            name="nome"
            value="<?= escapar($pessoa->getNome()) ?>"
        >
    </div>

    <div>
        <label>Sobrenome</label>
        <input
            type="text"
            name="sobrenome"
            value="<?= escapar($pessoa->getSobrenome()) ?>"
        >
    </div>

    <div>
        <label>Salário</label>
        <input
            type="number"
            step="0.01"
            name="salario"
            value="<?= escapar($pessoa->getSalario()) ?>"
        >
    </div>

    <div>
        <label>Cargo</label>
        <input
            type="text"
            name="cargo"
            value="<?= escapar($pessoa->getCargo()) ?>"
        >
    </div>

    <div>
        <label>Setor</label>
        <input
            type="text"
            name="setor"
            value="<?= escapar($pessoa->getSetor()) ?>"
        >
    </div>

    <div>
        <label>Crachá</label>
        <input
            type="text"
            name="cracha"
            value="<?= escapar($pessoa->getCracha()) ?>"
        >
    </div>

    <div>
        <label>ID Pessoa</label>
        <input
            type="number"
            name="idPessoa"
            value="<?= escapar($pessoa->getIdPessoa()) ?>"
        >
    </div>

    <br>

    <button type="submit">Salvar</button>

    <a href="<?= url("/pessoa") ?>">Voltar</a>
</form>