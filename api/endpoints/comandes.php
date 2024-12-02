<?php
include_once __DIR__ . "/../../config/dataBase.php";
include_once __DIR__ . "/../../models/Comestible.php";

class Comandes {
    //Mostra totes les comandes a la base de dades
    function mostrarTot($order) {
        try {
            $con = DataBase::connect();
    
            $stmt = "";
            if ($order > 0) {
                $stmt = $con->prepare("SELECT * FROM pedidos ORDER BY $order");
            } else {
                $stmt = $con->prepare("SELECT * FROM pedidos");
            }
    
            $stmt->execute();
            $result = $stmt->get_result();
    
            $productos = [];
            while ($row = $result->fetch_assoc()) {
                $producto = [
                    "id_comanda" => $row['id_pedido'],
                    "id_client" => $row['id_cliente'],
                    "descompte" => $row['id_descuento'],
                    "localitat" => $row['localidad'],
                    "codipostal" => $row['codigopostal'],
                    "carrer" => $row['calle'],
                    "nom" => $row['nombre'],
                    "telefon" => $row['telefono'],
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
            $stmt = $con->prepare("DELETE FROM pedidos WHERE id_pedido = ?");
            $stmt-> bind_param("d", $id);
            $stmt-> execute();
            
            //Borrar productes de comanda
            $stmt = $con->prepare("DELETE FROM productos_pedidos WHERE id_pedido = ?");
            $stmt-> bind_param("d", $id);
            $stmt-> execute();
    
            $stmt-> close();
    
            return json_encode("COMANDA ESBORRADA");
        } catch (\Throwable $th) {
            return json_encode("Error BBDD");
        }
    }
    
    //Inserta una comanda a la BBDD
    function crear($id_client, $descompte, $localitat, $codipostal, $carrer, $nom, $telefon, $preu) {
        try {
            $con = DataBase::connect();
    
            $stmt = $con->prepare("INSERT INTO pedidos (id_cliente, id_descuento, localidad, codigopostal, calle, nombre, telefono, precio) VALUES(?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ddsdssdd", $id_client, $descompte, $localitat, $codipostal, $carrer, $nom, $telefon, $preu);
            $stmt->execute();
    
            $stmt->close();
    
            return json_encode("Comanda Insertada");
        } catch (\Throwable $th) {
            return json_encode("Error BBDD");
        }
    
    }
    
    //Modifica una comanda a la BBDD
    function modificar($id_comanda, $id_client, $descompte, $localitat, $codipostal, $carrer, $nom, $telefon, $preu) {
        try {
            $con = DataBase::connect();
    
            $stmt = $con->prepare("UPDATE pedidos SET id_cliente = ?, id_descuento = ?, localidad = ?, codigopostal = ?, calle = ?, nombre = ?, telefono = ?, precio = ? WHERE id_pedido = ?");
            $stmt->bind_param("ddsdssddd", $id_client, $descompte, $localitat, $codipostal, $carrer, $nom, $telefon, $preu, $id_comanda);
            $stmt->execute();
    
            $stmt->close();
    
            return json_encode("Comanda Modificada");
    
        } catch (\Throwable $th) {
            return json_encode("Error BBDD");
        }
    }
    
    //Moure aixo a un lloc correcte
    function clauAdmin() {
        return "080705";
    }
}
