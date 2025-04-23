<div id="cartaBackground">
    <div id="infoproductes">
        <button class="smallgreenbutton" onclick="window.history.back();"><- La Carta</button>
        <br>

        <div class="cartaimages">
            <img src="/img/burgers/<?=$info->getImagen()?>.webp">
        </div>
        <br>
        <h2><?=$info->getNombre()?></h2>
        <p><?=$info->getDescripcion()?></p>
        <br><br>
        <?=$controller->comprovarIntolerancies($info->getDescripcion())?>
    </div>
</div>