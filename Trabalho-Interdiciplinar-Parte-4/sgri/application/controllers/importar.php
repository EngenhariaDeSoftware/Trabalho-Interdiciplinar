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
class Importar extends CI_Controller {


    public function formularioImportarUsuarios()
    {
        $this->load->model('xmls');
        
        $xml     = new Xmls();
        $rowsXml = $xml -> obterXmls();
        
        $data["xml"] = $rowsXml->result();
        
        $this->load->view('importarUsuarios', $data);
    }
    
    public function formularioImportarEtc()
    {
        $this->load->model('xmls');
        
        $xml     = new Xmls();
        $rowsXml = $xml -> obterXmls();
        
        $data["xml"] = $rowsXml->result();
        
        $this->load->view('importarEtc', $data);
    }
    
    
    public function executarImportacaoEtc(){
        
        if (!$this->access_rule->has_permission(1))
                $this->access_rule->no_access();
        
        $this->load->model('usuarios');
        $this->load->model('pessoas');
        $this->load->model('acessos');
        
        $url_xml = $_FILES["file"]["tmp_name"];
        
        if($xml_content = simplexml_load_file($url_xml)){
            
            $i = 0;
            foreach($xml_content->item as $valor)
            {
                
              
                //Informacao pessoal 1
                $array[$i]["DisciplinasNome"]          = $valor->Disciplinas->Nome;
                $array[$i]["DisciplinasTurno"]         = $valor->Disciplinas->Turno;
                $array[$i]["DisciplinasHoraInicial"]   = $valor->Disciplinas->horaInicial;
                $array[$i]["DisciplinasHoraFinal"]     = $valor->Disciplinas->horaFinal;
                $array[$i]["DisciplinasIdCurso"]       = $valor->Disciplinas->idCurso;

                //Informacao pessoal 2
                $array[$i]["PessoasNome"]  = $valor->Pessoas->Nome;
                $array[$i]["PessoasEmail"] = $valor->Pessoas->Email;

                //Informacao pessoal 3
                $array[$i]["TurmasNome"]  = $valor->Turmas->Nome;
                $array[$i]["TurmasGrupo"] = $valor->Turmas->Grupo;
                
                $array[$i]["SalasPredio"]     = $valor->Salas->Predio;
                $array[$i]["SalasAndar"]      = $valor->Salas->Andar;
                $array[$i]["SalasNumero"]     = $valor->Salas->Numero;
                $array[$i]["SalasTipoSala"]   = $valor->Salas->tipoSala;
                $array[$i]["SalasCapacidade"] = $valor->Salas->Capacidade;

                $i++;
                
            }

            
            //Executar pessoas e pegar idPessoa
            $pessoas   = new Pessoas();
            $arrayPessoa = $pessoas->saveOnXml($array);

            
            //parametro adicional idPessoa
            //$acessos    = new Acessos();
            //$arrayAcesso = $acessos->obterIdAcesso($array);

            
            //parametro adicional idPessoa
            //$usuarios = new Usuarios();
            //$usuarios->importar($array, $arrayPessoa, $arrayAcesso);
         
            echo "Parabens!!! Você importou com sucesso os usuários. Basta Lista-los para verificar";
  

        }else{
            echo "Erro ao Carregar o XML";
        }
    }

