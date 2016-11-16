<?php include('navbar.php'); ?>
<div class="container lower-box box-primary">
    <div class="bg"></div>
    <div class="row">
        <?php include("mensaje.php") ?>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <h3>Iniciar Sesión</h3>
            <form method="post" action="/login/verificar/">
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="email" name="mail" class="form-control" id="usuario"
                           placeholder="email@ejemplo.com"
                           title="Email" maxlength="50" data-toggle="tooltip" data-placement="right" autofocus required>
                </div>
                <div class="form-group">
                    <label for="pass">Contraseña</label>
                    <input type="password" name="pwd" class="form-control" id="pass"
                           placeholder="Ingrese su contraseña..."
                           title="Contraseña" maxlength="80"
                           pattern="[A-Za-z0-9\S]{1,80}" data-toggle="tooltip" data-placement="right" required>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Recordarme
                    </label>
                </div>
                <a href="%" class="pull-left">¿Olvidaste tu contraseña?</a>
                <button type="submit" class="btn btn-primary pull-right">Inicie Sesión</button>
            </form>
        </div>
    </div>
</div>