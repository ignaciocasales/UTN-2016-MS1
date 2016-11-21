<?php include('navbar.php'); ?>
<div class="container">
    <div class="row">
        <div class="bg"></div>
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 lower-box box-primary">
            <?php if ($_SESSION["rol"] === 'developer') { ?>
                <h4 class="text-center">Vehiculo de <?php $titular = $vehiculo->getTitular();
                    echo $titular->getNombre() . ' ' . $titular->getApellido(); ?></h4>
            <?php } ?>
            <?php if ($_SESSION["rol"] === 'titular') { ?>
                <h4 class="text-center">Datos de su vehículo</h4>
            <?php } ?>
            <hr>
            <div class="row">
                <div class="col-xs-3 box-right-content">
                    <img
                        src="/generadorQR.php?qr=<?= $vehiculo->getQR(); ?>"
                        title="Vehiculo" class="img-responsive img-thumbnail"/>
                </div>
                <div class="col-xs-9">
                    <h6><b>Dominio: </b><?= $vehiculo->getDominio(); ?></h6>
                    <h6><b>Marca: </b><?= $vehiculo->getMarca(); ?></h6>
                    <h6><b>Modelo </b><?= $vehiculo->getModelo(); ?></h6>
                </div>
            </div>
            <?php if ($_SESSION["rol"] === 'developer') { ?>
                <a class="btn btn-primary pull-right" href="/consulta/todosVehiculos/" role="button"><span
                        class="glyphicon glyphicon-arrow-left"></span>Volver</a>
            <?php } ?>
            <?php if ($_SESSION["rol"] === 'titular') { ?>
                <a class="btn btn-primary pull-right" href="/consulta/usuarioVehiculos/"
                   role="button"><span
                        class="glyphicon glyphicon-arrow-left"></span>Volver</a>
            <?php } ?>
        </div>
    </div>
</div>

