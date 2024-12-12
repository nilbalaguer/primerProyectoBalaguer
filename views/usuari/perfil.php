<?php
require_once "public/utils/protection.php";

if ($_SESSION['admin'] == 1) {
    header("Location: ".url."admin/panelAdmin");
}
?>

<div id="gridprofile">
    <div id="lateralperfil">
        <img id="fotoperfil" src="<?=url?>img/users/user<?=random_int(1,8)?>.png" alt="Foto de perfil">
        <br>
        <h2 id="nomperfil"><?=$_SESSION['usuari'];?></h2>
        <br>
        <div id="datosusuario">
            <h4>Nom Complet:</h4>
            <p><?=$_SESSION['nom'];?></p>
            <h4>Telefon:</h4>
            <p><?=$_SESSION['telefon'];?></p>
            <h4>CodiPostal:</h4>
            <p><?=$_SESSION['codipostal'];?></p>
            <h4>Localitat:</h4>
            <p><?=$_SESSION['localitat'];?></p>
            <h4>Direccio:</h4>
            <p><?=$_SESSION['carrer'];?></p>
        </div>
        <br>
    </div>

    <div id="restoperfil">
        <h1 class="heading2">Les meves Comandes</h1>
        <div>
            <?php
                $perfilcontroller = new productoController();
                echo $perfilcontroller->verPedidosCliente();

            ?>
        </div>
    </div>
</div>