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
class Acessos extends CI_Model {

    private $idAcesso = null;
    private $nome = null;

    /**
     * Lista todos acessos
     * Sem parametros
     * @retorna <objeto>
     */
    public function obterAcessos() {

        $sql = "SELECT * FROM  acessos";
        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    /**
     * Lista todos acessos
     * Sem parametros
     * @retorna <objeto>
     */
    public function obterAcessosProfessores() {

        $sql = "SELECT * FROM  acessos WHERE idAcesso = 3";
        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    
    
    public function obterIdAcesso($xml){
        $i =0;
        foreach($xml as $valor)
        {
            $NomeAcesso = $valor["NomeAcesso"];
            $sql = "
                SELECT
                    *
                FROM
                    acessos
                WHERE
                    nome = '$NomeAcesso'
            ";
            $query     = $this->query->setQuery($sql);
            
            foreach($query->result() as $val)
            {
                $ar[$i] = $val->idAcesso;
            }
            
            $i++;
         
        }
        return $ar;
        
        
        
     
    }
            

}

?>