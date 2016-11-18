<nav class="navbar navbar-default bg-pri">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
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

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="responsiveMenu">
            <?php
            if ((isset($_SESSION["mail"]) && $_SESSION["pwd"])) {
                ?>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true"
                           aria-expanded="false">
                            Consultas <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if ($_SESSION["rol"] === 'titular') { ?>
                                <li><a href="#">Multas</a></li>
                                <li><a href="#">Peajes</a></li>
                                <li><a href="/consulta/usuarioVehiculos/">Vehículos</a></li>
                            <?php } ?>
                            <?php if ($_SESSION["rol"] === 'developer') { ?>
                                <li><a href="/consulta/todosUsuarios/">Usuarios</a></li>
                                <li><a href="#">Titulares</a></li>
                                <li><a href="/consulta/todosVehiculos/">Vehiculos</a></li>
                                <li><a href="#">Sensores</a></li>
                                <li><a href="#">Reclamos</a></li>
                                <li><a href="#">Tarifas</a></li>
                            <?php } ?>
                            <?php if ($_SESSION["rol"] === 'empleado') { ?>
                                <li><a href="#">Tarifas</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="disabled">
                        <?php if ($_SESSION["rol"] === 'titular') { ?>
                            <a href="/index.php">
                                Reclamos <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                            </a>
                        <?php } ?>
                    </li>
                    <?php if ($_SESSION["rol"] === 'empleado' || $_SESSION["rol"] === 'developer') { ?>
                        <li>
                            <a href="/titular/buscarDni/">
                                Registrar Vehiculo <span class="glyphicon glyphicon-plus-sign"
                                                         aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="/simulacion/simular/">
                                Simulación <span class="glyphicon glyphicon-road" aria-hidden="true"></span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
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
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

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