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
class Xml extends CI_Controller {


    /**
    * Apresenta o formulario para cadastro
    * sem parametros
    * @retorna <array + template>
    */
    public function formularioPessoaXml() {
        if (!$this->access_rule->has_permission(4))
            $this->access_rule->no_access();
        
        $this->load->model('acessos');

        $acessos = new Acessos();
        //$rows    = $acessos->obterAcessosProfessores();
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
        
        $this->load->view('cadastroPessoasXml', $data);
    }
    
    /**
    * Apresenta o formulario para cadastro
    * sem parametros
    * @retorna <array + template>
    */
    public function salvar() {
        if (!$this->access_rule->has_permission(4))
            $this->access_rule->no_access();
        
        $nomeArquivo = md5(rand(0, 99999));
        $fp = fopen("theme/xml/".$nomeArquivo.".xml", "a");
        
        // Escreve "exemplo de escrita" no bloco1.txt
        $escreve = fwrite($fp, '<?xml version="1.0" encoding="UTF-8"?>');
        $escreve = fwrite($fp, '<Pessoas>');
        $escreve = fwrite($fp, '<item>');
        $escreve = fwrite($fp, '<InformacaoPessoal>');
        $escreve = fwrite($fp, '<Nome>'.$_POST["nome"].'</Nome>');
        $escreve = fwrite($fp, '<DataNascimento>'.$_POST["dataNacimento"].'</DataNascimento>');
        $escreve = fwrite($fp, '<dataCadastro>'.date("d/m/Y").'</dataCadastro>');
        $escreve = fwrite($fp, '<Cpf>'.$_POST["cpf"].'</Cpf>');
        $escreve = fwrite($fp, '<Contatos>');
        $escreve = fwrite($fp, '<Telefone>'.$_POST["telefone"].'</Telefone>');
        $escreve = fwrite($fp, '<celular>'.$_POST["celular"].'</celular>');
        $escreve = fwrite($fp, '<Email>'.$_POST["email"].'</Email>');
        $escreve = fwrite($fp, '<Morada>');
        $escreve = fwrite($fp, '<Cep>'.$_POST["cep"].'</Cep>');
        $escreve = fwrite($fp, '<Cidade>'.$_POST["cidade"].'</Cidade>');
        $escreve = fwrite($fp, '<Estado>'.$_POST["estado"].'</Estado>');
        $escreve = fwrite($fp, '<Bairro>'.$_POST["bairro"].'</Bairro>');
        $escreve = fwrite($fp, '<Endereco>'.$_POST["endereco"].'</Endereco>');
        $escreve = fwrite($fp, '</Morada>');
        $escreve = fwrite($fp, '</Contatos>');
        $escreve = fwrite($fp, '</InformacaoPessoal>');
        $escreve = fwrite($fp, '<Usuarios>');
        $escreve = fwrite($fp, '<Usuario>'.$_POST["usuario"].'</Usuario>');
        $escreve = fwrite($fp, '<Senha>'.$_POST["senha"].'</Senha>');
        $escreve = fwrite($fp, '</Usuarios>');
        $escreve = fwrite($fp, '<Acesso>');
        $escreve = fwrite($fp, '<Nome>'.$_POST["idAcesso"].'</Nome>');
        $escreve = fwrite($fp, '</Acesso>');
        $escreve = fwrite($fp, '</item>');
        $escreve = fwrite($fp, '</Pessoas>');

       $this->load->model('xmls');
       $xml = new Xmls();
       $xml->set('url', $nomeArquivo.".xml");
       $xml->inserir($xml);
       
       //nWarning  nSuccess nFailure
        $array = array(
            "sucesso"  => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro Cadastrado com sucesso!!! ",
            "tipo"     => "nSuccess",
            "redirecionar" => true,
            "url"          => "xml/formularioPessoaXml"
        );

        print_r(json_encode($array));
   
    }
    
    

}

?>