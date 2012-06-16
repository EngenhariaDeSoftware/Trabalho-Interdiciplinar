<?php
//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');

/**
* Classe: Estado
* Finalidade: Obtem cidades
* Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
* Data de Criação: 17/03/2012
*/
class Estado extends CI_Controller {

    function index() {
        $this->load->view('index');
    }

    /**
    * Obtem uma cidade a partir do estado escolhido
    * sem parametros
    * @retorna <json>
    */
    function obterCidades() {

        
        $this->load->model('cidades');

        $cidades = new Cidades();
        $rows    = $cidades->obterCidades();

        print_r(json_encode($rows->result()));
    }
    
     /**
    * Obtem uma cidade a partir do estado escolhido
    * sem parametros
    * @retorna <json>
    */
    function obterCidadesXml() {

        $this->load->model('cidades');

        $cidades = new Cidades();
        $rows    = $cidades->obterCidadesXml();

        print_r(json_encode($rows->result()));
    }

}

?>