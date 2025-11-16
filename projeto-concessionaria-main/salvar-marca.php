<?php
$acao = $_REQUEST['acao'] ?? '';

switch ($acao) {
    case 'cadastrar':
        $nome = $_POST['nome_marca'] ?? '';

        $stmt = $conn->prepare("INSERT INTO marca (nome_marca) VALUES (?)");
        $stmt->bind_param("s", $nome);
        $ok = $stmt->execute();

        if ($ok) {
            echo "<script>alert('Marca cadastrada com sucesso!');location.href='?page=listar-marca';</script>";
        } else {
            $erro = addslashes($stmt->error ?: $conn->error);
            echo "<script>alert('Não foi possível cadastrar a marca. Erro: {$erro}');location.href='?page=listar-marca';</script>";
        }
        $stmt->close();
        break;

    case 'editar':
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        if ($id <= 0) {
            echo "<script>alert('ID inválido para edição.');location.href='?page=listar-marca';</script>";
            exit;
        }

        $nome = $_POST['nome_marca'] ?? '';

        $stmt = $conn->prepare("UPDATE marca SET nome_marca = ? WHERE id_marca = ?");
        $stmt->bind_param("si", $nome, $id);
        $ok = $stmt->execute();

        if ($ok) {
            echo "<script>alert('Marca editada com sucesso!');location.href='?page=listar-marca';</script>";
        } else {
            $erro = addslashes($stmt->error ?: $conn->error);
            echo "<script>alert('Não foi possível editar a marca. Erro: {$erro}');location.href='?page=listar-marca';</script>";
        }
        $stmt->close();
        break;

    case 'excluir':
        // Pega o id de forma segura (aceita GET/POST)
        $id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;
        if ($id <= 0) {
            echo "<script>alert('ID inválido para exclusão.');location.href='?page=listar-marca';</script>";
            exit;
        }

        // Verifica se existem modelos ligados a essa marca
        $checkStmt = $conn->prepare("SELECT COUNT(*) AS qtd FROM modelo WHERE marca_id_marca = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
        $row = $result->fetch_object();
        $qtd = (int)($row->qtd ?? 0);
        $checkStmt->close();

        if ($qtd > 0) {
            echo "<script>alert('Não é possível excluir: existem {$qtd} modelo(s) vinculados a esta marca. Primeiro exclua ou altere esses modelos.');location.href='?page=listar-marca';</script>";
            exit;
        }

        // Não há dependentes -> pode excluir com segurança
        $delStmt = $conn->prepare("DELETE FROM marca WHERE id_marca = ?");
        $delStmt->bind_param("i", $id);
        $ok = $delStmt->execute();

        if ($ok) {
            echo "<script>alert('Marca excluída com sucesso!');location.href='?page=listar-marca';</script>";
        } else {
            $erro = addslashes($delStmt->error ?: $conn->error);
            echo "<script>alert('Não foi possível excluir a marca. Erro: {$erro}');location.href='?page=listar-marca';</script>";
        }
        $delStmt->close();
        break;

    default:
        // Ação desconhecida: redireciona para listagem
        header("Location: ?page=listar-marca");
        exit;
}