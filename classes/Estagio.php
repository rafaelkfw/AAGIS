<?php
require_once __DIR__."/../bd/MySQL.php";

class Estagio{

    private int $idEstagio;
    
    public function __construct(private string $name, private date $dataInicio, private date $dataFim,
    private string $empresa, private string $setorEmpresa, private bool $vinculoTrabalhista, 
    private bool $obrigatorio, private string $nameSupervisor, private string $emailSupervisor, 
    private string $Professor, private int $idAluno, private int $idProfessor){
    }

    public function getIdEstagio(){
        return $this->idEstagio;
    }

    public function setIdEstagio($idEstagio): void{
        $this->idEstagio = $idEstagio;
    }

    public function getIdAluno(){
        return $this->idAluno;
    }

    public function setIdAluno($idAluno): void{
        $this->idAluno = $idAluno;
    }

     public function getIdProfessor(){
        return $this->idProfessor;
    }

    public function setIdProfessor($idProfessor): void{
        $this->idProfessor = $idProfessor;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name): void{
        $this->name = $name;
    }

    public function getDataInicio(){
        return $this->dataInicio;
    }

    public function setDataInicio($dataInicio): void{
        $this->dataInicio = $dataInicio;
    }

    public function getDataFim(){
        return $this->dataFim;
    }

    public function setDataFim($dataFim): void{
        $this->dataFim = $dataFim;
    }

    public function getEmpresa(){
        return $this->empresa;
    }

    public function setEmpresa($empresa): void{
        $this->empresa = $empresa;
    }

    public function getSetorEmpresa(){
        return $this->setorEmpresa;
    }

    public function setSetorEmpresa($setorEmpresa): void{
        $this->setorEmpresa = $setorEmpresa;
    }

    public function isVinculoTrabalhista(){
        return $this->vinculoTrabalhista;
    }

    public function setVinculoTrabalhista($vinculo): void{
        $this->vinculoTrabalhista = $vinculo;
    }

    public function isObrigatorio(){
        return $this->obrigatorio;
    }

    public function setObrigatorio($obrigatorio): void{
        $this->obrigatorio = $obrigatorio;
    }

    public function getNameSupervisor(){
        return $this->nameSupervisor;
    }

    public function setNameSupervisor($nameSupervisor): void{
        $this->nameSupervisor = $nameSupervisor;
    }

    public function getEmailSupervisor(){
        return $this->emailSupervisor;
    }

    public function setEmailSupervisor($emailSupervisor): void{
        $this->emailSupervisor = $emailSupervisor;
    }

    public function getProfessor(){
        return $this->professor;
    }

    public function setProfessor($professor): void{
        $this->professor = $professor;
    }

    //salva as info
    public function save():bool{
        $conexao = new MySQL();
        $sql = "INSERT INTO estagio (name, dataInicio, dataFim, empresa, setorEmpresa, vinculoTrabalhista, 
        obrigatorio, nameSupervisor, emailSupervisor, professor, idAluno, idProfessor)
        VALUES ('{$this->name}', '{$this->dataInicio}', '{$this->dataFim}', '{$this->empresa}',
        '{$this->setorEmpresa}', '{$this->vinculoTrabalhista}', '{$this->obrigatorio}', '{$this->nameSupervisor}',
        '{$this->emailSupervisor}', '{$this->Professor}', '{$this->idAluno}', '{$this->idProfessor}')";
        return $conexao->executa($sql);
    }

    //pega todas as infos
     public static function findall():array{
        $conexao = new MySQL();
        $sql = "SELECT * FROM estagio";
        $resultados = $conexao->consulta($sql);
        $estagios = array();
        foreach($resultados as $resultado){
            $e = new Estagio(
                $resultado['name'],
                $resultado['dataInicio'],
                $resultado['dataFim'],
                $resultado['empresa'],
                $resultado['setorEmpresa'],
                $resultado['vinculoTrabalhista'],
                $resultado['obrigatorio'],
                $resultado['nameSupervisor'],
                $resultado['emailSupervisor'],
                $resultado['Professor']
            );
            $e->idEstagio = $resultado['idEstagio'];
            $estagios[] = $e;
        }
        return $estagios;
    }

    public static function find($idEstagio):Estagio{
        $conexao = new MySQL();
        $sql = "SELECT * FROM estagio WHERE idEstagio = {$idEstagio}";
        $resultado = $conexao->consulta($sql);
        $e = new Estagio(
            $resultado[0]['name'],
            $resultado[0]['dataInicio'],
            $resultado[0]['dataFim'],
            $resultado[0]['empresa'],
            $resultado[0]['setorEmpresa'],
            $resultado[0]['vinculoTrabalhista'],
            $resultado[0]['obrigatorio'],
            $resultado[0]['nameSupervisor'],
            $resultado[0]['emailSupervisor'],
            $resultado[0]['Professor']
        );
        $e->setIdEstagio($resultado[0]['idEstagio']);
        return $e;
    }

    //STATIC = NAO PRECISA CRIAR OBJETO PRA USAR O MÉTODO
    //BOOL = VALOR Q VAI RETORNAR

}