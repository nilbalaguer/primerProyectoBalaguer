<?php
    include_once "controllers/usuarioController.php";

    if (isset($_POST['usuario'])) {
        $session = new usuarioController();
        $session->startSession($_POST['usuario'], $_POST['contrasenya']);
    }
?>

<div id="fondoiniciasessio">
    <div id="divbee2">
        <img src="/img/bee.gif">
    </div>
    <div id="formularioiniciasessio">
        <div>
            <h2 class="heading2">INICIA SESSIO</h2>
        </div>
        <form action="/usuario/iniciaSessio" method="post">
            <label>Usuari:</label>
            <br>
            <input name="usuario" required>
            <br><br>
            <label>Clau d'acces:</label>
            <br>
            <input type="password" name="contrasenya" required>
            <br><br>
            <input class="greenbutton" type="submit" value="Entrar">
        </form>
        <div id="loginadiv">
            <a href="/usuario/registrarse">No tens conta? Registrat!</a>
        </div>
    </div>
    <div id="divbee">
        <img src="/img/bee.gif">
    </div>
</div>