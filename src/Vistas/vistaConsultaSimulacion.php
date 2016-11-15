<?php include('navbar.php'); ?>
<header>
    <h2 style="text-align: center">Simulacion</h2>
</header>
<div class = "container">
    <div class="row">
        <form class="col-md-12" action="/simulacion/verificar/" method="post">
            <div class="row">
                <div class="col-md-2 col-md-offset-1 lower-box box-primary" style="height: 150px">
                    <label for="patente">Seleccione patente</label>
                    <select name="patente">
                        <?php foreach ($listado as $vehiculo) {?>
                        <option><?= $vehiculo->getDominio() ?></option>
                        <?php } ?>
                    </select>

                    <button type="submit" class="btn btn-primary" style="top:30px">Simular</button>
                </div>
                <div class="col-md-8 col-md-offset-1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Semaforo</h3>
                                </div>
                                <div class="panel-body">
                                    <input type="radio" name="evento" value="semaforo" checked="checked"> Semaforo en rojo
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Peaje</h3>
                                </div>
                                <div class="panel-body">
                                    <input type="radio" name="evento" value="peaje"> Peaje <br/>
                                    <input type="datetime" name="eventoFecha" step="1" min="2016-11-01 00:00:00" max="2016-12-26 00:00:00" value="2016-11-01 07:30:51"> AAAA-MM-DD
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>