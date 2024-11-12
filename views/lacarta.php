<?php 
include_once "controllers/productoController.php";
$controllercarta = new productoController();

if (isset($_GET['id'])) {
    $controllercarta->afegirProducte($_GET['id']);

    header("Location: ".url."producto/lacarta");
}

$productes = $controllercarta->mostrarProductes();

?>


<div id="cartaBackground">
    <div class="container d-flex flex-column align-items-center" id="carta">
        <div id="lacartatitle" class="text-center mb-3">
            <h2 class="heading2">LA CARTA</h2>
        </div>
        <div id="filtroslinks" class="d-flex justify-content-center mb-4 space-between">
            <a class="mx-2">POLLASTRE</a>
            <a class="mx-2">HAMBURGESES</a>
            <a class="mx-2">TOT</a>
            <a class="mx-2">COMPLEMENTS</a>
            <a class="mx-2">VEDELLA</a>
        </div>
        <!--Finestra que es pot moure i mostra els productes afegits al carro-->
        <?php if (isset($_COOKIE['carro'])) {?>
        <div id="ventana">
            <div id="ventana-header">Arrástrame</div>
            <?php
                foreach ($controllercarta->veureCarro() as $variable) {
                    echo $variable;
                }
            ?>
        </div>

        <script>
            // JavaScript para mover la ventana
            const ventana = document.getElementById("ventana");
            const header = document.getElementById("ventana-header");

            let offsetX = 0, offsetY = 0, mouseX = 0, mouseY = 0;

            header.onmousedown = function(event) {
            event.preventDefault();
            
            // Posición inicial del mouse
            mouseX = event.clientX;
            mouseY = event.clientY;

            document.onmousemove = moverVentana;
            document.onmouseup = detenerVentana;
            };

            function moverVentana(event) {
            event.preventDefault();

            // Calcular el nuevo cursor
            offsetX = mouseX - event.clientX;
            offsetY = mouseY - event.clientY;

            // Actualizar posición del mouse
            mouseX = event.clientX;
            mouseY = event.clientY;

            // Establecer la nueva posición de la ventana
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
            <?php for ($i=0; $i < count($productes)/3; $i++) {?>
                <div class="row">
                    <?php for ($j=0; $j < 3*count($productes); $j++) {?>
                        <div class="col">
                            <img class="cartaimages" src="/img/burgers/<?=$productes[$j + $i]->getImagen()?>.png" alt="hamburgesa">
                            <h3><?=$productes[$j + $i]->getNombre()?></h3>
                            <div class="d-flex justify-content-around">
                                <p><?=$productes[$j + $i]->getPrecio()?> €</p>
                                <form method="GET" action="lacarta">
                                    <input hidden name="id" value="<?=$productes[$j + $i]->getId()?>">
                                    <label for="submit<?=$productes[$j+$i]->getId()?>"><img src='/img/plus.png' alt='+'></label>
                                    <input hidden id="submit<?=$productes[$j+$i]->getId()?>" class="plusimage" type="submit" value="+" alt="Afegir">
                                </form>
                                
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>