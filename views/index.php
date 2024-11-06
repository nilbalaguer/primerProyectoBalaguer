<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylemenufooter.css">
    <link rel="stylesheet" href="css/styledefaults.css">
    <link rel="stylesheet" href="css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>FOODCRAFT</title>
</head>
<body>
    <header>
        <div>
            <img id="logoimageheader" src="img/FoodCraft.png" alt="FOODCRAFT">
        </div>
        <div id="centrallinks">
            <a>INICI</a>
            <a>LA CARTA</a>
            <a>COMANDA</a>
        </div>
        <div id="divlinkclient">
            <a>CLIENT</a>
        </div>
    </header>


    <?php
        include_once("productos/listado.php");

        $vista;
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>