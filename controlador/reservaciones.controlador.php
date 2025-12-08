<?php 


class ctrReservaciones{

    static public function ctrMostrarReservaciones(){
        $tabla="vw_reservacion";
        $respuesta = mdlreservaciones::mdlMostrarReservaciones($tabla);

        return $respuesta;
    }
    static public function mdlMostrarHabitacionesDisponibles($fechaInicio, $fechaFin){
        $procedimiento="sp_ObtenerHabitacionesDisponibles";
        $respuesta = mdlreservaciones::mdlMostrarHabitacionesDisponibles($procedimiento, $fechaInicio, $fechaFin);

        return $respuesta;
    }
    static public function ctrEliminarReservacion(){

        if(isset($_POST['clave_reserva_eliminar']) && !empty($_POST['clave_reserva_eliminar'])){

            $clave = $_POST['clave_reserva_eliminar'];

            // Intentar eliminar en la tabla 'reservaciones' y si no funciona probar 'reservacion'
            $tablasPosibles = array('reservaciones','reservacion','vw_reservacion');

            foreach($tablasPosibles as $tabla){
                $respuesta = mdlreservaciones::mdlEliminarReservacion($tabla, $clave);
                if ($respuesta === false) {
                    // error con esa tabla, continuar con la siguiente
                    continue;
                }
                // Si rowCount > 0 se eliminó; si 0, puede que la tabla exista pero sin coincidencias
                // Devolvemos el resultado (número de filas afectadas o 0)
                return $respuesta;
            }

            return false;

        }

    }
    //ctrMostrarTiposHabitacion
    static public function ctrMostrarTiposHabitacion(){
        $tabla="TiposHabitacion";
        $respuesta = mdlreservaciones::mdlMostrarTiposHabitacion($tabla);

        return $respuesta;
    }

    static public function ctrMostrarServicios(){
        $tabla="Servicios";
        $respuesta = mdlreservaciones::mdlMostrarServicios($tabla);

        return $respuesta;
    }
    static public function ctrVerificarCliente($dato){
        $tabla="Clientes";
        $respuesta = mdlreservaciones::mdlVerificarCliente($tabla, $dato);

        return $respuesta;
    }
    static public function ctrCalcularTotalServicios($listaServiciosIDs){
        $totalServicios = 0;
        $detalles = [];

        // Validamos que sea un array
        if (!is_array($listaServiciosIDs) || empty($listaServiciosIDs)) {
            return 0;
        }

        foreach ($listaServiciosIDs as $idServicio) {
            // LLAMADA AL MODELO: Aquí conectamos con la capa de datos
            // Definimos la tabla "Servicios" aquí, no en la vista
            $respuesta = ModeloReservaciones::mdlObtenerServicio("Servicios", $idServicio);

            if ($respuesta) {
                // Sumamos el precio (asegurando que sea numérico)
                $totalServicios += floatval($respuesta["Precio"]);
                
                // Opcional: Guardar detalles para mostrar en resumen
                $detalles[] = [
                    "nombre" => $respuesta["Nombre"],
                    "precio" => $respuesta["Precio"]
                ];
            }
        }

        return $totalServicios;
    }

    
    static public function ctrGuardarReservacionDividido(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'guardar_reserva'){
            
            // Recopilar todos los datos del POST en un array.
            $datos = [
                'cliente_reserva' => $_POST['cliente_reserva'],
                'id_empleado' => $_SESSION['idEmpleado'] ?? 2, // Usar ID de sesión o 2 como fallback
                'fecha_desde' => $_POST['fecha_desde'],
                'fecha_hasta' => $_POST['fecha_hasta'],
                'habitaciones_seleccionadas' => $_POST['habitaciones_seleccionadas'] ?? [],
                'servicios' => $_POST['servicios'] ?? [] // Nuevo formato: [id => cantidad]
            ];

            // Llamar al método del modelo y devolver el resultado.
            $respuesta = mdlreservaciones::mdlGuardarReservacionDividido($datos);

            return $respuesta;
        }
        // Devolver false si no es la acción correcta, para evitar errores.
        return false;
    }


    static public function ctrBuscarReservaciones(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filtros = [
                'fecha_desde' => $_POST['fecha_desde'] ?? null,
                'fecha_hasta' => $_POST['fecha_hasta'] ?? null,
                'tipo_habitacion' => $_POST['tipo_habitacion'] ?? null,
                'numero_reserva' => $_POST['numero_reserva'] ?? null,
                'estados' => $_POST['estados'] ?? []
            ];

            $respuesta = mdlreservaciones::mdlBuscarReservaciones($filtros);
            
            header('Content-Type: application/json');
            echo json_encode($respuesta);
        }
    }
    
    static public function ctrActualizarReservacion(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clave_reserva'])) {
            $datos = [
                'clave_reserva' => $_POST['clave_reserva'],
                'nombre_cliente' => $_POST['nombre_cliente'],
                'fecha_entrada' => $_POST['fecha_entrada'],
                'fecha_salida' => $_POST['fecha_salida'],
                'estado' => $_POST['estado']
            ];

            $respuesta = mdlreservaciones::mdlActualizarReservacion($datos);

            if ($respuesta) {
                // Redirigir o mostrar un mensaje de éxito
                echo "<script>alert('Reservación actualizada con éxito.'); window.location = 'reservaciones';</script>";
            } else {
                // Mostrar un mensaje de error
                echo "<script>alert('Error al actualizar la reservación.'); window.location = 'reservaciones';</script>";
            }
        }
    }
    static public function ctrCancelarReservacion(){
        if(isset($_POST['clave_reserva_cancelar'])){
            $tabla = "vw_reservacion"; // O la tabla que sea correcta
            $clave = $_POST['clave_reserva_cancelar'];
            $respuesta = mdlreservaciones::mdlCancelarReservacion($tabla, $clave);

            if($respuesta){
                echo "<script>alert('Reservación cancelada con éxito.'); window.location = 'reservaciones';</script>";
            } else {
                echo "<script>alert('Error al cancelar la reservación.'); window.location = 'reservaciones';</script>";
            }
        }
    }
}



?>