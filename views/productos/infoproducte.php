<div id="cartaBackground">
    <div id="carta">
        <button class="smallgreenbutton" onclick="window.history.back();"><- La Carta</button>
        <br>
        <?php
            $controller = new productoController();
            $info = $controller->veureUnProducte($_GET['prod'])[0];
        ?>

        <div class="cartaimages">
            <img src="/img/burgers/<?=$info->getImagen()?>.webp">
        </div>
        <br>
        <h2><?=$info->getNombre()?></h2>
        <p><?=$info->getDescripcion()?></p>
    </div>
</div>