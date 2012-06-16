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
class reservaseventos extends CI_Model {
 	 	 	 	 	
	
    private $idReservaEvento = null;
    private $nome           = null;
    private $data           = null;
    private $hora           = null;
    private $idCoordenador  = null;
    private $idSala         = null;
    private $status         = null;
    
    /**
    * Obtem a ultima pessoa no banco
    * Sem parametros
    * @retorna <objeto>
    */
    public function gerarRelatorioReservasEventos($data, $tipo) {
        /*
         * [select2] => 15
          [dataInicial] => 11/06/2012
          [dataFinal] => 28/06/2012
         */
        
        if($tipo == 1){
            $sql = "
                SELECT 
                    *,
                    count(e.idEquipamento) AS totalEquipamento,
                    e.nome AS equipamentoNome,
                    p.nome AS pessoaNome,
                    p2.nome AS professorNome,
                    e.nome AS equipamentoNome
                FROM
                    reservas_eventos re
                INNER JOIN
                    pessoas p
                ON
                    re.idCoordenador = p.idPessoa
                INNER JOIN
                    reservas_eventos_professores rep
                ON
                    rep.idReservaEvento = re.idReservaEvento
                INNER JOIN
                    reservas_equipamentos req
                ON
                    req.idReservaEvento = re.idReservaEvento
                INNER JOIN
                    equipamentos e
                ON
                    e.idEquipamento = req.idEquipamento
                INNER JOIN
                    pessoas p2
                ON
                    rep.idProfessor = p2.idPessoa
                GROUP BY
                    e.idEquipamento
            ";
        }
        
        if($tipo == 0){
            $dataInicial = $this->query->dateEua($data["dataInicial"]);
            $dataFinal   = $this->query->dateEua($data["dataFinal"]);
            $idPessoa    = $data["idPessoa"];
            $sql = "
                SELECT 
                    *,
                    count(e.idEquipamento) AS totalEquipamento,
                    e.nome AS equipamentoNome,
                    p.nome AS pessoaNome,
                    p2.nome AS professorNome,
                    e.nome AS equipamentoNome
                FROM
                    reservas_eventos re
                INNER JOIN
                    pessoas p
                ON
                    re.idCoordenador = p.idPessoa
                INNER JOIN
                    reservas_eventos_professores rep
                ON
                    rep.idReservaEvento = re.idReservaEvento
                INNER JOIN
                    reservas_equipamentos req
                ON
                    req.idReservaEvento = re.idReservaEvento
                INNER JOIN
                    equipamentos e
                ON
                    e.idEquipamento = req.idEquipamento
                INNER JOIN
                    pessoas p2
                ON
                    rep.idProfessor = p2.idPessoa
                WHERE
                    rep.idProfessor = '$idPessoa' and
                    re.data BETWEEN '$dataInicial' and '$dataFinal'
                GROUP BY
                    e.idEquipamento
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
                reservas_eventos
             values(
                '',
                '$objeto->nome',
                '$objeto->data',
                '$objeto->hora',
                '$objeto->idCoordenador',
                '$objeto->idSala',
                '0'
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
    public function obterIdReservaEvento() {
        
        $sql    = "SELECT MAX(idReservaEvento) AS idReservaEvento FROM reservas_eventos";
        $query  = $this->query->setQuery($sql);
        return $query;
    }
    
    /**
    * Obtem a ultima pessoa no banco
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterProfessores($objeto) {
        $id = $objeto["id"];
        
        $sql = "
            SELECT 
                *
            FROM 
                reservas_eventos_professores rep
            INNER JOIN
                pessoas p
            ON
                p.idPessoa = rep.idProfessor
            WHERE
                rep.idReservaEvento = '$id'
        ";
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
    public function obterReservasEventosAll($tipo) {
        
        if($tipo == "negado"){
            $status = 2;
        }
        if($tipo == "aceito"){
            $status = 3;
        }
        
        $sql = "
                SELECT 
                    *,
                    p.nome AS pessoaNome,
                    re.nome AS nome
                FROM 
                    reservas_eventos re
                INNER JOIN
                    salas s
                ON
                    re.idSala = s.idSala
                INNER JOIN
                    pessoas p
                ON
                    re.idCoordenador = p.idPessoa 
                WHERE
                    re.status = '$status'
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

    public function pesquisarInfra($objeto){
        
        $linhas = " 1=1 and ";
        if( $objeto->dataInicial != "" and $objeto->dataFinal != "" ){
            $linhas .= "re.data BETWEEN '" .$this->query->dateEua($objeto->dataInicial)."'";
            $linhas .= " and '" .$this->query->dateEua($objeto->dataFinal)."'";
        }
        
        $sql = "
                SELECT 
                    *,
                    p.nome AS pessoaNome,
                    re.nome AS nome
                FROM 
                    reservas_eventos re
                INNER JOIN
                    pessoas p
                ON
                    p.idPessoa = re.idCoordenador
                WHERE
                    $linhas
        ";

        $query = $this->query->setQuery($sql);
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
    public function cancelar($objeto, $status) {
        
        $sql = "
            UPDATE 
                reservas_eventos
            SET
                status      = '$status'
            WHERE
                idReservaEvento = '$objeto->idReservaEvento'
        ";
        $query = $this->query->setQuery($sql);
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
    public function obterReservasEventosCanceladosInfra() {
        
        $data = date("Y-m-d");
        
        $sql = "
                SELECT 
                    *,
                    p.nome AS pessoaNome,
                    re.nome AS nome
                FROM 
                    reservas_eventos re
                INNER JOIN
                    salas s
                ON
                    re.idSala = s.idSala
                INNER JOIN
                    pessoas p
                ON
                    re.idCoordenador = p.idPessoa
                WHERE
                    re.status = 1
        ";
        $query  = $this->query->setQuery($sql);
        return $query;
    }
    
     /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterReservasEventosPassadosInfra() {
        
        $data = date("Y-m-d");
        
        $sql = "
                SELECT 
                    *,
                    p.nome AS pessoaNome,
                    re.nome AS nome
                FROM 
                    reservas_eventos re
                INNER JOIN
                    salas s
                ON
                    re.idSala = s.idSala
                INNER JOIN
                    pessoas p
                ON
                    re.idCoordenador = p.idPessoa
                WHERE
                    re.status = 0 and
                    re.data <= '$data'
        ";
        $query  = $this->query->setQuery($sql);

        return $query;
    }
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterReservasEventosAtivosInfra() {
        
        $data = date("Y-m-d");
        
        $sql = "
                SELECT 
                    *,
                    p.nome AS pessoaNome,
                    re.nome AS nome
                FROM 
                    reservas_eventos re
                INNER JOIN
                    salas s
                ON
                    re.idSala = s.idSala
                INNER JOIN
                    pessoas p
                ON
                    re.idCoordenador = p.idPessoa 
                WHERE
                    re.status = 0 and
                    re.data >= '$data'
        ";
        $query  = $this->query->setQuery($sql);

        return $query;
    }
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterMinhasReservasEventos() {
        
        $idPessoa = $this->session->userdata('idPessoa');        
        
        $data = date("Y-m-d");
        
        $sql = "
                SELECT 
                    *
                FROM 
                    reservas_eventos re
                INNER JOIN
                    salas s
                ON
                    re.idSala = s.idSala 
                WHERE
                    idCoordenador = $idPessoa and
                    re.status = 0 and
                    re.data >= '$data'
        ";
        $query  = $this->query->setQuery($sql);

        return $query;
    }
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterReservaEventosPassadas() {
        
        $idPessoa = $this->session->userdata('idPessoa');        
        
        $data = date("Y-m-d");
        
        $sql = "
                SELECT 
                    *
                FROM 
                    reservas_eventos re
                INNER JOIN
                    salas s
                ON
                    re.idSala = s.idSala 
                WHERE
                    idCoordenador = $idPessoa and
                    re.data <= '$data'
        ";
        $query  = $this->query->setQuery($sql);

        return $query;
    }
    
    
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterMinhasReservasEventosCanceladas() {
        
        $idPessoa = $this->session->userdata('idPessoa');        
                
        $sql = "
                SELECT 
                    *
                FROM 
                    reservas_eventos re
                INNER JOIN
                    salas s
                ON
                    re.idSala = s.idSala 
                WHERE
                    idCoordenador = $idPessoa and
                    re.status = 1
        ";
        $query  = $this->query->setQuery($sql);

        return $query;
    }
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterPorData($data) {
        
        $idPessoa    = $this->session->userdata('idPessoa');
        $dataInicial = $this->query->dateEua($data['dataInicial']);
        $dataFinal   = $this->query->dateEua($data['dataFinal']); 
        
        $sql = "
                SELECT 
                    re.nome AS nomeReserva,
                    re.data, re.hora, re.status,
                    p.nome AS pessoaNome,
                    e.nome AS equipamentoNome
                FROM 
                    reservas_eventos re
                INNER JOIN
                     reservas_eventos_professores rep
                ON
                    rep.idReservaEvento = re.idReservaEvento
                INNER JOIN
                    pessoas p
                ON
                    p.idPessoa = rep.idProfessor
                INNER JOIN
                    reservas_equipamentos req
                ON
                    req.idReservaEvento = re.idReservaEvento
                INNER JOIN
                    equipamentos e
                ON
                    e.idEquipamento = req.idEquipamento
                WHERE
                    re.idCoordenador = '$idPessoa' and
                    re.data BETWEEN '$dataInicial' and '$dataFinal'
        ";

        $query  = $this->query->setQuery($sql);

        return $query;
    }
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterPorDataProf($data) {
        
        $dataInicial = $this->query->dateEua($data['dataInicial']);
        $dataFinal   = $this->query->dateEua($data['dataFinal']); 
        
        $sql = "
                SELECT 
                    re.nome AS nomeReserva,
                    re.data, re.hora, re.status,
                    p.nome AS pessoaNome,
                    e.nome AS equipamentoNome
                FROM 
                    reservas_eventos re
                INNER JOIN
                     reservas_eventos_professores rep
                ON
                    rep.idReservaEvento = re.idReservaEvento
                INNER JOIN
                    pessoas p
                ON
                    p.idPessoa = rep.idProfessor
                INNER JOIN
                    reservas_equipamentos req
                ON
                    req.idReservaEvento = re.idReservaEvento
                INNER JOIN
                    equipamentos e
                ON
                    e.idEquipamento = req.idEquipamento
                WHERE
                    re.data BETWEEN '$dataInicial' and '$dataFinal'
        ";

        $query  = $this->query->setQuery($sql);

        return $query;
    }
    
    
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function listasMinhasReservasEventosProfessores() {
        
        $idPessoa    = $this->session->userdata('idPessoa');
        $data        = date("Y-m-d");
        $sql = "
                SELECT 
                    *
                FROM 
                    reservas_eventos_professores rep
                INNER JOIN
                     reservas_eventos re
                ON
                    rep.idReservaEvento = re.idReservaEvento
                INNER JOIN
                    salas s
                ON
                    s.idSala = re.idSala
                WHERE
                    rep.idProfessor = '$idPessoa' and
                    re.data >= '$data' and
                    re.status = 0
        ";

        $query  = $this->query->setQuery($sql);

        return $query;
    }
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function listasMinhasReservasEventosProfessoresPassados() {
        
        $idPessoa    = $this->session->userdata('idPessoa');
        $data        = date("Y-m-d");
        $sql = "
                SELECT 
                    *
                FROM 
                    reservas_eventos_professores rep
                INNER JOIN
                     reservas_eventos re
                ON
                    rep.idReservaEvento = re.idReservaEvento
                INNER JOIN
                    salas s
                ON
                    s.idSala = re.idSala
                WHERE
                    rep.idProfessor = '$idPessoa' and
                    re.data <= '$data' and
                    re.status = 0
        ";

        $query  = $this->query->setQuery($sql);

        return $query;
    }
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function listaMinhaReservaEventoProfessorAlls($status) {
        
        $idPessoa    = $this->session->userdata('idPessoa');
        $sql = "
                SELECT 
                    *
                FROM 
                    reservas_eventos_professores rep
                INNER JOIN
                     reservas_eventos re
                ON
                    rep.idReservaEvento = re.idReservaEvento
                INNER JOIN
                    salas s
                ON
                    s.idSala = re.idSala
                WHERE
                    rep.idProfessor = '$idPessoa' and
                    re.status = '$status'
        ";

        $query  = $this->query->setQuery($sql);

        return $query;
    }
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function listasMinhasReservasEventosProfessoresCancelados() {
        
        $idPessoa    = $this->session->userdata('idPessoa');
        $data        = date("Y-m-d");
        $sql = "
                SELECT 
                    *
                FROM 
                    reservas_eventos_professores rep
                INNER JOIN
                     reservas_eventos re
                ON
                    rep.idReservaEvento = re.idReservaEvento
                INNER JOIN
                    salas s
                ON
                    s.idSala = re.idSala
                WHERE
                    rep.idProfessor = '$idPessoa' and
                    re.status = 1
        ";

        $query  = $this->query->setQuery($sql);

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