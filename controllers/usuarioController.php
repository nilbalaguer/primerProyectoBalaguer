<?php
//Totes les opcions de configuracio de usuari
include_once "models/UsuarioDAO.php";

class usuarioController
{
    public function iniciaSessio() {
        //Dirigeix a la pagina de inici de sessio
        include_once "views/usuari/iniciaSessio.php";
    }

    public function registrarse() {
        include_once "views/usuari/registre.php";
    }

    public function perfil() {
        //Dirigeix a la pagina del perfil de usuari
        include_once "views/usuari/perfil.php";
    }

    public function tancaSessio() {
        //Tanca la sessio

        session_start();
        session_destroy();

        header("Location:".url."usuario/iniciaSessio");
    }

    public function startSession($usuari, $contrasenya) {
        //Inicia la sessio de l'usuari
        $usuarioDAO = new UsuarioDAO();
        $resultado = $usuarioDAO->getUsuario($usuari);

        if ($resultado != null && password_verify($contrasenya,$resultado['contrasenya']) ) {
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

    public function createUser($usuari, $nom, $contrasenya, $contrasenyarepetida, $imatge) {
        if ($contrasenya == $contrasenyarepetida) {
            echo "Creant conta...";
            $usuariDAO = new UsuarioDAO();
            $usuariDAO->insertaUsuari($nom, $usuari, $contrasenya);
        } else {
            echo "Les Claus no coinsideixen :(";
        }

        echo $usuari.$nom.$contrasenya.$contrasenyarepetida.$imatge;
    }
}
