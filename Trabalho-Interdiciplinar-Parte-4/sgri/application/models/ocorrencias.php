<?php

//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');

/**
 * Classe: Acessos
 * Finalidade: Obtem acesso ao Banco Acesso
 * Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
 * Data de Criação: 17/03/2012
 */
class Ocorrencias extends CI_Model {

    private $idOcorrencia = null;
    private $descricao = null;
    private $data = null;
    private $de = null;
    private $para = array();

    /**
    * Insere registros
    * $objeto = valores a serem inseridos
    * @retorna <objeto>
    */
    public function inserir($objeto) {
        
        $objeto->de = $this->session->userdata('idPessoa');
        $objeto->data = date("Y-m-d");
        foreach($objeto->para as $valor){
            
            $sql = "
                INSERT INTO
                    ocorrencias
                values(
                    '',
                    '$objeto->descricao',
                    '$objeto->data',
                    '$objeto->de',
                    '$valor'
                    )
            ";
            $query = $this->query->setQuery($sql);
        }
        
        return $query;
    }
    
    public function entradas(){
        $para = $this->session->userdata('idPessoa');
        
        $sql = "
            SELECT 
                *,
                p2.nome AS meEnviou
            FROM 
                ocorrencias o
            INNER JOIN
                pessoas p
            ON
                o.para = p.idPessoa
            INNER JOIN
                pessoas p2
            ON
                p2.idPessoa = o.de
            WHERE 
                para = '$para' 
            order by o.idOcorrencia DESC 
        ";
        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    public function saidas(){
        $de = $this->session->userdata('idPessoa');
        
        $sql = "
            SELECT 
                *,
                p2.nome AS euEnviei
            FROM 
                ocorrencias o
            INNER JOIN
                pessoas p
            ON
                o.para = p.idPessoa
            INNER JOIN
                pessoas p2
            ON
                p2.idPessoa = o.para
            WHERE 
                de = '$de' 
            order by o.idOcorrencia DESC 
        ";
        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    public function deletar($objeto){
        
        $sql = "
            DELETE FROM
                ocorrencias
            WHERE
             idOcorrencia = '$objeto->idOcorrencia'
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    public function checkTotais(){
        $idPessoa = $this->session->userdata('idPessoa');
        
        $sql = "
            SELECT 
                o.idOcorrencia
            FROM 
                ocorrencias o
            WHERE 
                para = '$idPessoa' 
        ";
        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    public function pesquisar($data){
        
        $pesquisa = $data["pesquisa"];
        $idPessoa = $this->session->userdata('idPessoa');
        
        $sql = "
            SELECT 
                *
            FROM 
                ocorrencias
            WHERE 
                para = '$idPessoa' ||
                de   = '$idPessoa' and
                descricao like '%$pesquisa%'
        ";
        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterOcorrenciasInfra() {
        
        $sql = "
                SELECT 
                    p.nome, 
                    COUNT( o.de ) AS total
                FROM 
                    ocorrencias o
                INNER JOIN
                    pessoas p
                ON
                    p.idPessoa = o.de
                GROUP BY
                    p.nome
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