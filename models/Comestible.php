<?php
include_once("models/Producto.php");

class Comestible extends Producto{
    public function __construct($nombre = null, $descripcion = null, $precio = null){
        parent::__construct($nombre, $descripcion, $precio);
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }
}