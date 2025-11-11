<h1>Editar Funcionário</h1>
<?php
    // Busca o funcionário no banco de dados usando o ID recebido via URL
    $sql = "SELECT * FROM funcionario WHERE id_funcionario = ".$_REQUEST["id"];
    $res = $conn->query($sql);
    $row = $res->fetch_object();
?>
<h1>Editar Funcionário</h1>
<form action="?page=salvar-funcionario" method="POST">
    <!-- Ação "editar" e o ID do funcionário são enviados de forma oculta -->
	<input type="hidden" name="acao" value="editar">
	<input type="hidden" name="id" value="<?php print $row->id_funcionario; ?>">

	<div class="mb-3">
		<label>Nome do Funcionário</label>
		<!-- O campo 'value' é preenchido com o dado atual do banco -->
		<input type="text" name="nome_funcionario" value="<?php print $row->nome_funcionario; ?>" class="form-control" required>
	</div>
    <div class="mb-3">
		<label>CPF</label>
		<input type="text" name="cpf_funcionario" value="<?php print $row->cpf_funcionario; ?>" class="form-control" required>
	</div>
	<div class="mb-3">
		<label>E-mail</label>
		<input type="email" name="email_funcionario" value="<?php print $row->email_funcionario; ?>" class="form-control">
	</div>
	<div class="mb-3">
		<label>Telefone</label>
		<input type="text" name="fone_funcionario" value="<?php print $row->fone_funcionario; ?>" class="form-control">
	</div>
	<div>
		<button type="submit" class="btn btn-primary">Salvar Alterações</button>
	</div>
</form>