<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$users = [
    ['id' => 1, 'usuario' => 'admin', 'contrasenya' => 'nurlamillor', 'nombre' => 'Administrador', 'email' => 'admin@foodcraft.com'],
];

// Procesar solicitud POST para iniciar sesión
$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $usuario = $data['usuario'];
    $contrasenya = $data['contrasenya'];

    // Buscar el usuario en la base de datos (array de usuarios)
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
}
