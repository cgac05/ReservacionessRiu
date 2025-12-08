<?php

require_once "../../../controlador/plantilla.controlador.php";
require_once "../../../controlador/reservaciones.controlador.php";
require_once "../../../modelo/reservaciones.modelo.php";

class AjaxReservaciones {

    public function ajaxBuscarReservaciones() {
        // Llama al método del controlador que maneja la búsqueda.
        ctrReservaciones::ctrBuscarReservaciones();
    }
}

// Comprueba la acción solicitada por AJAX.
if (isset($_POST["accion"]) && $_POST["accion"] == "buscar") {
    $servicios = new AjaxReservaciones();
    $servicios->ajaxBuscarReservaciones();
}
