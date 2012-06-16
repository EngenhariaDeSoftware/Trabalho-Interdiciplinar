<?php
//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');

/**
* Classe: Pessoa
* Finalidade: Registra, altera, lista, atualiza dados de pessoas e usuarios
* Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
* Data de Criação: 17/03/2012
*/
class Pessoa extends CI_Controller {


    /**
    * Apresenta o formulario para cadastro
    * sem parametros
    * @retorna <array + template>
    */
    public function formularioPessoa() {
        if (!$this->access_rule->has_permission(14))
            $this->access_rule->no_access();
        
        $this->load->model('acessos');

        $acessos = new Acessos();
        $rows    = $acessos->obterAcessos();

        $data['acessos'] = $rows->result();

        if ( isset($_POST["id"]) ) {
            $this->load->model('pessoas');

            $id      = $_POST["id"];
            $pessoas = new Pessoas();
            
            $pessoas->set("idPessoa", $id);
            
            $rows            = $pessoas->obterPorPessoas($pessoas);
            $data['pessoas'] = $rows->result();
            
            $this->load->view('editarPessoas', $data);
            return false;
        }
        
        $this->load->view('cadastroPessoas', $data);
    }

    
    /**
    * Obtem pessoas
    * sem parametros
    * @retorna <array + template>
    */
    public function obterPessoaXml() {
        if (!$this->access_rule->has_permission(14))
            $this->access_rule->no_access();
        
        $this->load->model('pessoas');

        $pessoas = new Pessoas();
        $rows    = $pessoas->obterPessoasXml();

        $data['pessoas'] = $rows->result();

        $this->load->view('listarPessoasXml', $data);
    }
    
    /**
    * Obtem pessoas
    * sem parametros
    * @retorna <array + template>
    */
    public function formAddUsuario() {
        if (!$this->access_rule->has_permission(14))
            $this->access_rule->no_access();
        
        $this->load->model('acessos');
        $acessos = new Acessos();
        $rows    = $acessos->obterAcessos();
        
        $data['acessos'] = $rows->result();
        
        $senha = rand(0, 1000)."puc".rand(0, 59874);
        
        $data["id"] = $_POST["id"];
        $data["senha"] = $senha;

        $this->load->view('cadastroPessoasXml', $data);
    }
    
     /**
    * Obtem pessoas
    * sem parametros
    * @retorna <array + template>
    */
    public function obterPessoa() {
        if (!$this->access_rule->has_permission(14))
            $this->access_rule->no_access();
        
        $this->load->model('pessoas');

        $pessoas = new Pessoas();
        $rows    = $pessoas->obterPessoas();

        $data['pessoas'] = $rows->result();

        $this->load->view('listarPessoas', $data);
    }

    //excluir essa funcao depois de adaptar ao formularioPessoa
    /*public function cadastroPessoa() {
        $this->load->model('acessos');

        $acessos = new Acessos();
        $rows = $acessos->obterAcessos();

        $data['acessos'] = $rows->result();
        $this->load->view('cadastroPessoas', $data);
    }*/
    //excluir essa funcao depois de adaptar ao formularioPessoa

    /**
    * Salva um registro
    * sem parametros
    * @retorna <Funcao>
    */
    public function salvar() {
        if (!$this->access_rule->has_permission(14))
            $this->access_rule->no_access();
        
        $this->load->model('pessoas');

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
        if (!$this->access_rule->has_permission(14))
            $this->access_rule->no_access();
        
        if ( 
            $_POST["nome"] == ""    || 
            $_POST["email"] == ""   || 
            $_POST["cidade"] == ""  || 
            $_POST["usuario"] == "" || 
            $_POST["senha"] == ""   || 
            $_POST["idAcesso"] == "" 
           ) 
        {
            $array = array(
                "sucesso"  => false,
                "Mensagem" => "<strong>Impossivel: </strong>Campos como Nome, Email, Cidade, Acesso,Usuario e Senha nao podem estar em brancos ",
                "tipo"     => "nFailure"
            );
            
            print_r(json_encode($array));
            return false;
        }

        $this->load->model('usuarios');
        
        $usuarios = new Usuarios();
        $pessoas  = new Pessoas();
        
        $dataCadastro = date("Y-m-d H:i:s");
        
        $pessoas->set("nome",          $_POST["nome"]);
        $pessoas->set("email",         $_POST["email"]);
        $pessoas->set("telefone",      $_POST["telefone"]);
        $pessoas->set("celular",       $_POST["celular"]);
        $pessoas->set("cpf",           $_POST["cpf"]);
        $pessoas->set("dataNacimento", $_POST["dataNacimento"]);
        $pessoas->set("cep",           $_POST["cep"]);
        $pessoas->set("cidade",        $_POST["cidade"]);
        $pessoas->set("bairro",        $_POST["bairro"]);
        $pessoas->set("endereco",      $_POST["endereco"]);
        $pessoas->set("dataCadastro",  $dataCadastro);

        $verdade = $pessoas->verificaEmailExiste($pessoas, $_POST["usuario"]);

        if (!$verdade) {
            $array = array(
                "sucesso"  => false,
                "Mensagem" => "<strong>Impossivel: </strong>Registro ja existe!!! EMAIL ou USUARIO ",
                "tipo"     => "nFailure"
            );

            print_r(json_encode($array));
            return false;
        }
        
        $resultado = $pessoas->inserir($pessoas);
        
        /* Inserindo usuarios */
        foreach ( $resultado->result() as $valor ) {
            $_POST["idPessoa"] = $valor->idPessoa;
        }
        
        $usuarios->set("usuario",  $_POST["usuario"]);
        $usuarios->set("senha",    $_POST["senha"]);
        $usuarios->set("idPessoa", $_POST["idPessoa"]);
        $usuarios->set("idAcesso", $_POST["idAcesso"]);
        
        $usuarios->inserir($usuarios);

        //nWarning  nSuccess nFailure
        $array = array(
            "sucesso"  => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro Cadastrado com sucesso!!! ",
            "tipo"     => "nSuccess",
            "redirecionar" => true,
            "url"          => "pessoa/formularioPessoa"
        );

        print_r(json_encode($array));
    }

