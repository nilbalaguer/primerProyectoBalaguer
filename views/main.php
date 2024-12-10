<!DOCTYPE html>
<html lang="ca">
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
    <link rel="stylesheet" href="/css/admin.css">
    <title>FOODCRAFT</title>
</head>
<body>
    <header>
        <div>
            <img id="logoimageheader" src="/img/FoodCraft.webp" alt="FOODCRAFT">
        </div>
        <div id="centrallinks">
            <a href="<?=url?>producto/home">INICI</a>
            <a href="<?=url?>producto/lacarta">LA CARTA</a>
            <a class="d-none d-xl-block" href="<?=url?>producto/comanda">COMANDA</a>
        </div>
        <div id="divlinkclient">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                CLIENT
            </button>
            <ul class="dropdown-menu">
                <?php
                session_start();
                if (isset($_SESSION['usuari'])) {
                    echo "<li><h2 class='heading2 dropdown-item'>".$_SESSION['usuari']."</h2></li>";
                }
                ?>
                <li><a class="dropdown-item" href="<?=url?>usuario/iniciaSessio">Inicia Sessio</a></li>
                <li><a class="dropdown-item" href="<?=url?>usuario/tancaSessio">Tanca Sessio</a></li>
                <li><a class="dropdown-item" href="<?=url?>usuario/perfil">Perfil de usuari</a></li>
            </ul>
        </div>
        
    </header>

    <?php
        /*
        include_once("productos/listado.php");

        $vista;
        */
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>