<?php include('navbar.php'); ?>
<?php if (isset($daoVehiculoModal)) { ?>
    <script type="text/javascript">
        $(window).load(function () {
            $('#modalEliminarVehiculo').modal('show');
        });
    </script>
<?php } ?>
<div class="container lower-box box-primary">
    <?php if ($_SESSION["rol"] === 'developer') { ?>
        <h4 class="text-center">Lista de todos los vehículos del sistema</h4>
    <?php } ?>
    <?php if ($_SESSION["rol"] === 'titular') { ?>
        <h4 class="text-center">Sus vehículos</h4>
    <?php } ?>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
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
                        <?php } ?>
                        <th></th>
                        <th></th>
                        <?php if ($_SESSION['rol'] === 'developer') { ?>
                            <th>
                                <a href="/titular/buscarDni/">
                                    <span class="glyphicon glyphicon-plus" title="Añadir"
                                          data-toggle="tooltip"
                                          data-placement="right">

                                    </span>
                                </a>
                            </th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($listado as $objeto) { ?>
                        <tr>
                            <td>
                                <?= $objeto->getDominio(); ?>
                            </td>
                            <td>
                                <?php echo $objeto->getMarca(); ?>
                            </td>
                            <td>
                                <?php echo $objeto->getModelo(); ?>
                            </td>
                            <?php if ($_SESSION['rol'] === 'developer') { ?>
                                <td>
                                    <?php $o = $objeto->getTitular();
                                    echo $o->getDni(); ?>
                                </td>
                                <td>
                                    <a href="#">
                                        <span class="glyphicon glyphicon-pencil" title="Modificar" data-toggle="tooltip"
                                              data-placement="right">
                                        </span>
                                    </a>
                                </td>
                                <td>
                                    <a href="/vehiculo/eliminarModal/<?php echo $objeto->getId(); ?>">
                                        <span class="glyphicon glyphicon-trash" title="Eliminar" data-toggle="tooltip"
                                              data-placement="right">
                                        </span>
                                    </a>
                                </td>
                            <?php } ?>
                            <td>
                                <a href="/consulta/vehiculo/<?= $objeto->getId(); ?>">
                                    <span class="glyphicon glyphicon-eye-open" title="Detalle" data-toggle="tooltip"
                                          data-placement="right">
                                    </span>
                                </a>
                            </td>
                            <?php if ($_SESSION["rol"] === 'titular') { ?>
                                <td>
                                    <a href="/consulta/movimientos/<?= $objeto->getId(); ?>">
                                        <span class="glyphicon glyphicon-list-alt" title="Consultar Movimientos"
                                              data-toggle="tooltip" data-placement="right">
                                        </span>
                                    </a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
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
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <h5>PATENTE DEL VEHICULO: <?= $vehiculo->getDominio(); ?></h5>
                        <h5>Marca: <?= $vehiculo->getMarca(); ?></h5>
                        <h5>Modelo: <?= $vehiculo->getModelo(); ?></h5>
                        <h5>TITULAR: <?php $titular = $vehiculo->getTitular();
                            echo $titular->getNombre() . ' ' . $titular->getApellido(); ?></h5>
                        <hr>
                        <h4>Eliminar Vehiculo?</h4>
                        <form action="/vehiculo/eliminar/" method="post">
                            <input type="hidden" name="dominio" value="<?= $vehiculo->getDominio(); ?>" readonly>
                            <button type="submit" class="btn btn-danger pull-left" name="eliminar">Eliminar</button>
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar
                            </button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>
