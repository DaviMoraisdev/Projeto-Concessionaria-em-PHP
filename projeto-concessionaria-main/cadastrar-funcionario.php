<h1>Cadastrar Funcionário</h1>
<form action="?page=salvar-funcionario" method="POST">
	
    <!-- CORREÇÃO: trocado 'values' por 'value' -->
	<input type="hidden" name="acao" value="cadastrar">

	<div class="mb-3">
		<label for="nome_funcionario">Nome</label>
		<input type="text" name="nome_funcionario" id="nome_funcionario" class="form-control" required>
	</div>

    <!-- CAMPO CPF ADICIONADO -->
    <div class="mb-3">
		<label for="cpf_funcionario">CPF</label>
		<input type="text" name="cpf_funcionario" id="cpf_funcionario" class="form-control" required>
	</div>

	<div class="mb-3">
		<label for="email_funcionario">E-mail</label>
		<input type="email" name="email_funcionario" id="email_funcionario" class="form-control" required>
	</div>

	<div class="mb-3">
		<label for="telefone_funcionario">Telefone</label>
		<input type="text" name="telefone_funcionario" id="telefone_funcionario" class="form-control">
	</div>

	<div class="mb-3">
		<button type="submit" class="btn btn-primary">Enviar</button>
	</div>
</form>