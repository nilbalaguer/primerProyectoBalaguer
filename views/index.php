<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/stylemenufooter.css">
    <link rel="stylesheet" href="/css/styledefaults.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/comanda.css">
    <link rel="stylesheet" href="/css/carta.css">
    <link rel="stylesheet" href="/css/perfil.css">
    <title>FOODCRAFT</title>
</head>
<body>
    <header>
        <div>
            <img id="logoimageheader" src="/img/FoodCraft.png" alt="FOODCRAFT">
        </div>
        <div id="centrallinks">
            <a href="<?=url?>producto/home">INICI</a>
            <a href="<?=url?>producto/lacarta">LA CARTA</a>
            <a class="d-none d-xl-block" href="<?=url?>producto/comanda">COMANDA</a>
        </div>
        <div id="divlinkclient">
            <a id="maindesplegable" href="#">CLIENT</a>
            <?php
            if (isset($_SESSION['usuari'])) {
                echo $_SESSION['usuari'];
            } ?>
            <div class="desplegablemenu">
                <a href="<?=url?>usuario/iniciaSessio">Inicia Sessio</a>
                <a href="<?=url?>usuario/tancaSessio">Tanca Sessio</a>
                <a href="<?=url?>usuario/perfil">Perfil de usuari</a>
            </div>
        </div>
    </header>

    <?php
        /*
        include_once("productos/listado.php");

        $vista;
        */
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>