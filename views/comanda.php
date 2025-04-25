<div id="backgroundcomanda">
    <form id="formulariocomanda" class="container" method="post" action="comanda">
        <div class="text-center d-flex justify-content-center">
            <h2 class="heading2">COMANDA</h2>
            <img src="/img/coin.webp">
        </div>
        <div class="row" id="divform">
            <div class="col">
                <label>Localitat:</label>
                <br>
                <input name="localitat" type="text" required value="<?=$_SESSION['localitat']?>">
                <br><br>
                <label>Codi Postal:</label>
                <br>
                <input name="codipostal" type="number" required value="<?=$_SESSION['codipostal']?>">
                <br><br>
                <label>Carrer i Número:</label>
                <br>
                <input name="carrernumero" type="text" required value="<?=$_SESSION['carrer']?>">
            </div>
            <div class="col">
                <label>Nom i Cognom:</label>
                <br>
                <input name="nomclient" type="text" required value="<?=$_SESSION['nom']?>">
                <br><br>
                <label>Numero de Telèfon:</label>
                <br>
                <input name="telefon" type="tel" maxlength="9" required value="<?=$_SESSION['telefon']?>">
                <br><br>
                <label>Codi de Descompte:</label>
                <br>
                <input name="codidescompte" type="text">
            </div>
            <div class="col" id="demanatbox">
                <?php
                    if ($existe_carro) {
                        echo $controllercomanda->veureCarro();
                        echo "<br><br>Total: ".$controllercomanda->preuFinal(). "<br><p>Amb IVA inclos</p>";
                    } else {
                        echo "No has afegit res al carro";
                    }
                
                ?>
            </div>
        </div>
        <div class="text-end">
            <input <?=($existe_carro == false) ? "disabled" : "";?> class="greenbutton d-none d-lg-block" type="submit" value="FINALITZA LA COMPRA">
            <input <?=($existe_carro == false) ? "disabled" : "";?> class="smallgreenbutton d-lg-none" type="submit" value="FINALITZA LA COMPRA">
        </div>
    </form>
</div>