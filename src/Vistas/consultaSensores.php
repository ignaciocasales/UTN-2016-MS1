<?php include('navbar.php'); ?>
<div class="container lower-box box-primary">
    <h4 class="text-center">Sensores de <?= $tipo ?> en el sistema</h4>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha Instalación</th>
                        <th>Latitud | Longitud</th>
                        <th>Número de Serie</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($listado as $objeto) { ?>
                        <tr>
                            <td><?= $objeto->getId(); ?></td>
                            <td><?= $objeto->getFechaAlta(); ?></td>
                            <td><?php echo $objeto->getLatitud() . ' | ' . $objeto->getLongitud(); ?></td>
                            <td><?= $objeto->getNumeroSerie(); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

