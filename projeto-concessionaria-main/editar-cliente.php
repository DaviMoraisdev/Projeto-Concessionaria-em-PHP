<?php
// editar-cliente.php
// Busca o cliente com segurança e exibe o formulário de edição

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    echo "<script>alert('ID inválido.');location.href='?page=listar-cliente';</script>";
    exit;
}

$stmt = $conn->prepare("SELECT id_cliente, nome_cliente, cpf_cliente, email_cliente, telefone_cliente, data_nasc_cliente FROM cliente WHERE id_cliente = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_object();
$stmt->close();

if (!$row) {
    echo "<script>alert('Cliente não encontrado.');location.href='?page=listar-cliente';</script>";
    exit;
}
?>
<h1>Editar Cliente</h1>
<form action="?page=salvar-cliente" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id" value="<?= (int)$row->id_cliente ?>">

    <div class="mb-3">
        <label>Nome do Cliente</label>
        <input type="text" name="nome_cliente" value="<?= htmlspecialchars($row->nome_cliente ?? '') ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>CPF</label>
        <input type="text" name="cpf_cliente" value="<?= htmlspecialchars($row->cpf_cliente ?? '') ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>E-mail</label>
        <input type="email" name="email_cliente" value="<?= htmlspecialchars($row->email_cliente ?? '') ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Telefone</label>
        <!-- nome padronizado para telefone_cliente -->
        <input type="text" name="telefone_cliente" value="<?= htmlspecialchars($row->telefone_cliente ?? '') ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Data de Nascimento</label>
        <input type="date" name="data_nasc_cliente" value="<?= htmlspecialchars($row->data_nasc_cliente ?? '') ?>" class="form-control">
    </div>
    <div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </div>
</form>