<div class="container">
    <div class="row">
        <div class="bg"></div>
        <div class="col-xs-8 col-md-4">
            <form class="form box-primary" style="padding: 8px;" method='GET'action="%" >
                <div class="form-group" aria-required="true">
                    <label for="Nombre">Nombre</label><br/>
                    <input type="text" name="nombre">
                </div>
                <div class="form-group">
                    <label for="Apellido">Apellido</label><br/>
                    <input type="text" name="apellido" required>
                </div>
                <div class="form-group">
                    <label for="dni">DNI (sin puntos)</label><br/>
                    <input type="text" name="dni" pattern="(?:\d*){8}" maxlength="8" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label><br/>
                    <input type="text" name="telefono" pattern="([0-90000000]){7}" maxlength="7" required>
                </div>
                <button type="submit" class="btn btn-primary pull-right" >Registrar</button>
            </form>
        </div>
    </div>
</div>