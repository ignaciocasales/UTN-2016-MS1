<?php include URL_VISTA . 'navbar.php';?>
<div class="container lower-box box-primary">
    <div class="bg"></div>
    <div class="row">
        <div class="hidden-xs hidden-sm col-md-8 box-right-content">
            <h2>Bienvenido</h2>
            <p>La Municipalidad está planeando la informatización y automatización del pago de peajes y la registración
                de multas por pasaje de semáforo en rojo o exceso de velocidad en las arterias urbanas. Para
                cumplimentar dicha tarea se desarrolló un sistema prototípico que realiza la simulación del proceso
                hasta tanto no se compre la infraestructura adecuada ni se realice la legislación respectiva que
                garantice y ponga a punto el sistema.</p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Su mail:</h3>
                </div>
                <div class="panel-body">
                    <?php echo $_SESSION["mail"]; ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Sus privilegios:</h3>
                </div>
                <div class="panel-body">
                    <?php echo $_SESSION["rol"]; ?>
                </div>
            </div>
        </div>
    </div>
</div>