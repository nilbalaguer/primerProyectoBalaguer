<?php

include_once __DIR__ . "/../../config/dataBase.php";

class Usuari {
    //Mostra totes les comandes a la base de dades
    function mostrarTot($order) {
        try {
            $con = DataBase::connect();
    
            $stmt = "";
            if ($order > 0) {
                $stmt = $con->prepare("SELECT * FROM clientes ORDER BY $order");
            } else {
                $stmt = $con->prepare("SELECT * FROM clientes");
            }

            $stmt->execute();
            $result = $stmt->get_result();

            $productos = [];
            while ($row = $result->fetch_assoc()) {
                $producto = [
                    "id" => $row['id'],
                    "nom" => $row['nombre'],
                    "usuari" => $row['usuario'],
                    "contrasenya" => $row['contrasenya'],
                ];
                $productos[] = $producto;
            }

            $con->close();
    
            $response = [
                "status" => "success",
                "data" => $productos
            ];
    
            return json_encode($response);
        } catch (\Throwable $th) {
            return json_encode("Error BBDD");
        }
        
    }
    
    //Elimina una comanda de la bbdd
    function eliminar($id) {
        try {
            $con = DataBase::connect();
            //Borrar comanda
            $stmt = $con->prepare("DELETE FROM clientes WHERE id = ?");
            $stmt-> bind_param("d", $id);
            $stmt-> execute();
    
            $stmt-> close();
    
            return json_encode("Usuari Eliminat");
        } catch (\Throwable $th) {
            return json_encode("Error BBDD");
        }
    }
    
    //Inserta una comanda a la BBDD
    function crear($nom, $usuari, $contrasenya) {
        try {
            $con = DataBase::connect();

            $contrasenya = password_hash($contrasenya, PASSWORD_DEFAULT);
    
            $stmt = $con->prepare("INSERT INTO clientes (nombre, usuario, contrasenya) VALUES(?,?,?)");
            $stmt->bind_param("sss", $nom, $usuari, $contrasenya);
            $stmt->execute();
    
            $stmt->close();
    
            return json_encode("Usuari Insertat");
        } catch (\Throwable $th) {
            return json_encode("$th Error BBDD");
        }
    
    }
    
    //Modifica una comanda a la BBDD
    function modificar($id, $nom, $usuari, $contrasenya) {
        try {
            $con = DataBase::connect();

            $contrasenya = password_hash($contrasenya, PASSWORD_DEFAULT);
    
            $stmt = $con->prepare("UPDATE clientes SET nombre = ?, usuario = ?, contrasenya = ? WHERE id = ?");
            $stmt->bind_param("sssd", $nom, $usuari, $contrasenya, $id);
            $stmt->execute();
    
            $stmt->close();
    
            return json_encode("Usuari Modificat");
    
        } catch (\Throwable $th) {
            return json_encode("$th Error BBDD");
        }
    }
}
