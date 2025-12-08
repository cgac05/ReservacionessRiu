<?php

class ctrRoles{

    static public function ctrMostrarRoles(){
        $tabla = "roles";
        $respuesta = mdlRoles::mdlMostrarRoles($tabla);
        return $respuesta;
    }

    static public function ctrCrearRol(){
        if(isset($_POST["nuevo_rol"])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevo_rol"])){
                $tabla = "roles";
                $datos = $_POST["nuevo_rol"];
                $respuesta = mdlRoles::mdlCrearRol($tabla, $datos);
                if($respuesta == "ok"){
                    echo '<script>
                        swal({
                            type: "success",
                            title: "¡El rol ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "roles";
                            }
                        });
                    </script>';
                }
            }else{
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡El nombre del rol no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "roles";
                        }
                    });
                </script>';
            }
        }
    }
}
