<?php include('navbar.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3 lower-box box-primary">
            <div class="bg"></div>
            <h4 class="text-center">Ingrese el DNI</h4>
            <hr>
            <form class="text-center form-inline" method="post" action="/titular/verificar">
                <div class="form-group">
                    <label for="Titular">DNI</label>
                    <input type="text" name="dni" class="form-control" id="Titular"
                           title="Sin puntos ni separación." size="10" maxlength="8" data-toggle="tooltip"
                           data-placement="bottom" autofocus
                           required>
                </div>
                <button type="submit" class="btn btn-primary">verificar</button>
            </form>
        </div>
    </div>
</div>

