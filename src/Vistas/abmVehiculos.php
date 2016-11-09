<?php include('navbar.php'); ?>
<header>
    <h2 style="text-align: center">Registro de Vehiculo</h2>
</header>
<div class="container lower-box">
    <div class="bg"></div>
    <div class="row">
        <div class="col-xs-8 col-md-offset-2 box-primary">
            <form class="form" method='GET' action="%">
                <div class="row">
                    <div class="col-md-6 box-right-content">
                        <div class="form-group" aria-required="true">
                            <label for="Patente">Patente</label><br/>
                            <input type="text" class="form-control" name="patente">
                        </div>
                        <div class="form-group">
                            <label for="Marca">Marca</label><br/>
                            <input type="text" class="form-control" name="marca" required>
                        </div>
                        <div class="form-group">
                            <label for="Modelo">Modelo</label><br/>
                            <input type="text" class="form-control" name="modelo" pattern="(?:\d*){8}" maxlength="8"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">DNI DEL TITULAR</h3>
                            </div>
                            <div class="panel-body">
                                <?php echo $existe['dni']; ?>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">NOMBRE</h3>
                            </div>
                            <div class="panel-body">
                                <?php echo $existe['nombre'] . ' ' . $existe['apellido']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
