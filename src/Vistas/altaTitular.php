<?php include('navbar.php'); ?>
<div class="container">
    <div class="bg"></div>
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 lower-box box-primary">
            <h4 class="text-center">Registro de Titular</h4>
            <hr>
            <div class="row">
                <div class="col-xs-12">
                    <form method='POST' action="/titular/darAltaTitular/" autocomplete="off">
                        <div class="col-xs-4 box-right-content">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre"
                                       placeholder="Nombre"
                                       autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" name="apellido" class="form-control" id="apellido"
                                       placeholder="Apellido"
                                       required>
                            </div>
                        </div>
                        <div class="col-xs-4 box-right-content">
                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <input type="text" name="dni" class="form-control" id="dni" pattern="(?:\d*){8}"
                                       value="<?= $dni ?>" maxlength="8" placeholder="Teléfono" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" name="telefono" class="form-control" id="telefono"
                                       pattern="([0-90000000]){7}" maxlength="7" placeholder="Apellido" required>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="email">Dirección de Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                       placeholder="email@ejemplo.com" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="text" style="display:none;">
                                <input type="password" class="form-control" id="password" placeholder="Contraseña"
                                       name="password" maxlength="7" readonly onfocus="this.removeAttribute('readonly');" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>