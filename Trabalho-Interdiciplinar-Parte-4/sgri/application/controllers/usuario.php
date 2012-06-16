<?php

//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');

/**
 * Classe: Usuario
 * Finalidade: Sem aplicação
 * Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
 * Data de Criação: 17/03/2012
 */
class Usuario extends CI_Controller {


    public function sair() {
        echo "<script>window.location.href='../../'</script>";
    }
    
    public function salvarUsuarioXml(){

        $this->load->model('usuarios');
        $usuarios = new Usuarios();
        $usuarios->set("usuario",   $_POST["usuario"]);
        $usuarios->set("senha",     $_POST["senha"]);
        $usuarios->set("idPessoa",  $_POST["idPessoa"]);
        $usuarios->set("idAcesso",  $_POST["idAcesso"]);
        $usuarios->inserir($usuarios);
        
        //nWarning  nSuccess nFailure
        $array = array(
            "sucesso"  => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro Cadastrado com sucesso!!! ",
            "tipo"     => "nSuccess",
            "redirecionar" => true,
            "url"          => "pessoa/obterPessoaXml"
        );

        print_r(json_encode($array));
    }

}

?>