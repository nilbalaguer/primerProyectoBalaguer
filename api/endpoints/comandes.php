<?php
include_once __DIR__ . "/../../config/dataBase.php";
include_once __DIR__ . "/../../models/Comestible.php";

function mostrarTot($order) {

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
}

function eliminar($id) {
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
}

function clauAdmin() {
    return "080705";
}