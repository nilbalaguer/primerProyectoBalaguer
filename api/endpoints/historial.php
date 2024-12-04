<?php

include_once __DIR__ . "/../../config/dataBase.php";

class Historial {

    function mostrar() {
        try {
            $con = DataBase::connect();
    
            $stmt = "";
            $stmt = $con->prepare("SELECT * FROM historial ORDER BY fecha DESC");
    
            $stmt->execute();
            $result = $stmt->get_result();
    
            $registres = [];
            while ($row = $result->fetch_assoc()) {
                $registre = [
                    "id_registro" => $row['id'],
                    "id_client" => $row['id_usuario'],
                    "accio" => $row['accion'],
                    "data" => $row['fecha'],
                ];
                $registres[] = $registre;
            }
    
            $con->close();

            $response = [
                "status" => "success",
                "data" => $registres
            ];
    
            return json_encode($response);
        } catch (\Throwable $th) {
            return json_encode("Error BBDD");
        }
    }
}