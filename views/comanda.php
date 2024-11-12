<div id="backgroundcomanda">
    <form id="formulariocomanda" class="container" method="post" action="">
        <div class="text-center d-flex justify-content-center">
            <h2 class="heading2">COMANDA</h2>
            <img src="/img/coin.png">
        </div>
        <div class="row" id="divform">
            <div class="col">
                <label>Localitat:</label>
                <br>
                <input name="localitat" type="text">
                <br><br>
                <label>Codi Postal:</label>
                <br>
                <input name="codipostal" type="text">
                <br><br>
                <label>Carrer i Número:</label>
                <br>
                <input name="carrernumero" type="text">
            </div>
            <div class="col">
                <label>Nom i Cognom:</label>
                <br>
                <input name="nomclient" type="text">
                <br><br>
                <label>Numero de Telèfon:</label>
                <br>
                <input name="telefon" type="text">
                <br><br>
                <label>Codi de Descompte:</label>
                <br>
                <input name="codidescompte" type="text">
            </div>
            <div class="col" id="demanatbox">
                <?php
                    include_once "controllers/productoController.php";
                    $controllercomanda = new productoController();

                    if (isset($_COOKIE['carro'])) {
                        foreach ($controllercomanda->veureCarro() as $variable) {
                            echo $variable;
                        }
                    } else {
                        echo "No has afegit res al carro";
                    }
                
                ?>
            </div>
        </div>
        <div class="text-center">
            <input class="greenbutton" type="submit" value="FINALITZA LA COMPRA">
        </div>
    </form>
</div>