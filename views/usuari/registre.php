<?php
    include_once "controllers/usuarioController.php";

    if (isset($_POST['usuario'])) {
        $session = new usuarioController();
        $session->createUser($_POST['usuario'], $_POST['nombre'], $_POST['contrasenya'], $_POST['contrasenyarepetida'], $_POST['codipostal'], $_POST['telefon'], $_POST['localitat'], $_POST['carrer']);
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
            <input name="usuario" required>
            <br><br>
            <label>Nom complet:</label>
            <br>
            <input name="nombre" required>
            <br><br>
            <label>Clau d'acces:</label>
            <br>
            <input type="password" name="contrasenya" required>
            <br><br>
            <label>Repeteix la clau:</label>
            <br>
            <input type="password" name="contrasenyarepetida" required>
            <br><br>
            <label>Codi Postal:</label>
            <br>
            <input type="number" name="codipostal" required>
            <br><br>
            <label>Telefon:</label>
            <br>
            <input maxlength="9" name="telefon" required>
            <br><br>
            <label>Localitat:</label>
            <br>
            <input name="localitat" required>
            <br><br>
            <label>Carrer:</label>
            <br>
            <input name="carrer" required>
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