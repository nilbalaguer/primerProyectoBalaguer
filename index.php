<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>primerProyectoBalaguer</title>
</head>
<body>
    <h1>primerProyectoBalaguer</h1>
    <br><br>
    <form method="get" action="index.php">
        <label>Calculadora para Multiplicar</label>
        <br><br>
        <input type="number" id="valor1" name="valor1">
        <br><br>
        <input type="number" id="valor2" name="valor2">
        <br><br>
        <input type="submit" value="Calcular">
    </form>
    <?php
        if (isset($_GET['valor1'])) {
            $valor1 = $_GET['valor1'];
            $valor2 = $_GET['valor2'];

            $resultado = $valor1 * $valor2;

            echo ("Resultado: ".$resultado);
        }
    ?>
</body>
</html>