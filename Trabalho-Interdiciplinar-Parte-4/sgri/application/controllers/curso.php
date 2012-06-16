<?php

//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');

/**
 * Classe: Curso
 * Finalidade: Cadastro de Cursos
 * Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
 * Data de Criação: 17/03/2012
 */
class Curso extends CI_Controller {

    function index() {
        
    }

    /**
     * Formulario de Equipamento
     * sem parametros
     * @retorna <Formulario>
     */
    public function formularioCurso() {
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();
        
        if ( isset($_POST["id"]) ) {
            $this->load->model('cursos');

            $id     = $_POST["id"];
            $cursos = new Cursos();
            
            $cursos->set("idCurso", $id);
            
            $rows = $cursos->obterPorCursos($cursos);
            
            $data['cursos'] = $rows->result();
            $this->load->view('editarCursos', $data);
            return false;
        }

        $this->load->view('cadastroCursos');
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
        
        if ( $_POST["nome"] == "" ) {
            $array = array(
                "sucesso"  => false,
                "Mensagem" => "<strong>Impossivel: </strong>Campo Nome precisa ser preenchido.",
                "tipo"     => "nFailure"
            );

            print_r(json_encode($array));
            return false;
        }

        $this->load->model('cursos');
        $cursos = new Cursos();
        
        $cursos->set("nome", $_POST["nome"]);
        $verdade = $cursos->verificaNomeCursos($cursos);

        if (!$verdade) {
            $array = array(
                "sucesso"  => false,
                "Mensagem" => "<strong>Impossivel: </strong>Ja existe um curso com esse nome!!! ",
                "tipo"     => "nFailure"
            );
            print_r(json_encode($array));
            return false;
        }

        $resultado = $cursos->inserir($cursos);

        $array = array(
            "sucesso"  => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro Cadastrado com sucesso!!! ",
            "tipo"     => "nSuccess",
            "redirecionar" => true,
            "url"          => "curso/formularioCurso"
        );

        print_r(json_encode($array));
    }

    /**
     * Obtem um equipamento
     * sem parametros
     * @retorna <Template>
     */
    public function obterCurso() {
        if (!$this->access_rule->has_permission(15))
            $this->access_rule->no_access();
        
        $this->load->model('cursos');

        $cursos = new Cursos();
        $rows   = $cursos->obterCursos();

        $data['cursos'] = $rows->result();

        $this->load->view('listarCursos', $data);
    }

    /**
     * Atualiza registro
     * sem parametros
     * @retorna <json>
     */
    public function atualizar() {
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();
        
        $this->load->model('cursos');

        $cursos = new Cursos();
        
        $cursos->set("idCurso", $_POST["id"]);
        $cursos->set("nome",    $_POST["nome"]);
        
        $cursos->atualizar($cursos);

        $array = array(
            "sucesso"      => true,
            "Mensagem"     => "<strong>Sucesso: </strong>Registro Atualizado com sucesso!!! ",
            "tipo"         => "nSuccess",
            "redirecionar" => true,
            "url"          => "curso/obterCurso"
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
        
        $this->load->model('cursos');
        
        $id     = $_POST["id"];
        $cursos = new Cursos();
        $cursos->set("idCurso", $id);
        
        $query = $cursos->verificaFkRegistros($cursos);

        if($query->num_rows() >= 1)
        {
            $array = array(
                "sucesso"   => false,
                "Mensagem"  => "<strong>Sucesso: </strong>Existe Registros Relacionados!!! ",
                "tipo"      => "nFailure"
            );

            print_r(json_encode($array));
            return false;
        }

        $cursos->deletar($cursos);

        $array = array(
            "sucesso"   => true,
            "Mensagem"  => "<strong>Sucesso: </strong>Registro deletado com sucesso!!! ",
            "tipo"      => "nSuccess"
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
        
        $this->load->model('cursos');
        
        //$valor  = $_POST["valor"];
        $valor    = $_POST["pesquisa"];
        
        $cursos = new Cursos();
        $cursos->set("nome", $valor);
        
        $rows         = $cursos->pesquisar($cursos);

        $data['cursos'] = $rows->result();

        $this->load->view('pesquisaCursos', $data);
    }

}

?>