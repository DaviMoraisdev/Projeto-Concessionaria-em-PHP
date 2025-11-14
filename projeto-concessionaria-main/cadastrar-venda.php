<h1>Cadastrar Venda</h1>

<form action="?page=salvar-venda" method="POST">
    <input type="hidden" name="acao" value="cadastrar">

    <div class="mb-3">
        <label>Cliente</label>
        <select name="cliente_id_cliente" class="form-control" required>
            <option value="">- Selecione o cliente -</option>
            <?php
                $sql = "SELECT id_cliente, nome_cliente FROM cliente ORDER BY nome_cliente";
                $res = $conn->query($sql);
                if ($res && $res->num_rows > 0) {
                    while ($c = $res->fetch_object()) {
                        echo "<option value='{$c->id_cliente}'>" . htmlspecialchars($c->nome_cliente) . "</option>";
                    }
                } else {
                    echo "<option value=''>Nenhum cliente cadastrado</option>";
                }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Funcionário</label>
        <select name="funcionario_id_funcionario" class="form-control" required>
            <option value="">- Selecione o funcionário -</option>
            <?php
                $sql = "SELECT id_funcionario, nome_funcionario FROM funcionario ORDER BY nome_funcionario";
                $res = $conn->query($sql);
                if ($res && $res->num_rows > 0) {
                    while ($f = $res->fetch_object()) {
                        echo "<option value='{$f->id_funcionario}'>" . htmlspecialchars($f->nome_funcionario) . "</option>";
                    }
                } else {
                    echo "<option value=''>Nenhum funcionário cadastrado</option>";
                }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Veículo (Marca - Modelo)</label>
        <select name="modelo_id_modelo" class="form-control" required>
            <option value="">- Selecione o veículo -</option>
            <?php
                // Busca modelo com a marca para exibir "Marca - Modelo"
                $sql = "SELECT M.id_modelo, M.nome_modelo, MA.nome_marca 
                        FROM modelo AS M 
                        LEFT JOIN marca AS MA ON M.marca_id_marca = MA.id_marca
                        ORDER BY MA.nome_marca, M.nome_modelo";
                $res = $conn->query($sql);
                if ($res && $res->num_rows > 0) {
                    while ($m = $res->fetch_object()) {
                        $label = trim(($m->nome_marca ?? '') . ' - ' . ($m->nome_modelo ?? ''));
                        echo "<option value='{$m->id_modelo}'>" . htmlspecialchars($label) . "</option>";
                    }
                } else {
                    echo "<option value=''>Nenhum modelo cadastrado</option>";
                }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Data da Venda</label>
        <input type="date" name="data_venda" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Valor da Venda (ex.: 10000.00)</label>
        <input type="number" step="0.01" name="valor_venda" class="form-control" required>
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>