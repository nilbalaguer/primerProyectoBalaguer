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

    public function afegirProducte($producte) {
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
        return json_decode($_COOKIE['carro']);
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