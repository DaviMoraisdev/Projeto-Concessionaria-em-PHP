<h1>Cadastrar Cliente</h1>
<form action="?page=salvar-cliente" method="POST">
	<input type="hidden" name="acao" value="cadastrar">
	<div class="mb-3">
		<label>Nome do Cliente</label>
		<input type="text" name="nome_cliente" class="form-control" required>
	</div>
	<div class="mb-3">
		<label>CPF</label>
		<input type="text" name="cpf_cliente" class="form-control" required>
	</div>
	<div class="mb-3">
		<label>E-mail</label>
		<input type="email" name="email_cliente" class="form-control">
	</div>
	<div class="mb-3">
		<label>Telefone</label>
		<input type="text" name="telefone_cliente" class="form-control">
	</div>
    <div class="mb-3">
		<label>Data de Nascimento</label>
		<input type="date" name="data_nasc_cliente" class="form-control">
	</div>
	<div>
		<button type="submit" class="btn btn-primary">Enviar</button>
	</div>
</form>