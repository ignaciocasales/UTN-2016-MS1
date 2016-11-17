<?php include('navbar.php'); ?>
<?php if (isset($mensaje)) { ?>
    <div id="message" class="container">
        <div>
            <div id="inner-message" class="alert alert-<?= $mensaje->getTipo(); ?> alert-dismissible fade"
                 role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <?= $mensaje->getMensaje(); ?>
            </div>
        </div>
    </div>
    <script>
        function showAlert() {
            $("#inner-message").addClass("in");
        }

        window.setTimeout(function () {
            showAlert();
        }, 250);
    </script>
<?php } ?>
<div class="container lower-box box-primary">
    <div class="bg"></div>
    <div class="row">
        <?php include("mensaje.php") ?>
        <?php if ((isset($_SESSION["mail"]) && $_SESSION["pwd"])) { ?>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Su mail:</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $_SESSION["mail"]; ?>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sus privilegios:</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $_SESSION["rol"]; ?>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <h3>Iniciar Sesión</h3>
                <form method="post" action="/login/verificar/">
                    <div class="form-group <?php include("estadosValidacionFormularios.php"); ?>">
                        <label for="usuario">Usuario</label>
                        <input type="email" name="mail" class="form-control" id="usuario"
                               placeholder="email@ejemplo.com"
                               title="Email" maxlength="50" data-toggle="tooltip" data-placement="right" autofocus
                               required>
                    </div>
                    <div class="form-group <?php include("estadosValidacionFormularios.php"); ?>">
                        <label for="pass">Contraseña</label>
                        <input type="password" name="pwd" class="form-control" id="pass"
                               placeholder="Ingrese su contraseña..."
                               title="Contraseña" maxlength="80"
                               pattern="[A-Za-z0-9\S]{1,80}" data-toggle="tooltip" data-placement="right" required>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" disabled> Recordarme
                        </label>
                    </div>
                    <a href="/" class="pull-left" title="No implementado" data-toggle="tooltip" data-placement="bottom">¿Olvidaste
                        tu contraseña?</a>
                    <button type="submit" class="btn btn-primary pull-right">Inicie Sesión</button>
                </form>
            </div>
        <?php } ?>/
    </div>
</div>