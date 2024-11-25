<?php
include_once __DIR__."/Producto.php";

class Comestible extends Producto{
    public function __construct($id, $nombre, $descripcion = null, $precio = null, $imagen = null){
        parent::__construct($id, $nombre, $descripcion, $precio, $imagen);
    }
}