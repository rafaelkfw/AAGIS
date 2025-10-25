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
<table>
<tr>
                    <td>aluno</td>
                    <td>empresa</td>
                    <td>tipo</td>
                    <td>data_inicio</td>
                    <td>data_fim</td>
                    <td>status</td>
                    <td><a href='visualizar.php?id=['id']'>Visualizar</a></td>
                  </tr>
   <?php
        foreach($estagios as $Estagio){
            echo "<tr>";
                echo "<td>{$Estagio->getname()}</td>";
                echo "<td>{$Estagio->getdataInicio()}</td>";
                echo "<td>{$Estagio->getvinculoTrabalhista()}</td>";
                echo "<td>{$Estagio->getdataFim()}</td>";
                echo "<td>{$Estagio->getempresa()}</td>";
                echo "<td>{$Estagio->get$obrigatorio()}</td>";
                echo "<td>{$Estagio->getnameSupervisor()}</td>";
                echo "<td>{$Estagio->getemailSupervisor()}</td>";
                echo "<td>{$Estagio->getProfessor()}</td>";
                echo "<td>{$Estagio->getidAluno()}</td>";
                echo "<td>{$Estagio->getidProfessor()}</td>";
            echo "</tr>";
        }
    ?>
</table>

</body>
</html>

   <tr>
                <th>Aluno</th>
                <th>Empresa</th>
                <th>Tipo</th>
                <th>Início</th>
                <th>Término</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>