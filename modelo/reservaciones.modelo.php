<?php

require_once "conexion.php";

class mdlreservaciones{
    public static $lastError = '';

    
    static public function mdlMostrarReservaciones($tabla){
        try{
            $db = Conexion::conectar();

            $stmt = $db->prepare("SELECT * FROM " . $tabla);

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt = null;

            return $result;

        } catch (Exception $e) {
            return [];
        }

    }

    static public function mdlMostrarServicios($tabla){
        try{
            $db = Conexion::conectar();

            $stmt = $db->prepare("SELECT * FROM " . $tabla);

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt = null;

            return $result;

        } catch (Exception $e) {
            return [];
        }

    }

    static public function mdlMostrarHabitacionesDisponibles($procedimiento, $fechaInicio, $fechaFin){
        try{
            $db = Conexion::conectar();

            $stmt = $db->prepare("exec " . $procedimiento . " :fechaInicio, :fechaFin");

            $stmt->bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
            $stmt->bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR);

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt = null;

            return $result;

        } catch (Exception $e) {
            return [];
        }

    }

    static public function mdlMostrarTiposHabitacion($tabla){
        try{
            $db = Conexion::conectar();

            $stmt = $db->prepare("SELECT * FROM " . $tabla);

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt = null;

            return $result;

        } catch (Exception $e) {
            return [];
        }

    }

    static public function mdlEliminarReservacion($tabla, $clave){

        try{
            $db = Conexion::conectar();

            $sql = "DELETE FROM " . $tabla . " WHERE [Clave de reserva] = :clave";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(":clave", $clave, PDO::PARAM_STR);

            $stmt->execute();

            $rowCount = $stmt->rowCount();

            $stmt = null;

            return $rowCount;

        } catch (Exception $e) {
            return false;
        }


    }

    static public function mdlVerificarCliente($tabla, $dato){
        try{
            $db = Conexion::conectar();

            $stmt = $db->prepare("SELECT * FROM " . $tabla . " WHERE email = :dato");

            $stmt->bindParam(":dato", $dato, PDO::PARAM_STR);

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = null;

            return $result;

        } catch (Exception $e) {
            return [];
        }

    }

    // Obtener un servicio por id
    static public function mdlObtenerServicio($tabla, $id){
        try{
            $db = Conexion::conectar();
            $stmt = $db->prepare("SELECT * FROM " . $tabla . " WHERE ServicioId = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = null;
            return $result;
        } catch (Exception $e){
            self::$lastError = $e->getMessage();
            error_log("mdlObtenerServicio error: " . $e->getMessage());
            return false;
        }
    }

    // Obtener una habitación por id
    static public function mdlObtenerHabitacion($tabla, $id){
        try{
            $db = Conexion::conectar();
            $stmt = $db->prepare("SELECT * FROM " . $tabla . " WHERE HabitacionID = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = null;
            return $result;
        } catch (Exception $e){
            self::$lastError = $e->getMessage();
            error_log("mdlObtenerHabitacion error: " . $e->getMessage());
            return false;
        }
    }

    // Guardar la reservación y devolver el id insertado
    static public function mdlGuardarReservacion($tabla, $datos){
        try{
            $db = Conexion::conectar();
            $sql = "INSERT INTO " . $tabla . " (Email, FechaInicio, FechaFin, Total) VALUES (:email, :fi, :ff, :total)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":email", $datos['Email'], PDO::PARAM_STR);
            $stmt->bindParam(":fi", $datos['FechaInicio'], PDO::PARAM_STR);
            $stmt->bindParam(":ff", $datos['FechaFin'], PDO::PARAM_STR);
            $stmt->bindParam(":total", $datos['Total']);
            $stmt->execute();
            // Obtener id insertado
            $lastId = $db->lastInsertId();
            $stmt = null;
            return $lastId ? $lastId : false;
        } catch (Exception $e){
            self::$lastError = $e->getMessage();
            error_log("mdlGuardarReservacion error: " . $e->getMessage());
            return false;
        }
    }

    // Asignar servicios a una reservación
    static public function mdlAsignarServicios($tabla, $reservaId, $servicios){
        try{
            $db = Conexion::conectar();
            $sql = "INSERT INTO " . $tabla . " (ReservaID, ServicioID) VALUES (:reserva, :servicio)";
            $stmt = $db->prepare($sql);
            foreach($servicios as $s){
                $stmt->bindParam(':reserva', $reservaId, PDO::PARAM_INT);
                $stmt->bindParam(':servicio', $s, PDO::PARAM_INT);
                $stmt->execute();
            }
            $stmt = null;
            return true;
        } catch (Exception $e){
            self::$lastError = $e->getMessage();
            error_log("mdlAsignarServicios error: " . $e->getMessage());
            return false;
        }
    }

    // Asignar habitaciones a una reservación
    static public function mdlAsignarHabitaciones($tabla, $reservaId, $habitaciones){
        try{
            $db = Conexion::conectar();
            $sql = "INSERT INTO " . $tabla . " (ReservaID, HabitacionID) VALUES (:reserva, :habitacion)";
            $stmt = $db->prepare($sql);
            foreach($habitaciones as $h){
                $stmt->bindParam(':reserva', $reservaId, PDO::PARAM_INT);
                $stmt->bindParam(':habitacion', $h, PDO::PARAM_INT);
                $stmt->execute();
            }
            $stmt = null;
            return true;
        } catch (Exception $e){
            self::$lastError = $e->getMessage();
            error_log("mdlAsignarHabitaciones error: " . $e->getMessage());
            return false;
        }
    }

    static public function mdlGuardarReservacionDividido($datos){
    
        $db = Conexion::conectar();
        
        try {
            $db->beginTransaction(); // Importante para mantener integridad

            // --- PASO 1: Llamar al SP para la Cabecera ---
            $stmt = $db->prepare("EXEC sp_CrearCabeceraReserva @EmailCliente=?, @EmpleadoID=?, @FechaEntrada=?, @FechaSalida=?");
            $stmt->execute([
                $datos['cliente_reserva'],
                $datos['id_empleado'],
                $datos['fecha_desde'],
                $datos['fecha_hasta']
            ]);
            
            // Obtener el ID que nos devolvió el SP
            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar si el SP devolvió un ID
            if (!$res || !isset($res['ReservaID'])) {
                throw new Exception("El procedimiento almacenado no devolvió un ID de reserva.");
            }
            $reservaId = $res['ReservaID'];

            // --- PASO 2: Insertar Habitaciones (El Trigger actuará aquí) ---
            $habitaciones = $datos['habitaciones_seleccionadas'] ?? [];
            
            if (!empty($habitaciones)) {
                $stmtHab = $db->prepare("INSERT INTO Reservacion_Habitaciones (ReservacionID, HabitacionID) VALUES (?, ?)");
                foreach ($habitaciones as $habID) {
                    $stmtHab->execute([$reservaId, $habID]);
                }
            }

            // --- PASO 3: Insertar Servicios ---
            $servicios = $datos['servicios'] ?? [];
            if(!empty($servicios)){
                $stmtServ = $db->prepare("INSERT INTO Reservacion_Servicios (ReservacionID, ServicioID, Cantidad) VALUES (?, ?, ?)");
                foreach ($servicios as $servID => $cantidad) {
                    if ($cantidad > 0) {
                        $stmtServ->execute([$reservaId, $servID, $cantidad]);
                    }
                }
            }

            $db->commit(); // Guardar todo
            return $reservaId; // Devolver el ID en caso de éxito

        } catch (Exception $e) {
            $db->rollBack(); // Deshacer si algo falla
            error_log("Error en mdlGuardarReservacionDividido: " . $e->getMessage()); // Log del error
            return false;
        }
    }

}
//mdlMostrarTiposHabitacion


?>