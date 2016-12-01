<!-- Navbar -->
<nav class="navbar navbar-default bg-pri">
    <div class="container">
        <!-- Navbar Header -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#responsiveMenu" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/" id="responsiveBrand">
                <img alt="Brand" src="<?php echo URL_IMG . 'traffic-lights-icon.png'; ?>" class="img-responsive brand"
                     title="Trafi-MDQ" data-toggle="tooltip"
                     data-placement="bottom">
            </a>
        </div>
        <!-- /Navbar Header -->
        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="responsiveMenu">
            <?php
            if ((isset($_SESSION["mail"]) && $_SESSION["pwd"])) {
                ?>
                <?php if ($_SESSION["rol"] === 'developer') { ?>
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"
                               aria-expanded="false">
                                Consultas
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?= '/consulta/usuarios/' ?>">Usuarios</a>
                                </li>
                                <li>
                                    <a href="<?= '/consulta/vehiculos/' ?>">Vehiculos</a>
                                </li>
                                <li>
                                    <a href="<?= '/consulta/sensoresPeaje/' ?>">Peajes</a>
                                </li>
                                <li>
                                    <a href="<?= '/consulta/sensoresMulta/' ?>">Semáforos</a>
                                </li>
                                <li>
                                    <a href="<?= '/consulta/tarifas/' ?>">Tarifas</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?= '/titular/buscar/' ?>">
                                Registrar Vehiculo
                                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= '/simulacion/cargar/' ?>">
                                Simulación
                                <span class="glyphicon glyphicon-road" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                <?php } ?>

                <?php if ($_SESSION["rol"] === 'empleado') { ?>
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"
                               aria-expanded="false">
                                Consultas
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?= '/consulta/tarifas/' ?>">Tarifas</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?= '/titular/buscar/' ?>">
                                Registrar Vehiculo
                                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= '/simulacion/cargar/' ?>">
                                Simulación
                                <span class="glyphicon glyphicon-road" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                <?php } ?>

                <?php if ($_SESSION["rol"] === 'titular') { ?>
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"
                               aria-expanded="false">
                                Consultas
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?= '/consulta/usuarioVehiculos/' ?>">Mis Vehículos</a>
                                </li>
                            </ul>
                        </li>
                        <li class="disabled">
                            <a href="/">
                                Reclamos
                                <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                <?php } ?>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/logout/terminar/">
                            Cerrar Sesión <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                        </a>
                    </li>
                </ul>
                <?php
            } else {
                ?>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/">
                            Iniciar Sesión <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
                        </a>
                    </li>
                </ul>
                <?php
            }
            ?>
        </div>
        <!-- /Navbar Links -->
    </div>
</nav>
<!-- /Navbar-->
<!-- Este espacio es para los mensajes a los usuarios -->
<div id="message" class="container" style="min-height: 54px;">
    <div>
        <div id="inner-message" class="alert <?php if (isset($this->mensaje)) { ?>
                                                    <?php echo 'alert-' . $this->mensaje->getTipo(); ?>
                                                    <?php } ?>
                                                    alert-dismissible fade"
             role="alert">

            <?php if (isset($this->mensaje)) { ?>
                <?= $this->mensaje->getMensaje(); ?>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Script que genera animación de 'fade in' sobre los alerts -->
<script>
    function showAlert() {
        $("#inner-message").addClass("in");
    }

    window.setTimeout(function () {
        showAlert();
    }, 250);
</script>
<!-- / Mensajes -->