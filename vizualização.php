<?php

session_start();
if(!isset($_SESSION['idUsuario'])){
    header("location: cadastro.php");
}

if(isset($_GET['idEstagio'])){
     require_once __DIR__.'/classes/estagio.php';
     estagio::mudarStatus($_GET['idEstagio']);
}

require_once __DIR__.'/classes/estagio.php';
$estagios = estagio::findall();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>O cadastro do estagio </title>
    
</head>
<body>
<h1>Estágios Cadastrados</h1>
     <?php 
     foreach($estagios as $estagio){
        if($estagio->getStatus() == 1 ){
             echo "{$estagio->getEmpresa()} - <a href='cadastro.php?idEstagio={$estagio->getIdEstagio()}'>Fechar estagio</a>";
             echo "<br>";
        }
     } 
     ?>
    <a href="listagem.php">Voltar para listagem</a>

</body>
</html>