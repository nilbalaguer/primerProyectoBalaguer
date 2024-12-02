<?php

include_once __DIR__ . "/../models/ProductoDAO.php";
include_once __DIR__ . "/../controllers/adminController.php";

class productoController{
    public function index(){

        $view = "views/prodcutos/listado.php";
        include_once("views/index.php");
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
            setcookie("carro", json_encode($data), time() + 600, "/");
        } else {
            $data = json_decode($_COOKIE['carro'], true);
            $data[] = $producte;
            setcookie("carro", json_encode($data), time() + 600, "/");
        }
    }

    //Mostra els productes emagatzemats al carro
    public function veureCarro() {
        $data = json_decode($_COOKIE['carro'], true);
        $resultado = "<ol>";

        foreach ($data as $variable) {
            $resultado .= "<li>".$variable['nom']." ".$variable['preu']." € <a href='?eliminar=".$variable['id']."'><img src='/img/minus.png' alt='-'></a></li>";
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

        if (isset($_COOKIE['carro'])) {
            setcookie("carro", json_encode($data), time() + 600, "/");
        }
    }

    //Retorna el preu final de la suma dels productes del carro
    public function preuFinal() {
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
    
    //Dirigeix a la pagina home
    public function home() {
        include_once("views/home.php");
    }

    //Dirigeix a la pagina La Carta
    public function lacarta() {
        include_once("views/lacarta.php");
    }

    //Dirigeix a la pagina de comanda
    public function comanda() {
        include_once("views/comanda.php");
    }
}