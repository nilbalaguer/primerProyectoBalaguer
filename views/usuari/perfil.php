<?php
require_once "public/utils/protection.php";
?>

<div id="gridprofile">
    <div id="lateralperfil">
        <img id="fotoperfil" src="<?=url?>img/users/user<?=random_int(1,8)?>.png" alt="Foto de perfil">
        <br>
        <h2 id="nomperfil"><?=$_SESSION['usuari'];?></h2>
        <br>
        <?=$_SESSION['nom'];?>
        <br>
        <br>
        <?=$_SESSION['id'];?>
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