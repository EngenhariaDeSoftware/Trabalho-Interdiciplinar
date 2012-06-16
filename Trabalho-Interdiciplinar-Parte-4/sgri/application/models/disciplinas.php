<?php

//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');

/**
 * Classe: Cursos
 * Finalidade: Obtem acesso ao Banco Cursos
 * Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
 * Data de Criação: 17/03/2012
 */
class Disciplinas extends CI_Model {

    private $idDisciplina = null;
    private $nome = null;
    private $turno = null;
    private $horaInicial = null;
    private $horaFinal = null;
    public $idCurso = array();

    /**
     * Insere registros
     * $objeto = valores a serem inseridos
     * @retorna <objeto>
     */
    public function inserir($objeto) {

        foreach ($objeto->idCurso as $key => $valor) {
            $sql = "
                INSERT INTO
                    disciplinas
                values(
                    '',
                    '$objeto->nome',
                    '$objeto->turno',
                    '$objeto->horaInicial',
                    '$objeto->horaFinal',
                    '$valor'
                    )
            ";
            $query = $this->query->setQuery($sql);
        }

        return $query;
    }

    /**
     * Atualiza Registros
     * $objeto = valores a serem atualizados
     * @retorna <objeto>
     */
    public function atualizar($objeto) {

        if( $objeto->idCurso != 0 ){
            foreach ($objeto->idCurso as $key => $valor) {
                $sql = "
                    UPDATE 
                        disciplinas
                    SET
                        nome          = '$objeto->nome',
                        turno         = '$objeto->turno',
                        horaInicial   = '$objeto->horaInicial',
                        horaFinal     = '$objeto->horaFinal',
                        horaFinal     = '$objeto->horaFinal',
                        idCurso       = '".$objeto->idCurso[0]."'
                    WHERE
                        idDisciplina  = '$objeto->idDisciplina'
                ";
            
                $query = $this->query->setQuery($sql);

                $sql = "
                    SELECT 
                        idDisciplina
                    FROM
                        disciplinas
                    WHERE
                        idCurso      = '$valor' and
                        idDisciplina = '$objeto->idDisciplina'
                ";
                $query = $this->query->setQuery($sql);
                
                if( $query->num_rows() == 0 )
                {
                    $sql = "
                        INSERT
                            INTO
                        disciplinas
                            values
                            (
                                '',
                                '$objeto->nome',
                                '$objeto->turno',
                                '$objeto->horaInicial',
                                '$objeto->horaFinal',
                                '$valor'
                            )
                    ";
                    $query = $this->query->setQuery($sql);
                }
                

            }
        } else {
            $sql = "
                UPDATE 
                    disciplinas
                SET
                    nome        = '$objeto->nome',
                    turno       = '$objeto->turno',
                    horaInicial = '$objeto->horaInicial',
                    horaFinal   = '$objeto->horaFinal',
                    horaFinal   = '$objeto->horaFinal'
                WHERE
                    idDisciplina = '$objeto->idDisciplina'
            ";

            $query = $this->query->setQuery($sql);
        }




        return $query;
    }

    /**
     * Verifica se existe equipamento repetido
     * $objeto = valores a serem verificados
     * @retorna <boleano>
     */
    public function verificaNomeCursos($objeto) {

        $sql = "
            SELECT *
                FROM
             cursos
                WHERE
             nome = '$objeto->nome'
        ";

        $query = $this->query->setQuery($sql);

        $resultado = $this->query->numRows($query);

        if ($resultado == '0') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Obtem todos equipamentos
     * Sem parametros
     * @retorna <objeto>
     */
    public function obterDisciplinas() {

        $sql = "
            SELECT 
                *,
                disciplinas.nome AS disciplinaNome,
                cursos.nome AS cursoNome
            FROM 
                disciplinas
            INNER JOIN
                cursos
            ON
                disciplinas.idCurso = cursos.idCurso
            ";
        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    /**
     * Obtem todos equipamentos
     * Sem parametros
     * @retorna <objeto>
     */
    public function obterUltimasDisciplinas() {

        $sql = "
            SELECT 
                *,
                disciplinas.nome AS disciplinaNome,
                cursos.nome AS cursoNome
            FROM 
                disciplinas
            INNER JOIN
                cursos
            ON
                disciplinas.idCurso = cursos.idCurso
                ORDER BY disciplinas.nome ASC LIMIT 0 , 6
            ";
        $query = $this->query->setQuery($sql);
        return $query;
    }

    
    /**
     * Obtem um unico equipamento
     * $objeto = um unico id a ser pesquisado
     * @retorna <objeto>
     */
    public function obterPorDisciplinas($objeto) {

        $sql = "
            SELECT 
                *,
                disciplinas.nome AS disciplinaNome,
                cursos.nome AS cursoNome 
            FROM 
                disciplinas
            INNER JOIN
                cursos
            ON
                disciplinas.idCurso = cursos.idCurso            
            WHERE 
                idDisciplina = '$objeto->idDisciplina'
            ";
        $query = $this->query->setQuery($sql);
        return $query;
    }

    /**
     * Deleta equipamentos
     * $objeto = objeto com os itens a serem deletados
     * @retorna <objeto>
     */
    public function deletar($objeto) {

        $sql = "
            DELETE FROM
                disciplinas
            WHERE
             idDisciplina = '$objeto->idDisciplina'
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }

    //Excluir essa funcao talvessssssssssssssssssssss
    /*
      public function verificaFkRegistros($objeto)
      {
      $sql = "
      SELECT * FROM disciplinas WHERE idCurso = '$objeto->idDisciplina'
      ";
      $query = $this->query->setQuery($sql);

      return $query;
      } */

    public function verificaProfessorDisciplina($objeto) {
        $sql = "
            SELECT 
                disciplinas.idDisciplina 
            FROM 
                disciplinas
            INNER JOIN
                professores_disciplinas
            ON
                professores_disciplinas.idDisciplina = disciplinas.idDisciplina
            WHERE 
                professores_disciplinas.idDisciplina = '$objeto->idDisciplina'
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

        $sql = "
            SELECT
                *,
                disciplinas.nome AS disciplinaNome,
                cursos.nome AS cursoNome
            FROM
                disciplinas
            INNER JOIN
                cursos
            ON
                disciplinas.idCurso = cursos.idCurso
            WHERE
                disciplinas.nome LIKE '%$objeto->nome%'
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }

    public function obterDisciplinasPorIds($data)
    {   
        $i = 0;
        $array = array();
        foreach($data["ids"] as $valor)
        {
            
            $sql = "
                SELECT * FROM disciplinas WHERE idDisciplina = '$valor'
            ";
            $query = $this->query->setQuery($sql);
            
            
            foreach($query->result() as $disciplinas)
            {
                $array[$i]["nome"]          = $disciplinas->nome;
                $array[$i]["horaInicial"]   = $disciplinas->horaInicial;
                $array[$i]["horaFinal"]     = $disciplinas->horaFinal;
                $array[$i]["idDisciplina"]  = $disciplinas->idDisciplina;
                $i++;
            }
        }
        return $array;
    }
    
    //Ecluir talves
    /*
    public function obterDiciplinaComCurso($idCurso) {
        $sql = "
            SELECT
                idCurso
            FROM
                cursos
            WHERE
                cursos.idCurso = $idCurso and
                cursos.idCurso not in (SELECT idCurso FROM disciplinas)
        ";
        $query = $this->query->setQuery($sql);
        return $query;
    }

    public function obterDiciplinaSemCurso($objeto) {
        
    }*/
    
 
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