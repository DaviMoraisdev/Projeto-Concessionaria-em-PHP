<?php
// salvar-cliente.php
$acao = $_REQUEST['acao'] ?? '';

switch ($acao) {
    case 'cadastrar':
        $nome = $_POST['nome_cliente'] ?? '';
        $cpf = $_POST['cpf_cliente'] ?? '';
        $email = $_POST['email_cliente'] ?? '';
        $telefone = $_POST['telefone_cliente'] ?? null;
        $data_nasc = $_POST['data_nasc_cliente'] ?? null;

        $stmt = $conn->prepare("INSERT INTO cliente (nome_cliente, cpf_cliente, email_cliente, telefone_cliente, data_nasc_cliente) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nome, $cpf, $email, $telefone, $data_nasc);
        $ok = $stmt->execute();

        if ($ok) {
            echo "<script>alert('Cliente cadastrado com sucesso!');location.href='?page=listar-cliente';</script>";
        } else {
            $erro = addslashes($stmt->error ?: $conn->error);
            echo "<script>alert('Não foi possível cadastrar o cliente. Erro: {$erro}');location.href='?page=cadastrar-cliente';</script>";
        }
        $stmt->close();
        break;

    case 'editar':
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        if ($id <= 0) {
            echo "<script>alert('ID inválido para edição.');location.href='?page=listar-cliente';</script>";
            exit;
        }

        $nome = $_POST['nome_cliente'] ?? '';
        $cpf = $_POST['cpf_cliente'] ?? '';
        $email = $_POST['email_cliente'] ?? '';
        $telefone = $_POST['telefone_cliente'] ?? null;
        $data_nasc = $_POST['data_nasc_cliente'] ?? null;

        $stmt = $conn->prepare("UPDATE cliente SET nome_cliente = ?, cpf_cliente = ?, email_cliente = ?, telefone_cliente = ?, data_nasc_cliente = ? WHERE id_cliente = ?");
        $stmt->bind_param("sssssi", $nome, $cpf, $email, $telefone, $data_nasc, $id);
        $ok = $stmt->execute();

        if ($ok) {
            echo "<script>alert('Cliente editado com sucesso!');location.href='?page=listar-cliente';</script>";
        } else {
            $erro = addslashes($stmt->error ?: $conn->error);
            echo "<script>alert('Não foi possível editar o cliente. Erro: {$erro}');location.href='?page=editar-cliente&id={$id}';</script>";
        }
        $stmt->close();
        break;

    case 'excluir':
        $id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;
        if ($id <= 0) {
            echo "<script>alert('ID inválido para exclusão.');location.href='?page=listar-cliente';</script>";
            exit;
        }

        // Verifica se existem vendas ligadas a esse cliente
        $check = $conn->prepare("SELECT COUNT(*) AS qtd FROM venda WHERE cliente_id_cliente = ?");
        $check->bind_param("i", $id);
        $check->execute();
        $result = $check->get_result();
        $row = $result->fetch_object();
        $qtd = (int)($row->qtd ?? 0);
        $check->close();

        if ($qtd > 0) {
            echo "<script>alert('Não é possível excluir: existem {$qtd} venda(s) vinculada(s) a este cliente. Exclua ou reatribua essas vendas antes.');location.href='?page=listar-cliente';</script>";
            exit;
        }

        // Sem dependentes -> pode excluir
        $del = $conn->prepare("DELETE FROM cliente WHERE id_cliente = ?");
        $del->bind_param("i", $id);
        $ok = $del->execute();

        if ($ok) {
            echo "<script>alert('Cliente excluído com sucesso!');location.href='?page=listar-cliente';</script>";
        } else {
            $erro = addslashes($del->error ?: $conn->error);
            echo "<script>alert('Não foi possível excluir o cliente. Erro: {$erro}');location.href='?page=listar-cliente';</script>";
        }
        $del->close();
        break;

    default:
        header("Location: ?page=listar-cliente");
        exit;
}