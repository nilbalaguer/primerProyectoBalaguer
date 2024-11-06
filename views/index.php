<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylemenufooter.css">
    <link rel="stylesheet" href="css/styledefaults.css">
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