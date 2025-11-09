<h1>Cadastrar Venda</h1>
<form action="?page=salvar-venda" method="POST">
    <input type="hidden" name="acao" values="cadastrar">
    <div class="mb-3">
        <label>Cliente
            <input type="text" name="cliente_venda" class="form-control">
        </label>
    </div>
    <div class="mb-3">
        <label>Funcionário
            <input type="text" name="funcionario_venda" class="form-control">
        </label>
    </div>
    <div class="mb-3">
        <label>Veículo
            <input type="text" name="veiculo_venda" class="form-control">
        </label>
    </div>
    <div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>