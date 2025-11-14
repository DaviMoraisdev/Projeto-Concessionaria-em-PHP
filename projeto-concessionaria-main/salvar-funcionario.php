<?php
    // Garante que 'acao' exista
    $acao = $_REQUEST['acao'] ?? '';

    switch ($acao) {
        case 'cadastrar':
            $nome = $_POST['nome_funcionario'] ?? '';
            $cpf = $_POST['cpf_funcionario'] ?? '';
            $email = $_POST['email_funcionario'] ?? '';
            $telefone = $_POST['telefone_funcionario'] ?? '';

            // Ajuste: inclui cpf (se a coluna existir no banco)
            $sql = "INSERT INTO funcionario (nome_funcionario, cpf_funcionario, email_funcionario, telefone_funcionario) VALUES ('{$nome}', '{$cpf}', '{$email}', '{$telefone}')";

            $res = $conn->query($sql);

            if ($res == true) {
                print "<script>alert('Cadastrou com sucesso!');</script>";
                print "<script>location.href='?page=listar-funcionario';</script>";
            } else {
                $erro = $conn->error;
                print "<script>alert('Não cadastrou! Erro: " . addslashes($erro) . "');</script>";
                print "<script>location.href='?page=listar-funcionario';</script>";
            }
            break;

        case 'editar':
            // Pega id enviado pelo formulário (name="id")
            $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

            if ($id <= 0) {
                print "<script>alert('ID inválido para edição.');</script>";
                print "<script>location.href='?page=listar-funcionario';</script>";
                exit;
            }

            $nome = $_POST['nome_funcionario'] ?? '';
            $cpf = $_POST['cpf_funcionario'] ?? '';
            $email = $_POST['email_funcionario'] ?? '';
            $telefone = $_POST['telefone_funcionario'] ?? '';

            // Atualiza inclusive o CPF
            $sql = "UPDATE funcionario SET
                        nome_funcionario='{$nome}',
                        cpf_funcionario='{$cpf}',
                        email_funcionario='{$email}',
                        telefone_funcionario='{$telefone}'
                    WHERE id_funcionario = {$id}";

            $res = $conn->query($sql);

            if ($res == true) {
                print "<script>alert('Editou com sucesso!');</script>";
                print "<script>location.href='?page=listar-funcionario';</script>";
            } else {
                $erro = $conn->error;
                print "<script>alert('Não editou! Erro: " . addslashes($erro) . "');</script>";
                print "<script>location.href='?page=listar-funcionario';</script>";
            }
            break;

        case 'excluir':
            // Aceita id via GET ou POST (listar envia via GET)
            $id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;

            if ($id <= 0) {
                print "<script>alert('ID inválido para exclusão.');</script>";
                print "<script>location.href='?page=listar-funcionario';</script>";
                exit;
            }

            $sql = "DELETE FROM funcionario WHERE id_funcionario = {$id}";

            $res = $conn->query($sql);

            if ($res == true) {
                print "<script>alert('Excluiu com sucesso!');</script>";
                print "<script>location.href='?page=listar-funcionario';</script>";
            } else {
                $erro = $conn->error;
                print "<script>alert('Não excluiu! Erro: " . addslashes($erro) . "');</script>";
                print "<script>location.href='?page=listar-funcionario';</script>";
            }
            break;

        default:
            // Ação desconhecida: redireciona para listagem (opcional)
            print "<script>location.href='?page=listar-funcionario';</script>";
            break;
    }