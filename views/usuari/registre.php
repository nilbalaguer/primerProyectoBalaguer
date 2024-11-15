<?php
    include_once "controllers/usuarioController.php";

    if (isset($_POST['usuario'])) {
        $session = new usuarioController();
        $session->createUser($_POST['usuario'], $_POST['nombre'], $_POST['contrasenya'], $_POST['contrasenyarepetida'], $_POST['imagen']);
    }
?>

<div id="fondoiniciasessio">
    <div id="divbee2">
        <img src="/img/bee.gif">
    </div>
    <div id="formularioiniciasessio">
        <div>
            <h2 class="heading2">REGISTRE</h2>
        </div>
        <form action="/usuario/registrarse" method="post">
            <label>Nom d'usuari:</label>
            <br>
            <input name="usuario">
            <br><br>
            <label>Nom complet:</label>
            <br>
            <input name="nombre">
            <br><br>
            <label>Clau d'acces:</label>
            <br>
            <input type="password" name="contrasenya">
            <br><br>
            <label>Repeteix la clau:</label>
            <br>
            <input type="password" name="contrasenyarepetida">
            <br><br>
            <label>Imatge de Perfil:</label>
            <br>
            <input type="file" name="imagen">
            <br><br>
            <input class="greenbutton" type="submit" value="Registrarse">
        </form>
        <div id="loginadiv">
            <a href="/usuario/iniciaSessio">Ja tens conta? Inicia sessio!</a>
        </div>
    </div>
    <div id="divbee">
        <img src="/img/bee.gif">
    </div>
</div>