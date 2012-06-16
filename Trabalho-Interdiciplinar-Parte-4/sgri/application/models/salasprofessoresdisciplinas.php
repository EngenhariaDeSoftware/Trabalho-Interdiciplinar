<?php
//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');

/**
* Classe: SalaProfessorDisciplina
* Finalidade: Nao utilizada ainda
* Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
* Data de Criação: 17/03/2012
*/
class salasprofessoresdisciplinas extends CI_Controller {


    
    private $idSalaProfessorDisciplina = null;
    private $idSala         = null;
    private $idPessoa       = null;
    private $idDisciplina   = null;
	
    /**
     * Insere registros
     * $objeto = valores a serem inseridos
     * @retorna <objeto>
     */
    public function inserir($objeto) {
        
        $sql = "
            INSERT INTO
                salas_professores_disciplinas
            values(
                '',
                '$objeto->idSala',
                '$objeto->idPessoa',
                '$objeto->idDisciplina'
            )
        ";
        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    public function verificaRegistros($objeto)
    {
        $sql = "
            SELECT
                idPessoa
            FROM
                salas_professores_disciplinas
            WHERE
                idSala       = '$objeto->idSala'   and
                idPessoa     = '$objeto->idPessoa' and
                idDisciplina = '$objeto->idDisciplina'
        ";
        $query = $this->query->setQuery($sql);
        if ( $query->num_rows() > '0' ) {
            return true;
        } else {
            return false;
        }

    }
    
    public function obterSalasProfessoresDisciplinas()
    {
        $sql = "
            SELECT
                *,
                pessoas.nome AS pessoaNome,
                disciplinas.nome AS disciplinaNome
            FROM
                salas_professores_disciplinas spd
            INNER JOIN
                salas
            ON
                spd.idSala = salas.idSala
            INNER JOIN
                pessoas
            ON
                spd.idPessoa = pessoas.idPessoa
            INNER JOIN
                disciplinas
            ON
                spd.idDisciplina = disciplinas.idDisciplina
        ";
        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    public function obterUltimasSalasProfessoresDisciplinas()
    {
        $sql = "
            SELECT
                *,
                pessoas.nome AS pessoaNome,
                disciplinas.nome AS disciplinaNome
            FROM
                salas_professores_disciplinas spd
            INNER JOIN
                salas
            ON
                spd.idSala = salas.idSala
            INNER JOIN
                pessoas
            ON
                spd.idPessoa = pessoas.idPessoa
            INNER JOIN
                disciplinas
            ON
                spd.idDisciplina = disciplinas.idDisciplina
                ORDER BY spd.idSalaProfessorDisciplina ASC LIMIT 0 , 3
        ";
        $query = $this->query->setQuery($sql);
        return $query;
    }
    
      
    public function obterPorSalasProfessoresDisciplinas($objeto)
    {
        $sql = "
            SELECT
                *,
                spd.idSalaProfessorDisciplina as spdId,
                pessoas.nome AS pessoaNome,
                disciplinas.nome AS disciplinaNome
            FROM
                salas_professores_disciplinas spd
            INNER JOIN
                salas
            ON
                spd.idSala = salas.idSala
            INNER JOIN
                pessoas
            ON
                spd.idPessoa = pessoas.idPessoa
            INNER JOIN
                disciplinas
            ON
                spd.idDisciplina = disciplinas.idDisciplina
            WHERE
                spd.idSalaProfessorDisciplina = '$objeto->idSalaProfessorDisciplina'
        ";

        $query = $this->query->setQuery($sql);

        return $query;

    }
    
    /**
     * Obtem Valor
     * $campo = nome do campo
     * @retorna <campo>
     */
    public function atualizar($objeto)
    {

        $sql = "
            UPDATE 
                salas_professores_disciplinas
            SET
                idPessoa     = '$objeto->idPessoa',
                idDisciplina = '$objeto->idDisciplina',
                idSala       = '$objeto->idSala'
            WHERE
                idSalaProfessorDisciplina   = '$objeto->idSalaProfessorDisciplina'
        ";

        $query = $this->query->setQuery($sql);
   
    }
    
    public function obterSalasProfessores($objeto)
    {
        $sql = "
            SELECT
                *,
                spd.idSalaProfessorDisciplina as spdId,
                pessoas.nome AS pessoaNome,
                disciplinas.nome AS disciplinaNome
            FROM
                salas_professores_disciplinas spd
            INNER JOIN
                salas
            ON
                spd.idSala = salas.idSala
            INNER JOIN
                pessoas
            ON
                spd.idPessoa = pessoas.idPessoa
            INNER JOIN
                disciplinas
            ON
                spd.idDisciplina = disciplinas.idDisciplina
            WHERE
                spd.idPessoa = '$objeto->idPessoa'
              GROUP BY spd.idSala
        ";

        $query = $this->query->setQuery($sql);

        return $query;

    }
    
    public function obterHorariosDisciplinas($data){
        
        $idPessoa = $this->session->userdata('idPessoa'); 
        $sql = "
            SELECT
                *
            FROM
                salas_professores_disciplinas spd
            INNER JOIN
                disciplinas d
            ON
                spd.idDisciplina = d.idDisciplina
            WHERE
                spd.idPessoa = '$idPessoa' and
                spd.idSala   = '$data[id]'
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