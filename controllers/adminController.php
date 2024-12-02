<?php
include_once __DIR__ .  "/../models/AdminDAO.php";

class adminController
{
    //Dirigeix al admin a la pagina de inici de sessio de admin
    public function iniciaSessio() {
        include_once "views/admin/iniciaSessio.html";
    }

    //Dirigeix al adimn al panell d'administracio
    public function panelAdmin() {
        include_once "views/admin/panel.html";
    }

    public function registrarAccio($accio) {
        AdminDAO::insertarAccio($accio);
    }
}
