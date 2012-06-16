<?php
//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');

/**
* Classe: Pesquisa
* Finalidade: Pesquisa global
* Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
* Data de Criação: 17/03/2012
*/
class Pesquisa extends CI_Controller {

    public function index() {
        
    }

    /**
    * Lista itens pesquisados
    * Sem parametros
    * @retorna <array + template>
    */
    public function glob() {
        if (!$this->access_rule->has_permission(1))
            $this->access_rule->no_access();
        
        $this->load->model('pesquisas');
        $this->load->model('pessoas');
        $this->load->model('acessos');
        $this->load->model('equipamentos');
        $this->load->model('salas');
        $this->load->model('usuarios');
        $this->load->model('cidades');

        $valor     = $_POST["pesquisaGlobal"];
        $pesquisas = new Pesquisas();
        
        $pesquisas->set("campo", $valor);
        
        $rows          = $pesquisas->glob($pesquisas);
        $data["dados"] = $rows->result();

        $this->load->view('pesquisaPesquisas', $data);
    }

    /**
    * Lista itens pesquisados
    * Sem parametros
    * @retorna <json>
    */
    public function autoCompletar()
    {
        if (!$this->access_rule->has_permission(1))
            $this->access_rule->no_access();
        
        $this->load->model('pesquisas');
        $this->load->model('pessoas');
        $this->load->model('acessos');
        $this->load->model('equipamentos');
        $this->load->model('salas');
        $this->load->model('usuarios');
        $this->load->model('cidades');

        $valor     = $_POST["pesquisaGlobal"];
        $pesquisas = new Pesquisas();
        
        $pesquisas->set("campo", $valor);
        
        $rows          = $pesquisas->autoCompletar($pesquisas);
        
        $array = array();
        $i = 0;
        
        foreach($rows->result() as $valor)
        {
            $array[$i] = $valor->pessoaNome;
            $i++;
        }
        print_r(json_encode($array));
 
        
    }
}

?>