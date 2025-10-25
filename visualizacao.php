<?php
session_start();
if(!isset($_SESSION['idUsuario'])){
     header("Location: cadastro.php");
     exit;
}

require_once __DIR__ . '/classes/Estagio.php';

$estagio = null;
if(isset($_GET['idEstagio'])){
     $id = intval($_GET['idEstagio']);
     $estagio = Estagio::find($id);
}

// processa atualização
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save']) && isset($_POST['idEstagio'])){
     $id = intval($_POST['idEstagio']);
     $e = Estagio::find($id);
     $e->setDataInicio($_POST['dataInicio'] ?? $e->getDataInicio());
     $e->setDataFim($_POST['dataFim'] ?? $e->getDataFim());
     $e->setObrigatorio(isset($_POST['estagioTipo']) ? intval($_POST['estagioTipo']) : $e->isObrigatorio());
     $e->setVinculoTrabalhista(isset($_POST['vinculo']) ? intval($_POST['vinculo']) : $e->isVinculoTrabalhista());
     $e->setSetorEmpresa($_POST['setor'] ?? $e->getSetorEmpresa());
     $e->setEmpresa($_POST['nomeEmpresa'] ?? $e->getEmpresa());
     $e->setNameSupervisor($_POST['nomeSupervisor'] ?? $e->getNameSupervisor());
     $e->setEmailSupervisor($_POST['emailSupervisor'] ?? $e->getEmailSupervisor());
     $e->update();
     header('Location: listagem.php');
     exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
     <meta charset="UTF-8">
     <title>Visualizar / Editar Estágio</title>
</head>
<body>
     <h1>Visualizar / Editar Estágio</h1>

     <?php if(!$estagio): ?>
          <p>Nenhum estágio selecionado. <a href="listagem.php">Voltar à lista</a></p>
     <?php else: ?>
          <form method="post" action="visualizacao.php?idEstagio=<?= $estagio->getIdEstagio() ?>">
               <input type="hidden" name="idEstagio" value="<?= $estagio->getIdEstagio() ?>">

               <label>Data Início: <input type="date" name="dataInicio" value="<?= htmlspecialchars($estagio->getDataInicio()) ?>" required></label><br>
               <label>Data Fim: <input type="date" name="dataFim" value="<?= htmlspecialchars($estagio->getDataFim()) ?>" required></label><br>

               <label>Tipo de Estágio:
                    <label><input type="radio" name="estagioTipo" value="1" <?= $estagio->isObrigatorio() ? 'checked' : '' ?>> Obrigatório</label>
                    <label><input type="radio" name="estagioTipo" value="0" <?= !$estagio->isObrigatorio() ? 'checked' : '' ?>> Não Obrigatório</label>
               </label>

               <label>Vínculo:
                    <label><input type="radio" name="vinculo" value="1" <?= $estagio->isVinculoTrabalhista() ? 'checked' : '' ?>> Carteira</label>
                    <label><input type="radio" name="vinculo" value="0" <?= !$estagio->isVinculoTrabalhista() ? 'checked' : '' ?>> Sem Carteira</label>
               </label>

               <label>Setor: <input type="text" name="setor" value="<?= htmlspecialchars($estagio->getSetorEmpresa()) ?>"></label><br>
               <label>Empresa: <input type="text" name="nomeEmpresa" value="<?= htmlspecialchars($estagio->getEmpresa()) ?>"></label><br>
               <label>Supervisor: <input type="text" name="nomeSupervisor" value="<?= htmlspecialchars($estagio->getNameSupervisor()) ?>"></label><br>
               <label>E-mail Supervisor: <input type="email" name="emailSupervisor" value="<?= htmlspecialchars($estagio->getEmailSupervisor()) ?>"></label><br>

               <button type="submit" name="save">Salvar alterações</button>
               <a href="listagem.php">Voltar</a>
          </form>
     <?php endif; ?>

</body>
</html>
