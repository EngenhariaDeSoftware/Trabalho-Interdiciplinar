<?php
//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');
/**
* Classe: Cidades
* Finalidade: Obtem acesso ao Banco Cidades
* Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
* Data de Criação: 17/03/2012
*/
class Cidades extends CI_Model {

    private $id     = null;
    private $estado = null;
    private $uf     = null;
    private $nome   = null;
    
    /**
    * Lista todas Cidades
    * Sem parametros
    * @retorna <objeto>
    */
    function obterCidades() {
        
        $this->id = $_POST["idEstado"];

        $sql    = "SELECT * FROM  cidades WHERE idEstado = $this->id";
        $query  = $this->query->setQuery($sql);

        return $query;
    }
    
    /**
    * Lista todas Cidades
    * Sem parametros
    * @retorna <objeto>
    */
    function obterCidadesXml() {
        
        $this->id = $_POST["idEstado"];

        $sql    = "SELECT * FROM  cidades WHERE uf = '$this->id'";
        $query  = $this->query->setQuery($sql);

        return $query;
    }

}

?>