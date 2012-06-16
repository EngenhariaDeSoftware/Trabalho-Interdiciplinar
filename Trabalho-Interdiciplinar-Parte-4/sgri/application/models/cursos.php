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
class Cursos extends CI_Model {

    private $idCurso  = null;
    private $nome     = null;


    /**
    * Insere registros
    * $objeto = valores a serem inseridos
    * @retorna <objeto>
    */
    public function inserir($objeto) {

        $sql = "
            INSERT INTO
                cursos
             values(
                '',
                '$objeto->nome'
                )
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }

    /**
    * Atualiza Registros
    * $objeto = valores a serem atualizados
    * @retorna <objeto>
    */
    public function atualizar($objeto) {
        
        $sql = "
            UPDATE 
                cursos
            SET
                nome    = '$objeto->nome'
            WHERE
                idCurso = '$objeto->idCurso'
        ";

        $query = $this->query->setQuery($sql);
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
        
        if ( $resultado == '0' ) {
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
    public function obterCursos() {
        
        $sql    = "SELECT * FROM cursos";
        $query  = $this->query->setQuery($sql);
        return $query;
    }
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterUltimosCursos() {
        
        $sql    = "SELECT * FROM cursos ORDER BY nome ASC LIMIT 0 , 6";
        $query  = $this->query->setQuery($sql);
        return $query;
    }

    /**
    * Obtem um unico equipamento
    * $objeto = um unico id a ser pesquisado
    * @retorna <objeto>
    */
    public function obterPorCursos($objeto) {
        
        $sql    = "SELECT * FROM cursos WHERE idCurso = '$objeto->idCurso'";
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
                cursos
            WHERE
             idCurso = '$objeto->idCurso'
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    public function verificaFkRegistros($objeto)
    {
        $sql = "
            SELECT * FROM disciplinas WHERE idCurso = '$objeto->idCurso'
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
                *
            FROM
                cursos
            WHERE
             nome LIKE '%$objeto->nome%'
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