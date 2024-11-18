<?php

include_once("config/dataBase.php");
include_once("models/Comestible.php");

class ProductoDAO{
    public static function getAll($categoria, $order = "id") {
        try {
            $con = DataBase::connect();
            
            if ($categoria !== null) {
                $stmt = $con->prepare("SELECT * FROM productos WHERE categoria LIKE ? ORDER BY $order");
                $categoria = "%" . $categoria . "%";
                $stmt->bind_param("s", $categoria);
            } else {
                $stmt = $con->prepare("SELECT * FROM productos ORDER BY $order");
            }
    
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

    //Afegir la comanda a la taula pedidos i els producte d'aquesta a la taula productos_pedidos
    public static function insertarPedido($idcliente, $iddescuento = null, $localidad, $codigopostal, $calle, $nombre, $telefono, $productos = []) {
        $con = DataBase::connect();
        $stmt = $con->prepare("INSERT INTO pedidos (id_cliente, id_descuento, localidad, codigopostal, calle, nombre, telefono) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("ddsdssd", $idcliente, $iddescuento, $localidad, $codigopostal, $calle, $nombre, $telefono);
        $stmt->execute();

        $id_pedido = $con->insert_id;

        for ($i=0; $i < count($productos); $i++) {
            $stmt = $con->prepare("INSERT INTO productos_pedidos VALUES(?,?)");
            $stmt->bind_param("dd", $id_pedido, $productos[$i]);
            $stmt->execute();
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