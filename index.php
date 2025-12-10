<?php 

include "controlador/plantilla.controlador.php";

include "controlador/reservaciones.controlador.php";
//require_once "controlador/usuarios.controlador.php";

include "modelo/reservaciones.modelo.php";
//require_once "modelo/usuarios.modelo.php";






//require_once "controlador/roles.controlador.php";
//require_once "modelo/roles.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();






?>