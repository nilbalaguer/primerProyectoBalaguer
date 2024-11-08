<?php

include_once __DIR__ .  "/../models/ProductoDAO.php";

class productoController{
    public function index(){

        $view = "views/prodcutos/listado.php";
        include_once("views/index.php");
    }

    public function show() {
        echo"Muestra un producto";

        $producto = new ProductoDAO();
        $producto = $producto->getAll();

        echo "<table>";
        for ($i=0; $i < count($producto); $i++) { 
            echo "<tr>";
            echo "<td>".$producto[$i]->getNombre()."</td>";
            echo "<td>".$producto[$i]->getPrecio()."</td>";
            echo "<td>".$producto[$i]->getDescripcion()."</td>";
            echo "</tr>";
        }

        echo "</table>";
        return $producto;
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

    public function mostrarProductes() {
        $producto = new ProductoDAO();
        $producto = $producto->getAll();

        echo "<table>";
        for ($i=0; $i < count($producto); $i++) { 
            echo "<tr>";
            echo "<td style=\"color:black;\">".$producto[$i]->getNombre()."</td>";
            echo "<td style=\"color:black;\">".$producto[$i]->getPrecio()."</td>";
            echo "<td style=\"color:black;\">".$producto[$i]->getDescripcion()."</td>";
            echo "</tr>";
        }

        echo "</table>";
        return $producto;
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