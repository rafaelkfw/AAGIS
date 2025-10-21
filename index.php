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
<h1>estagios cadastrados</h1>
     <?php 
     foreach($estagios as $estagio){
        if($estagio->getstatus() == 1 ){
             echo "{$estagio->getdescricao()} - {$estagio->getempresa()} - <a href='cadastro.php?idEstagio={$estagio->getidEstagio()}'>Fechar estagio</a>";
             echo "<br>";
        }
    

     } 
     ?>
<a href="sair.php">Sair</a> 


</body>
</html>