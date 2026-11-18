<h1>Pessoas</h1>

<?php renderizarFlashMessages(); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.14.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.14.1/jquery-ui.min.js"></script>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">
    Nova pessoa
</button>

<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar pessoa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form method="POST" action="<?= escapar($action) ?>">
                <div>
                    <label>Nome</label>
                    <input
                        type="text"
                        name="nome"
                        id="nome"
                        value=""
                        class="form-control"
                    >
                </div>

                <div>
                    <label>E-mail</label>
                    <input
                        type="text"
                        name="email"
                        id="email"
                        value=""
                        class="form-control"
                    >
                </div>

                <div>
                    <label>Telefone</label>
                    <input
                        type="number"
                        name="telefone"
                        id="telefone"
                        value=""
                        class="form-control"
                    >
                </div>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" href=# class="btn btn-primary">Cadastrar</button>
      </div>
    </div>
  </div>
</div>

<br><br>

<?php if (empty($dados)): ?>
    <p>Nenhuma pessoa encontrada.</p>
<?php else: ?>
    <table class="table table-striped mb-0" border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($dados as $pessoa): ?>
            <tr>
                <td><?= escapar($pessoa->getId()) ?></td>
                <td><?= escapar($pessoa->getNome()) ?></td>
                <td><?= escapar($pessoa->getEmail()) ?></td>
                <td><?= escapar($pessoa->getTelefone()) ?></td>
                <td>
                    <button type="button" class="btn btn-warning">Editar</button>
                    <button type="button" class="btn btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>