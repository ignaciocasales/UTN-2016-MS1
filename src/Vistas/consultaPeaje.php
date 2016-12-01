<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
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
                    foreach ($listado as $objeto) {
                        ?>
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
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

