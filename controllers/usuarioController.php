<?php
//Totes les opcions de configuracio de usuari
include_once "models/UsuarioDAO.php";

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

    public function tancaSessio() {
        //Tanca la sessio

        session_start();
        session_destroy();

        header("Location:".url."producto/home");
    }

    public function startSession($usuari, $contrasenya) {
        //Inicia la sessio de l'usuari
        $usuarioDAO = new UsuarioDAO();
        $resultado = $usuarioDAO->getUsuario($usuari);

        if ($resultado != null && $contrasenya == $resultado['contrasenya']) {
            session_destroy();
            session_start();

            $_SESSION['id'] = $resultado['id'];
            $_SESSION['usuari'] = $resultado['usuario'];
            $_SESSION['nom'] = $resultado['nombre'];

            header("Location: " . url . "usuario/perfil");
        } else {
            echo "Usuari o Contrasenya incorrecta :(";
        }
    }
}
