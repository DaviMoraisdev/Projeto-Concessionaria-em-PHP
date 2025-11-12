<h1>Listar Venda</h1>
<div class="mb-3">
    <a href="?page=cadastrar-venda" class="btn btn-primary">Nova Venda</a>
</div>
<?php
    $sql = "SELECT V.*, C.nome_cliente, F.nome_funcionario, M.nome_modelo, MA.nome_marca
            FROM venda AS V
            JOIN cliente AS C ON V.cliente_id_cliente = C.id_cliente
            JOIN funcionario AS F ON V.funcionario_id_funcionario = F.id_funcionario
            JOIN modelo AS M ON V.modelo_id_modelo = M.id_modelo
            JOIN marca AS MA ON M.marca_id_marca = MA.id_marca";
    $res = $conn->query($sql);
    $qtd = $res->num_rows;

    if ($qtd > 0) {
        print "<table class='table table-hover table-striped table-bordered'>";
        print "<tr>";
        print "<th>#</th>";
        print "<th>Cliente</th>";
        print "<th>Funcionário</th>";
        print "<th>Veículo</th>";
        print "<th>Data da Venda</th>";
        print "<th>Valor da Venda</th>";
        print "<th>Ações</th>";
        print "</tr>";
        while ($row = $res->fetch_object()) {
            print "<tr>";
            print "<td>" . $row->id_venda . "</td>";
            print "<td>" . $row->nome_cliente . "</td>";
            print "<td>" . $row->nome_funcionario . "</td>";
            print "<td>" . $row->nome_marca . " - " . $row->nome_modelo . "</td>";
            print "<td>" . $row->data_venda . "</td>";
            print "<td>R$ " . number_format($row->valor_venda, 2, ',', '.') . "</td>";
            print "<td>
                        <button onclick=\"location.href='?page=editar-venda&id=".$row->id_venda."';\" class='btn btn-success'>Editar</button>
                        <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar-venda&acao=excluir&id=".$row->id_venda."';}else{false;}\" class='btn btn-danger'>Excluir</button>
                   </td>";
            print "</tr>";
        }
        print "</table>";
    } else {
        print "<p class='alert alert-danger'>Não encontrou resultados!</p>";
    }
?>