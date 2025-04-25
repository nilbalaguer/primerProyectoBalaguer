<div id="cartaBackground">
    <div class="container d-flex flex-column align-items-center" id="carta">
        <div id="lacartatitle" class="text-center mb-3">
            <h2 class="heading2">LA CARTA</h2>
        </div>
        <div id="filtroslinks" class="d-none d-lg-flex d-flex justify-content-around mb-4">
            <a class="mx-2 d-none d-lg-block <?=($_GET['categoria'] != "begudes") ? "botonfiltrocomanda" : "botonfiltrocomandaselect";?>" href="lacarta?categoria=begudes">BEGUDES</a>
            <a class="mx-2 d-none d-lg-block <?=($_GET['categoria'] != "pollo") ? "botonfiltrocomanda" : "botonfiltrocomandaselect";?>" href="lacarta?categoria=pollo">POLLASTRE</a>
            <a class="mx-2 <?=($_GET['categoria'] != "hamburgesa") ? "botonfiltrocomanda" : "botonfiltrocomandaselect";?>" href="lacarta?categoria=hamburgesa">HAMBURGUESES</a>
            <a class="mx-2 <?=($_GET['categoria'] == "") ? "botonfiltrocomandaselect" : "botonfiltrocomanda";?>" href="lacarta?categoria">TOT</a>
            <a class="mx-2 d-none d-lg-block <?=($_GET['categoria'] != "complements") ? "botonfiltrocomanda" : "botonfiltrocomandaselect";?>" href="lacarta?categoria=complements">COMPLEMENTS</a>
            <a class="mx-2 d-none d-lg-block <?=($_GET['categoria'] != "vedella") ? "botonfiltrocomanda" : "botonfiltrocomandaselect";?>" href="lacarta?categoria=vedella">VEDELLA</a>
            <a class="mx-2 d-none d-lg-block <?=($_GET['categoria'] != "postres") ? "botonfiltrocomanda" : "botonfiltrocomandaselect";?>" href="lacarta?categoria=postres">POSTRES</a>
        </div>

        <div id="filtroslinks" class="d-lg-none">
            <button class="botonfiltrocomandaDropDown dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                FILTRAR PER...
            </button>
            <ul class="dropdown-categorias dropdown-menu">
                <li><a href="lacarta?categoria=begudes">BEGUDES</a></li>
                <li><a href="lacarta?categoria=pollo">POLLASTRE</a></li>
                <li><a href="lacarta?categoria=hamburgesa">HAMBURGUESES</a></li>
                <li><a href="lacarta?categoria">TOT</a></li>
                <li><a href="lacarta?categoria=complements">COMPLEMENTS</a></li>
                <li><a href="lacarta?categoria=vedella">VEDELLA</a></li>
                <li><a href="lacarta?categoria=postres">POSTRES</a></li>
            </ul>
        </div>

        <!--Finestra que es pot moure i mostra els productes afegits al carro-->
        <?php if (isset($_COOKIE['carro'])) {?>
        <div id="ventana">
            <div id="ventana-header"><h2 class="heading2">COMANDA</h2></div>
            <div id="botonventanitacomanda">
                <?php
                    echo $controllercarta->veureCarro();
                    echo "<br><br>Total: ".$controllercarta->preuFinalSenseIva()."<br>";
                ?>
            </div>
            <a class="smallgreenbutton" href="<?=url?>producto/comanda">FINALITZA LA COMPRA</a>
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
                        <div class="col marcoproducto">
                            <div class="cartaimages">
                                <a href="infoproducte?prod=<?=$productes[$temporalId]->getId()?>"><img src="/img/burgers/<?=$productes[$temporalId]->getImagen()?>.webp" alt="Producte:<?=$productes[$temporalId]->getDescripcion()?>"></a>
                            </div>
                            <h3><?=$productes[$temporalId]->getNombre()?></h3>
                            <div class="d-flex justify-content-around">
                                <p><?=$productes[$temporalId]->getPrecio()?> €</p>
                                <form method="GET" action="lacarta">
                                    <input hidden name="id" value="<?=$productes[$temporalId]->getId()?>">
                                    <input hidden name="preu" value="<?=$productes[$temporalId]->getPrecio()?>">
                                    <input hidden name="nom" value="<?=$productes[$temporalId]->getNombre()?>">
                                    <?php if (isset($_GET['categoria'])) {
                                        echo '<input hidden name="categoria" value="'.$_GET['categoria'].'">';
                                    }?>
                                    <label for="submit<?=$productes[$temporalId]->getId()?>"><img class="plusimage" src='/img/plus.webp' alt='+'></label>
                                    <input hidden id="submit<?=$productes[$temporalId]->getId()?>" type="submit" value="+" alt="Afegir">
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>