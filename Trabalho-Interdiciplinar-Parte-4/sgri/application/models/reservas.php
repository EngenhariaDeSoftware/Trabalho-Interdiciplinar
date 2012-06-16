<?php
//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');

/**
* Classe: Equipamentos
* Finalidade: Obtem acesso ao Banco Equipamentos
* Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
* Data de Criação: 17/03/2012
*/
class Reservas extends CI_Model {

    private $idReserva = null;
    private $idPessoa  = null;
    private $idTurma   = null;
    private $idSala    = null;
    private $data      = null;
    private $hora      = null;
    private $obs       = null;
    private $status    = null;
    private $pesquisa  = null;
    private $dataInicial = null;
    private $dataFinal   = null;
    private $idEquipamento = array();

    
    /**
    * Obtem a ultima pessoa no banco
    * Sem parametros
    * @retorna <objeto>
    */
    public function gerarRelatoriosReservas($data, $tipo) {
        /*
         * [select2] => 15
          [dataInicial] => 11/06/2012
          [dataFinal] => 28/06/2012
         */
        
        if($tipo == 1){
            $sql = "
                SELECT 
                    *,
                    p.nome AS pessoaNome,
                    count(r.idSala) as totalSala,
                    count(r.idTurma) as totalTurma
                FROM
                    reservas r
                INNER JOIN
                    pessoas p
                ON
                    r.idPessoa = p.idPessoa
                INNER JOIN
                    turmas t
                ON
                    t.idTurma = r.idTurma
                INNER JOIN
                    salas s
                ON
                    s.idSala = r.idSala
                GROUP BY r.idPessoa, r.idTurma, r.idSala
            ";
        }
        
        if($tipo == 0){
            $dataInicial = $this->query->dateEua($data["dataInicial"]);
            $dataFinal   = $this->query->dateEua($data["dataFinal"]);
            $idPessoa    = $data["idPessoa"];
            $sql = "
                SELECT 
                    *,
                    p.nome AS pessoaNome,
                    count(r.idSala) as totalSala,
                    count(r.idTurma) as totalTurma
                FROM
                    reservas r
                INNER JOIN
                    pessoas p
                ON
                    r.idPessoa = p.idPessoa
                INNER JOIN
                    turmas t
                ON
                    t.idTurma = r.idTurma
                INNER JOIN
                    salas s
                ON
                    s.idSala = r.idSala
                WHERE
                    r.idPessoa = '$idPessoa' and
                    r.data BETWEEN '$dataInicial' and '$dataFinal'
                GROUP BY r.idPessoa, r.idTurma, r.idSala
            ";
        }
        
        
        $query  = $this->query->setQuery($sql);

        return $query;
    }
    
