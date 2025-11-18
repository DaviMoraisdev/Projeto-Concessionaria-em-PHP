<?php
// Garante que 'acao' exista
$acao = $_REQUEST['acao'] ?? '';

switch ($acao) {
    case 'cadastrar':
        $nome = $_POST['nome_funcionario'] ?? '';
        $cpf = $_POST['cpf_funcionario'] ?? '';
        $email = $_POST['email_funcionario'] ?? '';
        $telefone = $_POST['telefone_funcionario'] ?? '';

        $stmt = $conn->prepare("INSERT INTO funcionario (nome_funcionario, cpf_funcionario, email_funcionario, telefone_funcionario) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $cpf, $email, $telefone);
        $ok = $stmt->execute();

        if ($ok) {
            echo "<script>alert('Cadastrou com sucesso!');location.href='?page=listar-funcionario';</script>";
        } else {
            $erro = addslashes($stmt->error ?: $conn->error);
            echo "<script>alert('Não cadastrou! Erro: " . $erro . "');location.href='?page/listar-funcionario';</script>";
        }
        $stmt->close();
        break;

    case 'editar':
        // Pega id enviado pelo formulário (name="id")
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

        if ($id <= 0) {
            echo "<script>alert('ID inválido para edição.');location.href='?page=listar-funcionario';</script>";
            exit;
        }

        $nome = $_POST['nome_funcionario'] ?? '';
        $cpf = $_POST['cpf_funcionario'] ?? '';
        $email = $_POST['email_funcionario'] ?? '';
        $telefone = $_POST['telefone_funcionario'] ?? '';

        $stmt = $conn->prepare("UPDATE funcionario SET nome_funcionario = ?, cpf_funcionario = ?, email_funcionario = ?, telefone_funcionario = ? WHERE id_funcionario = ?");
        $stmt->bind_param("ssssi", $nome, $cpf, $email, $telefone, $id);
        $ok = $stmt->execute();

        if ($ok) {
            echo "<script>alert('Editou com sucesso!');location.href='?page=listar-funcionario';</script>";
        } else {
            $erro = addslashes($stmt->error ?: $conn->error);
            echo "<script>alert('Não editou! Erro: " . $erro . "');location.href='?page=listar-funcionario';</script>";
        }
        $stmt->close();
        break;

    case 'excluir':
        // Aceita id via GET ou POST (listar envia via GET)
        $id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;

        if ($id <= 0) {
            echo "<script>alert('ID inválido para exclusão.');location.href='?page=listar-funcionario';</script>";
            exit;
        }

        $stmt = $conn->prepare("DELETE FROM funcionario WHERE id_funcionario = ?");
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();

        if ($ok) {
            echo "<script>alert('Excluiu com sucesso!');location.href='?page=listar-funcionario';</script>";
        } else {
            $erro = addslashes($stmt->error ?: $conn->error);
            echo "<script>alert('Não excluiu! Erro: " . $erro . "');location.href='?page/listar-funcionario';</script>";
        }
        $stmt->close();
        break;

    default:
        // Ação desconhecida: redireciona para listagem (opcional)
        echo "<script>location.href='?page=listar-funcionario';</script>";
        break;
}