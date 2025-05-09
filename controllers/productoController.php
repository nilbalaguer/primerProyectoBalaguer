<?php

include_once __DIR__ . "/../models/ProductoDAO.php";
include_once __DIR__ . "/../controllers/adminController.php";

class productoController{
    public function index(){

        $view = "views/prodcutos/listado.php";
        include_once("views/index.php");
    }

    public function comprovarIntolerancies($descripcion) {
        $intolerancias = "";

        if (strpos($descripcion, "lactosa") != false) {
            $intolerancias .= "<img class='imgintolerant' src='/img/intolerancies/lactosa.webp'>";
        } else {
            $intolerancias .= "<img class='imgintolerant' src='/img/intolerancies/lactosano.webp'>";
        }

        if (strpos($descripcion, "gluten") != false) {
            $intolerancias .= "<img class='imgintolerant' src='/img/intolerancies/gluten.webp'>";
        } else {
            $intolerancias .= "<img class='imgintolerant' src='/img/intolerancies/glutenno.webp'>";
        }

        return $intolerancias;
    }

    public function veureUnProducte($id) {
        $producto = new ProductoDAO();
        $info = $producto->getProductoById($id);

        return $info;
    }

    //Retorna les comandes fetes per el client
    public function verPedidosCliente() {
        $producto = new ProductoDAO();
        $info = $producto->verPedidosCliente();

        return $info;
    }

    //Finalitza la compra i inserta la comanda a la base de dades
    public function finalitzarCompra($idcliente, $localidad, $codigopostal, $calle, $nombre, $telefono, $productos = [], $iddescuento = null) {
        $producto = new ProductoDAO();
        $producto->insertarPedido($idcliente, $localidad, $codigopostal, $calle, $nombre, $telefono, $productos, productoController::preuFinal() ,$iddescuento);
        
        $admin = new adminController();
        $admin->registrarAccio("FinalitzarCompra");

        setcookie("carro", json_encode("hola"), time() + 0, "/");
        
        header("Location: /usuario/perfil");
    }

    //Obtindre productes de la base de dades
    public function mostrarProductes($categoria = null) {
        $producto = new ProductoDAO();
        $producto = $producto->getAll($categoria);

        return $producto;
    }

    //Afegeix productes al carro de la compra
    public function afegirProducte($id, $preu, $nom) {
        $producte = [
            "nom"=>$nom,
            "id"=>$id,
            "preu"=>$preu
        ];
        if (!isset($_COOKIE['carro'])) {
            $data = [$producte];
            setcookie("carro", json_encode($data), time() + 1000, "/");
        } else {
            $data = json_decode($_COOKIE['carro'], true);
            $data[] = $producte;
            setcookie("carro", json_encode($data), time() + 1000, "/");
        }
    }

    //Mostra els productes emagatzemats al carro
    public function veureCarro() {
        $data = json_decode($_COOKIE['carro'], true);

        $resultado = "<ol>";

        foreach ($data as $variable) {
            $resultado .= "<li>".$variable['nom']." ".$variable['preu']." € <a href='?eliminar=".$variable['id']."'><img src='/img/minus.webp' alt='-'></a></li>";
        }

        return $resultado."</ol>";
    }

    //Retorna la id dels productes del carro
    public function idCarro() {
        $data = json_decode($_COOKIE['carro'], true);
        $resultado = [];

        foreach ($data as $variable) {
            $resultado[] = $variable['id'];
        }

        return $resultado;
    }

    //Elimina un producte del carro
    public function eliminarProducte($id) {
        $data = json_decode($_COOKIE['carro'], true);

        $cont = 0;
        foreach ($data as $variable) {
            if ($variable['id'] == $id) {
                unset($data[$cont]);
                $data = array_values($data);
                break;
            }

            $cont++;
        }

        if (count($data) < 1) {
            setcookie("carro", "", time() - 3600, "/");
        } elseif (isset($_COOKIE['carro'])) {
            setcookie("carro", json_encode($data), time() + 1000, "/");
        }
    }

    //Retorna el preu final de la suma dels productes del carro
    public function preuFinal() {
        $data = json_decode($_COOKIE['carro'], true);
        $preu = 0;

        foreach ($data as $variable) {
            $preu += $variable['preu'];
        }

        return $preu + $preu * 0.10." €";
    }

    public function preuFinalSenseIva() {
        $data = json_decode($_COOKIE['carro'], true);
        $preu = 0;

        foreach ($data as $variable) {
            $preu += $variable['preu'];
        }

        return $preu." €";
    }

    //Aquesta funcio borra las cookies (Raons de desenvolupament)
    public function borrarCookies() {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time() - 3600, '/'); // Expira la cookie
                setcookie($name, '', time() - 3600, '/', $_SERVER['HTTP_HOST']); // Expira la cookie en el dominio
            }
        }

        header("Location: ".url."producto/home");
    }

    public function obtindreDescompte($id_descompte) {
        $producto = new ProductoDAO();
        $producto->obtindreDescompte($id_descompte);
    }
    
    //Dirigeix a la pagina home
    public function home() {
        include_once("views/home.php");
    }

    //Dirigeix a la pagina La Carta i carrega la seva logica
    public function lacarta() {

        include_once "controllers/productoController.php";

        $controllercarta = new productoController();

        if (isset($_GET['id'])) {
            $controllercarta->afegirProducte($_GET['id'], $_GET['preu'], $_GET['nom']);

            if (isset($_GET['categoria'])) {
                header("Location: ".url."producto/lacarta?categoria=".$_GET['categoria']);
            } else {
                header("Location: ".url."producto/lacarta?categoria");
            }
        } elseif (isset($_GET['eliminar'])) {
            $controllercarta->eliminarProducte($_GET['eliminar']);

            header("Location: ".url."producto/lacarta?categoria");
        }

        $productes = [];

        if (isset($_GET['categoria'])) {
            $productes = $controllercarta->mostrarProductes($_GET['categoria']);
        } else {
            $productes = $controllercarta->mostrarProductes();
        }

        include_once("views/lacarta.php");
    }

    //Dirigeix a la pagina de comanda
    public function comanda() {
        include_once "controllers/productoController.php";
        require_once "public/utils/protection.php";
        $controllercomanda = new productoController();
    
        if (isset($_GET['eliminar'])) {
            $controllercomanda->eliminarProducte($_GET['eliminar']);
        
            header("Location: ".url."producto/comanda");
        }
    
        if (isset($_POST['nomclient'])) {
            $controllercomanda->finalitzarCompra($_SESSION['id'], $_POST['localitat'], $_POST['codipostal'], $_POST['carrernumero'], $_POST['nomclient'], $_POST['telefon'], $controllercomanda->idCarro(), $_POST['codidescompte']);
        }

        $existe_carro = isset($_COOKIE['carro']);

        include_once("views/comanda.php");
    }

    public function infoproducte() {
        $controller = new productoController();
        $info = $controller->veureUnProducte($_GET['prod'])[0];

        include_once("views/productos/infoproducte.php");
    }
}