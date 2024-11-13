<?php 
session_start();
?>

<div id="gridprofile">
    <div id="lateralperfil">
        <img id="fotoperfil" src="<?=url?>img/users/<?=$_SESSION['usuari'];?>.png" alt="Foto de perfil">
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
        <h1>La Meva Conta</h1>
        <div>si</div>
        <div>si</div>
    </div>
</div>