<?php

//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');

/**
 * Classe: Index
 * Finalidade: Classe que chama a pagina inicial
 * Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
 * Data de Criação: 17/03/2012
 */
class Index extends CI_Controller {

    /**
     * Pagina Inicial. Carrega varios controllers e Models e Templates na tela inicial
     * sem parametros
     * @retorna <array + template>
     */
    public function HomePage() {
        $this->load->view('login');
    }

    public function login() {

        $session = $this->session->all_userdata();

 
        if (isset($_POST['usuario'])) {

            $usuario = mysql_escape_string($_POST['usuario']);
            $senha = md5(mysql_escape_string($_POST['senha']));

            $this->load->model('login');

            $login = new Login();
            $login->set("usuario", $usuario);
            $login->set("senha", $senha);
            $logar = $login->validar($login);

            if (!$logar) {
                unset($_POST["usuario"]);
                unset($_POST["senha"]);
                echo "<script>alert('Usuario ou Senha Invalidos!!!');</script>";
                echo "<script>window.location.href = '../';</script>";
                return false;
            }

            $resultado = $login->obterDadosUsuarios($login);

            foreach ($resultado->result() as $valor) {

                $sessao = array(
                    'idPessoa' => $valor->idPessoa,
                    'nome' => $valor->pessoaNome,
                    'email' => $valor->email,
                    'idAcesso' => $valor->idAcesso,
                    'acessoNome' => $valor->acessoNome
                );
            }
            $this->session->set_userdata($sessao);

            $session = $this->session->all_userdata();
            
            //1 coordnador
            //2 InfraEstrutura
            //3 professor
            //4 recursos Humanos
            if($this->session->userdata('idAcesso') == 1){
                $this->indexCoordenador();
            }
            if($this->session->userdata('idAcesso') == 2){
                $this->indexInfraEstrutura();
            }
            if($this->session->userdata('idAcesso') == 3){
                $this->indexProfessor();
            }
            if($this->session->userdata('idAcesso') == 4){
                $this->indexRecursosHumanos();
            }
            if($this->session->userdata('idAcesso') == 5){
                $this->indexControlerAcademico();
            }
            return false;
        } else {

            echo "<script>window.location.href = '../';</script>";
            return false;
            exit;
        }
    }
    
    function indexCoordenador() {
        if (!$this->access_rule->has_permission(2))
            $this->access_rule->no_access();
        
        $this->sessoes->verificaSessao();        
        
        $this->load->model('pessoas');

        $pessoas = new Pessoas();
        $rowsTotal = $pessoas->obterPessoas();
        $rows = $pessoas->obterUltimasPessoas();
        
        $data["pessoas"] = $rows->result();
        $data["pessoasTotal"] = $rowsTotal->num_rows();
        
        $data["urlInicial"] = "inicio/indexCoordenador";
        $this->load->library('parser');
        
        $datas['pagina']= $this->load->view('indexCoordenador', $data, TRUE);
        $this->parser->parse('index',$datas); 
    }
    
    function indexControlerAcademico() {
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
        
        $data["urlInicial"] = "inicio/controlerAcademico";
        
        
        $this->load->library('parser');
        $datas['pagina']= $this->load->view('indexControlerAcademico', $data, TRUE);
        $this->parser->parse('index',$datas); 

        

    }
    
    function indexProfessor() {
        if (!$this->access_rule->has_permission(3))
            $this->access_rule->no_access();
        
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
        
        
        
        $data["urlInicial"] = "inicio/professor";
        
        $this->load->library('parser');
        $datas['pagina']= $this->load->view('indexProfessor', $data, TRUE);
        $this->parser->parse('index',$datas); 
        
    }
    
    function indexInfraEstrutura() {
        if (!$this->access_rule->has_permission(1))
            $this->access_rule->no_access();
        
        $this->sessoes->verificaSessao();        
        
        $this->load->model('pessoas');

        $pessoas = new Pessoas();
        $rowsTotal = $pessoas->obterPessoas();
        $rows = $pessoas->obterUltimasPessoas();

        $data["pessoas"] = $rows->result();
        $data["pessoasTotal"] = $rowsTotal->num_rows();

        //equipamentos
        $this->load->model('equipamentos');

        $equipamentos = new Equipamentos();
        $ultimosEquipamentos = $equipamentos->obterUltimosEquipamentos();
        $equipamentoTotal = $equipamentos->obterEquipamentos();

        $data["equipamentoTotal"] = $equipamentoTotal->num_rows();
        $data["ultimosEquipamentos"] = $ultimosEquipamentos->result();

        //salas
        $this->load->model('salas');

        $salas = new Salas();
        $ultimasSalas = $salas->obterUltimasSalas();
        $salasTotal = $salas->obterSalas();

        $data["ultimasSalas"] = $ultimasSalas->result();
        $data["salasTotal"] = $salasTotal->num_rows();
        
        $data["urlInicial"] = "inicio/inicial";
        $this->load->library('parser');
        
        $datas['pagina']= $this->load->view('indexInfraEstrutura', $data, TRUE);
        $this->parser->parse('index',$datas); 
    }
    
    function indexRecursosHumanos() {
        if (!$this->access_rule->has_permission(4))
            $this->access_rule->no_access();
        
        $this->sessoes->verificaSessao();        
        
        $this->load->model('pessoas');

        $pessoas = new Pessoas();
        $rowsTotal = $pessoas->obterPessoas();
        $rows = $pessoas->obterUltimasPessoas();
        
        $data["pessoas"] = $rows->result();
        $data["pessoasTotal"] = $rowsTotal->num_rows();
        
        $data["urlInicial"] = "inicio/recursosHumanos";
        $this->load->library('parser');
        
        $datas['pagina']= $this->load->view('indexRecursosHumanos', $data, TRUE);
        $this->parser->parse('index',$datas); 
    }
    
    

}