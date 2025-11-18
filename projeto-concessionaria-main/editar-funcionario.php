<?php
// Busca o funcionario com segurança usando prepared statement e validação do id
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    echo "<script>alert('ID inválido.');location.href='?page=listar-funcionario';</script>";
    exit;
}

$stmt = $conn->prepare("SELECT id_funcionario, nome_funcionario, cpf_funcionario, email_funcionario, telefone_funcionario FROM funcionario WHERE id_funcionario = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_object();
$stmt->close();

if (!$row) {
    echo "<script>alert('Funcionário não encontrado.');location.href='?page=listar-funcionario';</script>";
    exit;
}
?>

<h1>Editar Funcionário</h1>
<form action="?page=salvar-funcionario" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id" value="<?= (int)$row->id_funcionario ?>">

    <div class="mb-3">
        <label>Nome do Funcionário</label>
        <input type="text" name="nome_funcionario" value="<?= htmlspecialchars($row->nome_funcionario ?? '') ?>" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>CPF</label>
        <input type="text" name="cpf_funcionario" value="<?= htmlspecialchars($row->cpf_funcionario ?? '') ?>" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>E-mail</label>
        <input type="email" name="email_funcionario" value="<?= htmlspecialchars($row->email_funcionario ?? '') ?>" class="form-control">
    </div>

    <div class="mb-3">
        <label>Telefone</label>
        <!-- Nome do campo padronizado para 'telefone_funcionario' -->
        <input type="text" name="telefone_funcionario" value="<?= htmlspecialchars($row->telefone_funcionario ?? '') ?>" class="form-control">
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </div>
</form>