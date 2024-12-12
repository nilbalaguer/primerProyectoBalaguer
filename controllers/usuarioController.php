<?php
//Totes les opcions de configuracio de usuari
include_once "models/UsuarioDAO.php";
include_once "controllers/adminController.php";

class usuarioController
{
    public function index() {
        usuarioController::perfil();
    }

    //Dirigeix a la pagina de inici de sessio
    public function iniciaSessio() {
        include_once "views/usuari/iniciaSessio.php";
    }

    //Dirigeix a la pagina de registre
    public function registrarse() {
        include_once "views/usuari/registre.php";
    }

    //Dirigeix a la pagina del perfil de usuari
    public function perfil() {
        include_once "views/usuari/perfil.php";
    }

    //Tanca la sessio del usuari
    public function tancaSessio() {
        session_start();

        $admin = new adminController;
        $admin->registrarAccio("CloseSession");

        session_destroy();

        header("Location:".url."usuario/iniciaSessio");
    }

    //Inicia la sessio del usuari
    public function startSession($usuari, $contrasenya) {
        $usuarioDAO = new UsuarioDAO();
        $resultado = $usuarioDAO->getUsuario($usuari);

        if ($resultado != null && password_verify($contrasenya,$resultado['contrasenya']) ) {
            session_destroy();
            session_start();

            $_SESSION['id'] = $resultado['id'];
            $_SESSION['usuari'] = $resultado['usuario'];
            $_SESSION['nom'] = $resultado['nombre'];
            $_SESSION['codipostal'] = $resultado['codigopostal'];
            $_SESSION['telefon'] = $resultado['telefono'];
            $_SESSION['localitat'] = $resultado['localidad'];
            $_SESSION['carrer'] = $resultado['calle'];
            $_SESSION['admin'] = $resultado['administrador'];

            $admin = new adminController();
            $admin->registrarAccio("StartSession");

            header("Location: " . url . "usuario/perfil");
        } else {
            echo "<div class='alert alert-danger'><h2>Usuari o Contrasenya incorrecta :(</h2></div>";
        }
    }

    //Registra a un usuari
    public function createUser($usuari, $nom, $contrasenya, $contrasenyarepetida, $codipostal, $telefon, $localitat, $carrer) {
        if ($contrasenya == $contrasenyarepetida) {
            $usuariDAO = new UsuarioDAO();

            //Si l'usuari ja existeix no creara la conta
            if ($usuariDAO->getUsuario($usuari) == null) {

                $usuariDAO->insertaUsuari($nom, $usuari, $contrasenya, $codipostal, $telefon, $localitat, $carrer);
                session_start();
                $_SESSION['id'] = 0;

                $admin = new adminController();
                $admin->registrarAccio("CreateUser:$usuari");
                session_destroy();

                header("Location: iniciaSessio");
            } else {
                echo "<div class='alert alert-danger'><h2>Aquest usuari ja existeix :(</h2></div>";
            }
        } else {
            echo "<div class='alert alert-danger'><h2>Les Claus no coinsideixen :(</h2></div>";
        }
    }
}
