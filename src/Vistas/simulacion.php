<?php include('navbar.php'); ?>
<div class="container lower-box box-primary">
    <div class="bg"></div>
    <div class="row">
        <div class="col-sm-12">
            <h4 class="text-center">Simulación</h4>
            <hr>
        </div>
        <div class="col-sm-12">
            <form action="<?= '/simulacion/generar/' ?>" method="post">
                <div class="row">
                    <div class="col-sm-6 box-right-content">
                        <div class="form-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Seleccione patente</h3>
                                </div>
                                <div class="panel-body">
                                    <label for="patente"></label>
                                    <select name="patente" id="patente" style="width: 23%;">
                                        <?php /** @var \Modelo\Vehiculo $vehiculo */
                                        foreach ($this->listado as $vehiculo) { ?>
                                            <option><?= $vehiculo->getDominio() ?></option><?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Fecha del evento</h3>
                                </div>
                                <div class="panel-body">
                                    <div class='input-group date' id='datetimepicker'>
                                        <input onkeydown="return false" type='text' name="fecha" class="form-control"
                                               id="fecha"
                                               placeholder="Fecha del Evento..."
                                               title="Fecha" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <!--suppress JSUnresolvedFunction -->
                                <script type="text/javascript">
                                    $(function () {
                                        $('#datetimepicker').datetimepicker({
                                            format: 'YYYY-MM-DD HH:mm:ss',
                                            minDate: moment(),
                                            maxDate: '2016-12-31 23:59:59'
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Evento</h3>
                                </div>
                                <div class="panel-body">
                                    <label for="evento"></label>
                                    <input id="evento" type="radio" name="evento" value="multa" checked="checked">
                                    Semaforo en rojo
                                    <hr>
                                    <input id="evento" type="radio" name="evento" value="peaje">
                                    Peaje
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success pull-right">generar</button>
            </form>
        </div>
    </div>
</div>
