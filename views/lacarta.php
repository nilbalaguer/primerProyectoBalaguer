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
        <div id="divProductos">
            <?php 
                $controller = new productoController();
                $productes = $controller->mostrarProductes();
            ?>

            <?php for ($i=0; $i < count($productes)/3; $i++) {?>
                <div class="row">
                    <?php for ($j=0; $j < 3*count($productes); $j++) {?>
                        <div class="col">
                            <img class="cartaimages" src="/img/burgers/<?=$productes[$j + $i]->getImagen()?>.png" alt="hamburgesa">
                            <h3><?=$productes[$j + $i]->getNombre()?></h3>
                            <div class="d-flex justify-content-around">
                                <p><?=$productes[$j + $i]->getPrecio()?> €</p>
                                <a class="plusimage" href="#"><img src="/img/plus.png" alt="Afegir"></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>