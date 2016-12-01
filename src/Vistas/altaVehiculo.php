<?php include('navbar.php'); ?>
<div class="container">
    <div class="bg"></div>
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 lower-box box-primary">
            <h4 class="text-center">Registro de Vehiculo</h4>
            <hr>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-6 box-right-content">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">DNI DEL TITULAR</h3>
                                        </div>
                                        <div class="panel-body">
                                            <?php echo $titular->getDni(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">NOMBRE</h3>
                                        </div>
                                        <div class="panel-body">
                                            <?php echo $titular->getNombre() . ' ' . $titular->getApellido(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <script type="text/javascript">
                                function displayForm(c) {
                                    if (c.value == "1") {

                                        document.getElementById("patenteVieja").style.visibility = 'visible';
                                        document.getElementById("patenteMercosur").style.visibility = 'hidden';

                                    } else if (c.value == "2") {

                                        document.getElementById("patenteVieja").style.visibility = 'hidden';
                                        document.getElementById("patenteMercosur").style.visibility = 'visible';

                                    } else {
                                    }
                                }
                            </script>
                            <div class="form-group form-inline">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="a" id="optionsRadios1" value="1"
                                               onClick="displayForm(this)">
                                        Patente Vieja |
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="a" id="optionsRadios2" value="2"
                                               onClick="displayForm(this)">
                                        Patente Mercosur
                                    </label>
                                </div>
                            </div>
                            <form method='POST' action="<?= '/vehiculo/alta/' ?>">
                                <input type="hidden" name="dni" value="<?php echo $titular->getDni(); ?>" readonly>
                                <div class="form-group">
                                    <label for="marcaModelo">Marca | Modelo</label><br>
                                    <select name="marcaModelo" id="marcaModelo" style="width: 100%;">
                                        <?php foreach ($this->listado as $marcaModelo) { ?>
                                            <option>
                                                <?= $marcaModelo['marca'] . ' | ' . $marcaModelo['modelo'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group" id="patenteVieja" style="visibility: hidden">
                                    <label for="patente">Patente</label>
                                    <div class="input-group">
                                        <input type="text" name="patente[]" class="form-control" id="patente"
                                               maxlength="3" placeholder="AAA" pattern="^[a-zA-Z]+$" autofocus>
                                        <div class="input-group-addon">-</div>
                                        <input type="text" name="patente[]" class="form-control" maxlength="3"
                                               placeholder="000" pattern="^[0-9]+$">
                                    </div>
                                </div>
                                <div class="form-group" id="patenteMercosur"
                                     style="visibility: hidden; position: absolute; display: block; top: 109px;">
                                    <label for="patenteM">Patente Mercosur</label>
                                    <div class="input-group">
                                        <input type="text" name="patente[]" class="form-control" id="patenteM"
                                               maxlength="2" placeholder="AA" pattern="^[a-zA-Z]+$">
                                        <div class="input-group-addon">-</div>
                                        <input type="text" name="patente[]" class="form-control" maxlength="3"
                                               placeholder="000" pattern="^[0-9]+$">
                                        <div class="input-group-addon">-</div>
                                        <input type="text" name="patente[]" class="form-control" maxlength="2"
                                               placeholder="AA" pattern="^[a-zA-Z]+$">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Registrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

