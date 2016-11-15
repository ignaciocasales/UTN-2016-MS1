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
                        <th>DNI - Titular</th>
                        <?php if ($_SESSION['rol'] === 'developer') { ?>
                        <th></th>
                        <th></th>
                        <th><a href="/titular/buscarDni/"><span class="glyphicon glyphicon-plus" title="Añadir" data-toggle="tooltip"
                                              data-placement="right"></span></a></th>
                        <?php }?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($listado as $objeto) { ?>
                        <tr>
                            <td><?= $objeto->getDominio(); ?></td>
                            <td><?php echo $objeto->getMarca(); ?></td>
                            <td><?php echo $objeto->getModelo(); ?></td>
                            <td><?php $o = $objeto->getTitular();
                                echo $o->getDni(); ?></td>
                            <?php if ($_SESSION['rol'] === 'developer') { ?>
                            <td><a href="#" class="disabled"><span class="glyphicon glyphicon-pencil" title="Modificar"
                                                  data-toggle="tooltip" data-placement="right"></span></a></td>
                            <td><a href="#"><span class="glyphicon glyphicon-trash" title="Eliiminar"
                                                  data-toggle="tooltip" data-placement="right"></span></a></td>
                            <?php } ?>
                        </tr>
                    <?php }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
