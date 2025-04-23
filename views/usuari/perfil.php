<div id="gridprofile">
    <div id="lateralperfil"  class="d-none d-lg-block">
        <img id="fotoperfil" src="<?=url?>img/users/user<?=random_int(1,8)?>.png" alt="Foto de perfil">
        <br>
        <h2 id="nomperfil"><?=$_SESSION['usuari'];?></h2>
        <br>
        <form id="datosusuario">
            <label>Nom Complet:</label>
            <br>
            <input value="<?=$_SESSION['nom'];?>">
            <br><br>
            <label>Telefon:</label>
            <br>
            <input value="<?=$_SESSION['telefon'];?>">
            <br><br>
            <label>Codi Postal:</label>
            <br>
            <input value="<?=$_SESSION['codipostal'];?>">
            <br><br>
            <label>Localitat:</label>
            <br>
            <input value="<?=$_SESSION['localitat'];?>">
            <br><br>
            <label>Direccio:</label>
            <br>
            <input value="<?=$_SESSION['carrer'];?>">
            <br>
        </form>
        <br>
    </div>

    <div id="restoperfil">
        <h1 class="heading2">Les meves Comandes</h1>
        <div>
            <?php
                echo $perfilcontroller->verPedidosCliente();

            ?>
        </div>
    </div>
</div>