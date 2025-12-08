<?php 


class ctrUsuarios{


    static public function ctrMostrarUsuarios(){

     $tabla="usuarios";

     $respuesta=mdlUsuarios::mdlMostrarUsuarios($tabla);

     return $respuesta;

    }

    static public function ctrGuardarUsuario(){
        if(isset($_POST["nom_usuario"])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nom_usuario"]) &&
               preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario"])){

                $ruta = "";

                if(isset($_FILES["subirImgUsuario"]["tmp_name"]) && !empty($_FILES["subirImgUsuario"]["tmp_name"])){
                    
                    list($ancho, $alto) = getimagesize($_FILES["subirImgUsuario"]["tmp_name"]);
                    
                    $nuevoAncho = 480;
                    $nuevoAlto = 382;

                    $directorio = "vistas/imagenes/usuarios";

                    if($_FILES["subirImgUsuario"]["type"] == "image/jpeg"){
                        $ruta = $directorio."/".$_POST["usuario"].".jpg";
                        $origen = imagecreatefromjpeg($_FILES["subirImgUsuario"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destino, $ruta);
                    }

                    if($_FILES["subirImgUsuario"]["type"] == "image/png"){
                        $ruta = $directorio."/".$_POST["usuario"].".png";
                        $origen = imagecreatefrompng($_FILES["subirImgUsuario"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "usuarios";

                $encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array("nombre" => $_POST["nom_usuario"],
                               "usuario" => $_POST["usuario"],
                               "password" => $encriptar,
                               "rol" => $_POST["rol_usuario"],
                               "foto" => $ruta);

                $respuesta = mdlUsuarios::mdlGuardarUsuario($tabla, $datos);

                if($respuesta == "ok"){
                    echo '<script>

                        swal({

                            type: "success",

                            title: "¡El usuario ha sido guardado correctamente!",

                            showConfirmButton: true,

                            confirmButtonText: "Cerrar"

                        }).then(function(result){

                            if(result.value){

                                window.location = "usuarios";

                            }

                        });

                    </script>';
                }

            }else{
                echo '<script>

                    swal({

                        type: "error",

                        title: "¡El nombre de usuario no puede ir vacío o llevar caracteres especiales!",

                        showConfirmButton: true,

                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "usuarios";

                        }

                    });

                </script>';
            }
        }
    }





}
?>