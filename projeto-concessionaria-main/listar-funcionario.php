<h1>Listar Funcionários</h1>
<div class="mb-3">
    <a href="?page=cadastrar-funcionario" class="btn btn-primary">Novo Funcionário</a>
</div>
<?php
    $sql = "SELECT * FROM funcionario";
    $res = $conn->query($sql);
    $qtd = $res->num_rows;

    if ($qtd > 0) {
        print "<table class='table table-hover table-striped table-bordered'>";
        print "<tr>";
        print "<th>#</th>";
        print "<th>Nome</th>";
        print "<th>CPF</th>";
        print "<th>E-mail</th>";
        print "<th>Telefone</th>";
        print "<th>Ações</th>";
        print "</tr>";
        while ($row = $res->fetch_object()) {
            print "<tr>";
            print "<td>" . htmlspecialchars($row->id_funcionario ?? '') . "</td>";
            print "<td>" . htmlspecialchars($row->nome_funcionario ?? '') . "</td>";
            print "<td>" . htmlspecialchars($row->cpf_funcionario ?? '') . "</td>";
            print "<td>" . htmlspecialchars($row->email_funcionario ?? '') . "</td>";
            print "<td>" . htmlspecialchars($row->telefone_funcionario ?? '') . "</td>";

            // Links usam 'id' para compatibilidade com salvar-funcionario.php
            $id = (int)($row->id_funcionario ?? 0);
            print "<td>
                        <button onclick=\"location.href='?page=editar-funcionario&id={$id}';\" class='btn btn-success'>Editar</button>
                        <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar-funcionario&acao=excluir&id={$id}';}else{false;}\" class='btn btn-danger'>Excluir</button>
                   </td>";
            print "</tr>";
        }
        print "</table>";
    } else {
        print "<p class='alert alert-danger'>Não encontrou resultados!</p>";
    }
?>