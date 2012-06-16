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
class ProfessorDisciplina extends CI_Controller {

    function index() {
        
    }

    /**
     * Formulario de formularioDisciplina
     * sem parametros
     * @retorna <Formulario>
     */
    public function formularioProfessorDisciplina() {
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();
        
        $this->load->model('pessoas');
        $this->load->model('disciplinas');

        $pessoas = new Pessoas();
        $rowsProfessor = $pessoas->obterProfessor();
        $rowsProfessor = $rowsProfessor->result();

        $disciplinas = new Disciplinas();
        $rows = $disciplinas->obterDisciplinas();
        $rows = $rows->result();

        $data['desciplinas'] = $rows;
        $data['professores'] = $rowsProfessor;

        $this->load->view('cadastroDisciplinaProfessor', $data);
    }

    /**
     * Salva registro
     * sem parametros
     * @retorna <Nada>
     */
    public function salvar() {
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();
        
        $this->load->model('ProfessoresDisciplinas');

        if (isset($_POST["id"])) {
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
        
        $this->load->model('ProfessoresDisciplinas');
        $ProfessoresDisciplinas = new ProfessoresDisciplinas();

        $ProfessoresDisciplinas->set("idPessoa", $_POST["idPessoa"]);
        if( isset($_POST["idDiciplina"]) ){
            $ProfessoresDisciplinas->set("idDiciplina", $_POST["idDiciplina"]);
        } else {
            $array = array(
                "sucesso" => false,
                "Mensagem" => "<strong>Aviso: </strong> Selecione pelo menos uma disciplina na grade Direita!!! ",
                "tipo" => "nWarning"
            );

            print_r(json_encode($array));
            return false;
        }

        $ProfessoresDisciplinas->inserir($ProfessoresDisciplinas);

        $array = array(
            "sucesso" => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro Cadastrado com sucesso!!! ",
            "tipo" => "nSuccess"
        );

        print_r(json_encode($array));
    }

    public function obterProfessorDisciplina()
    {
        if (!$this->access_rule->has_permission(15))
            $this->access_rule->no_access();
        
        $this->load->model('professoresDisciplinas');
        $this->load->model('pessoas');
        
        $pessoas         = new Pessoas();
        $rowsProfessores = $pessoas -> obterProfessor();
        
        $data['datas'] = $rowsProfessores->result();

        $this->load->view('listarDisciplinasProfessores', $data);        
    }
    
    public function obterDisciplinaPorProfessor()
    {
        if (!$this->access_rule->has_permission(15))
            $this->access_rule->no_access();
        
        $this->load->model('professoresDisciplinas');
        
        $ProfessoresDisciplinas = new professoresdisciplinas();
        $ProfessoresDisciplinas->set("idPessoa", $_POST["id"]);
        
        $rows = $ProfessoresDisciplinas->obterDisciplinasPorProfessores($ProfessoresDisciplinas);
        
        $data["datas"] = $rows->result();
        $this->load->view('relacaoDisciplinasProfessores', $data);
        
    }
    
    public function obterDisciplinaProfessor()
    {
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();
        
        $this->load->model('ProfessoresDisciplinas');

        $id = $_POST["id"];
        $ProfessoresDisciplinas = new ProfessoresDisciplinas();
        
        $ProfessoresDisciplinas -> set("idPessoa", $id);
        
        $rows = $ProfessoresDisciplinas -> obterDisciplinasProfessores($ProfessoresDisciplinas);
        
        print_r(json_encode($rows->result()));
        
    }
    
    public function deletar()
    {
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();
        
        $this->load->model('ProfessoresDisciplinas');
        
        $idProfessorDisciplina = $_POST["id"];
        
        
        
        
        $ProfessoresDisciplinas = new ProfessoresDisciplinas();
        $ProfessoresDisciplinas -> set("idProfessorDisciplina", $idProfessorDisciplina);
        $rows = $ProfessoresDisciplinas -> deletar($ProfessoresDisciplinas);
        
        $array = array(
            "sucesso" => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro Excluido com sucesso!!! ",
            "tipo" => "nSuccess"
        );

        print_r(json_encode($array));
    }
}

?>