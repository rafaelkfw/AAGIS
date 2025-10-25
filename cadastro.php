<?php
// TIRAR TODA A PARTE DO LOGIN DEPOIS QUE FAZER O CADASTRO.
if(isset($_POST['botao'])){
    require_once __DIR__."\classes\Estagio.php";
    require_once __DIR__."\classes\Aluno.php";
    session_start();
    $e = new Estagio($_SESSION['nome'],$_POST['dataInicio'],$_POST['dataFim'],$_POST['nomeEmpresa'],
    $_POST['setor'],$_POST['vinculo'],$_POST['estagioTipo'],$_POST['nomeSupervisor'],$_POST['emailSupervisor']
    , $_SESSION['idAluno'], $_SESSION['idProfessor']);
    $e->save();
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Estágio</title>
</head>
<body>
    <h1>Fazer Cadastro:</h1>
    <form action='formCadEstagio.php' method='post'>

        <label for='dataInicio'>Data de Início: </label>
        <input type='date' name='dataInicio' id='dataInicio' required>

        <label for='dataDeFim'>Data de Fim: </label>
        <input type='date' name='dataDeFim' id='dataDeFim' required>

        <label for='tipoDeEstagio'>Tipo de Estágio: </label>
        <input type='radio' name='tipoEstagio' id='obrigatorio' required>
        <input type='radio' name='tipoEstagio' id='naoObrigatorio' required>

        <label for='vinculo'>Vínculo Trabalhista: </label>
        <input type='radio' name='vinculo' id='vinculo' required>

        <label for='setor'>Setor Atuante: </label>
        <input type='setor' name='setor' id='setor' required>

        <label for='nomeEmpresa'>Nome da Empresa: </label>
        <input type='nomeEmpresa' name='nomeEmpresa' id='nomeEmpresa' required>

        <label for='nomeSuper'>Nome do Supervisor: </label>
        <input type='nomeSuper' name='nomeSuper' id='nomeSuper' required>
        
        <label for='emailSuper'>E-mail do Survisor: </label>
        <input type='emailSuper' name='emailSuper' id='emailSuper' required>

        <!-- botões -->
        <input type='button' name='botaoCadastro'> Cadastrar
        <input type='button' name='botaoCancelar' href='sair.php'> Cancelar
    
</body>
</html>