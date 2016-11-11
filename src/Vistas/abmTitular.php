<?php include('navbar.php'); ?>
<header>
    <h2 style="text-align: center">Registro de Titular</h2>
</header>
<div class="container">
    <div class="bg"></div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2  lower-box box-primary">
            <form class="form" method='POST' action="/titular/darAltaTitular/">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 box-right-content input-width-90">
                        <div class="form-group " aria-required="true">
                            <label for="Nombre">Nombre</label><br/>
                            <input type="text" name="nombre" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="Apellido">Apellido</label><br/>
                            <input type="text" name="apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label><br/>
                            <input type="text" name="email" required>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4 box-right-content input-width-90">
                                <div class="form-group">
                                    <label for="dni">DNI (sin puntos)</label><br/>
                                    <input type="text" name="dni" pattern="(?:\d*){8}"  value=<?= $dni?> maxlength="8" required>
                                </div>
                                <div class="form-group">
                                    <label for="telefono">Telefono</label><br/>
                                    <input type="text" name="telefono" pattern="([0-90000000]){7}" maxlength="7" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-8 input-width-95">
                                <div class="form-group">
                                    <label for="usuario">Usuario</label><br/>
                                    <input type="text" name="usuario" pattern="(?:\d*){8}" maxlength="8" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label><br/>
                                    <input type="text" name="´password" pattern="([0-90000000]){7}" maxlength="7" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" style="top: 14px" class="btn btn-primary pull-right">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
