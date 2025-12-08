<?php 

require_once "conexion.php";



class mdlUsuarios{



    static public function mdlMostrarUsuarios($tabla){


        $stmt= Conexion::conectar()->prepare("SELECT * FROM $tabla");

        $stmt ->execute();

        return $stmt->fetchAll();



        $stmt->close();

        $stmt =null;


    }

    static public function mdlGuardarUsuario($tabla, $datos){


        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, password, rol, foto) VALUES (:nombre, :usuario, :password, :rol, :foto)");


        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);


        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);


        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);


        $stmt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);


        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);


        if($stmt->execute()){


            return "ok";


        }else{


            return "error";


        }


        $stmt->close();


        $stmt = null;


    }
}





?>