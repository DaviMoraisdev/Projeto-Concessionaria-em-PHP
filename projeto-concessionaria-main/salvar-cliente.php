<?php
switch ($_REQUEST['acao']) {
    case 'cadastrar':
        $nome = $_POST['nome_cliente'];
        $cpf = $_POST['cpf_cliente'];
        $email = $_POST['email_cliente'];
        $fone = $_POST['fone_cliente'];
        $data_nasc = $_POST['data_nasc_cliente'];

        $sql = "INSERT INTO cliente (nome_cliente, cpf_cliente, email_cliente, fone_cliente, data_nasc_cliente) 
                VALUES ('{$nome}', '{$cpf}', '{$email}', '{$fone}', '{$data_nasc}')";

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Cliente cadastrado com sucesso!');</script>";
            print "<script>location.href='?page=listar-cliente';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar o cliente.');</script>";
            print "<script>location.href='?page=listar-cliente';</script>";
        }
        break;

    case 'editar':
        $nome = $_POST['nome_cliente'];
        $cpf = $_POST['cpf_cliente'];
        $email = $_POST['email_cliente'];
        $fone = $_POST['fone_cliente'];
        $data_nasc = $_POST['data_nasc_cliente'];

        $sql = "UPDATE cliente SET
                    nome_cliente='{$nome}',
                    cpf_cliente='{$cpf}',
                    email_cliente='{$email}',
                    fone_cliente='{$fone}',
                    data_nasc_cliente='{$data_nasc}'
                WHERE id_cliente=" . $_POST['id'];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Cliente editado com sucesso!');</script>";
            print "<script>location.href='?page=listar-cliente';</script>";
        } else {
            print "<script>alert('Não foi possível editar o cliente.');</script>";
            print "<script>location.href='?page=listar-cliente';</script>";
        }
        break;

    case 'excluir':
        $sql = "DELETE FROM cliente WHERE id_cliente=" . $_REQUEST['id'];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Cliente excluído com sucesso!');</script>";
            print "<script>location.href='?page=listar-cliente';</script>";
        } else {
            print "<script>alert('Não foi possível excluir o cliente.');</script>";
            print "<script>location.href='?page=listar-cliente';</script>";
        }
        break;
}