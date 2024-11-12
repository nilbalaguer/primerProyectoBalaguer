<?php 
session_start();
?>

<h1>Perfil</h1>

<?=$_SESSION['id'];?>
<br>
<?=$_SESSION['usuari'];?>
<br>
<?=$_SESSION['nom'];?>
<br>