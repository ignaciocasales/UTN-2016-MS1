<?php include URL_VISTA . 'navbar.php';?>
<div class="container login box-primary">
    <div class="bg"></div>
    <div class="row">
        <div class="hidden-xs hidden-sm col-md-8 bienvenida">
            <h2>Bienvenido</h2>
            <p>La Municipalidad está planeando la informatización y automatización del pago de peajes y la registración
                de multas por pasaje de semáforo en rojo o exceso de velocidad en las arterias urbanas. Para
                cumplimentar dicha tarea se desarrolló un sistema prototípico que realiza la simulación del proceso
                hasta tanto no se compre la infraestructura adecuada ni se realice la legislación respectiva que
                garantice y ponga a punto el sistema.</p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <h3>Iniciar Sesión</h3>
            <form method="post" action="/login/verificar/">
                <div class="form-group">
                    <label for="usuario">Nombre de Usuario</label>
                    <input type="email" name="mail" class="form-control" id="usuario"
                           placeholder="Ingrese su email..."
                           title="No corresponde" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label for="pass">Contraseña</label>
                    <input type="password" name="pwd" class="form-control" id="pass"
                           placeholder="Ingrese su contraseña..."
                           title="Sólo caracteres alfanumméricos" maxlength="80"
                           pattern="[A-Za-z0-9\S]{1,80}" autofocus required>
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