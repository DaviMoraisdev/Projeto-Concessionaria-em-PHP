<h1>Editar Venda</h1>
<?php
    $sql_venda = "SELECT * FROM venda WHERE id_venda = ".$_REQUEST["id"];
    $res_venda = $conn->query($sql_venda);
    $row_venda = $res_venda->fetch_object();
?>
<h1>Editar Venda</h1>
<form action="?page=salvar-venda" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id" value="<?php print $row_venda->id_venda; ?>">

    <div class="mb-3">
        <label>Cliente</label>
        <select name="cliente_id_cliente" class="form-control" required>
            <?php
				$sql_clientes = "SELECT id_cliente, nome_cliente FROM cliente";
				$res_clientes = $conn->query($sql_clientes);
				while($row_cliente = $res_clientes->fetch_object()){
                    $selected = ($row_cliente->id_cliente == $row_venda->cliente_id_cliente) ? 'selected' : '';
					print "<option value='".$row_cliente->id_cliente."' ".$selected.">".$row_cliente->nome_cliente."</option>";
				}
			?>
        </select>
    </div>
    <div class="mb-3">
        <label>Funcionário</label>
        <select name="funcionario_id_funcionario" class="form-control" required>
            <?php
				$sql_funcionarios = "SELECT id_funcionario, nome_funcionario FROM funcionario";
				$res_funcionarios = $conn->query($sql_funcionarios);
				while($row_funcionario = $res_funcionarios->fetch_object()){
                    $selected = ($row_funcionario->id_funcionario == $row_venda->funcionario_id_funcionario) ? 'selected' : '';
					print "<option value='".$row_funcionario->id_funcionario."' ".$selected.">".$row_funcionario->nome_funcionario."</option>";
				}
			?>
        </select>
    </div>
    <div class="mb-3">
        <label>Veículo (Modelo)</label>
        <select name="modelo_id_modelo" class="form-control" required>
            <?php
				$sql_modelos = "SELECT id_modelo, nome_modelo, placa_modelo FROM modelo";
				$res_modelos = $conn->query($sql_modelos);
				while($row_modelo = $res_modelos->fetch_object()){
                    $selected = ($row_modelo->id_modelo == $row_venda->modelo_id_modelo) ? 'selected' : '';
					print "<option value='".$row_modelo->id_modelo."' ".$selected.">".$row_modelo->nome_modelo." (".$row_modelo->placa_modelo.")</option>";
				}
			?>
        </select>
    </div>
    <div class="mb-3">
        <label>Data da Venda</label>
        <input type="date" name="data_venda" value="<?php print $row_venda->data_venda; ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Valor da Venda (R$)</label>
        <input type="number" step="0.01" name="valor_venda" value="<?php print $row_venda->valor_venda; ?>" class="form-control" required>
    </div>
    <div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </div>
</form>