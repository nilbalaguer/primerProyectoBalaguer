<?php

abstract class Producto{

    protected $id;
    protected $descripcion;
    protected $precio;
    protected $nombre;
    protected $imagen;

    public function __construct($id, $nombre, $descripcion, $precio, $imagen) {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->nombre = $nombre;
        $this->imagen = $imagen;
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

    public function getImagen() {
        return $this->imagen;
    }

    public function getId() {
        return $this->id;
    }
}