<?php
//Aquest fitxer tot i el seu nom no vol dir que sigui operat per el admin si no que realitza fucnions administratives per part de l'usuari

class AdminDAO
{
    public static function insertarAccio($accio) {
        try {
            echo "<script>alert('Hola');</script>";

            session_start();
            $usuari = $_SESSION['id'];

            $con = DataBase::connect();
            $stmt = $con->prepare("INSERT INTO historial (accion, id_usuario, fecha) VALUES (?, ?, ?)");
            $fecha = date("Y-m-d H:i:s");
            $stmt->bind_param("sss", $accio, $usuari, $fecha);
            $stmt->execute();

            $stmt->close();
            $con->close();

            echo "<script>alert('Hola');</script>";

        } catch (\Throwable $th) {
            echo "<script>alert($th);</script>";
            echo "<p style='font-size: 200%; font-weight: bold; color: red;'>Els nostres servidors no estan disponibles :(</p><p>Lamentem les molesties</p>";
        }
    }
}
