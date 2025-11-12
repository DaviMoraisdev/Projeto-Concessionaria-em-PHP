<h1>Listar Cliente</h1>
<div class="mb-3">
    <a href="?page=cadastrar-cliente" class="btn btn-primary">Novo Cliente</a>
</div>
<?php
    $sql = "SELECT * FROM cliente";
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
        print "<th>Data de Nascimento</th>";
        print "<th>Ações</th>";
        print "</tr>";
        while ($row = $res->fetch_object()) {
            print "<tr>";
            print "<td>" . $row->id_cliente . "</td>";
            print "<td>" . $row->nome_cliente . "</td>";
            print "<td>" . $row->cpf_cliente . "</td>";
            print "<td>" . $row->email_cliente . "</td>";
            print "<td>" . $row->fone_cliente . "</td>";
            print "<td>" . $row->data_nasc_cliente . "</td>";
            print "<td>
                        <button onclick=\"location.href='?page=editar-cliente&id=".$row->id_cliente."';\" class='btn btn-success'>Editar</button>
                        <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar-cliente&acao=excluir&id=".$row->id_cliente."';}else{false;}\" class='btn btn-danger'>Excluir</button>
                   </td>";
            print "</tr>";
        }
        print "</table>";
    } else {
        print "<p class='alert alert-danger'>Não encontrou resultados!</p>";
    }
?>