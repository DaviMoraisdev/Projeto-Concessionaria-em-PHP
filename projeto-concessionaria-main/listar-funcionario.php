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
            print "<td>" . $row->id_funcionario . "</td>";
            print "<td>" . $row->nome_funcionario . "</td>";
            
            // CORREÇÃO 1: Garante que a propriedade existe antes de tentar acessá-la
            print "<td>" . htmlspecialchars($row->cpf_funcionario ?? '') . "</td>";
            print "<td>" . htmlspecialchars($row->email_funcionario ?? '') . "</td>";

            // CORREÇÃO 2: Usa 'telefone_funcionario' em vez de 'fone_funcionario'
            print "<td>" . htmlspecialchars($row->telefone_funcionario ?? '') . "</td>";
            
            print "<td>
                        <button onclick=\"location.href='?page=editar-funcionario&id=".$row->id_funcionario."';\" class='btn btn-success'>Editar</button>
                        <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar-funcionario&acao=excluir&id=".$row->id_funcionario."';}else{false;}\" class='btn btn-danger'>Excluir</button>
                   </td>";
            print "</tr>";
        }
        print "</table>";
    } else {
        print "<p class='alert alert-danger'>Não encontrou resultados!</p>";
    }
?>