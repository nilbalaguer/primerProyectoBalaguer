<?php

include_once __DIR__ .  "/../models/ProductoDAO.php";

class productoController{
    public function index(){

        $view = "views/prodcutos/listado.php";
        include_once("views/index.php");
    }

    public function newProducto() {
        echo"Crear nuevo producto";
    }

    public function crear() {
        /*
        $producto = new CamisetaDAO();
        $producto = $producto->getAll();
        $producto = $producto->store($producto);
        */

        include_once("views/productos/create.php");
        
    }

    //Obtindre productes de la base de dades
    public function mostrarProductes() {
        $producto = new ProductoDAO();
        $producto = $producto->getAll();

        return $producto;
    }

    public function afegirProducte($id, $preu, $nom) {
        $producte = [
            "nom"=>$nom,
            "id"=>$id,
            "preu"=>$preu
        ];
        if (!isset($_COOKIE['carro'])) {
            $data = [$producte];
            setcookie("carro", json_encode($data), time() + 500, "/");
        } else {
            $data = json_decode($_COOKIE['carro'], true);
            $data[] = $producte;
            setcookie("carro", json_encode($data), time() + 500, "/");
        }
    }

    public function veureCarro() {
        $data = json_decode($_COOKIE['carro'], true);
        $resultado = "<ol>";

        foreach ($data as $variable) {
            $resultado .= "<li>".$variable['nom']." ".$variable['preu']." €</li>";
        }

        return $resultado."</ol>";
    }

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
    
    public function home() {
        include_once("views/home.php");
    }

    public function lacarta() {
        include_once("views/lacarta.php");
    }

    public function comanda() {
        include_once("views/comanda.php");
    }
}