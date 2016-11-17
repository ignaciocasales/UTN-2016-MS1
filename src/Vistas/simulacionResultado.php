<?php include('navbar.php'); ?>
<div class="container lower-box box-primary">
    <div class="bg"></div>
    <div class="row">
        <div class="col-sm-12">
            <h4 class="text-center">Simulación Resultado</h4>
            <hr>
        </div>
        <div class="col-sm-12">
            Se genero un evento en la cuenta de: <?= $titular->getNombre() . ' ' . $titular->getApellido(); ?>
        </div>
    </div>
</div>