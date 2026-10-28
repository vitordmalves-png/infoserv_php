<h1>Funcionários</h1>

<?php renderizarFlashMessages(); ?>

<a href="<?= url("/funcionarios/novo") ?>">Novo funcionário</a>

<br><br>

<?php if (empty($funcionarios)): ?>
    <p>Nenhum funcionário encontrado.</p>
<?php else: ?>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Cargo</th>
            <th>Setor</th>
            <th>Salário</th>
            <th>Crachá</th>
            <th>ID Pessoa</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($funcionarios as $funcionario): ?>
            <tr>
                <td><?= escapar($funcionario->getId()) ?></td>
                <td><?= escapar($funcionario->getNome()) ?></td>
                <td><?= escapar($funcionario->getSobrenome()) ?></td>
                <td><?= escapar($funcionario->getCargo()) ?></td>
                <td><?= escapar($funcionario->getSetor()) ?></td>
                <td><?= escapar($funcionario->getSalario()) ?></td>
                <td><?= escapar($funcionario->getCracha()) ?></td>
                <td><?= escapar($funcionario->getIdPessoa()) ?></td>
                <td>
                    <a href="<?= url("/funcionarios/{$funcionario->getId()}/editar") ?>">
                        Editar
                    </a>

                    <form
                        method="POST"
                        action="<?= url("/funcionarios/{$funcionario->getId()}/deletar") ?>"
                        style="display:inline"
                    >
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
