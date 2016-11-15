<?php include('navbar.php'); ?>
<div class="container">
    <div class="bg"></div>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 lower-box box-primary">
            <h3 class="text-center">Registro de Vehiculo</h3>
            <hr>
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">DNI DEL TITULAR</h3>
                            </div>
                            <div class="panel-body">
                                <input type="text" name="dni" value="<?php echo $titular->getDni(); ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">NOMBRE</h3>
                            </div>
                            <div class="panel-body">
                                <?php echo $titular->getNombre() . ' ' . $titular->getApellido(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                <form method='POST' action="/vehiculo/darAltaVehiculo/">
                    <div class="form-group">
                        <label for="patente">Patente</label>
                        <input type="text" name="patente" class="form-control" id="patente"
                               title="..." maxlength="50" data-toggle="tooltip" data-placement="right"
                               autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="marca">Marca</label>
                        <input type="text" name="marca" class="form-control" id="marca"
                               title="..." maxlength="50" data-toggle="tooltip" data-placement="right"
                               autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="modelo">Modelo</label>
                        <input type="text" name="modelo" class="form-control" id="modelo"
                               title="..." maxlength="50" data-toggle="tooltip" data-placement="right"
                               autofocus required>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>