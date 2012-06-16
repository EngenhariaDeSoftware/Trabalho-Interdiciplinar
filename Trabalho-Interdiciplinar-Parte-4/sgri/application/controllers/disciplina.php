<?php

//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');

/**
 * Classe: Disciplinas
 * Finalidade: Cadastro de Disciplinas
 * Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
 * Data de Criação: 17/03/2012
 */
class Disciplina extends CI_Controller {

    function index() {
        
    }

    /**
     * Formulario de formularioDisciplina
     * sem parametros
     * @retorna <Formulario>
     */
    public function formularioDisciplina() {
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();
        
        $this->load->model('cursos');
        $cursos = new Cursos();
        $rowsCursos = $cursos->obterCursos();

        $data["cursos"] = $rowsCursos->result();

        if (isset($_POST["id"])) {
         
            $this->load->model('disciplinas');

            $id = $_POST["id"];
            $disciplinas = new Disciplinas();

            $disciplinas->set("idDisciplina", $id);

            $rows = $disciplinas->obterPorDisciplinas($disciplinas);
            $rows = $rows->result();


            $data['desciplinas'] = $rows;
            $this->load->view('editarDisciplinas', $data);
            return false;
        }

        $this->load->view('cadastroDisciplinas', $data);
    }

    /**
     * Salva registro
     * sem parametros
     * @retorna <Nada>
     */
    public function salvar() {
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();
        
        $this->load->model('cursos');

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

        if ( !isset($_POST["idCurso"][0]) || 
             $_POST["nome"] == "" || 
             $_POST["idCurso"][0] == "" || 
             $_POST["horaInicial"] == "" || 
             $_POST["horaFinal"] == "" || 
             $_POST["idCurso"] == "") {
            $array = array(
                "sucesso" => false,
                "Mensagem" => "<strong>Impossivel: </strong>Campo Nome, Tuno, Hora Inicial e Hora final precisa ser preenchido.
                    Se você preencheu, verfique tambem se você selecionou corretamente as diciplinas na grade direita<br/>",
                "tipo" => "nFailure"
            );

            print_r(json_encode($array));
            return false;
        }

        $this->load->model('disciplinas');
        $disciplinas = new Disciplinas();

        $disciplinas->set("nome", $_POST["nome"]);
        $disciplinas->set("turno", $_POST["turno"]);
        $disciplinas->set("horaInicial", $_POST["horaInicial"]);
        $disciplinas->set("horaFinal", $_POST["horaFinal"]);
        $disciplinas->set("idCurso", $_POST["idCurso"]);

        $resultado = $disciplinas->inserir($disciplinas);

        $array = array(
            "sucesso" => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro Cadastrado com sucesso!!! ",
            "tipo" => "nSuccess",
            "redirecionar" => true,
            "url"          => "disciplina/formularioDisciplina"
            
        );

        print_r(json_encode($array));
    }

    /**
     * Obtem um equipamento
     * sem parametros
     * @retorna <Template>
     */
    public function obterDisciplina() {
        if (!$this->access_rule->has_permission(15))
            $this->access_rule->no_access();
        
        $this->load->model('disciplinas');

        $disciplinas = new Disciplinas();
        $rows = $disciplinas->obterDisciplinas();

        $data['disciplinas'] = $rows->result();

        $this->load->view('listarDisciplinas', $data);
    }

    /**
     * Atualiza registro
     * sem parametros
     * @retorna <json>
     */
    public function atualizar() {
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();
        
        $this->load->model('disciplinas');

        $disciplinas = new Disciplinas();

        $disciplinas->set("idDisciplina", $_POST["id"]);
        $disciplinas->set("nome",         $_POST["nome"]);
        $disciplinas->set("turno",        $_POST["turno"]);
        $disciplinas->set("horaInicial",  $_POST["horaInicial"]);
        $disciplinas->set("horaFinal",    $_POST["horaFinal"]);
        
        if( isset($_POST["idCurso"] )){
            $disciplinas->set("idCurso", $_POST["idCurso"]);
        }else{
            $disciplinas->set("idCurso", 0);
        }

        $disciplinas->atualizar($disciplinas);

        $array = array(
            "sucesso" => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro Atualizado com sucesso!!! ",
            "tipo" => "nSuccess",
            "redirecionar" => true,
            "url" => "disciplina/obterDisciplina"
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
        
        $this->load->model('disciplinas');

        $id = $_POST["id"];
        $disciplinas = new Disciplinas();
        $disciplinas->set("idDisciplina", $id);

        //Verificar aqui o PROFESSOR
        $query = $disciplinas->verificaProfessorDisciplina($disciplinas);
        
        $rows = $query->num_rows();
        if( $rows > 0 )
        {
            $array = array(
                "sucesso"   => false,
                "Mensagem"  => "<strong>Falha na Esclusão: </strong>Existe Registros Relacionados!!! Verifique Professores e suas disciplinas Disciplinas ",
                "tipo"      => "nFailure"
            );
            print_r(json_encode($array));
            return false;
        }

        $disciplinas->deletar($disciplinas);

        $array = array(
            "sucesso" => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro deletado com sucesso!!! ",
            "tipo" => "nSuccess"
        );

        print_r(json_encode($array));
    }

    /**
     * Pesquisa um registro
     * sem parametros
     * @retorna <Template>
     */
    public function pesquisar() {
        if (!$this->access_rule->has_permission(15))
            $this->access_rule->no_access();
        
        $this->load->model('disciplinas');

        //$valor = $_POST["valor"];
        $valor    = $_POST["pesquisa"];
        $disciplinas = new Disciplinas();
        $disciplinas->set("nome", $valor);

        $rows = $disciplinas->pesquisar($disciplinas);

        $data['disciplinas'] = $rows->result();

        $this->load->view('pesquisaDisciplinas', $data);
    }


}

?>