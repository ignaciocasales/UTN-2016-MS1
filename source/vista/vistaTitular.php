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
    <style>
        
        .form-control:focus {
            border-color: green;
            border: 2px;
        }
        
        #titulo {
            border: 3px solid rgba(255, 255, 255, 0.5);
            border-bottom-style: groove;
            border-radius: 8px;
            text-shadow: 2px 0 0 #fff, -2px 0 0 #fff, 0 2px 0 #fff, 0 -2px 0 #fff, 1px 1px #fff, -1px -1px 0 #fff, 1px -1px 0 #A92, -1px 1px 0 #fff;
        }
        
        .form {
            border: 3px solid rgba(255, 255, 255, 0.5);
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 6px;
        }
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body style="background-image:url(img/fondo.jpg)">
    <header class="container"> <img src="img/logo.jpg" class="image-responsive " id="logo" />
        <nav class="navbar navbar-default menu">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="#">Informacion</a></li>
                    <li><a href="#">Contacto</a></li>
                    <li class ="active"><a>Registro Titular</a></li>

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
                <div class="col-md-12 pd-15">
                    <h2>Registro de Vehiculos</h2>
                    <p>Descripcion.</p>
                </div>
            </div>
        </section>
        <section id="registrar" class="color-primario">
            <div class="row center-block">
                <div class="col-md-4 col-md-offset-4 pd-15">
                    <form class="form" action="enviar.php" method="POST">
                        <label for="Nombre">Nickname</label>
                        <input type="text" name="nickname" class="form-control" />
                        <br/>
                        <label for="Nombre">Contraseña</label>
                        <input type="password" name="contraseña" class="form-control" />
                        <br/>
                        <label for="Nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" />
                        <br/>
                        <label for="Dni">Apellido</label>
                        <input type="text" name="apellido" class="form-control" />
                        <br/>
                        <label for="Nombre">DNI</label>
                        <input type="text" name="dni" class="form-control" />
                        <br/>
                        <label for="Nombre">Domicilio</label>
                        <input type="text" name="domicilio" class="form-control" />
                        <br/>
                        <label for="Nombre">Email</label>
                        <input type="text" name="email" class="form-control" />
                        <br/>
                        <button type="submit" class="btn btn-info"> Enviar </button> <span class="pull-right"><input type="checkbox" name="check" value="No guardar"> No guardar</span> </form>
                </div>
            </div>
        </section>
    </section>
    <footer class="container">
        <section class="color-secundario">
            <div class="row">
                <article class="col-md-4 pd-30">
                    <h4>Informacion</h4>
                    <p>Texto</p>
                </article>
                <article class="col-md-4 pd-30">
                    <h4>Informacion</h4>
                    <p>Texto</p>
                </article>
                <article class="col-md-4 pd-30">
                    <h4>Contacto</h4>
                    <p>Texto</p>
                </article>
            </div>
        </section>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>