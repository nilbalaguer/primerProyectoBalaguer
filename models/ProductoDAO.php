<?php

include_once("config/dataBase.php");
include_once("models/Comestible.php");

class ProductoDAO{
    //Obte tots els productes aplicant o no categoria
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

    //Borrar
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
    public static function insertarPedido($idcliente, $localidad, $codigopostal, $calle, $nombre, $telefono, $productos, $preufinal, $iddescuento = null) {
        $con = DataBase::connect();
        $stmt = $con->prepare("INSERT INTO pedidos (id_cliente, id_descuento, localidad, codigopostal, calle, nombre, telefono, precio) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ddsdssdd", $idcliente, $iddescuento, $localidad, $codigopostal, $calle, $nombre, $telefono, $preufinal);
        $stmt->execute();

        $id_pedido = $con->insert_id;

        for ($i=0; $i < count($productos); $i++) {
            $stmt = $con->prepare("INSERT INTO productos_pedidos VALUES(?,?)");
            $stmt->bind_param("dd", $id_pedido, $productos[$i]);
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
            while ($row = $result->fetch_assoc()) {
                $pedidos .= "<div class='profileorderproducts'><h4 class='profileordertitle'><b>Identificador Comanda:</b> ".$row['id_pedido']."<br> <b>Descompte:</b> ".$row['id_descuento']." <b>Localitat:</b> ".$row['localidad']." <b>Codi Postal:</b> ".$row['codigopostal']." <b>Carrer:</b> ".$row['calle']." <b>Nom del client:</b> ".$row['nombre']." <b>Telefon:</b> ".$row['telefono']."</h4><div class='onlyproductsprofile'>";
                $stmt = $con->prepare("SELECT * FROM productos_pedidos WHERE id_pedido = ?");
                $stmt->bind_param("d", $row['id_pedido']);

                $stmt->execute();
                $result1 = $stmt->get_result();
                $pedidos .= "<div class='divproductosdelperfil'>";
                while ($row1 = $result1->fetch_assoc()) {
                    $producto = ProductoDAO::getProductoById($row1['id_producto']);
                    $pedidos .= "<div class='productoenperfildiv'><img class='comandaimagesperfil' src='/img/burgers/".$producto[0]->getImagen().".webp' alt='imatge producte'><p>".$producto[0]->getNombre()."</p><p>".$producto[0]->getPrecio()."€</p></div>";
                }
                $pedidos .= "</div></div><div class='divprecioperfil'><h2>".$row['precio']." €</h2></div></div>";
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

    //Borrar
    public static function destroy($id) {
        $con = DataBase::connect();
        $stmt = $con->prepare("DELETE FROM camisetas WHERE id = ?");
        $stmt-> bind_param("i", $id);
        $stmt-> execute();
        $stmt-> close();
    }
}