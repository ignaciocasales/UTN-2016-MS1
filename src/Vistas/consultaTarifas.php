<?php include('navbar.php'); ?>
<div class="container lower-box box-primary">
    <h4 class="text-center">Tarifarios en el Sistema</h4>
</div>
<div class="container">
    <div class="row">
        <?php
        /** @var \Modelo\Tarifa $objeto */
        foreach ($this->listado as $objeto) {
            ?>
            <div class="col-xs-12 col-sm-4 col-md-3 lower-box box-primary">
                <h6 style="background-color: #E3E3E3;">
                    <b>
                        Fecha Desde:
                    </b>
                    <?= $objeto->getFechaDesde(); ?>
                </h6>
                <h6>
                    <b>
                        Fecha Hasta:
                    </b>
                    <?= $objeto->getFechaHasta(); ?>
                </h6>
                <h6>
                    <b>
                        Peaje en Hora Pico: &dollar;
                    </b>
                    <?= $objeto->getPeajeHorasPico(); ?>
                </h6>
                <h6>
                    <b>
                        Peaje en Hora Normal: &dollar;
                    </b>
                    <?= $objeto->getPeajeHorasNormal(); ?>
                </h6>
                <h6>
                    <b>
                        Multa Semáfore en rojo: &dollar;
                    </b>
                    <?= $objeto->getMulta(); ?>
                </h6>
            </div>
            <?php
        }
        ?>
    </div>
</div>