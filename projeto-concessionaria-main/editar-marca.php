<h1>Editar Marca</h1>
<?php
    $sql = "SELECT * FROM marca WHERE id_marca = " . $_REQUEST['id'];
    $res = $conn->query($sql);
    $row = $res->fetch_object();
?>

<!-- O formulário fica limpo, apenas exibindo os dados -->
<form action="?page=salvar-marca" method="POST">
    <!-- Ação 'editar' para o switch em salvar-marca.php -->
    <input type="hidden" name="acao" value="editar">
    
    <!-- 4. Corrigir o nome do campo oculto para 'id' -->
    <input type="hidden" name="id" value="<?php print $row->id_marca; ?>">
    
    <div class="mb-3">
        <label>Nome da Marca</label>
        <!-- Apenas imprime a variável que já foi buscada no topo -->
        <input type="text" name="nome_marca" value="<?php print $row->nome_marca; ?>" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>