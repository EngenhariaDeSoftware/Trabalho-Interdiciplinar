<?php
//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');

/**
* Classe: Inicio
* Finalidade: Inicia o sistema aparti do momento que vc esteja dentro
* Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
* Data de Criação: 17/03/2012
*/

class Inicio extends CI_Controller {


    /**
    * Nao está aplicada
    * sem parametros
    * @retorna <json>
    */
    public function index() {
        $this->load->view('index');
    }
    
    /**
    * Tela inicial do sistema
    * sem parametros
    * @retorna <array + template>
    */
    function inicial()
    {
        if (!$this->access_rule->has_permission(1))
            $this->access_rule->no_access();
        
        $this->sessoes->verificaSessao();
        
        //pessoas
        $this->load->model('pessoas');
        
        $pessoas   = new Pessoas();
        $rowsTotal = $pessoas->obterPessoas();
        $rows      = $pessoas->obterUltimasPessoas();

        $data["pessoas"]      = $rows->result();
        $data["pessoasTotal"] = $rowsTotal->num_rows();

        //equipamentos
        $this->load->model('equipamentos');
        
        $equipamentos        = new Equipamentos();
        $ultimosEquipamentos = $equipamentos->obterUltimosEquipamentos();
        $equipamentoTotal    = $equipamentos->obterEquipamentos();

        $data["equipamentoTotal"]    = $equipamentoTotal->num_rows();
        $data["ultimosEquipamentos"] = $ultimosEquipamentos->result();

        //salas
        $this->load->model('salas');
        
        $salas        = new Salas();
        $ultimasSalas = $salas->obterUltimasSalas();
        $salasTotal   = $salas->obterSalas();

        $data["ultimasSalas"] = $ultimasSalas->result();
        $data["salasTotal"]   = $salasTotal->num_rows();

        $this->load->view('inicial', $data);
    }
    
    /**
    * Tela inicial do sistema
    * sem parametros
    * @retorna <array + template>
    */
    function professor()
    {
        if (!$this->access_rule->has_permission(3))
            $this->access_rule->no_access();
        //colocar nivel sessao aqui
       /*
        $sessao = array(
                    'idPessoa' => $valor->idPessoa,
                    'nome' => $valor->pessoaNome,
                    'email' => $valor->email,
                    'idAcesso' => $valor->idAcesso,
                    'acessoNome' => $valor->acessoNome
                );
        */
        $idPessoa = $this->session->userdata('idPessoa');

        $this->sessoes->verificaSessao();
        
        //turmas
        $this->load->model('turmas');
        $turmas     = new Turmas();
        $turmas->set("idPessoa", $idPessoa);
        $rowsTurmas = $turmas->obterTurmasProfessor($turmas);
        $data["turmas"]      = $rowsTurmas->result();
        
        //Equipamentos Disponiveis
        $this->load->model('equipamentos');
        $equipamentos     = new Equipamentos();
        $rowsEquipa       = $equipamentos->obterEquipamentosDisponiveis();
        $data["equipamentos"]   = $rowsEquipa->result();
        
        //Equipamentos em anutenaçãpo
        $rowsEquipa             = $equipamentos->obterEquipamentosManutencao();
        $data["equipamentosManutencao"]   = $rowsEquipa->result();

        $this->load->view('indexProfessor', $data);
    }
    
    /**
    * Tela inicial do sistema
    * sem parametros
    * @retorna <array + template>
    */
    function indexCoordenador()
    {
        if (!$this->access_rule->has_permission(2))
            $this->access_rule->no_access();
        
        $this->sessoes->verificaSessao();        
        
        $this->load->model('pessoas');

        $pessoas = new Pessoas();
        $rowsTotal = $pessoas->obterPessoas();
        $rows = $pessoas->obterUltimasPessoas();
        
        $data["pessoas"] = $rows->result();
        $data["pessoasTotal"] = $rowsTotal->num_rows();

        $this->load->view('indexCoordenador', $data);
    }
    
    /**
    * Tela inicial do sistema
    * sem parametros
    * @retorna <array + template>
    */
    function recursosHumanos()
    {
        if (!$this->access_rule->has_permission(4))
            $this->access_rule->no_access();
        
        $this->sessoes->verificaSessao();        
        
        $this->load->model('pessoas');

        $pessoas = new Pessoas();
        $rowsTotal = $pessoas->obterPessoas();
        $rows = $pessoas->obterUltimasPessoas();
        
        $data["pessoas"] = $rows->result();
        $data["pessoasTotal"] = $rowsTotal->num_rows();

        $this->load->view('indexRecursosHumanos', $data);
    }
    
    function controlerAcademico()
    {
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();
        
        $this->sessoes->verificaSessao();
        
        //pessoas
        $this->load->model('cursos');
        
        $cursos   = new Cursos();
        $rowsTotal = $cursos->obterCursos();
        $rows      = $cursos->obterUltimosCursos();

        $data["cursos"]      = $rows->result();
        $data["cursosTotal"] = $rowsTotal->num_rows();
        
        //disciplinas
        $this->load->model('disciplinas');
        
        $disciplinas   = new Disciplinas();
        $rowsTotal = $disciplinas->obterDisciplinas();
        $rows      = $disciplinas->obterUltimasDisciplinas();

        $data["disciplinas"]      = $rows->result();
        $data["disciplinasTotal"] = $rowsTotal->num_rows();
        
        //Turmas
        $this->load->model('turmas');
        
        $turmas        = new Turmas();
        $rowsTotal = $turmas->obterTurmas();
        $rows      = $turmas->obterUltimasTurmas();

        $data["turmasTotal"] = $rowsTotal->num_rows();
        $data["turmas"]      = $rows->result();

        //salas
        $this->load->model('salas');
        
        $salas        = new Salas();
        $ultimasSalas = $salas->obterUltimasSalas();
        $salasTotal   = $salas->obterSalas();

        $data["ultimasSalas"] = $ultimasSalas->result();
        $data["salasTotal"]   = $salasTotal->num_rows();

        $this->load->view('indexControlerAcademico', $data);
    }
    
    
}
?>