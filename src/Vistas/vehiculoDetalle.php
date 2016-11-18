<?php include('navbar.php'); ?>
<div class="container">
    <div class="row">
        <div class="bg"></div>
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 lower-box box-primary">
            <h4 class="text-center">Vehiculo de <?php $titular = $vehiculo->getTitular();
                echo $titular->getNombre() . ' ' . $titular->getApellido(); ?></h4>
            <hr>
            <div>
                <div class="col-xs-3">
                    <img
                        src="/generadorQR.php?qr=<?= $vehiculo->getQR(); ?>"
                        title="Vehiculo" class="img-responsive img-thumbnail"/>
                </div>
                <div class="col-xs-9">
                    <h6><b>Dominio: </b><?= $vehiculo->getDominio(); ?></h6>
                    <h6><b>Marca: </b><?= $vehiculo->getMarca(); ?></h6>
                    <h6><b>Modelo </b><?= $vehiculo->getModelo(); ?></h6>
                </div>
                <?php if ($_SESSION["rol"] === 'developer') { ?>
                    <a class="btn btn-primary pull-right" href="/consulta/todosVehiculos/" role="button">Volver</a>
                <?php } ?>
                <?php if ($_SESSION["rol"] === 'titular') { ?>
                    <a class="btn btn-primary pull-right" href="/consulta/usuarioVehiculos/"
                       role="button">Volver</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
