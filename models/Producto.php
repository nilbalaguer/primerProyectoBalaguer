<?php

abstract class Producto{
    protected $descripcion;
    protected $precio;
    protected $nombre;

    public function __construct($nombre, $descripcion, $precio) {
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->nombre = $nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function getNombre(){
        return $this->nombre;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }

    public function getPrecio(){
        return $this->precio;
    }
}