    /**
    * Atualiza registros
    * sem parametros
    * @retorna <json>
    */
    public function atualizar() {
        if (!$this->access_rule->has_permission(14))
            $this->access_rule->no_access();
        

        $this->load->model('usuarios');
        $this->load->model('pessoas');

        $pessoas = new Pessoas();
        
        $pessoas->set("idPessoa",      $_POST["id"]);
        $pessoas->set("nome",          $_POST["nome"]);
        $pessoas->set("email",         $_POST["email"]);
        $pessoas->set("telefone",      $_POST["telefone"]);
        $pessoas->set("celular",       $_POST["celular"]);
        $pessoas->set("cpf",           $_POST["cpf"]);
        $pessoas->set("dataNacimento", $_POST["dataNacimento"]);
        $pessoas->set("cep",           $_POST["cep"]);
        $pessoas->set("cidade",        $_POST["cidade"]);
        $pessoas->set("bairro",        $_POST["bairro"]);
        $pessoas->set("endereco",      $_POST["endereco"]);
        
        $pessoas->atualizar($pessoas);
        
        //Inserindo usuarios
        $usuarios = new Usuarios();
        if( $_POST["senha"] != "" ){
            $usuarios->set("senha",    $_POST["senha"]);
        }else{
            $usuarios->set("senha",    "0");
        }
        $usuarios->set("usuario",  $_POST["usuario"]);
        $usuarios->set("idPessoa", $_POST["id"]);
        $usuarios->set("idAcesso", $_POST["idAcesso"]);
        
        $usuarios->atualizar($usuarios);

        $array = array(
            "sucesso"      => true,
            "Mensagem"     => "<strong>Sucesso: </strong>Registro Atualizado com sucesso!!! ",
            "tipo"         => "nSuccess",
            "redirecionar" => true,
            "url"          => "pessoa/obterPessoa"
        );

        print_r(json_encode($array));
    }

    /**
    * Detalha uma pessoa
    * sem parametros
    * @retorna <array + template>
    */
    public function detalhe() {
        if (!$this->access_rule->has_permission(14))
            $this->access_rule->no_access();
        
        $this->load->model('pessoas');
        
        $id      = $_POST["id"];
        $pessoas = new Pessoas();
        $pessoas->set("idPessoa", $id);
        
        $rows            = $pessoas->detalhe($pessoas);
        $data['pessoas'] = $rows->result();
        
        $this->load->view('detalhePessoas', $data);
    }

    /**
    * Deleta um Registro
    * sem parametros
    * @retorna <json>
    */
    public function deletar() {
        if (!$this->access_rule->has_permission(14))
            $this->access_rule->no_access();
        
        //deletar usuario
        $this->load->model('usuarios');
        
        $id       = $_POST["id"];
        $usuarios = new Usuarios();
        
        $usuarios->set("idPessoa", $id);
        $usuarios->deletar($usuarios);

        //deletar pessoa
        $this->load->model('pessoas');
        
        $pessoas = new Pessoas();
        
        $pessoas->set("idPessoa", $id);
        $pessoas->deletar($pessoas);

        $array = array(
            "sucesso"  => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro Cadastrado com sucesso!!! ",
            "tipo"     => "nSuccess"
        );

        print_r(json_encode($array));
    }

    /**
    * Pesquisa um registro
    * sem parametros
    * @retorna <array + template>
    */
    public function pesquisar() {        
        if (!$this->access_rule->has_permission(14))
            $this->access_rule->no_access();
        
        $this->load->model('pessoas');
        
        $valor   = $_POST["pesquisa"];
        $opcao   = $_POST["opcao"];
        $pessoas = new Pessoas();
        
        $pessoas->set("nome",  $valor);
        $pessoas->set("opcao", $opcao);
        
        $rows            = $pessoas->pesquisar($pessoas);
        $data['pessoas'] = $rows->result();

        $this->load->view('pesquisaPessoas', $data);
    }

}

?>