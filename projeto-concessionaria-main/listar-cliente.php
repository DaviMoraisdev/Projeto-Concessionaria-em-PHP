<h1>Listar Cliente</h1>
<div class="mb-3">
    <a href="?page=cadastrar-cliente" class="btn btn-primary">Novo Cliente</a>
</div>
<?php
    $sql = "SELECT * FROM cliente ORDER BY nome_cliente";
    $res = $conn->query($sql);
    $qtd = $res ? $res->num_rows : 0;

    if ($qtd > 0) {
        print "<table class='table table-hover table-striped table-bordered'>";
        print "<tr>";
        print "<th>#</th>";
        print "<th>Nome</th>";
        print "<th>CPF</th>";
        print "<th>E-mail</th>";
        print "<th>Telefone</th>";
        print "<th>Data de Nascimento</th>";
        print "<th>Ações</th>";
        print "</tr>";
        while ($row = $res->fetch_object()) {
            $id = (int)($row->id_cliente ?? 0);
            $nome = htmlspecialchars($row->nome_cliente ?? '');
            $cpf = htmlspecialchars($row->cpf_cliente ?? '');
            $email = htmlspecialchars($row->email_cliente ?? '');
            $telefone = htmlspecialchars($row->telefone_cliente ?? '');
            $data_nasc = htmlspecialchars($row->data_nasc_cliente ?? '');

            print "<tr>";
            print "<td>" . $id . "</td>";
            print "<td>" . $nome . "</td>";
            print "<td>" . $cpf . "</td>";
            print "<td>" . $email . "</td>";
            print "<td>" . $telefone . "</td>";
            print "<td>" . $data_nasc . "</td>";
            print "<td>
                        <button onclick=\"location.href='?page=editar-cliente&id={$id}';\" class='btn btn-success'>Editar</button>
                        <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar-cliente&acao=excluir&id={$id}';}else{false;}\" class='btn btn-danger'>Excluir</button>
                   </td>";
            print "</tr>";
        }
        print "</table>";
    } else {
        print "<p class='alert alert-danger'>Não encontrou resultados!</p>";
    }
?>