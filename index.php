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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>O cadastro do estagio </title>
    
</head>
<body>
<h1>estagios cadastrados</h1>
    <?php
    foreach($estagios as $estagio){
        if($estagio->isAtivo()){
            echo htmlspecialchars($estagio->getName()) . ' - ' . htmlspecialchars($estagio->getEmpresa()) . ' - <a href="visualizacao.php?idEstagio=' . $estagio->getIdEstagio() . '">Ver / Editar</a>';
            echo "<br>";
        }
    }
    ?>
<a href="sair.php">Sair</a> 


</body>
</html>