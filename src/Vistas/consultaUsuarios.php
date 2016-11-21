<?php include('navbar.php'); ?>
<!-- LEER !!!
    Esta consulta mucho sentido no tiene, la subo como ejemplo para las demas consultas.
    Tienen que modificar ciertas cosas dependiendo a quien mostrarle los datos.
    Por ejemplo, el titular no puede borrar o añadir multas, solo visualizarlas.
    Mas adelante tambien implementariamos la paginacion para que no se vea feo, en este momento no importa eso.
    Esta tabla esta pensada para los usuarios.
-->
<div class="container lower-box box-primary">
    <h4 class="text-center">ABM | Usuarios del Sistema</h4>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Mail</th>
                        <th>Password</th>
                        <th>Privilegios</th>
                        <th></th>
                        <th></th>
                        <th><a href="#"><span class="glyphicon glyphicon-plus" title="Añadir" data-toggle="tooltip"
                                              data-placement="right"></span></a></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($listado as $objeto) { ?>
                        <tr>
                            <td><?= $objeto->getEmail(); ?></td>
                            <td><?= $objeto->getPassword(); ?></td>
                            <td><?php $o = $objeto->getRol();
                                echo $o->getDescripcion(); ?></td>

                            <td><a href="#"><span class="glyphicon glyphicon-pencil" title="Modificar"
                                                  data-toggle="tooltip" data-placement="right"></span></a></td>
                            <td><a href="#"><span class="glyphicon glyphicon-trash" title="Eliiminar"
                                                  data-toggle="tooltip" data-placement="right"></span></a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
