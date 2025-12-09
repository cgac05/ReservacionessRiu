<?php

require_once "../../../controlador/plantilla.controlador.php";
require_once "../../../controlador/reservaciones.controlador.php";
require_once "../../../modelo/reservaciones.modelo.php";

class AjaxReservaciones {

    public function ajaxBuscarReservaciones() {
        // Llama al método del controlador que maneja la búsqueda.
        ctrReservaciones::ctrBuscarReservaciones();
    }

    public function ajaxObtenerCliente() {
        if (isset($_POST["clave_reserva"])) {
            $clave_reserva = $_POST["clave_reserva"];
            $respuesta = ctrReservaciones::ctrObtenerClientePorReservacion($clave_reserva);
            header('Content-Type: application/json');
            echo json_encode($respuesta);
        }
    }
}

// Comprueba la acción solicitada por AJAX.
if (isset($_POST["accion"])) {
    $ajax = new AjaxReservaciones();
    if ($_POST["accion"] == "buscar") {
        $ajax->ajaxBuscarReservaciones();
    } elseif ($_POST["accion"] == "obtenerCliente") {
        $ajax->ajaxObtenerCliente();
    }
}
