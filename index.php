<?php
include_once "controllers/productoController.php";
include_once "controllers/usuarioController.php";
include_once "config/parameters.php";
//Importa el menu i el estilo
include_once "views/index.php";

if (!isset($_GET['controller'])) {
    header("Location: " . url . "producto/home");
} else {
    //Establece el nombre del controlador
    $nombre_controller = $_GET["controller"]."Controller";
    if (class_exists($nombre_controller)) {
        //Instancia el controlador
        $controller = new $nombre_controller();

        //Comprueba si action existe
        if(isset($_GET["action"]) && method_exists( $controller, $_GET["action"] )) {
            $action = $_GET["action"];
        } else {
            //Default action esta definido en parameters.php
            $action = default_action;
        }

        //ejecuta action en el controlador
        $controller -> $action();
    } else {
        echo "No existe el Controller ".$nombre_controller;
    }
}

include_once "views/footer.php";
