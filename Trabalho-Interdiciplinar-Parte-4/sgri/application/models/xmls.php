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
class Xmls extends CI_Model {

    private $idXml = null;
    private $url   = null;

    /**
     * Lista todos acessos
     * Sem parametros
     * @retorna <objeto>
     */
    public function inserir($objeto) {

        $sql = "
            INSERT INTO
                xmls
             values(
                '',
                '$objeto->url'
                )
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }
     
    
    /**
    * Obtem todos equipamentos
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterXmls() {
        
        $sql    = "SELECT * FROM xmls";
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