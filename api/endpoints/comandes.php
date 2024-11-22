<?php
include_once "../dataBase.php";
include_once "/models/Comestible.php";

//echo json_encode("Núria ets la millor del mon i del univers");

$categoria = null;

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

echo json_encode($productos[0]->getNombre());