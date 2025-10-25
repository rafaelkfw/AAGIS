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

    <a href="cadastro.php">Cadastrar novo estágio</a>
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Aluno</th>
                <th>Empresa</th>
                <th>Período</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($estagios as $estagio): ?>
            <tr>
                <td><?= htmlspecialchars($estagio->getIdEstagio()) ?></td>
                <td><?= htmlspecialchars($estagio->getName()) ?></td>
                <td><?= htmlspecialchars($estagio->getEmpresa()) ?></td>
                <td><?= htmlspecialchars($estagio->getDataInicio()) ?> - <?= htmlspecialchars($estagio->getDataFim()) ?></td>
                <td>
                    <?php
                        $s = $estagio->getStatus();
                        if($s == \Estagio::STATUS_FINALIZADO){
                            echo 'Finalizado';
                        } elseif($s == \Estagio::STATUS_ATIVO){
                            echo 'Ativo';
                        } else {
                            echo 'Em andamento';
                        }
                    ?>
                </td>
                <td>
                    <?php if($estagio->isFinalizado()): ?>
                        <span style="color:gray">Inacessível (finalizado)</span>
                    <?php else: ?>
                        <a href="visualizacao.php?idEstagio=<?= $estagio->getIdEstagio() ?>">Visualizar / Editar</a>
                        |
                        <a href="listagem.php?idEstagio=<?= $estagio->getIdEstagio() ?>">Alternar Status</a>
                        |
                        <a href="deletar.php?idEstagio=<?= $estagio->getIdEstagio() ?>" onclick="return confirm('Finalizar este estágio?')">Finalizar</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>