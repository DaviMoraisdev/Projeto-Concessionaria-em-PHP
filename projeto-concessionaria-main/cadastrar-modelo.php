<h1>Cadastrar Modelo de Veículo</h1>
<form action="?page=salvar-modelo" method="POST">
	<input type="hidden" name="acao" value="cadastrar">
    <div class="mb-3">
		<label>Marca do Veículo</label>
		<select name="marca_id_marca" class="form-control" required>
			<option value="">- Selecione a Marca -</option>
			<?php
				// Código descomentado para buscar as marcas
				$sql = "SELECT * FROM marca ORDER BY nome_marca ASC";
				$res = $conn->query($sql);
				
                // Verifica se encontrou alguma marca
				if ($res->num_rows > 0) {
                    // Loop para criar uma <option> para cada marca encontrada
					while($row = $res->fetch_object()){
						print "<option value='".$row->id_marca."'>".$row->nome_marca."</option>";
					}
				} else {
                    print "<option>Nenhuma marca cadastrada</option>";
                }
			?>
		</select>
	</div>
	<div class="mb-3">
		<label>Nome do Modelo</label>
		<input type="text" name="nome_modelo" class="form-control" required>
	</div>
	<div class="mb-3">
		<label>Cor</label>
		<input type="text" name="cor_modelo" class="form-control">
	</div>
	<div class="mb-3">
		<label>Ano</label>
		<input type="number" name="ano_modelo" class="form-control">
	</div>
    <div class="mb-3">
		<label>Placa</label>
		<input type="text" name="placa_modelo" class="form-control" required>
	</div>
	<div class="mb-3">
		<button type="submit" class="btn btn-primary">Enviar</button>
	</div>
</form>