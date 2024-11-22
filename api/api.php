<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$users = [
    ['id' => 1, 'usuario' => 'admin', 'contrasenya' => 'nurlamillor', 'nombre' => 'Administrador', 'email' => 'admin@foodcraft.com'],
];

$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $usuario = $data['usuario'];
    $contrasenya = $data['contrasenya'];

    $existeUsuario = false;
    foreach ($users as $user) {
        if ($user['usuario'] == $usuario && $user['contrasenya'] == $contrasenya) {
            echo json_encode([
                'estado' => 'Exito',
                'mensaje' => 'Sesión iniciada',
                'usuario' => $user
            ]);
            $existeUsuario = true;
            break;
        }
    }

    if (!$existeUsuario) {
        http_response_code(401); // No autorizado
        echo json_encode([
            'estado' => 'Error',
            'mensaje' => 'Usuario o contraseña incorrectos'
        ]);
    }
} elseif ($metodo == 'GET') {
    if(isset($_GET['id'])) {
        echo json_encode("Núria guapa");
    } elseif (isset($_GET['comandes'])) {
        include_once "dataBase.php";
        include_once "http://primerProyectoBalaguer/models/Comestible.php";

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
    }
}
