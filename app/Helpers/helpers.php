<?php

use App\Http\Controllers\BlankoController;

function wilayah($tipe, $id) {
    return  BlankoController::getWilayah($tipe, $id);
}

?>
