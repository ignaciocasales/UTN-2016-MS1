<nav class="navbar navbar-default bg-pri">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#responsiveMenu" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo URL_PUBLIC . 'index.php'; ?>" id="responsiveBrand">
                <img alt="Brand" src="<?php echo URL_IMG . 'traffic-lights-icon.png'; ?>" class="img-responsive brand">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="responsiveMenu">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Consultas <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Multas</a></li>
                        <li><a href="#">Peajes</a></li>
                        <li><a href="#">Vehículos</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo URL_PUBLIC . 'index.php'; ?>">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Reclamos
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?php echo URL_PUBLIC . 'index.php'; ?>">
                        <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Iniciar Sesión
                    </a>
                </li>
                <li>
                    <a href="<?php echo URL_PUBLIC . 'index.php'; ?>">
                        <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Cerrar Sesión
                    </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