    /**
    * Insere registros
    * $objeto = valores a serem inseridos
    * @retorna <objeto>
    */
    public function inserir($objeto) {
        
        $objeto->data = $this->query->dateEua($objeto->data);
        $sql = "
            INSERT INTO
                reservas
             values(
                '',
                '$objeto->idPessoa',
                '$objeto->idTurma',
                '$objeto->idSala',
                '$objeto->data',
                '$objeto->hora',
                '$objeto->obs',
                '$objeto->status'
                )
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    /**
    * Obtem a ultima pessoa no banco
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterIdReserva() {
        
        $sql    = "SELECT MAX(idReserva) AS idReserva FROM reservas";
        $query  = $this->query->setQuery($sql);
        return $query;
    }


    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterReservasAtuais($objetor) {
        
        $dataHoje = date("Y-m-d");
        $sql = "
                SELECT 
                    r.idReserva,
                    t.nome AS turmaNome,
                    s.predio,
                    s.andar,
                    s.numero,
                    r.data,
                    r.hora
                FROM 
                    reservas r
                INNER JOIN
                    pessoas p
                ON
                    p.idPessoa = r.idPessoa
                INNER JOIN
                    turmas t
                ON
                    t.idTurma = r.idTurma
                INNER JOIN
                    salas s
                ON
                    s.idSala = r.idSala
                WHERE
                    r.idPessoa = '$objetor->idPessoa' and
                    r.status   = '0' and
                    r.data     >= '$dataHoje'
                    
        ";
        $query  = $this->query->setQuery($sql);
        return $query;
    }
    
     /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function pesquisarInfra($objetor) {
        
        $dataHoje = date("Y-m-d");
        $sql = "
                SELECT 
                    r.idReserva,
                    t.nome AS turmaNome,
                    s.predio,
                    s.andar,
                    s.numero,
                    r.data,
                    r.hora
                FROM 
                    reservas r
                INNER JOIN
                    pessoas p
                ON
                    p.idPessoa = r.idPessoa
                INNER JOIN
                    turmas t
                ON
                    t.idTurma = r.idTurma
                INNER JOIN
                    salas s
                ON
                    s.idSala = r.idSala
                WHERE
                    r.idPessoa = '$objetor->idPessoa' and
                    r.status   = '0' and
                    r.data     < '$dataHoje'
                    
        ";
        $query  = $this->query->setQuery($sql);
        return $query;
    }
    
    
     /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterReservaAlls($objetor, $status) {
        
        $sql = "
                SELECT 
                    r.idReserva,
                    t.nome AS turmaNome,
                    s.predio,
                    s.andar,
                    s.numero,
                    r.data,
                    r.hora
                FROM 
                    reservas r
                INNER JOIN
                    pessoas p
                ON
                    p.idPessoa = r.idPessoa
                INNER JOIN
                    turmas t
                ON
                    t.idTurma = r.idTurma
                INNER JOIN
                    salas s
                ON
                    s.idSala = r.idSala
                WHERE
                    r.idPessoa = '$objetor->idPessoa' and
                    r.status   = '$status'                    
        ";
        $query  = $this->query->setQuery($sql);
        return $query;
    }
    
     /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterReservasPassadas($objetor) {
        
        $dataHoje = date("Y-m-d");
        $sql = "
                SELECT 
                    r.idReserva,
                    t.nome AS turmaNome,
                    s.predio,
                    s.andar,
                    s.numero,
                    r.data,
                    r.hora
                FROM 
                    reservas r
                INNER JOIN
                    pessoas p
                ON
                    p.idPessoa = r.idPessoa
                INNER JOIN
                    turmas t
                ON
                    t.idTurma = r.idTurma
                INNER JOIN
                    salas s
                ON
                    s.idSala = r.idSala
                WHERE
                    r.idPessoa = '$objetor->idPessoa' and
                    r.status   = '0' and
                    r.data     < '$dataHoje'
                    
        ";
        $query  = $this->query->setQuery($sql);
        return $query;
    }
    
    
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterReservaCanceladas($objetor) {
        
        $sql = "
                SELECT 
                    r.idReserva,
                    t.nome AS turmaNome,
                    s.predio,
                    s.andar,
                    s.numero,
                    r.data,
                    r.hora
                FROM 
                    reservas r
                INNER JOIN
                    pessoas p
                ON
                    p.idPessoa = r.idPessoa
                INNER JOIN
                    turmas t
                ON
                    t.idTurma = r.idTurma
                INNER JOIN
                    salas s
                ON
                    s.idSala = r.idSala
                WHERE
                    r.idPessoa = '$objetor->idPessoa' and
                    r.status   = '1'
        ";
        $query  = $this->query->setQuery($sql);
        return $query;
    }
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterEquipamentosReservaInfraEventos($objetor) {
        
        $sql = "
                SELECT 
                    e.nome, 
                    COUNT( e.idEquipamento ) AS total
                FROM 
                    reservas_eventos re
                INNER JOIN
                    reservas_equipamentos req
                ON
                    req.idReservaEvento = re.idReservaEvento
                INNER JOIN
                    equipamentos e
                ON
                    e.idEquipamento = req.idEquipamento
                
                GROUP BY e.nome
        ";
  
        $query  = $this->query->setQuery($sql);
        return $query;
    }
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterEquipamentosReservaInfra($objetor) {
        
        $sql = "
                SELECT 
                    e.nome, 
                    COUNT( e.idEquipamento ) AS total
                FROM 
                    reservas r
                INNER JOIN
                    reservas_equipamentos re
                ON
                    r.idReserva = re.idReserva
                INNER JOIN
                    equipamentos e
                ON
                    e.idEquipamento = re.idEquipamento
                GROUP BY e.nome
        ";
  
        $query  = $this->query->setQuery($sql);
        return $query;
    }
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterEquipamentosReserva($objetor) {
        
        $sql = "
                SELECT 
                    e.nome, 
                    COUNT( e.idEquipamento ) AS total
                FROM 
                    reservas r
                INNER JOIN
                    reservas_equipamentos re
                ON
                    r.idReserva = re.idReserva
                INNER JOIN
                    equipamentos e
                ON
                    e.idEquipamento = re.idEquipamento
                WHERE
                    r.idPessoa = '$objetor->idPessoa' and
                    r.status   = '0'
                GROUP BY e.nome
        ";
  
        $query  = $this->query->setQuery($sql);
        return $query;
    }
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterEquipamentosReservaCancelados($objetor) {
        
        $sql = "
                SELECT 
                    e.nome, 
                    COUNT( e.idEquipamento ) AS total
                FROM 
                    reservas r
                INNER JOIN
                    reservas_equipamentos re
                ON
                    r.idReserva = re.idReserva
                INNER JOIN
                    equipamentos e
                ON
                    e.idEquipamento = re.idEquipamento
                WHERE
                    r.idPessoa = '$objetor->idPessoa' and
                    r.status   = '1'
                GROUP BY e.nome
        ";
  
        $query  = $this->query->setQuery($sql);
        return $query;
    }
    
    
    
    /**
    * Obtem um unico equipamento
    * $objeto = um unico id a ser pesquisado
    * @retorna <objeto>
    */
    public function obterPorEquipamentos($objeto) {
        
        $sql    = "SELECT * FROM ssssssssss WHERE idEquipamento = '$objeto->idEquipamento'";
        $query  = $this->query->setQuery($sql);
        return $query;
    }

    /**
    * Obtem um unico equipamento
    * $objeto = objeto contendo o id do equipamento para detalhe
    * @retorna <objeto>
    */
    public function detalhe($objeto) {
        
        $sql = "
                SELECT 
                    r.idReserva,
                    t.nome AS turmaNome,
                    s.predio,
                    s.andar,
                    s.numero,
                    r.data,
                    r.hora,
                    d.nome AS DisciplinaNome,
                    c.nome AS cursoNome,
                    r.obs
                FROM 
                    reservas r
                INNER JOIN
                    pessoas p
                ON
                    p.idPessoa = r.idPessoa
                INNER JOIN
                    turmas t
                ON
                    t.idTurma = r.idTurma
                INNER JOIN
                    salas s
                ON
                    s.idSala = r.idSala
                INNER JOIN
                    disciplinas d
                ON
                    d.idDisciplina = t.idDisciplina
                INNER JOIN
                    cursos c
                ON
                    c.idCurso = d.idCurso
                WHERE
                    r.idPessoa = '$objeto->idPessoa' and
                    r.idReserva	= '$objeto->idReserva'
        ";
        $query  = $this->query->setQuery($sql);
        return $query;

        $query = $this->query->setQuery($sql);
        return $query;
    }

    
    /**
    * Pesquisa registros
    * $objeto = Contem dados para pesquisa
    * @retorna <objeto>
    */
    public function pesquisarInfra2($objeto) {

        $linhas = " 1=1 and ";
        if( $objeto->dataInicial != "" and $objeto->dataFinal != "" ){
            $linhas .= "r.data BETWEEN '" .$this->query->dateEua($objeto->dataInicial)."'";
            $linhas .= " and '" .$this->query->dateEua($objeto->dataFinal)."'";
        }
        
        $sql = "
                SELECT 
                    r.idReserva,
                    t.nome AS turmaNome,
                    s.predio,
                    s.andar,
                    s.numero,
                    r.data,
                    r.hora,
                    d.nome AS DisciplinaNome,
                    c.nome AS cursoNome,
                    r.obs,
                    r.status
                FROM 
                    reservas r
                INNER JOIN
                    pessoas p
                ON
                    p.idPessoa = r.idPessoa
                INNER JOIN
                    turmas t
                ON
                    t.idTurma = r.idTurma
                INNER JOIN
                    salas s
                ON
                    s.idSala = r.idSala
                INNER JOIN
                    disciplinas d
                ON
                    d.idDisciplina = t.idDisciplina
                INNER JOIN
                    cursos c
                ON
                    c.idCurso = d.idCurso
                WHERE
                    $linhas
        ";

      

        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    /**
    * Pesquisa registros
    * $objeto = Contem dados para pesquisa
    * @retorna <objeto>
    */
    public function pesquisar($objeto) {

        $linhas = " and 1=1 and ";
        if( $objeto->dataInicial != "" and $objeto->dataFinal != "" ){
            $linhas .= "r.data BETWEEN '" .$this->query->dateEua($objeto->dataInicial)."'";
            $linhas .= " and '" .$this->query->dateEua($objeto->dataFinal)."'";
            $linhas .= " and ";
        }
        
        if( $objeto->hora != "" ){
            $linhas .= "r.hora = '".$objeto->hora."'";
            $linhas .= " and ";
        }
        
        if( $objeto->pesquisa != "" ){
            $linhas .= "r.idTurma like '%".$objeto->pesquisa."%'";
            $linhas .= " or ";
            $linhas .= "r.idSala like '%".$objeto->pesquisa."%'";
            $linhas .= " or ";
            $linhas .= "r.obs like '%".$objeto->pesquisa."%'";
            $linhas .= " and ";
        }
        
        $linhas .= " r.status = 0 ";
        
        $sql = "
                SELECT 
                    r.idReserva,
                    t.nome AS turmaNome,
                    s.predio,
                    s.andar,
                    s.numero,
                    r.data,
                    r.hora,
                    d.nome AS DisciplinaNome,
                    c.nome AS cursoNome,
                    r.obs
                FROM 
                    reservas r
                INNER JOIN
                    pessoas p
                ON
                    p.idPessoa = r.idPessoa
                INNER JOIN
                    turmas t
                ON
                    t.idTurma = r.idTurma
                INNER JOIN
                    salas s
                ON
                    s.idSala = r.idSala
                INNER JOIN
                    disciplinas d
                ON
                    d.idDisciplina = t.idDisciplina
                INNER JOIN
                    cursos c
                ON
                    c.idCurso = d.idCurso
                WHERE
                    r.idPessoa = '$objeto->idPessoa'
                    $linhas
        ";

      

        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    /**
    * Pesquisa registros
    * $objeto = Contem dados para pesquisa
    * @retorna <objeto>
    */
    public function pesquisarCanceladas($objeto) {

        $linhas = " and 1=1 and ";
        if( $objeto->dataInicial != "" and $objeto->dataFinal != "" ){
            $linhas .= "r.data BETWEEN '" .$this->query->dateEua($objeto->dataInicial)."'";
            $linhas .= " and '" .$this->query->dateEua($objeto->dataFinal)."'";
            $linhas .= " and ";
        }
        
        if( $objeto->hora != "" ){
            $linhas .= "r.hora = '".$objeto->hora."'";
            $linhas .= " and ";
        }
        
        if( $objeto->pesquisa != "" ){
            $linhas .= "r.idTurma like '%".$objeto->pesquisa."%'";
            $linhas .= " or ";
            $linhas .= "r.idSala like '%".$objeto->pesquisa."%'";
            $linhas .= " or ";
            $linhas .= "r.obs like '%".$objeto->pesquisa."%'";
            $linhas .= " and ";
        }
        
        $linhas .= " r.status = 1 ";
        
        $sql = "
                SELECT 
                    r.idReserva,
                    t.nome AS turmaNome,
                    s.predio,
                    s.andar,
                    s.numero,
                    r.data,
                    r.hora,
                    d.nome AS DisciplinaNome,
                    c.nome AS cursoNome,
                    r.obs
                FROM 
                    reservas r
                INNER JOIN
                    pessoas p
                ON
                    p.idPessoa = r.idPessoa
                INNER JOIN
                    turmas t
                ON
                    t.idTurma = r.idTurma
                INNER JOIN
                    salas s
                ON
                    s.idSala = r.idSala
                INNER JOIN
                    disciplinas d
                ON
                    d.idDisciplina = t.idDisciplina
                INNER JOIN
                    cursos c
                ON
                    c.idCurso = d.idCurso
                WHERE
                    r.idPessoa = '$objeto->idPessoa'
                    $linhas
        ";

      

        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    
    
    /**
    * Pesquisa registros
    * $objeto = Contem dados para pesquisa
    * @retorna <objeto>
    */
    public function cancelar($objeto) {
        
        $sql = "
            UPDATE 
                reservas
            SET
                status      = '1'
            WHERE
                idReserva   = '$objeto->idReserva' and
                idPessoa    = '$objeto->idPessoa'
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function detalhesEquipamentosInfra($objetor) {
        
        $sql = "
                SELECT 
                    *
                FROM 
                    reservas r
                INNER JOIN
                    reservas_equipamentos re
                ON
                    r.idReserva = re.idReserva
                INNER JOIN
                    equipamentos e
                ON
                    e.idEquipamento = re.idEquipamento
                WHERE
                    r.idReserva = '$objetor->idReserva'
        ";
        $query  = $this->query->setQuery($sql);
        return $query;
    }
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function detalhesEquipamentos($objetor) {
        
        $sql = "
                SELECT 
                    *
                FROM 
                    reservas r
                INNER JOIN
                    reservas_equipamentos re
                ON
                    r.idReserva = re.idReserva
                INNER JOIN
                    equipamentos e
                ON
                    e.idEquipamento = re.idEquipamento
                WHERE
                    r.idPessoa = '$objetor->idPessoa' and
                    r.idReserva = '$objetor->idReserva'
        ";
        $query  = $this->query->setQuery($sql);
        return $query;
    }

    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function checarReservaExiste($objetor) {
        /*$reservas->set("idTurma",  $_POST["idTurma"]);
        $reservas->set("idSala",   $_POST["idSala"]);
        $reservas->set("data",     $_POST["data"]);
        $reservas->set("hora",     $_POST["hora"]);musashi*/
        $objetor->data = $this->query->dateEua($objetor->data);
        $array = array();
        $i = 0;
        foreach($objetor->idEquipamento as $valor){
            
            $sql = "
                SELECT 
                    r.idReserva, 
                    d.horaInicial, 
                    d.horaFinal, 
                    r.data, 
                    e.nome
                FROM 
                    reservas r
                        INNER JOIN reservas_equipamentos re ON r.idReserva = re.idReserva
                        INNER JOIN equipamentos e           ON e.idEquipamento = re.idEquipamento
                        INNER JOIN turmas t                 ON r.idTurma = t.idTurma
                        INNER JOIN disciplinas d            ON t.idDisciplina = d.idDisciplina
                WHERE TIME(  '$objetor->hora' ) 
                    BETWEEN 
                        d.horaInicial and
                        d.horaFinal   and
                        r.data              = '$objetor->data' and
                        re.idEquipamento    = $valor and
                        r.status            = 0
            ";
            $query  = $this->query->setQuery($sql);
            
            if( $query->num_rows() > 0 )
            {             
                $array["num_rows"] = true;
                foreach ( $query->result() as $valor )
                {
                    $array[$i]["nome"] = $valor->nome;
                    $i++;
                }
                //return $query;
            }
        }

        return $array;
    }
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterReservasParaInfras($tipo) {
    
        //ativa - passado - cancelado
        
        $data = date("Y-m-d");
        $valores = "";
        
        if($tipo == "ativa"){
            $valores .= " r.status = '0' and r.data >= '$data'";
        }
        if($tipo == "passado"){
            $valores .= " r.status = '0' and r.data < '$data'";
        }
        if($tipo == "cancelado"){
            $valores .= " r.status = '1'";
        }
        if($tipo == "negada"){
            $valores .= " r.status = '2'";
        }
        if($tipo == "aceita"){
            $valores .= " r.status = '3'";
        }
        
        $sql = "
                SELECT 
                    r.idReserva AS reservaId,
                    p.nome AS pessoaNome,
                    s.predio, s.andar, s.numero,
                    t.nome AS turmaNome,
                    t.grupo, r.data, r.hora
                FROM 
                    reservas r
                INNER JOIN
                    reservas_equipamentos re
                ON
                    r.idReserva = re.idReserva
                INNER JOIN
                    equipamentos e
                ON
                    e.idEquipamento = re.idEquipamento
                INNER JOIN
                    pessoas p
                ON
                    p.idPessoa = r.idPessoa
                INNER JOIN
                    turmas t
                ON
                    t.idTurma = r.idTurma
                INNER JOIN
                    salas s
                ON
                    s.idSala = r.idSala
                WHERE
                    ".$valores." group by r.idReserva
        ";
 
        $query  = $this->query->setQuery($sql);

        return $query;
    }
    
    
    
    /**
    * Pesquisa registros
    * $objeto = Contem dados para pesquisa
    * @retorna <objeto>
    */
    public function mudarStatus($status, $id) {
        
        $sql = "
            UPDATE 
                reservas
            SET
                status    = '$status'
            WHERE
                idReserva = '$id'
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }

    /**
    * Obtem Valor
    * $campo = nome do campo
    * @retorna <campo>
    */
    public function get($campo) {
        return $this->$campo;
    }

    /**
    * Seta um valor
    * $campo = nome do Campo, $valor = valor do campo
    * @retorna
    */
    public function set($campo, $valor) {
        $this->$campo = $valor;
    }

}

?>