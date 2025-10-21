<?php
session_start();
if(!isset($_SESSION['idUsuario'])){
    header("location: cadastro.php");
}

if(isset($_GET['idEstagio'])){
     require_once __DIR__.'/classes/Estagio.php';
     Estagio::mudarStatus($_GET['idEstagio']);
}

require_once __DIR__.'/classes/Estagio.php';
$estagios = Estagio::findall();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Estágios</title>
</head>
<body>
    <h1>Lista de Estágios:</h1>


</body>
</html>