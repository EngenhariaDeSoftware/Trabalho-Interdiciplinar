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
class ProfessoresDisciplinas extends CI_Model {

    private $idProfessorDisciplina = null;
    private $idPessoa              = null;
    private $idDiciplina           = array();

    /**
     * Insere registros
     * $objeto = valores a serem inseridos
     * @retorna <objeto>
     */
    public function inserir($objeto) {

        foreach ($objeto->idDiciplina as $key => $valor) {
            $sql = "
                SELECT
                    *
                FROM
                    professores_disciplinas
                WHERE
                    idPessoa = '$objeto->idPessoa' and
                    idDisciplina = '$valor'
            ";
            $query = $this->query->setQuery($sql);

            if ($query->num_rows() == 0) {
                $sql = "
                    INSERT INTO
                        professores_disciplinas
                    values(
                        '',
                        '$objeto->idPessoa',
                        '$valor'
                        )
                ";
                $query = $this->query->setQuery($sql);
            }
        }

        return $query;
    }
    
    //Talves excluir
    /*
    public function obterProfessoresDisciplinas() {
        
        $sql = "
                SELECT
                    pessoas.nome AS pessoaNome,
                    cursos.nome AS cursoNome,
                    disciplinas.nome AS disciplinaNome
                FROM
                    professores_disciplinas
                INNER JOIN
                    pessoas
                ON
                    professores_disciplinas.idPessoa = pessoas.idPessoa
                INNER JOIN
                    disciplinas
                ON
                    disciplinas.idDisciplina = professores_disciplinas.idDisciplina
                INNER JOIN
                    cursos
                ON
                    disciplinas.idCurso = cursos.idCurso
                    
            ";
        $query = $this->query->setQuery($sql);
        return $query;
    }*/
    
    public function obterDisciplinasPorProfessores($objeto)
    {
        $sql = "
                SELECT
                    disciplinas.horaInicial,
                    disciplinas.horaFinal,
                    professores_disciplinas.idProfessorDisciplina,
                    pessoas.nome     AS pessoaNome,
                    cursos.nome      AS cursoNome,
                    disciplinas.nome AS disciplinaNome
                FROM
                    professores_disciplinas
                INNER JOIN
                    pessoas
                ON
                    professores_disciplinas.idPessoa = pessoas.idPessoa
                INNER JOIN
                    disciplinas
                ON
                    disciplinas.idDisciplina = professores_disciplinas.idDisciplina
                INNER JOIN
                    cursos
                ON
                    disciplinas.idCurso = cursos.idCurso
                WHERE
                    professores_disciplinas.idPessoa = '$objeto->idPessoa'

                    
            ";
        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    public function obterDisciplinasProfessores($objeto)
    {
        $sql = "
            SELECT
                disciplinas.horaInicial,
                disciplinas.horaFinal,
                disciplinas.nome AS disciplinaNome,
                cursos.nome AS cursoNome,
                disciplinas.idDisciplina AS disciplinaId
            FROM
                professores_disciplinas
            INNER JOIN
                disciplinas
            ON
                professores_disciplinas.idDisciplina = disciplinas.idDisciplina
            INNER JOIN
                cursos
            ON
            disciplinas.idCurso = cursos.idCurso            
            WHERE
                professores_disciplinas.idPessoa = '$objeto->idPessoa'
        ";

        $query = $this->query->setQuery($sql);
        return $query;
        
    }
    
    /**
    * Deleta um Professor Disciplina
    * $objeto = Objeto com id da Pessoa
    * @retorna <objeto>
    */
    public function deletar($objeto) {
        
        $sql = "
            DELETE FROM
                professores_disciplinas
            WHERE
             idProfessorDisciplina = '$objeto->idProfessorDisciplina'
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