<h1>Listar Modelo</h1>
<div class="mb-3">
    <a href="?page=cadastrar-modelo" class="btn btn-primary">Novo Modelo</a>
</div>
<?php
    $sql = "SELECT M.*, MA.nome_marca 
            FROM modelo AS M
            JOIN marca AS MA ON M.marca_id_marca = MA.id_marca";
    $res = $conn->query($sql);
    $qtd = $res->num_rows;

    if ($qtd > 0) {
        print "<table class='table table-hover table-striped table-bordered'>";
        print "<tr>";
        print "<th>#</th>";
        print "<th>Marca</th>";
        print "<th>Modelo</th>";
        print "<th>Cor</th>";
        print "<th>Ano</th>";
        print "<th>Placa</th>";
        print "<th>Ações</th>";
        print "</tr>";
        while ($row = $res->fetch_object()) {
            print "<tr>";
            print "<td>" . $row->id_modelo . "</td>";
            print "<td>" . $row->nome_marca . "</td>";
            print "<td>" . $row->nome_modelo . "</td>";
            print "<td>" . $row->cor_modelo . "</td>";
            print "<td>" . $row->ano_modelo . "</td>";
            print "<td>" . $row->placa_modelo . "</td>";
            print "<td>
                        <button onclick=\"location.href='?page=editar-modelo&id=".$row->id_modelo."';\" class='btn btn-success'>Editar</button>
                        <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar-modelo&acao=excluir&id=".$row->id_modelo."';}else{false;}\" class='btn btn-danger'>Excluir</button>
                   </td>";
            print "</tr>";
        }
        print "</table>";
    } else {
        print "<p class='alert alert-danger'>Não encontrou resultados!</p>";
    }
?>