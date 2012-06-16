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
class reservaseventosprofessores extends CI_Model {	 	 	 	 	 	 	
	
    private $idReservaEventoProfessor = null;
    private $idProfessor              = array();
    private $idReservaEvento          = null;

    /**
    * Insere registros
    * $objeto = valores a serem inseridos
    * @retorna <objeto>
    */
    public function inserir($objeto) {

        foreach($objeto->idProfessor as $valor)
        {
            $sql = "
                INSERT INTO
                    reservas_eventos_professores
                values(
                    '',
                    '$valor',
                    '$objeto->idReservaEvento'
                    )
            ";
            $query = $this->query->setQuery($sql);
        }

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