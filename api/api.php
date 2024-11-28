<?php
include_once "endpoints/comandes.php";

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
    if (isset($_GET['clau'])) {
        if ($_GET['clau'] == clauAdmin()) {
            if(isset($_GET['test'])) {
                echo json_encode("Conexio Correcta Amb la API");
            } elseif (isset($_GET['comandes'])) {
                echo mostrarTot($_GET['comandes']);
            } elseif (isset($_GET['eliminar'])&&isset($_GET['clau'])) {
                echo eliminar($_GET['eliminar']);
            } elseif (isset($_GET['crear'])) {
                echo crear($_GET['id_client'], $_GET['descompte'], $_GET['localitat'], $_GET['codipostal'], $_GET['carrer'], $_GET['nom'], $_GET['telefon'], $_GET['preu']);
            } elseif (isset($_GET['modificar'])) {
                echo modificar($_GET['id_comanda'], $_GET['id_client'], $_GET['descompte'], $_GET['localitat'], $_GET['codipostal'], $_GET['carrer'], $_GET['nom'], $_GET['telefon'], $_GET['preu']);
            } else {
                echo json_encode("Operacio Desconeguda");
            }
        } else {
            echo json_encode("Error La Clau no es Correcta");
        }
    } else {
        echo json_encode("Error Clau no creada");
    }
}