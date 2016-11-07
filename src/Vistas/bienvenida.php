<?php include URL_VISTA . 'navbar.php';?>
<div class="container lower-box box-primary">
    <div class="bg"></div>
    <div class="row">
        <?php include ("mensaje.php")?>
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