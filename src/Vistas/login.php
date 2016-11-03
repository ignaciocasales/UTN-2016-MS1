<div class="container login box">
    <div class="bg"></div>
    <div class="row">
        <div class="hidden-xs hidden-sm col-md-8 bienvenida">
            <h2>Bienvenido</h2>
            <p>La Municipalidad está planeando la informatización y automatización del pago de peajes y la registración de multas por pasaje de semáforo en rojo o exceso de velocidad en las arterias urbanas. Para cumplimentar dicha tarea se debe desarrolló inicialmente un sistema prototípico que realiza la simulación del proceso hasta tanto no se compre la infraestructura adecuada ni se realice la legislación respectiva que garantice y ponga a punto el sistema.</p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <h3>Iniciar Sesión</h3>
            <form method="post" action="/login/verificar/">
                <div class="form-group">
                    <label for="usuario">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="usuario" placeholder="Ingrese su nombre de usuario..." name="usuario">
                </div>
                <div class="form-group">
                    <label for="pass">Contraseña</label>
                    <input type="password" class="form-control" id="pass" placeholder="Ingrese su contraseña..." name="pass">
                </div>
                <button type="submit" class="btn btn-primary pull-right">Inicie Sesión</button>
            </form>
        </div>
    </div>
</div>