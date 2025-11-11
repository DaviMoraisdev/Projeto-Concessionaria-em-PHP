<h1>Cadastrar Marca</h1>
<form action="?page=salvar-marca" method="POST">
	<input type="hidden" name="acao" value="cadastrar">
	<div class="mb-3">
		<label>Nome da Marca</label>
		<input type="text" name="nome_marca" class="form-control" required>
	</div>
	<div>
		<button type="submit" class="btn btn-primary">Enviar</button>
	</div>
</form>