<?php include('navbar.php'); ?>
<div class="container lower-box box-primary">
    <div class="row">
        <div class="bg"></div>
        <div class="col-xs-6">
            <h6><b>Dominio: </b><?= $vehiculo->getDominio(); ?> |
                <b>Saldo: </b><?= $cuentaCorriente->getSaldo(); ?>
            </h6>
        </div>
        <div class="col-xs-6">
            <!-- Aca deberia tener el máximo crédito -->
        </div>
        <div class="col-xs-6">
            <a class="btn btn-info" href="#" role="button">Ver Sólo Multas</a>
            <a class="btn btn-info" href="#" role="button">Ver Sólo Peajes</a>
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
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Importe</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($listadoMovimientos) {
                        foreach ($listadoMovimientos as $objeto) { ?>
                            <tr class="<?php if ($objeto->getEventoPeaje()) {
                                echo 'warning';
                            } else {
                                echo 'danger';
                            } ?>">
                                <td><?php if ($objeto->getEventoPeaje()) {
                                        echo 'Peaje';
                                    } else {
                                        echo 'Semáforo en Rojo';
                                    } ?></td>
                                <td><?= $objeto->getFechaYhora(); ?></td>
                                <td>&dollar;<?= $objeto->getImporte(); ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>