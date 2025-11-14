<?php
// Ativa exibição de erros apenas para depuração (remova em produção)
ini_set('display_errors', 1);
error_reporting(E_ALL);

$acao = $_REQUEST['acao'] ?? '';

switch ($acao) {
    case 'cadastrar':
        // Pega e valida os dados (garante inteiros para FK)
        $cliente_id = isset($_POST['cliente_id_cliente']) ? (int)$_POST['cliente_id_cliente'] : 0;
        $funcionario_id = isset($_POST['funcionario_id_funcionario']) ? (int)$_POST['funcionario_id_funcionario'] : 0;
        $modelo_id = isset($_POST['modelo_id_modelo']) ? (int)$_POST['modelo_id_modelo'] : 0;
        $data = $_POST['data_venda'] ?? '';
        $valor = $_POST['valor_venda'] ?? '';

        if ($cliente_id <= 0 || $funcionario_id <= 0 || $modelo_id <= 0 || empty($data) || $valor === '') {
            echo "<script>alert('Preencha todos os campos corretamente.');location.href='?page=cadastrar-venda';</script>";
            exit;
        }

        // Verifica se os ids existem (previne erro de FK)
        $check = $conn->query("SELECT 1 FROM cliente WHERE id_cliente = {$cliente_id} LIMIT 1");
        if (!$check || $check->num_rows == 0) {
            echo "<script>alert('Cliente inválido.');location.href='?page=cadastrar-venda';</script>";
            exit;
        }
        $check = $conn->query("SELECT 1 FROM funcionario WHERE id_funcionario = {$funcionario_id} LIMIT 1");
        if (!$check || $check->num_rows == 0) {
            echo "<script>alert('Funcionário inválido.');location.href='?page=cadastrar-venda';</script>";
            exit;
        }
        $check = $conn->query("SELECT 1 FROM modelo WHERE id_modelo = {$modelo_id} LIMIT 1");
        if (!$check || $check->num_rows == 0) {
            echo "<script>alert('Modelo inválido.');location.href='?page=cadastrar-venda';</script>";
            exit;
        }

        // Insere usando prepared statement
        $stmt = $conn->prepare("INSERT INTO venda (cliente_id_cliente, funcionario_id_funcionario, modelo_id_modelo, data_venda, valor_venda) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            $erro = $conn->error;
            echo "<script>alert('Erro ao preparar a query: ". addslashes($erro) ."');location.href='?page=cadastrar-venda';</script>";
            exit;
        }
        // data_venda será string (formato YYYY-MM-DD), valor como float/decimal
        $valor_num = (float)$valor;
        $stmt->bind_param("iiisd", $cliente_id, $funcionario_id, $modelo_id, $data, $valor_num);
        $ok = $stmt->execute();

        if ($ok) {
            echo "<script>alert('Venda registrada com sucesso!');location.href='?page=listar-venda';</script>";
        } else {
            $erro = $stmt->error ? $stmt->error : $conn->error;
            echo "<script>alert('Erro ao registrar a venda: ". addslashes($erro) ."');location.href='?page=cadastrar-venda';</script>";
        }

        $stmt->close();
        break;

    case 'editar':
        // (Se quiser implementar edição, certifique-se de validar e usar prepared statements)
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        if ($id <= 0) {
            echo "<script>alert('ID inválido para edição.');location.href='?page=listar-venda';</script>";
            exit;
        }
        $cliente_id = isset($_POST['cliente_id_cliente']) ? (int)$_POST['cliente_id_cliente'] : 0;
        $funcionario_id = isset($_POST['funcionario_id_funcionario']) ? (int)$_POST['funcionario_id_funcionario'] : 0;
        $modelo_id = isset($_POST['modelo_id_modelo']) ? (int)$_POST['modelo_id_modelo'] : 0;
        $data = $_POST['data_venda'] ?? '';
        $valor = $_POST['valor_venda'] ?? '';

        if ($cliente_id <= 0 || $funcionario_id <= 0 || $modelo_id <= 0 || empty($data) || $valor === '') {
            echo "<script>alert('Preencha todos os campos corretamente.');location.href='?page=editar-venda&id={$id}';</script>";
            exit;
        }

        $stmt = $conn->prepare("UPDATE venda SET cliente_id_cliente = ?, funcionario_id_funcionario = ?, modelo_id_modelo = ?, data_venda = ?, valor_venda = ? WHERE id_venda = ?");
        if (!$stmt) {
            $erro = $conn->error;
            echo "<script>alert('Erro ao preparar a query: ". addslashes($erro) ."');location.href='?page=editar-venda&id={$id}';</script>";
            exit;
        }
        $valor_num = (float)$valor;
        $stmt->bind_param("iiisdi", $cliente_id, $funcionario_id, $modelo_id, $data, $valor_num, $id);
        $ok = $stmt->execute();

        if ($ok) {
            echo "<script>alert('Venda editada com sucesso!');location.href='?page=listar-venda';</script>";
        } else {
            $erro = $stmt->error ? $stmt->error : $conn->error;
            echo "<script>alert('Erro ao editar a venda: ". addslashes($erro) ."');location.href='?page=editar-venda&id={$id}';</script>";
        }
        $stmt->close();
        break;

    case 'excluir':
        $id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;
        if ($id <= 0) {
            echo "<script>alert('ID inválido para exclusão.');location.href='?page=listar-venda';</script>";
            exit;
        }
        $stmt = $conn->prepare("DELETE FROM venda WHERE id_venda = ?");
        if (!$stmt) {
            $erro = $conn->error;
            echo "<script>alert('Erro ao preparar exclusão: ". addslashes($erro) ."');location.href='?page=listar-venda';</script>";
            exit;
        }
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        if ($ok) {
            echo "<script>alert('Venda excluída com sucesso!');location.href='?page=listar-venda';</script>";
        } else {
            $erro = $stmt->error ? $stmt->error : $conn->error;
            echo "<script>alert('Erro ao excluir venda: ". addslashes($erro) ."');location.href='?page=listar-venda';</script>";
        }
        $stmt->close();
        break;

    default:
        header("Location: ?page=listar-venda");
        exit;
}