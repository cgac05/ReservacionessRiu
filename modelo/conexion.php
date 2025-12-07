<?php
    class conexion {
        static public function conectar() {
            $host = "localhost";
            $database = "reservacioneRiu";
            $username = "user";
            $password = "1234";
            $puerto = "1433";

            try {
                $conn = new PDO("sqlsrv:Server=$host,$puerto;Database=$database", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                return null;
            }
        }

        
    }
?>  