<?php

include_once("config/dataBase.php");
include_once("models/Comestible.php");

class ProductoDAO{
    public static function getAll($order = "id") {
        try {
            $con = DataBase::connect();
            $stmt = $con->prepare("SELECT * FROM productos ORDER BY $order");
            $stmt->execute();
            $result = $stmt->get_result();

            $productos = [];
            while ($row = $result->fetch_assoc()) {
                $producto = new Comestible($row['id'], $row['nombre'], $row['descripcion'], $row['precio'], $row['imagen']);
                $productos[] = $producto;
            }

            $con->close();
            return $productos;
        } catch (\Throwable $th) {
            echo "<p style='font-size: 200%; font-weight: bold; color: red;'>Els nostres servidors no estan disponibles :(</p><p>Lamentem les molesties</p>";
            throw $th;
        }
        
    }

    public static function store($producto){
        $con = DataBase::connect();
        $stmt = $con->prepare("INSERT INTO camisas (nombre, talla, precio) VALUES (?,?,?);");
        $stmt ->bind_param("ssd", $producto->getNombre(),$producto->getTalla(),$producto->getPrecio());

        $stmt->execute();
        $result = $stmt->get_result();

        $productos = [];

        while($producto = $result->fetch_object("Camiseta")) {
            $productos[] = $producto;
        }

        $con->close();
    }

    public static function destroy($id) {
        $con = DataBase::connect();
        $stmt = $con->prepare("DELETE FROM camisetas WHERE id = ?");
        $stmt-> bind_param("i", $id);
        $stmt-> execute();
        $stmt-> close();
    }
}