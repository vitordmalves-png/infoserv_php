<h1>Pessoas</h1>

<?php renderizarFlashMessages(); ?>

<a href="<?= url("/pessoas/novo") ?>">Novo funcionário</a>

<br><br>

<?php if (empty($pessoas)): ?>
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

        <?php foreach ($pessoas as $pessoas): ?>
            <tr>
                <td><?= escapar($pessoas->getId()) ?></td>
                <td><?= escapar($pessoas->getNome()) ?></td>
                <td><?= escapar($pessoas->getSobrenome()) ?></td>
                <td><?= escapar($pessoas->getCargo()) ?></td>
                <td><?= escapar($pessoas->getSetor()) ?></td>
                <td><?= escapar($pessoas->getSalario()) ?></td>
                <td><?= escapar($pessoas->getCracha()) ?></td>
                <td><?= escapar($pessoas->getIdPessoa()) ?></td>
                <td>
                    <a href="<?= url("/funcionarios/{$pessoa->getId()}/editar") ?>">
                        Editar
                    </a>

                    <form
                        method="POST"
                        action="<?= url("/funcionarios/{$pessoa->getId()}/deletar") ?>"
                        style="display:inline"
                    >
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
