<?php include('navbar.php'); ?>
<div class="container">
    <div class="bg"></div>
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 lower-box box-primary">
            <h4 class="text-center">Registro de Vehiculo</h4>
            <hr>
            <div class="row">
                <div class="col-xs-12">
                    <form method='POST' action="/vehiculo/darAltaVehiculo/">
                        <div class="col-xs-6 box-right-content">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">DNI DEL TITULAR</h3>
                                        </div>
                                        <div class="panel-body">
                                            <?php echo $titular->getDni(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
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
                        <div class="col-xs-6">
                            <input type="hidden" name="dni" value="<?php echo $titular->getDni(); ?>" readonly>
                            <div class="form-group">
                                <label for="patente">Patente</label>
                                <input type="text" name="patente" class="form-control" id="patente"
                                       title="..." maxlength="7" data-toggle="tooltip" data-placement="right"
                                       autofocus required>
                            </div>
                            <div class="form-group">
                                <select name="patente" id="patente" style="width: 23%;">
                                    <?php foreach ($listado as $vehiculo) { ?>
                                        <option><?= $vehiculo->getDominio() ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!--
                            <div class="form-group">
                                <label for="marca">Marca</label>
                                <input type="text" name="marca" class="form-control" id="marca"
                                       title="..." maxlength="30" data-toggle="tooltip" data-placement="right"
                                       autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="modelo">Modelo</label>
                                <input type="text" name="modelo" class="form-control" id="modelo"
                                       title="..." maxlength="30" data-toggle="tooltip" data-placement="right"
                                       autofocus required>
                            </div>
                            -->
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>