<?php
switch ($_REQUEST['acao']) {
    case 'cadastrar':
        $nome = $_POST['nome_marca'];

        $sql = "INSERT INTO marca (nome_marca) VALUES ('{$nome}')";

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Marca cadastrada com sucesso!');</script>";
            print "<script>location.href='?page=listar-marca';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar a marca.');</script>";
            print "<script>location.href='?page=listar-marca';</script>";
        }
        break;

    case 'editar':
        $nome = $_POST['nome_marca'];

        $sql = "UPDATE marca SET nome_marca='{$nome}' WHERE id_marca=" . $_POST['id'];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Marca editada com sucesso!');</script>";
            print "<script>location.href='?page=listar-marca';</script>";
        } else {
            print "<script>alert('Não foi possível editar a marca.');</script>";
            print "<script>location.href='?page=listar-marca';</script>";
        }
        break;

    case 'excluir':
        // CUIDADO: Idealmente, você não deve poder excluir uma marca se existirem modelos associados a ela.
        $sql = "DELETE FROM marca WHERE id_marca=" . $_REQUEST['id'];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Marca excluída com sucesso!');</script>";
            print "<script>location.href='?page=listar-marca';</script>";
        } else {
            print "<script>alert('Não foi possível excluir a marca. Verifique se existem modelos vinculados a ela.');</script>";
            print "<script>location.href='?page=listar-marca';</script>";
        }
        break;
}