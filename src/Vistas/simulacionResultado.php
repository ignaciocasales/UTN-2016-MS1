<?php include('navbar.php'); ?>
<header>
    <h2 style="text-align: center">Resultado de la Simulacion</h2>
</header>
<div class = "container">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">TITULAR</h3>
                        </div>
                        <div class="panel-body">
                            <?php echo $titular->getNombre() . ' ' . $titular->getApellido(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">PATENTE DEL VEHICULO</h3>
                        </div>
                        <div class="panel-body">
                            <?= $vehiculo->getDominio(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <?php if ($evento == 'semaforo') { ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">PRECIO DE MULTA POR SEMAFORO EN ROJO</h3>
                </div>
                <div class="panel-body">
                    <label for="precio">PRECIO: $1000</label>
                </div>
            </div>
            <?php } ?>
            <?php if ($evento == 'peaje') { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">GASTO DE PEAJE</h3>
                    </div>
                    <div class="panel-body">
                        <label for="precio">PRECIO: <?= $gastoPeaje ?></label>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">HORARIO DEL EVENTO</h3>
                    </div>
                    <div class="panel-body">
                        <label for="precio"><?= $eventoFecha ?></label>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>