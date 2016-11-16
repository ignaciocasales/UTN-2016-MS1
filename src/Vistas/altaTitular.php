<?php include('navbar.php'); ?>
<div class="container">
    <div class="bg"></div>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 lower-box box-primary">
            <h3 class="text-center">Registro de Titular</h3>
            <hr>
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    <form method='POST' action="/titular/darAltaTitular/">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre"
                                   autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellidos</label>
                            <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="dni">DNI</label>
                            <input type="text" name="dni" class="form-control" id="dni" pattern="(?:\d*){8}"
                                   value="<?= $dni ?>" maxlength="8" placeholder="Apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" id="telefono"
                                   pattern="([0-90000000]){7}" maxlength="7" placeholder="Apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control" id="email"
                                   placeholder="email@ejemplo.com" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" placeholder="Contraseña"
                                   name="´password" maxlength="7" required>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">REgistrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>