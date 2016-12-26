<?php

function rand_date($min_date, $max_date)
{
    $min_epoch = strtotime($min_date);
    $max_epoch = strtotime($max_date);

    $rand_epoch = rand($min_epoch, $max_epoch);

    return $rand_epoch;
}
