<div class="container">
    <div class="row">
        <div class="bg"></div>
        <div class="col-xs-8 col-md-8 col-md-offset-2">
            <form class="form box-primary" style="padding: 8px;" method='GET'action="%" >
                <div class="row">
                    <div class="col-md-6 registroVehiculoLinea">
                        <div class="form-group" aria-required="true">
                            <label for="Patente">Patente</label><br/>
                            <input type="text" name="patente">
                        </div>
                        <div class="form-group">
                            <label for="Marca">Marca</label><br/>
                            <input type="text" name="marca" required>
                        </div>
                        <div class="form-group">
                            <label for="Modelo">Modelo</label><br/>
                            <input type="text" name="modelo" pattern="(?:\d*){8}" maxlength="8" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="Titular">DNI TITULAR</label>
                        <input type="text" name="dni" maxlength="8" autofocus required><br/>
                        <button style="position:absolute; right: 50px; bottom: 100px" type="submit" class="btn btn-primary pull-right" >Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
