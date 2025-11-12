<?php
switch ($_REQUEST['acao']) {
    case 'cadastrar':
        $nome = $_POST['nome_cliente'];
        $cpf = $_POST['cpf_cliente'];
        $email = $_POST['email_cliente'];
        $telefone = $_POST['telefone_cliente']; // Corrigido de 'fone_cliente'
        $data_nasc = $_POST['data_nasc_cliente'];

        // Corrigido 'fone_cliente' para 'telefone_cliente' na query
        $sql = "INSERT INTO cliente (nome_cliente, cpf_cliente, email_cliente, telefone_cliente, data_nasc_cliente) 
                VALUES ('{$nome}', '{$cpf}', '{$email}', '{$telefone}', '{$data_nasc}')";

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
        $telefone = $_POST['telefone_cliente']; // Corrigido de 'fone_cliente'
        $data_nasc = $_POST['data_nasc_cliente'];

        // Corrigido 'fone_cliente' para 'telefone_cliente' na query
        $sql = "UPDATE cliente SET
                    nome_cliente='{$nome}',
                    cpf_cliente='{$cpf}',
                    email_cliente='{$email}',
                    telefone_cliente='{$telefone}',
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