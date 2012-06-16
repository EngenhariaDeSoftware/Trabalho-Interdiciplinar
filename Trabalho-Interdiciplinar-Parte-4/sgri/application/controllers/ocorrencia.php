<?php
//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');

/**
* Classe: Acesso
* Finalidade: Nao utilizada ainda
* Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
* Data de Criação: 17/03/2012
*/
class Ocorrencia extends CI_Controller {

    public function formularioOcorrencias(){
        
        $this->load->model('pessoas');
        $pessoas     = new Pessoas();
        $rowsPessoas = $pessoas->obterPessoas();
        
        $data['rowsPessoas'] = $rowsPessoas->result();
        $this->load->view('cadastroOcorrencias', $data);
    }
    
    public function salvar(){

        $this->load->model('ocorrencias');
        $ocorrencias = new Ocorrencias();

        $ocorrencias->set("descricao", $_POST["descricao"]);
        $ocorrencias->set("para",      $_POST["para"]);
        
        $ocorrencias->inserir($ocorrencias);
        $array = array(
            "sucesso" => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro Cadastrado com sucesso!!! ",
            "tipo" => "nSuccess",
            "redirecionar" => true,
            "url" => "ocorrencia/formularioOcorrencias"
        );

        print_r(json_encode($array));
    }
    
    public function entrada(){
        $this->load->model('ocorrencias');
        $ocorrencias = new Ocorrencias();
        $rows        = $ocorrencias->entradas();
        
        $data['rows'] = $rows->result();
        $this->load->view('ocorrenciasEntradas', $data);
    }
    
    public function saida(){
        $this->load->model('ocorrencias');
        $ocorrencias = new Ocorrencias();
        $rows        = $ocorrencias->saidas();
        
        $data['rows'] = $rows->result();
        $this->load->view('ocorrenciasSaidas', $data);
    }
    
    public function deletar(){
        $id = $_POST["id"];
        
        $this->load->model('ocorrencias');
        $ocorrencias = new Ocorrencias();
        
        $ocorrencias->set("idOcorrencia", $id);
        $ocorrencias -> deletar($ocorrencias);
        $array = array(
            "sucesso" => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro excluido com sucesso!!! ",
            "tipo" => "nSuccess",
            "redirecionar" => true,
            "url" => "ocorrencia/formularioOcorrencias"
        );

        print_r(json_encode($array));
        
    }
    
    public function checkTotal(){
        $this->load->model('ocorrencias');
        $ocorrencias = new Ocorrencias();
        
        $row = $ocorrencias->checkTotais();
        $total = $row->num_rows();
        
        $array = array("total" => $total);
        print_r(json_encode($array));
    }
    
    public function pesquisar(){
        $this->load->model('ocorrencias');
        $ocorrencia = new Ocorrencias();
        $rows = $ocorrencia->pesquisar($_POST);
        
        $data['rows'] = $rows->result();
        $this->load->view('pesquisaOcorrencias', $data);
    }
    
    /**
     * Salva registro
     * sem parametros
     * @retorna <Objeto>
     */
    public function relatorio() {
        $this->load->model('ocorrencias');


        $ocorrencias = new Ocorrencias();

        $rows = $ocorrencias->obterOcorrenciasInfra();

        $data["rows"] = $rows->result();

        $a = "";
        foreach ($data["rows"] as $valor) {
            $a .= "{name:" . "'$valor->nome',";
            $a .= "data:" . "[$valor->total]},";
        }
        $data["a"] = $a;
        $this->load->view('graficoOcorrencias', $data);
    }
    
    

}
/*
 Array
(
    [descricao] => cvavsa
    [para] => Array
        (
            [0] => 15
            [1] => 17
            [2] => 18
        )

)
 */
?>