<?php include('navbar.php'); ?>
<header>
    <h2 style="text-align: center">Registro de Vehiculo</h2>
</header>
<div class="container lower-box">
    <div class="bg"></div>
    <div class="row">
        <div class="col-xs-8 col-md-offset-2 box-primary">
            <form method='POST' action="/vehiculo/darAltaVehiculo/">
                <div class="row">
                    <div class="col-md-6 box-right-content">
                        <div class="form-group" aria-required="true">
                            <label for="patente">Patente</label><br/>
                            <input type="text" class="form-control" name="patente" required>
                        </div>
                        <div class="form-group">
                            <label for="marca">Marca</label><br/>
                            <input type="text" class="form-control" name="marca" required>
                        </div>
                        <div class="form-group">
                            <label for="modelo">Modelo</label><br/>
                            <input type="text" class="form-control" name="modelo" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">DNI DEL TITULAR</h3>
                            </div>
                            <div class="panel-body">
                                <input type="text" name="dni" value="<?php echo $titular->getDni(); ?>" readonly>
                            </div>
                        </div>
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
            </form>
        </div>
    </div>
</div>
