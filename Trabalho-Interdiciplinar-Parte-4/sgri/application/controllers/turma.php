<?php

//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');

/**
 * Classe: Equipamento
 * Finalidade: 
 * Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
 * Data de Criação: 17/03/2012
 */
class Turma extends CI_Controller {

    function index() {
        
    }
    
    //OKKKKKKKKKKKKKKKKKKKKKKK
    public function detalheEquipamento()
    {
        $this->load->view('detalheEquipamentoReserva');
    }

    /**
     * Formulario de Equipamento
     * sem parametros
     * @retorna <Formulario>
     */
    public function formularioTurma() {
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();
        
        $this->load->model('pessoas');
        
        $pessoas       = new Pessoas();
        $rowsProfessor = $pessoas -> obterProfessor();

        $data['professores'] = $rowsProfessor->result();
        
        if ( isset($_POST["id"]) ) {
            $this->load->model('turmas');
            
            $id = $_POST["id"];
            
            $turmas = new Turmas();
            
            $turmas->set("idTurma", $id);
            $rowsTurma = $turmas ->obterPorTurmas($turmas);
            
            $data['turmas'] = $rowsTurma->result();
            $this->load->view('editarTurmas', $data);
            return false;
        }

        $this->load->view('cadastroTurmas', $data);
    }

    /**
     * Salva registro
     * sem parametros
     * @retorna <Nada>
     */
    public function salvar() {
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();        

        if ( isset($_POST["id"]) ) {
            $this->atualizar($_POST["id"], $_POST);
        } else {
            $this->inserir();
        }
    }

    /**
     * Insere um registro
     * sem parametros
     * @retorna <json>
     */
    public function inserir() {
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();

        if ( $_POST["nome"] == "" || $_POST["grupo"] == "" ) {
            $array = array(
                "sucesso"  => false,
                "Mensagem" => "<strong>Impossivel: </strong>Campos nome e grupo precisa ser preenchido.",
                "tipo"     => "nFailure"
            );

            print_r(json_encode($array));
            return false;
        }
        
        if ( !isset($_POST["idDisciplina"]) || !isset($_POST["idPessoa"]) ) {
            $array = array(
                "sucesso"  => false,
                "Mensagem" => "<strong>Impossivel: </strong>O campo Disciplina e Professor precisar ser preenchido.",
                "tipo"     => "nFailure"
            );

            print_r(json_encode($array));
            return false;
        }

        $this->load->model('turmas');
        $turmas = new Turmas();

        $turmas->set("nome",          $_POST["nome"]);
        $turmas->set("grupo",         $_POST["grupo"]);
        $turmas->set("idPessoa",      $_POST["idPessoa"]);
        $turmas->set("idDisciplina",  $_POST["idDisciplina"]);
        
        $turmas->inserir($turmas);

        //nWarning  nSuccess nFailure
        $array = array(
            "sucesso"  => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro Cadastrado com sucesso!!! ",
            "tipo"     => "nSuccess",
            "redirecionar" => true,
            "url"          => "turma/formularioTurma"
        );

        print_r(json_encode($array));
    }

    /**
     * Obtem um equipamento
     * sem parametros
     * @retorna <Template>
     */
    public function obterTurma() {
        
        if (!$this->access_rule->has_permission(15))
            $this->access_rule->no_access();
        
        $this->load->model('turmas');
        $turmas     = new Turmas();
        $rowsTurmas = $turmas -> obterTurmas();
        
        $data["turmas"] = $rowsTurmas->result();
        
        $this->load->view('listarTurmas', $data);
    }

    /**
     * Atualiza registro
     * sem parametros
     * @retorna <json>
     */
    public function atualizar() {
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();

        if ( $_POST["nome"] == "" || $_POST["grupo"] == "" ) {
            $array = array(
                "sucesso"  => false,
                "Mensagem" => "<strong>Impossivel: </strong>Campos nome e grupo precisa ser preenchido.",
                "tipo"     => "nFailure"
            );

            print_r(json_encode($array));
            return false;
        }
        
        if ( !isset($_POST["idDisciplina"]) || !isset($_POST["idPessoa"]) ) {
            $array = array(
                "sucesso"  => false,
                "Mensagem" => "<strong>Impossivel: </strong>O campo Disciplina e Professor precisar ser preenchido.",
                "tipo"     => "nFailure"
            );

            print_r(json_encode($array));
            return false;
        }
        
        $this->load->model('turmas');

        $turma = new Turmas();
        
        $turma->set("idTurma",       $_POST["id"]);
        $turma->set("nome",          $_POST["nome"]);
        $turma->set("grupo",         $_POST["grupo"]);
        $turma->set("idPessoa",      $_POST["idPessoa"]);
        $turma->set("idDisciplina",  $_POST["idDisciplina"]);
        
        $turma->atualizar($turma);

        $array = array(
            "sucesso"      => true,
            "Mensagem"     => "<strong>Sucesso: </strong>Registro Atualizado com sucesso!!! ",
            "tipo"         => "nSuccess",
            "redirecionar" => true,
            "url"          => "turma/obterTurma"
        );

        print_r(json_encode($array));
    }

    /**
     * Deleta um registro
     * sem parametros
     * @retorna <json>
     */
    public function deletar() {
        
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();
        
        $this->load->model('turmas');
        
        $id           = $_POST["id"];
        $turmas = new Turmas();
        $turmas->set("idTurma", $id);
        
        $turmas->deletar($turmas);

        $array = array(
            "sucesso"   => true,
            "Mensagem"  => "<strong>Sucesso: </strong>Registro Excluido com sucesso!!! ",
            "tipo"      => "nSuccess"
        );

        print_r(json_encode($array));
    }

    /**
     * Detalha um registro
     * sem parametros
     * @retorna <Template>
     */
    public function detalhe() {

        
        $this->load->view('detalheReservas');
    }
    
    

    /**
     * Pesquisa um registro
     * sem parametros
     * @retorna <Template>
     */
    public function pesquisar() {
         if (!$this->access_rule->has_permission(15))
            $this->access_rule->no_access();

        $this->load->model('turmas');

        $valor = $_POST["pesquisa"];
        $opcao = $_POST["opcao"];

        $turmas = new Turmas();

        $turmas->set("nome", $valor);
        $turmas->set("opcao", $opcao);

        $rows = $turmas->pesquisar($turmas);

        $data['turmas'] = $rows->result();

        $this->load->view('pesquisaTurmas', $data);
    }

}

?>