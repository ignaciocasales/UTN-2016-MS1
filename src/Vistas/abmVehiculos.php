<?php include URL_VISTA . 'navbar.php'; ?>
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
                    </div>
                    <div class="col-md-6">
                        <label for="Titular">DNI TITULAR</label>
                        <input type="text" class="form-control" name="dni" maxlength="8" autofocus required><br/>
                        <button style="position:absolute; right: 50px; bottom: 100px" type="submit"
                                class="btn btn-primary pull-right">Registrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
