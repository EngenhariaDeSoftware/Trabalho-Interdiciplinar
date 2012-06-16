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
class Turmas extends CI_Model {

    private $idTurma    = null;
    private $nome       = null;
    private $grupo      = null;
    private $idPessoa   = null;
    private $idDisciplina = null;

    /**
    * Insere registros
    * $objeto = valores a serem inseridos
    * @retorna <objeto>
    */
    public function inserir($objeto) {
        
        $sql = "
            INSERT INTO
                turmas
             values(
                '',
                '$objeto->nome',
                '$objeto->grupo',
                '$objeto->idPessoa',
                '$objeto->idDisciplina'
                )
        ";

        $query = $this->query->setQuery($sql);
        return $query;
        //$this->db->insert('Equipamentos', $objeto); 
    }

    /**
    * Atualiza Registros
    * $objeto = valores a serem atualizados
    * @retorna <objeto>
    */
    public function atualizar($objeto) {

        $sql = "
            UPDATE 
                turmas
            SET
                nome            = '$objeto->nome',
                grupo           = '$objeto->grupo',
                idPessoa        = '$objeto->idPessoa',
                idDisciplina    = '$objeto->idDisciplina'
            WHERE
                idTurma   = '$objeto->idTurma'
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }

    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterTurmas() {
        
        $sql = "
            SELECT 
                *,
                pessoas.nome AS pessoaNome,
                disciplinas.nome AS disciplinaNome,
                turmas.nome AS turmaNome
            FROM 
                turmas 
            INNER JOIN
                pessoas
            ON
                turmas.idPessoa = pessoas.idPessoa
            INNER JOIN
                disciplinas
            ON
                turmas.idDisciplina = disciplinas.idDisciplina
            order by pessoas.nome ASC
        ";
        $query  = $this->query->setQuery($sql);
        return $query;
    }
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterUltimasTurmas() {
        
        $sql = "
            SELECT 
                *,
                pessoas.nome AS pessoaNome,
                disciplinas.nome AS disciplinaNome,
                turmas.nome AS turmaNome
            FROM 
                turmas 
            INNER JOIN
                pessoas
            ON
                turmas.idPessoa = pessoas.idPessoa
            INNER JOIN
                disciplinas
            ON
                turmas.idDisciplina = disciplinas.idDisciplina
                ORDER BY turmas.idTurma DESC LIMIT 0 , 6
        ";
        $query  = $this->query->setQuery($sql);
        return $query;
    }

    
    /**
    * Obtem um unico equipamento
    * $objeto = um unico id a ser pesquisado
    * @retorna <objeto>
    */
    public function obterPorTurmas($objeto) {
        
        $sql = "
            SELECT 
                *,
                pessoas.nome AS pessoaNome,
                disciplinas.nome AS disciplinaNome,
                turmas.nome AS turmaNome
            FROM 
                turmas 
            INNER JOIN
                pessoas
            ON
                turmas.idPessoa = pessoas.idPessoa
            INNER JOIN
                disciplinas
            ON
                turmas.idDisciplina = disciplinas.idDisciplina
            WHERE
                turmas.idTurma = '$objeto->idTurma'
        ";
        $query  = $this->query->setQuery($sql);
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
                turmas
            WHERE
             idTurma = '$objeto->idTurma'
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
                pessoas.nome AS pessoaNome,
                disciplinas.nome AS disciplinaNome,
                turmas.nome AS turmaNome
            FROM 
                turmas 
            INNER JOIN
                pessoas
            ON
                turmas.idPessoa = pessoas.idPessoa
            INNER JOIN
                disciplinas
            ON
                turmas.idDisciplina = disciplinas.idDisciplina
            WHERE
                turmas.$objeto->opcao LIKE '%$objeto->nome%' order by turmas.nome ASC
        ";
        $query  = $this->query->setQuery($sql);
        return $query;
        
    }
    
    /**
    * Pesquisa registros
    * $objeto = Contem dados para pesquisa
    * @retorna <objeto>
    */
    public function obterTurmasProfessor($objeto) {
        
        $sql = "
            SELECT 
                *,
                pessoas.nome AS pessoaNome,
                disciplinas.nome AS disciplinaNome,
                turmas.nome AS turmaNome,
                cursos.nome AS cursoNome
            FROM 
                turmas 
            INNER JOIN
                pessoas
            ON
                turmas.idPessoa = pessoas.idPessoa
            INNER JOIN
                disciplinas
            ON
                turmas.idDisciplina = disciplinas.idDisciplina
            INNER JOIN
                cursos
            ON
                disciplinas.idCurso = cursos.idCurso
            WHERE
                turmas.idPessoa = '$objeto->idPessoa'
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