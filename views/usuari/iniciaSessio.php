<?php
    include_once "controllers/usuarioController.php";

    if (isset($_POST['usuario'])) {
        $session = new usuarioController();
        $session->startSession($_POST['usuario'], $_POST['contrasenya']);
    }
?>

<div style="background-color: black; color: black;">
    <div>
        <form action="/usuario/iniciaSessio" method="post">
            <label>Nombre</label>
            <input name="usuario">
            <br><br>
            <label>Clau d'acces</label>
            <input type="password" name="contrasenya">
            <br><br>
            <input type="submit">
        </form>
    </div>
</div>