<div class="row">
    <div class="col-md-12">
        <hr>
        <?php
            $dominio = $_GET['dominio'];
            $marca   = $_GET['marca'];
            $modelo  = $_GET['modelo'];
            $titular = $_GET['titular'];
        ?>
        <h5>PATENTE DEL VEHICULO: <?= $dominio; ?></h5>
        <h5>Marca: <?= $marca; ?></h5>
        <h5>Modelo: <?= $modelo; ?></h5>
        <h5>TITULAR: <?= $titular; ?></h5>
        <hr>
        <h4>Eliminar Vehiculo?</h4>
        <form action="/vehiculo/eliminar/" method="post">
            <input type="hidden" name="dominio" value="<?= $dominio; ?>" readonly>
            <button type="submit" class="btn btn-danger pull-left" name="eliminar">Eliminar</button>
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>

        </form>
    </div>
</div>