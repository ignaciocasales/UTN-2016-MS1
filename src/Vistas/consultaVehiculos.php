<?php include('navbar.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Dominio</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <?php if ($_SESSION['rol'] === 'developer') { ?>

                            <th>DNI - Titular</th>
                            <th></th>
                            <th></th>
                            <th><a href="/titular/buscarDni/"><span class="glyphicon glyphicon-plus" title="Añadir"
                                                                    data-toggle="tooltip"
                                                                    data-placement="right"></span></a></th>
                        <?php } ?>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($listado as $objeto) { ?>
                        <tr>
                            <td><?= $objeto->getDominio(); ?></td>
                            <td><?php echo $objeto->getMarca(); ?></td>
                            <td><?php echo $objeto->getModelo(); ?></td>
                            <?php if ($_SESSION['rol'] === 'developer') { ?>

                                <td><?php $o = $objeto->getTitular();
                                    echo $o->getDni(); ?></td>
                                <td><a href="#"><span class="glyphicon glyphicon-pencil"
                                                      title="Modificar"
                                                      data-toggle="tooltip"
                                                      data-placement="right"></span></a></td>
                                <td><a href="" onclick="eliminar_vehiculo(
                                    '<?= $objeto->getDominio(); ?>',
                                        '<?= $objeto->getMarca(); ?>',
                                        '<?= $objeto->getModelo(); ?>',
                                        '<?php $titular= $objeto->getTitular();
                                                echo $titular->getNombre() . ' ' . $titular->getApellido();
                                    ?>');" data-toggle="modal" data-target="#modalEliminarVehiculo"><span class="glyphicon glyphicon-trash" title="Eliiminar"
                                                      data-toggle="tooltip" datatype="" data-placement="right"></span></a></td>
                            <?php } ?>
                            <td><a href="/consulta/vehiculo/<?= $objeto->getId(); ?>"><span
                                        class="glyphicon glyphicon-eye-open"
                                        title="Ver"
                                        data-toggle="tooltip"
                                        data-placement="right"></span></a></td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="modalEliminarVehiculo" class="fade modal" style="opacity: 50 " role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Eliminar Vehiculo</h4>
            </div>
            <div class="modal-body" id="datosVehiculo">

            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>
