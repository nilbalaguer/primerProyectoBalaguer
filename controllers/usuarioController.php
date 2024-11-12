<?php
//Totes les opcions de configuracio de usuari

class usuarioController
{
    public function iniciaSessio() {
        //Dirigeix a la pagina de inici de sessio
        include_once "views/usuari/iniciaSessio.php";
    }

    public function perfil() {
        //Dirigeix a la pagina del perfil de usuari
        include_once "views/usuari/perfil.php";
    }

    public function startSession($usuari, $contrasenya) {
        //Inicia la sessio de l'usuari
        echo "Usuari: ".$usuari." Contrasenya: ".$contrasenya;

        session_destroy();
        session_start();
        $_SESSION['usuari'] = $usuari;


        header("Location: " . url . "usuario/perfil");
    }

    public function tancaSessio() {
        //Tanca la sessio
        echo "caca";

        session_start();
        session_destroy();
    }
}
