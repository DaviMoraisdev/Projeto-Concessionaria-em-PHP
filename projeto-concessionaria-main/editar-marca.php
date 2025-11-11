<h1>Editar Marca</h1>
<form action="?page=salvar-marca" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id_marca" value="<?php echo $_GET['id_marca']; ?>">
    <div class="mb-3">
        <label>Nome
            <input type="text" name="nome_marca" class="form-control" value="<?php
                $sql = "SELECT * FROM marcas WHERE id_marca=".$_GET['id_marca'];
                $res = $conn->query($sql);
                $row = $res->fetch_object();
                echo $row->nome_marca;
            ?>">
        </label>
    </div>
    <div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>