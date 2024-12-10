<?php
include_once "endpoints/comandes.php";
include_once "endpoints/historial.php";
include_once "endpoints/productes.php";
include_once "endpoints/usuaris.php";
include_once "endpoints/admin.php";

$comandes = new Comandes();
$historial = new Historial();
$productes = new Productes();
$usuaris = new Usuari();
$admin = new Admin();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$metodo = $_SERVER['REQUEST_METHOD'];
session_start();

if ($metodo == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $usuario = $data['usuario'];
    $contrasenya = $data['contrasenya'];

    
    

    if (!$existeUsuario) {
        http_response_code(401); // No autorizado
        echo json_encode([
            'estado' => 'Error',
            'mensaje' => 'Usuario o contraseña incorrectos'
        ]);
    }
} elseif ($metodo == 'GET') {
    if (isset($_GET['clau'])) {
        if (password_verify($_GET['clau'], $admin->verificarContrasenya($_SESSION['usuari']))) {
            if(isset($_GET['test'])) {
                echo json_encode("Conexio Correcta Amb la API");
            } elseif (isset($_GET['comandes'])) {
                echo $comandes->mostrarTot($_GET['comandes']);
            } elseif (isset($_GET['eliminarComanda'])&&isset($_GET['clau'])) {
                echo $comandes->eliminar($_GET['eliminarComanda']);
            } elseif (isset($_GET['crearComanda'])) {
                echo $comandes->crear($_GET['id_client'], $_GET['descompte'], $_GET['localitat'], $_GET['codipostal'], $_GET['carrer'], $_GET['nom'], $_GET['telefon'], $_GET['preu']);
            } elseif (isset($_GET['modificarComanda'])) {
                echo $comandes->modificar($_GET['id_comanda'], $_GET['id_client'], $_GET['descompte'], $_GET['localitat'], $_GET['codipostal'], $_GET['carrer'], $_GET['nom'], $_GET['telefon'], $_GET['preu']);
            } elseif (isset($_GET['historial'])) {
                echo $historial->mostrar();
            } elseif (isset($_GET['productes'])) {
                echo $productes->mostrarTot($_GET['productes']);
            } elseif (isset($_GET['crearProducte'])) {
                echo $productes->crear($_GET['nom'], $_GET['descripcio'], $_GET['preu'], $_GET['imatge'], $_GET['categoria']);
            } elseif (isset($_GET['eliminarProducte'])) {
                echo $productes->eliminar($_GET['eliminarProducte']);
            } elseif (isset($_GET['modificarProducte'])) {
                echo $productes->modificar($_GET['id'], $_GET['nom'], $_GET['descripcio'], $_GET['preu'], $_GET['imatge'], $_GET['categoria']);
            } elseif (isset($_GET['usuaris'])) {
                echo $usuaris->mostrarTot($_GET['usuaris']);
            } elseif (isset($_GET['crearUsuari'])) {
                echo $usuaris->crear($_GET['nom'], $_GET['usuari'], $_GET['contrasenya']);
            } elseif (isset($_GET['eliminarUsuari'])) {
                echo $usuaris->eliminar($_GET['eliminarUsuari']);
            } elseif (isset($_GET['modificarUsuari'])) {
                echo $usuaris->modificar($_GET['id'], $_GET['nom'], $_GET['usuari'], $_GET['contrasenya']);
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