<h1>Editar Modelo</h1>
<?php
    $sql = "SELECT * FROM modelo WHERE id_modelo = ".$_REQUEST["id"];
    $res = $conn->query($sql);
    $row_modelo = $res->fetch_object();
?>
<h1>Editar Modelo de Veículo</h1>
<form action="?page=salvar-modelo" method="POST">
	<input type="hidden" name="acao" value="editar">
	<input type="hidden" name="id" value="<?php print $row_modelo->id_modelo; ?>">

    <div class="mb-3">
		<label>Marca do Veículo</label>
		<select name="marca_id_marca" class="form-control" required>
			<option>-Selecione a Marca-</option>
			<?php
				$sql_marcas = "SELECT * FROM marca";
				$res_marcas = $conn->query($sql_marcas);
				while($row_marca = $res_marcas->fetch_object()){
                    // Adiciona o atributo 'selected' se o ID da marca for igual ao do modelo
                    $selected = ($row_marca->id_marca == $row_modelo->marca_id_marca) ? 'selected' : '';
					print "<option value='".$row_marca->id_marca."' ".$selected.">".$row_marca->nome_marca."</option>";
				}
			?>
		</select>
	</div>
	<div class="mb-3">
		<label>Nome do Modelo</label>
		<input type="text" name="nome_modelo" value="<?php print $row_modelo->nome_modelo; ?>" class="form-control" required>
	</div>
	<div class="mb-3">
		<label>Cor</label>
		<input type="text" name="cor_modelo" value="<?php print $row_modelo->cor_modelo; ?>" class="form-control">
	</div>
	<div class="mb-3">
		<label>Ano</label>
		<input type="number" name="ano_modelo" value="<?php print $row_modelo->ano_modelo; ?>" class="form-control">
	</div>
    <div class="mb-3">
		<label>Placa</label>
		<input type="text" name="placa_modelo" value="<?php print $row_modelo->placa_modelo; ?>" class="form-control" required>
	</div>
	<div>
		<button type="submit" class="btn btn-primary">Salvar Alterações</button>
	</div>
</form>