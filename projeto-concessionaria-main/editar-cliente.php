<h1>Editar Cliente</h1>
<?php
    $sql = "SELECT * FROM cliente WHERE id_cliente = ".$_REQUEST["id"];
    $res = $conn->query($sql);
    $row = $res->fetch_object();
?>
<h1>Editar Cliente</h1>
<form action="?page=salvar-cliente" method="POST">
	<input type="hidden" name="acao" value="editar">
	<input type="hidden" name="id" value="<?php print $row->id_cliente; ?>">

	<div class="mb-3">
		<label>Nome do Cliente</label>
		<input type="text" name="nome_cliente" value="<?php print $row->nome_cliente; ?>" class="form-control" required>
	</div>
	<div class="mb-3">
		<label>CPF</label>
		<input type="text" name="cpf_cliente" value="<?php print $row->cpf_cliente; ?>" class="form-control" required>
	</div>
	<div class="mb-3">
		<label>E-mail</label>
		<input type="email" name="email_cliente" value="<?php print $row->email_cliente; ?>" class="form-control">
	</div>
	<div class="mb-3">
		<label>Telefone</label>
		<input type="text" name="telefone_cliente" value="<?php print $row->fone_cliente; ?>" class="form-control">
	</div>
    <div class="mb-3">
		<label>Data de Nascimento</label>
		<input type="date" name="data_nasc_cliente" value="<?php print $row->data_nasc_cliente; ?>" class="form-control">
	</div>
	<div>
		<button type="submit" class="btn btn-primary">Salvar Alterações</button>
	</div>
</form>