    public function executarImportacao(){
        
        if (!$this->access_rule->has_permission(1))
                $this->access_rule->no_access();
        
        $this->load->model('usuarios');
        $this->load->model('pessoas');
        $this->load->model('acessos');
        
        $url_xml = $_FILES["file"]["tmp_name"];
        
        if($xml_content = simplexml_load_file($url_xml)){
            
            $i = 0;
            foreach($xml_content->item as $valor)
            {
                if($valor->InformacaoPessoal->Nome == ""){
                    echo "O XML Está incorreto pois não existe a TAG Nome < Nome > - < / Nome >";
                    return false;
                }
                if($valor->InformacaoPessoal->DataNascimento == ""){
                    echo "O XML Está incorreto pois não existe a TAG DataNascimento < DataNascimento > - < / DataNascimento >";
                    return false;
                }
                if($valor->InformacaoPessoal->dataCadastro == ""){
                    echo "O XML Está incorreto pois não existe a TAG dataCadastro < dataCadastro > - < / dataCadastro >";
                    return false;
                }
                if($valor->InformacaoPessoal->Cpf == ""){
                    echo "O XML Está incorreto pois não existe a TAG Cpf < Cpf > - < / Cpf >";
                    return false;
                }
                /***********************************************/
                if($valor->InformacaoPessoal->Contatos->Telefone == ""){
                    echo "O XML Está incorreto pois não existe a TAG Telefone < Telefone > - < / Telefone >";
                    return false;
                }
                if($valor->InformacaoPessoal->Contatos->celular == ""){
                    echo "O XML Está incorreto pois não existe a TAG celular < celular > - < / celular >";
                    return false;
                }
                if($valor->InformacaoPessoal->Contatos->Email == ""){
                    echo "O XML Está incorreto pois não existe a TAG Email < Email > - < / Email >";
                    return false;
                }
                /***********************************************/
                if($valor->InformacaoPessoal->Contatos->Morada->Cep == ""){
                    echo "O XML Está incorreto pois não existe a TAG Cep < Cep > - < / Cep >";
                    return false;
                }
                if($valor->InformacaoPessoal->Contatos->Morada->Cidade == ""){
                    echo "O XML Está incorreto pois não existe a TAG Cidade < Cidade > - < / Cidade >";
                    return false;
                }
                if($valor->InformacaoPessoal->Contatos->Morada->Estado == ""){
                    echo "O XML Está incorreto pois não existe a TAG Estado < Estado > - < / Estado >";
                    return false;
                }
                if($valor->InformacaoPessoal->Contatos->Morada->Bairro == ""){
                    echo "O XML Está incorreto pois não existe a TAG Bairro < Bairro > - < / Bairro >";
                    return false;
                }
                if($valor->InformacaoPessoal->Contatos->Morada->Endereco == ""){
                    echo "O XML Está incorreto pois não existe a TAG Endereco < Endereco > - < / Endereco >";
                    return false;
                }
              
                //Informacao pessoal 1
                $array[$i]["Nome"]           = $valor->InformacaoPessoal->Nome;
                $array[$i]["DataNascimento"] = $valor->InformacaoPessoal->DataNascimento;
                $array[$i]["dataCadastro"]   = $valor->InformacaoPessoal->dataCadastro;
                $array[$i]["Cpf"]            = $valor->InformacaoPessoal->Cpf;

                //Informacao pessoal 2
                $array[$i]["Telefone"]   = $valor->InformacaoPessoal->Contatos->Telefone;
                $array[$i]["celular"]    = $valor->InformacaoPessoal->Contatos->celular;
                $array[$i]["Email"]      = $valor->InformacaoPessoal->Contatos->Email;

                //Informacao pessoal 3
                $array[$i]["Cep"]        = $valor->InformacaoPessoal->Contatos->Morada->Cep;
                $array[$i]["Cidade"]     = $valor->InformacaoPessoal->Contatos->Morada->Cidade;
                $array[$i]["Estado"]     = $valor->InformacaoPessoal->Contatos->Morada->Estado;
                $array[$i]["Bairro"]     = $valor->InformacaoPessoal->Contatos->Morada->Bairro;
                $array[$i]["Endereco"]   = $valor->InformacaoPessoal->Contatos->Morada->Endereco;

                $i++;
                
            }

            
            //Executar pessoas e pegar idPessoa
            $pessoas   = new Pessoas();
            $arrayPessoa = $pessoas->importar($array);

            
            //parametro adicional idPessoa
            //$acessos    = new Acessos();
            //$arrayAcesso = $acessos->obterIdAcesso($array);

            
            //parametro adicional idPessoa
            //$usuarios = new Usuarios();
            //$usuarios->importar($array, $arrayPessoa, $arrayAcesso);
         
            echo "Parabens!!! Você importou com sucesso os usuários. Basta Lista-los para verificar";
  

        }else{
            echo "Erro ao Carregar o XML";
        }
    }
}

?>