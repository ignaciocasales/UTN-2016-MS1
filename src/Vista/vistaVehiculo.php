<!DOCTYPE html>
    <html lang="es-AR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/estilo.css" rel="stylesheet">
        <title>TITULO DE PAGINA</title>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body style="background-image:url(img/fondo.jpg)">
        <header class="container"> <img src="img/logo.jpg" id="logo" />
            <nav class="navbar navbar-default menu">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Inicio</a></li>
                        <li><a href="#">Informacion</a></li>
                        <li><a href="#">Contacto</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../navbar-fixed-top/">Fixed top</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <section class="container">
            <section class="color-primario">
                <div class="row text-center">
                    <div class="col-md-8 pd-15">
                        <h2>Registro de Vehiculos</h2>
                        <p>Descripcion.</p>
                    </div>
                </div>
            </section>
            <section id="tabla" class="color-primario pd-15" style="overflow-x:auto;">
                <table class="table" style="border:3px; border-radius:9px;">
                    <thead>
                        <tr>
                            <th>Patente</th>
                            <th>Modelo</th>
                            <th>Marca</th>
                            <th>Titular</th>
                            <th>DNI</th>
                            <th>Domicilio</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($lista_vehiculos as $vehiculo) { ?>
                            <tr>
                                <td>
                                    <?= $vehiculo->getPatente(); ?>
                                </td>
                                <td>
                                    <?= $vehiculo->getModelo(); ?>
                                </td>
                                <td>
                                    <?= $vehiculo->getMarca(); ?>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><form method="POST" action="borrarDato.php">
                                    </form><a class="btn btn-primary" href="borrarDato.php">Borrar</a></td>
                                <?php }?>
                            </tr>
                    </tbody>
                </table> <a class="btn btn-primary" href="index.php">Volver</a> 
            </section>
        </section>
        <footer class="container">
            <section class="color-secundario">
                <div class="row">
                    <article class="col-md-4 pd-30">AAA</article>
                    <article class="col-md-4 pd-30">AAA</article>
                    <article class="col-md-4 pd-30">AAA</article>
                </div>
            </section>
        </footer>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>

    </html>