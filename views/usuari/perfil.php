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
        <form id="datosusuario">
            <label>Nom Complet:</label>
            <input value="<?=$_SESSION['nom'];?>">
            <br><br>
            <label>Telefon:</label>
            <input value="<?=$_SESSION['telefon'];?>">
            <br><br>
            <label>Codi Postal::</label>
            <input value="<?=$_SESSION['codipostal'];?>">
            <br><br>
            <label>Localitat:</label>
            <input value="<?=$_SESSION['localitat'];?>">
            <br><br>
            <label>Direccio:</label>
            <input value="<?=$_SESSION['carrer'];?>">
            <br>
        </form>
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