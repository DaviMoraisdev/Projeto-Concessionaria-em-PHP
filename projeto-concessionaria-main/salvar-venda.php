<?php
switch ($_REQUEST['acao']) {
    case 'cadastrar':
        $cliente_id = $_POST['cliente_id_cliente'];
        $funcionario_id = $_POST['funcionario_id_funcionario'];
        $modelo_id = $_POST['modelo_id_modelo'];
        $data = $_POST['data_venda'];
        $valor = $_POST['valor_venda'];

        $sql = "INSERT INTO venda (cliente_id_cliente, funcionario_id_funcionario, modelo_id_modelo, data_venda, valor_venda) 
                VALUES ('{$cliente_id}', '{$funcionario_id}', '{$modelo_id}', '{$data}', '{$valor}')";

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Venda registrada com sucesso!');</script>";
            print "<script>location.href='?page=listar-venda';</script>";
        } else {
            print "<script>alert('Não foi possível registrar a venda.');</script>";
            print "<script>location.href='?page=listar-venda';</script>";
        }
        break;

    case 'editar':
        $cliente_id = $_POST['cliente_id_cliente'];
        $funcionario_id = $_POST['funcionario_id_funcionario'];
        $modelo_id = $_POST['modelo_id_modelo'];
        $data = $_POST['data_venda'];
        $valor = $_POST['valor_venda'];

        $sql = "UPDATE venda SET
                    cliente_id_cliente='{$cliente_id}',
                    funcionario_id_funcionario='{$funcionario_id}',
                    modelo_id_modelo='{$modelo_id}',
                    data_venda='{$data}',
                    valor_venda='{$valor}'
                WHERE id_venda=" . $_POST['id'];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Venda editada com sucesso!');</script>";
            print "<script>location.href='?page=listar-venda';</script>";
        } else {
            print "<script>alert('Não foi possível editar a venda.');</script>";
            print "<script>location.href='?page=listar-venda';</script>";
        }
        break;

    case 'excluir':
        $sql = "DELETE FROM venda WHERE id_venda=" . $_REQUEST['id'];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Venda excluída com sucesso!');</script>";
            print "<script>location.href='?page=listar-venda';</script>";
        } else {
            print "<script>alert('Não foi possível excluir a venda.');</script>";
            print "<script>location.href='?page=listar-venda';</script>";
        }
        break;
}