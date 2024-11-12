<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//mi base de datos
$users = [
    ['id' => 1, 'nombre' => 'Juan Pérez', 'email' => 'juan@email.com', 'edad' => 19],
    ['id' => 2, 'nombre' => 'Juan Pérez', 'email' => 'juan@email.com', 'edad' => 19],
    ['id' => 3, 'nombre' => 'Juan Pérez', 'email' => 'juan@email.com', 'edad' => 19],
];

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'GET':
        if(isset($_GET['id'])) {
            $existe = false;
            foreach ($users as $user) {
                if ($user['id'] == $_GET['id']) {
                    echo json_encode([
                        'estado' => 'Exito',
                        'data' => $user
                    ]);
                    $existe = true;
                    break;
                }
            }

            if ($existe==false) {
                http_response_code(404);
            }
        } else {
            echo json_encode([
                'estado' => 'Exito',
                'data' => $users
            ]);
        }

        break;
    
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        echo json_encode($data);
        
        array_push($users, ['id' => 4, 'nombre', 'email' => 'oliver@gmail.com']);
        break;

        print_r($users);

    default:
        # code...
        break;
}