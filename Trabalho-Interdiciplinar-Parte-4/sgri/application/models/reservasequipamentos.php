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
class reservasequipamentos extends CI_Model {

    private $idReservaEquipamento = null;
    private $idEquipamento        = array();
    private $idReserva            = null;
    private $idReservaEvento      = null;

    /**
    * Insere registros
    * $objeto = valores a serem inseridos
    * @retorna <objeto>
    */
    public function inserir($objeto) {
        
        foreach( $objeto->idEquipamento as $valor ){

            $sql = "
                INSERT INTO
                    reservas_equipamentos
                values(
                    '',
                    '$valor',
                    '$objeto->idReserva',
                    NULL
                    )
            ";

            $query = $this->query->setQuery($sql);
        }
    }
    
    /**
    * Insere registros
    * $objeto = valores a serem inseridos
    * @retorna <objeto>
    */
    public function inserirEquipamentosReservas($objeto) {
        
        foreach( $objeto->idEquipamento as $valor ){

            $sql = "
                INSERT INTO
                    reservas_equipamentos
                values(
                    '',
                    '$valor',
                    NULL,
                    '$objeto->idReservaEvento'
                    )
            ";

            $query = $this->query->setQuery($sql);
        }
    }
    
    /**
    * Obtem um unico equipamento
    * $objeto = objeto contendo o id do equipamento para detalhe
    * @retorna <objeto>
    */
    public function checarExisteEquipamentos($objeto) {
        
        $sql = "
            SELECT *
                FROM
             reservas_equipamentos
                WHERE
             idEquipamento = '$objeto->idEquipamento'
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    /**
    * Obtem um unico equipamento
    * $objeto = objeto contendo o id do equipamento para detalhe
    * @retorna <objeto>
    */
    public function obterEquipamentos($objeto) {
        
        $id = $objeto["id"];
        
        $sql = "
                SELECT 
                    *
                FROM
                    reservas_equipamentos re
                INNER JOIN
                    equipamentos e
                ON
                    e.idEquipamento = re.idEquipamento
                WHERE
                    re.idReservaEvento = '$id'
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