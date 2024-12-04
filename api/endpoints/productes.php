<?php

include_once __DIR__ . "/../../config/dataBase.php";

class productes {
    //Mostra totes les comandes a la base de dades
    function mostrarTot($order) {
        try {
            $con = DataBase::connect();
    
            $stmt = "";
            if ($order > 0) {
                $stmt = $con->prepare("SELECT * FROM productos ORDER BY $order");
            } else {
                $stmt = $con->prepare("SELECT * FROM productos");
            }

            $stmt->execute();
            $result = $stmt->get_result();

            $productos = [];
            while ($row = $result->fetch_assoc()) {
                $producto = [
                    "id" => $row['id'],
                    "nom" => $row['nombre'],
                    "imatge" => $row['imagen'],
                    "descripcio" => $row['descripcion'],
                    "categoria" => $row['categoria'],
                    "preu" => $row['precio']
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
            $stmt = $con->prepare("DELETE FROM productos WHERE id = ?");
            $stmt-> bind_param("d", $id);
            $stmt-> execute();
    
            $stmt-> close();
    
            return json_encode("Producte Eliminat");
        } catch (\Throwable $th) {
            return json_encode("Error BBDD");
        }
    }
    
    //Inserta una comanda a la BBDD
    function crear($nom, $descripcio, $preu, $imatge, $categoria) {
        try {
            $con = DataBase::connect();
    
            $stmt = $con->prepare("INSERT INTO productos (nombre, descripcion, precio, imagen, categoria) VALUES(?,?,?,?,?)");
            $stmt->bind_param("ssdss", $nom, $descripcio, $preu, $imatge, $categoria);
            $stmt->execute();
    
            $stmt->close();
    
            return json_encode("Producte Insertat");
        } catch (\Throwable $th) {
            return json_encode("$th Error BBDD");
        }
    
    }
    
    //Modifica una comanda a la BBDD
    function modificar($id, $nom, $descripcio, $preu, $imatge, $categoria) {
        try {
            $con = DataBase::connect();
    
            $stmt = $con->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, imagen = ?, categoria = ? WHERE id = ?");
            $stmt->bind_param("ssdssd", $nom, $descripcio, $preu, $imatge, $categoria, $id);
            $stmt->execute();
    
            $stmt->close();
    
            return json_encode("Producte Modificat");
    
        } catch (\Throwable $th) {
            return json_encode("$th Error BBDD");
        }
    }
    
    //Moure aixo a un lloc correcte
    function clauAdmin() {
        return "080705";
    }
}
