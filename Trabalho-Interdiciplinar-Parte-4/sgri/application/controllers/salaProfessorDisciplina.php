<?php
//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');

/**
* Classe: SalaProfessorDisciplina
* Finalidade: Nao utilizada ainda
* Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
* Data de Criação: 17/03/2012
*/
class salaProfessorDisciplina extends CI_Controller {


    
    public function formularioSalaProfessorDisciplina()
    {
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();
        
        $this->load->model('salas');
        $this->load->model('pessoas');
        $this->load->model('disciplinas');
        
        $pessoas       = new Pessoas();
        $rowsProfessor = $pessoas -> obterProfessor();
        
        $salas     = new Salas();
        $rowsSalas = $salas->obterSalas();
        
        $data["professores"] = $rowsProfessor->result();
        $data["salas"]       = $rowsSalas->result();

        if ( isset($_POST["id"]) ) {
            $id = $_POST["id"];
            $this->load->model('salasprofessoresdisciplinas');
            
            $salasProDis = new salasProfessoresDisciplinas();
            $salasProDis->set("idSalaProfessorDisciplina", $id);
            
            $rows = $salasProDis->obterPorSalasProfessoresDisciplinas($salasProDis);
            
            $data["datas"] = $rows->result();
            
            $this->load->view('editarSalasProfessoresDisciplinas', $data);
            return false;
            
        }
        
        
        
        
        $this->load->view('cadastroSalasProfessoresDisciplinas', $data);
    }
    
    
    public function salvar()
    {
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();

        if ( isset($_POST["id"]) ) {
            $this->atualizar($_POST["id"], $_POST);
        } else {
            $this->inserir();
        }
    }
    
    public function inserir()
    {
        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();
        
        $this->load->model('salasProfessoresDisciplinas');
        
        if( !isset($_POST["idDisciplina"]) || !isset($_POST["idPessoa"]) )
        {
            $array = array(
                "sucesso"  => false,
                "Mensagem" => "<strong>Falha: </strong> Selecione os registros necessários",
                "tipo"     => "nFailure"
            );

            print_r(json_encode($array));
            return false;
        }
        
        
        $salasProfessoresDisciplinas = new salasProfessoresDisciplinas();
        
        $salasProfessoresDisciplinas->set("idSala",       $_POST["idSala"]);
        $salasProfessoresDisciplinas->set("idPessoa",     $_POST["idPessoa"]);
        $salasProfessoresDisciplinas->set("idDisciplina", $_POST["idDisciplina"]);
        
        $resultado = $salasProfessoresDisciplinas->verificaRegistros($salasProfessoresDisciplinas);
        
        if ($resultado) {
            $array = array(
                "sucesso"  => false,
                "Mensagem" => "<strong>Impossivel: </strong>Ja existe esse Registro",
                "tipo"     => "nFailure"
            );

            print_r(json_encode($array));
            return false;
        }
        
        $salasProfessoresDisciplinas->inserir($salasProfessoresDisciplinas);
        
        $array = array(
            "sucesso"      => true,
            "Mensagem"     => "<strong>Sucesso: </strong>Registro Cadastrado com sucesso!!! ",
            "tipo"         => "nSuccess",
            "redirecionar" => true,
            "url"          => "salaProfessorDisciplina/formularioSalaProfessorDisciplina"
        );

        print_r(json_encode($array));
      
    }
    
    public function obterSalaProfessorDisciplina()
    {
        if (!$this->access_rule->has_permission(15))
            $this->access_rule->no_access();
        
        $this->load->model('salasprofessoresdisciplinas');
        
        $salasProfessoresDisciplinas = new salasProfessoresDisciplinas();
        $rows = $salasProfessoresDisciplinas -> obterSalasProfessoresDisciplinas();
        
        $data["datas"] = $rows->result();
        $this->load->view('listarSalasProfessoresDisciplinas', $data);
    }
    
    /**
     * Atualiza registro
     * sem parametros
     * @retorna <json>
     */
    public function atualizar() {

        if (!$this->access_rule->has_permission(5))
            $this->access_rule->no_access();
        
        
        if( !isset($_POST["idDisciplina"]) )
        {
            $array = array(
                "sucesso"  => false,
                "Mensagem" => "<strong>Impossivel: </strong>Existem campos em branco ",
                "tipo"     => "nFailure"
            );
            
            print_r(json_encode($array));
            return false;
        }
        
        
        $this->load->model('salasprofessoresdisciplinas');
        
        $salasProfessoresDisciplinas = new salasProfessoresDisciplinas();

        $salasProfessoresDisciplinas->set("idPessoa",                  $_POST["idPessoa"]);
        $salasProfessoresDisciplinas->set("idSala",                    $_POST["idSala"]);
        $salasProfessoresDisciplinas->set("idDisciplina",              $_POST["idDisciplina"]);
        $salasProfessoresDisciplinas->set("idSalaProfessorDisciplina", $_POST["id"]);

        $salasProfessoresDisciplinas->atualizar($salasProfessoresDisciplinas);

        $array = array(
            "sucesso" => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro Atualizado com sucesso!!! ",
            "tipo" => "nSuccess",
            "redirecionar" => true,
            "url" => "salaProfessorDisciplina/obterSalaProfessorDisciplina"
        );

        print_r(json_encode($array));
    }
    
    public function obterHorarioDisciplina(){
        
        $this->load->model('salasprofessoresdisciplinas');
        $salaProfDis = new salasprofessoresdisciplinas();
        $result = $salaProfDis->obterHorariosDisciplinas($_POST);
        
        if( $result->num_rows() > 1 )
        {
            $i = 0;
            foreach($result->result() as $valor){
                $idsDisciplina[$i] = $valor->idDisciplina;
                $i++;
            }
            $array = array(
                "sucesso" => true,
                "Mensagem" => "<strong>Atenção: </strong><h5>Verificamos que vc leciona mais de 1 Disciplina nesta sala</h5><br /> <h6>Selecione O Horário da Disciplina!!! </h6>",
                "temMaisDoisRegistro" => true,
                "idsDisciplina" => $idsDisciplina,
                "url"          => "salaProfessorDisciplina/selecionaHorarioDisciplina"
            );
            

        } else {
            foreach($result->result() as $valor){
                $horaInicial = $valor->horaInicial;
            }
            $array = array(
                "sucesso" => true,
                "temMaisDoisRegistro" => false,
                "horaInicial" => $horaInicial
            );
        }
        print_r(json_encode($array));
    }

    public function selecionaHorarioDisciplina()
    {

        $this->load->model('disciplinas');
        $disciplinas     = new Disciplinas();
        $rowsDisciplinas = $disciplinas->obterDisciplinasPorIds($_POST);
        
        $data["disciplinas"] = $rowsDisciplinas;
        $this->load->view('selecionarHorariosDisciplinas', $data);
    }

}

?>