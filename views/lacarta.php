<?php 
include_once "controllers/productoController.php";
$controllercarta = new productoController();

if (isset($_GET['id'])) {
    $controllercarta->afegirProducte($_GET['id'], $_GET['preu'], $_GET['nom']);

    header("Location: ".url."producto/lacarta");
} elseif (isset($_GET['eliminar'])) {
    $controllercarta->eliminarProducte($_GET['eliminar']);

    header("Location: ".url."producto/lacarta");
}

$productes = [];

if (isset($_GET['categoria'])) {
    $productes = $controllercarta->mostrarProductes($_GET['categoria']);
} else {
    $productes = $controllercarta->mostrarProductes();
}

?>


<div id="cartaBackground">
    <div class="container d-flex flex-column align-items-center" id="carta">
        <div id="lacartatitle" class="text-center mb-3">
            <h2 class="heading2">LA CARTA</h2>
        </div>
        <div id="filtroslinks" class="d-flex justify-content-around mb-4">
            <a class="mx-2" href="lacarta?categoria=pollo">POLLASTRE</a>
            <a class="mx-2" href="lacarta?categoria=hamburgesa">HAMBURGESES</a>
            <a class="mx-2" href="lacarta">TOT</a>
            <a class="mx-2" href="lacarta?categoria=complements">COMPLEMENTS</a>
            <a class="mx-2" href="lacarta?categoria=vedella">VEDELLA</a>
        </div>
        <!--Finestra que es pot moure i mostra els productes afegits al carro-->
        <?php if (isset($_COOKIE['carro'])) {?>
        <div id="ventana">
            <div id="ventana-header"><h2 class="heading2">COMANDA</h2></div>
            <?php
                echo $controllercarta->veureCarro();
                echo "<br><br>Total: ".$controllercarta->preuFinal()."<br>";
            ?>
            <a class="smallgreenbutton" id="botonventanitacomanda" href="<?=url?>producto/comanda">FINALITZA LA COMPRA</a>
        </div>

        <script>
            //Js per moure la finestra
            const ventana = document.getElementById("ventana");
            const header = document.getElementById("ventana-header");

            let offsetX = 0, offsetY = 0, mouseX = 0, mouseY = 0;

            header.onmousedown = function(event) {
                event.preventDefault();
                
                mouseX = event.clientX;
                mouseY = event.clientY;

                document.onmousemove = moverVentana;
                document.onmouseup = detenerVentana;
            };

            function moverVentana(event) {
            event.preventDefault();

            offsetX = mouseX - event.clientX;
            offsetY = mouseY - event.clientY;

            mouseX = event.clientX;
            mouseY = event.clientY;

            ventana.style.top = (ventana.offsetTop - offsetY) + "px";
            ventana.style.left = (ventana.offsetLeft - offsetX) + "px";
            }

            function detenerVentana() {
            document.onmousemove = null;
            document.onmouseup = null;
            }
        </script>
        <?php } ?>

        <div id="divProductos">
            <?php for ($i = 0; $i < count($productes); $i += 3) { ?>
                <div class="row">
                    <?php for ($j = 0; $j < 3; $j++) {
                        $temporalId = $i + $j;
                        if ($temporalId >= count($productes)) break;
                        ?>
                        <div class="col">
                            <img class="cartaimages" src="/img/burgers/<?=$productes[$temporalId]->getImagen()?>.webp" alt="hamburgesa">
                            <h3><?=$productes[$temporalId]->getNombre()?></h3>
                            <div class="d-flex justify-content-around">
                                <p><?=$productes[$temporalId]->getPrecio()?> €</p>
                                <form method="GET" action="lacarta">
                                    <input hidden name="id" value="<?=$productes[$temporalId]->getId()?>">
                                    <input hidden name="preu" value="<?=$productes[$temporalId]->getPrecio()?>">
                                    <input hidden name="nom" value="<?=$productes[$temporalId]->getNombre()?>">
                                    <label for="submit<?=$productes[$temporalId]->getId()?>"><img src='/img/plus.png' alt='+'></label>
                                    <input hidden id="submit<?=$productes[$temporalId]->getId()?>" class="plusimage" type="submit" value="+" alt="Afegir">
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>