<?php

include_once("config/dataBase.php");
include_once("models/Comestible.php");

class ProductoDAO {
    //Obte tots els productes aplicant o no categoria
    public static function getAll($categoria, $order = "precio") {
        try {
            $con = DataBase::connect();

            if ($categoria !== null) {
                $stmt = $con->prepare("SELECT * FROM productos WHERE categoria LIKE ? ORDER BY $order DESC");
                $categoria = "%" . $categoria . "%";
                $stmt->bind_param("s", $categoria);
            } else {
                $stmt = $con->prepare("SELECT * FROM productos ORDER BY $order DESC");
            }

            $stmt->execute();
            $result = $stmt->get_result();

            $productos = [];
            while ($producto = $result->fetch_object("Comestible")) {
                $productos[] = $producto;
            }

            $con->close();
            return $productos;
        } catch (\Throwable $th) {
            echo "<p style='font-size: 200%; font-weight: bold; color: red;'>Els nostres servidors no estan disponibles :(</p><p>Lamentem les molesties</p>";
            throw $th;
        }
    }

    //Afegir la comanda a la taula pedidos i els producte d'aquesta a la taula productos_pedidos
    public static function insertarPedido($idcliente, $localidad, $codigopostal, $calle, $nombre, $telefono, $productos, $preufinal, $iddescuento = null) {
        $con = DataBase::connect();
        $stmt = $con->prepare("INSERT INTO pedidos (id_cliente, id_descuento, localidad, codigopostal, calle, nombre, telefono, precio) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ddsdssdd", $idcliente, $iddescuento, $localidad, $codigopostal, $calle, $nombre, $telefono, $preufinal);
        $stmt->execute();

        $id_pedido = $con->insert_id;

        foreach ($productos as $id_producto) {
            $stmt = $con->prepare("INSERT INTO productos_pedidos VALUES(?,?)");
            $stmt->bind_param("dd", $id_pedido, $id_producto);
            $stmt->execute();
        }

        $con->close();
    }

    //Mostra les comandes que a realitzat el usuari
    public static function verPedidosCliente() {
        try {
            $con = DataBase::connect();

            $stmt = $con->prepare("SELECT * FROM pedidos WHERE id_cliente = ? ORDER BY id_pedido DESC");
            $stmt->bind_param("d", $_SESSION['id']);
            $stmt->execute();
            $result = $stmt->get_result();

            $pedidos = "";
            while ($pedido = $result->fetch_object()) {
                $pedidos .= "<div class='profileorderproducts'><h4 class='profileordertitle'><b>Identificador Comanda:</b> {$pedido->id_pedido}<br> <b>Descompte:</b> {$pedido->id_descuento} <b>Localitat:</b> {$pedido->localidad} <b>Codi Postal:</b> {$pedido->codigopostal} <b>Carrer:</b> {$pedido->calle} <b>Nom del client:</b> {$pedido->nombre} <b>Telefon:</b> {$pedido->telefono}</h4><div class='onlyproductsprofile'>";

                $stmt = $con->prepare("SELECT * FROM productos_pedidos WHERE id_pedido = ?");
                $stmt->bind_param("d", $pedido->id_pedido);
                $stmt->execute();
                $result1 = $stmt->get_result();

                $pedidos .= "<div class='divproductosdelperfil row'>";
                while ($pp = $result1->fetch_object()) {
                    $producto = ProductoDAO::getProductoById($pp->id_producto);
                    $pedidos .= "<div class='productoenperfildiv col'><img class='comandaimagesperfil' src='/img/burgers/{$producto[0]->getImagen()}.webp' alt='imatge producte'><p>{$producto[0]->getNombre()}</p><p>{$producto[0]->getPrecio()}€</p></div>";
                }

                $descompte = ProductoDAO::obtindreDescompte($pedido->id_descuento);
                $precioFinal = $descompte !== null 
                    ? number_format($pedido->precio - $pedido->precio * $descompte / 100, 2)
                    : number_format($pedido->precio, 2);

                $pedidos .= "</div></div><div class='divprecioperfil'><h2>{$precioFinal} €</h2></div></div>";
            }

            $con->close();
            return $pedidos;
        } catch (\Throwable $th) {
            echo "<p style='font-size: 200%; font-weight: bold; color: red;'>Els nostres servidors no estan disponibles :(</p><p>Lamentem les molesties</p>";
            throw $th;
        }
    }

    //Obte un producte segons la seva id
    public static function getProductoById($id) {
        try {
            $con = DataBase::connect();

            $stmt = $con->prepare("SELECT * FROM productos WHERE id = ?");
            $stmt->bind_param("d", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            $productos = [];
            while ($producto = $result->fetch_object("Comestible")) {
                $productos[] = $producto;
            }

            $con->close();
            return $productos;
        } catch (\Throwable $th) {
            echo "<p style='font-size: 200%; font-weight: bold; color: red;'>Els nostres servidors no estan disponibles :(</p><p>Lamentem les molesties</p>";
            throw $th;
        }
    }

    //Obte el descompte de la bbdd
    public static function obtindreDescompte($id) {
        try {
            $con = DataBase::connect();

            $stmt = $con->prepare("SELECT * FROM descuentos WHERE codigo = ?");
            $stmt->bind_param("d", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            $descuento = $result->fetch_object();

            $con->close();

            return $descuento ? $descuento->porcentaje : null;
        } catch (\Throwable $th) {
            echo "<p style='font-size: 200%; font-weight: bold; color: red;'>Els nostres servidors no estan disponibles :(</p><p>Lamentem les molesties</p>";
            throw $th;
        }
    }

    //Borrar
    public static function destroy($id) {
        $con = DataBase::connect();
        $stmt = $con->prepare("DELETE FROM camisetas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    //Borrar
    public static function store($producto) {
        $con = DataBase::connect();
        $stmt = $con->prepare("INSERT INTO camisas (nombre, talla, precio) VALUES (?,?,?)");
        $stmt->bind_param("ssd", $producto->getNombre(), $producto->getTalla(), $producto->getPrecio());
        $stmt->execute();
        $result = $stmt->get_result();

        $productos = [];
        while ($producto = $result->fetch_object("Camiseta")) {
            $productos[] = $producto;
        }

        $con->close();
    }
}
