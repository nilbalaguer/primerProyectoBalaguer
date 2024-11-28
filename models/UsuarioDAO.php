<?php
include_once "config/dataBase.php";

class UsuarioDAO {
    //Obte les dades de un usuari segons el seu nom d'usuari
    public static function getUsuario($usuario) {
        try {
            $con = DataBase::connect();
            $stmt = $con->prepare("SELECT * FROM clientes WHERE usuario = ?");
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Devolver la primera fila como un array asociativo
                $usuarioData = $result->fetch_assoc();
            } else {
                $usuarioData = null; // Usuario no encontrado
            }

            $stmt->close();
            $con->close();

            return $usuarioData;
            
        } catch (\Throwable $th) {
            echo "<p style='font-size: 200%; font-weight: bold; color: red;'>Els nostres servidors no estan disponibles :(</p><p>Lamentem les molesties</p>";
            throw $th;
        }
        
    }

    //Registra un usuari en la base de dades i encripta la clau
    public static function insertaUsuari($nombre, $usuario, $contrasenya) {
        try {
            $clau = password_hash($contrasenya, PASSWORD_DEFAULT);

            $con = DataBase::connect();
            $stmt = $con->prepare("INSERT INTO clientes (nombre, usuario, contrasenya) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nombre, $usuario, $clau);
            
            if ($stmt->execute()) {
                echo "Execucio efectiva";
            } else {
                echo "caca";
            }

            $stmt->close();
            $con->close();

        } catch (\Throwable $th) {
            echo "<p style='font-size: 200%; font-weight: bold; color: red;'>Els nostres servidors no estan disponibles :(</p><p>Lamentem les molesties</p>";
        }
    }
}