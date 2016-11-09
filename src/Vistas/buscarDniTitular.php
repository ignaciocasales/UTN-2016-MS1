<?php include('navbar.php'); ?>
<div class="container lower-box box-primary"">
<div class="bg"></div>
<div class="row">
    <div class="hidden-xs hidden-sm col-md-3 box-right-content">
        <h5 style="text-align: center">INGRESE DNI DEL TITULAR</h5>
    </div>
    <div class="col-md-6">
        <form method="post" action="/titular/verificar">
            <div class="form-group">
                <label for="Titular">DNI</label>
                <input type="text" name="dni" size="10" maxlength="8" autofocus required>
                <button type="submit" class="btn btn-primary" style="left: 50px">Buscar
                </button>
            </div>
        </form>
    </div>

</div>
</div>