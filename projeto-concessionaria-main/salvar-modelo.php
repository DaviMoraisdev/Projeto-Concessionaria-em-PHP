<?php
switch ($_REQUEST['acao']) {
    case 'cadastrar':
        $marca_id = $_POST['marca_id_marca'];
        $nome = $_POST['nome_modelo'];
        $cor = $_POST['cor_modelo'];
        $ano = $_POST['ano_modelo'];
        $placa = $_POST['placa_modelo'];

        $sql = "INSERT INTO modelo (marca_id_marca, nome_modelo, cor_modelo, ano_modelo, placa_modelo) 
                VALUES ('{$marca_id}', '{$nome}', '{$cor}', '{$ano}', '{$placa}')";

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Modelo cadastrado com sucesso!');</script>";
            print "<script>location.href='?page=listar-modelo';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar o modelo.');</script>";
            print "<script>location.href='?page=listar-modelo';</script>";
        }
        break;

    case 'editar':
        $marca_id = $_POST['marca_id_marca'];
        $nome = $_POST['nome_modelo'];
        $cor = $_POST['cor_modelo'];
        $ano = $_POST['ano_modelo'];
        $placa = $_POST['placa_modelo'];

        $sql = "UPDATE modelo SET
                    marca_id_marca='{$marca_id}',
                    nome_modelo='{$nome}',
                    cor_modelo='{$cor}',
                    ano_modelo='{$ano}',
                    placa_modelo='{$placa}'
                WHERE id_modelo=" . $_POST['id'];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Modelo editado com sucesso!');</script>";
            print "<script>location.href='?page=listar-modelo';</script>";
        } else {
            print "<script>alert('Não foi possível editar o modelo.');</script>";
            print "<script>location.href='?page=listar-modelo';</script>";
        }
        break;

    case 'excluir':
        // CUIDADO: Não se deve poder excluir um modelo se ele estiver em uma venda.
        $sql = "DELETE FROM modelo WHERE id_modelo=" . $_REQUEST['id'];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Modelo excluído com sucesso!');</script>";
            print "<script>location.href='?page=listar-modelo';</script>";
        } else {
            print "<script>alert('Não foi possível excluir. Verifique se o modelo está vinculado a uma venda.');</script>";
            print "<script>location.href='?page=listar-modelo';</script>";
        }
        break;
}