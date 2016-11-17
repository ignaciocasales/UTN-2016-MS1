<?php

if (isset($mensaje)) {
    $m = $mensaje->getTipo();
    if ($m === 'danger') {

        echo "has-error";

    } else {

        echo "has-" . $m;

    }
}