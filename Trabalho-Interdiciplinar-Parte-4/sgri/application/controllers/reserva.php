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
class Reserva extends CI_Controller {

    function index() {
        
    }
    
    
    /**
     * Obtem um equipamento
     * sem parametros
     * @retorna <Template>
     */
    public function obterReservaAll($status) {


        $idPessoa = $this->session->userdata('idPessoa');

        $this->load->model('reservas');

        $reservas = new Reservas();
        $reservas->set("idPessoa", $idPessoa);
        $rowsReservas = $reservas->obterReservaAlls($reservas, $status);

        $data["reservas"] = $rowsReservas->result();

        $this->load->view('listarReservasPassadas', $data);
    }

    public function detalheEquipamentoInfra() {


        $id = $_POST["id"];
        $this->load->model('reservas');

        $reservas = new Reservas();
        $reservas->set("idReserva", $id);

        $rowsReservas = $reservas->detalhesEquipamentosInfra($reservas);

        $data["reservas"] = $rowsReservas->result();
        $this->load->view('detalheEquipamentoReserva', $data);
    }

    public function detalheEquipamento() {


        $idPessoa = $this->session->userdata('idPessoa');
        $id = $_POST["id"];
        $this->load->model('reservas');

        $reservas = new Reservas();
        $reservas->set("idReserva", $id);
        $reservas->set("idPessoa", $idPessoa);

        $rowsReservas = $reservas->detalhesEquipamentos($reservas);

        $data["reservas"] = $rowsReservas->result();
        $this->load->view('detalheEquipamentoReserva', $data);
    }

    /**
     * Formulario de Equipamento
     * sem parametros
     * @retorna <Formulario>
     */
    public function formularioReserva() {
        if (!$this->access_rule->has_permission(3))
            $this->access_rule->no_access();

        $idPessoa = $this->session->userdata('idPessoa');

        //turmas
        $this->load->model('turmas');
        $turmas = new Turmas();
        $turmas->set("idPessoa", $idPessoa);
        $rowsTurmas = $turmas->obterTurmasProfessor($turmas);
        $data["turmas"] = $rowsTurmas->result();

        //sala professor disciplina
        $this->load->model('salasprofessoresdisciplinas');
        $salasProfDis = new salasprofessoresdisciplinas();
        $salasProfDis->set("idPessoa", $idPessoa);
        $rowsSalasProfDis = $salasProfDis->obterSalasProfessores($salasProfDis);
        $data["salas"] = $rowsSalasProfDis->result();

        //Equipamntos sem manutencao
        $this->load->model('equipamentos');
        $equipamentos = new Equipamentos();
        $rowsEquipamentos = $equipamentos->obterEquipamentosDisponiveis();
        $data["equipamentos"] = $rowsEquipamentos->result();


        if (isset($_POST["id"])) {
            /*
              $this->load->model('reservas');

              $id           = $_POST["id"];
              $equipamentos = new Equipamentos();

              $equipamentos->set("idEquipamento", $id);

              $rows = $equipamentos->obterPorEquipamentos($equipamentos);

              $data['equipamentos'] = $rows->result();
              $this->load->view('editarEquipamentos', $data);
              return false; */
        }

        $this->load->view('cadastroReservas', $data);
    }

    /**
     * Salva registro
     * sem parametros
     * @retorna <Nada>
     */
    public function salvar() {
        if (!$this->access_rule->has_permission(3))
            $this->access_rule->no_access();

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
        if (!$this->access_rule->has_permission(3))
            $this->access_rule->no_access();

        if (!isset($_POST["idEquipamento"])) {
            $array = array(
                "sucesso" => false,
                "Mensagem" => "<strong>Atenção: </strong>você precisa selecionar pelo menos 1 equipamento.",
                "tipo" => "nFailure"
            );

            print_r(json_encode($array));
            return false;
        }
        if ($_POST["idTurma"] == "" || $_POST["idSala"] == "" || $_POST["data"] == "" || $_POST["hora"] == "") {
            $array = array(
                "sucesso" => false,
                "Mensagem" => "<strong>Atenção: </strong>alguns campos nao foram preenchidos.",
                "tipo" => "nFailure"
            );

            print_r(json_encode($array));
            return false;
        }
        $this->load->model('reservas');
        $reservas = new Reservas();
        $idPessoa = $this->session->userdata('idPessoa');

        /* verificar se existe ja essa reserva com esse equipamento */
        $reservas->set("idEquipamento", $_POST["idEquipamento"]);
        $reservas->set("idTurma", $_POST["idTurma"]);
        $reservas->set("idSala", $_POST["idSala"]);
        $reservas->set("data", $_POST["data"]);
        $reservas->set("hora", $_POST["hora"]);
        $rowsReservas = $reservas->checarReservaExiste($reservas);


        if (isset($rowsReservas["num_rows"])) {
            if ($rowsReservas["num_rows"]) {
                $equip = "";
                foreach ($rowsReservas as $valor) {
                    $equip .= " | " . $valor['nome'] . " | <br />";
                }

                $array = array(
                    "sucesso" => false,
                    "Mensagem" => "<strong>Não foi possivel: </strong>
                        Existe reservas ja feitas para esses equipamentos nessa data e hora." . $equip,
                    "tipo" => "nFailure"
                );
                print_r(json_encode($array));
                return false;
            }
        }
        /* verificar se existe ja essa reserva com esse equipamento */



        //Se OK GRAVAR

        $reservas->set("idPessoa", $idPessoa);
        $reservas->set("idTurma", $_POST["idTurma"]);
        $reservas->set("idSala", $_POST["idSala"]);
        $reservas->set("data", $_POST["data"]);
        $reservas->set("hora", $_POST["hora"]);
        $reservas->set("obs", $_POST["obs"]);
        $reservas->set("status", 0);

        $reservas->inserir($reservas);
        $rowsIdRe = $reservas->obterIdReserva();

        foreach ($rowsIdRe->result() as $valor) {
            $idReserva = $valor->idReserva;
        }

        $this->load->model('reservasequipamentos');

        $reservasEquip = new reservasequipamentos();
        $reservasEquip->set("idEquipamento", $_POST["idEquipamento"]);
        $reservasEquip->set("idReserva", $idReserva);

        $reservasEquip->inserir($reservasEquip);

        $array = array(
            "sucesso" => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro Cadastrado com sucesso!!! ",
            "tipo" => "nSuccess"
        );

        print_r(json_encode($array));
    }

    /**
     * Obtem um equipamento
     * sem parametros
     * @retorna <Template>
     */
    public function obterReserva() {

        if (!$this->access_rule->has_permission(3))
            $this->access_rule->no_access();

        $idPessoa = $this->session->userdata('idPessoa');

        $this->load->model('reservas');

        $reservas = new Reservas();
        $reservas->set("idPessoa", $idPessoa);
        $rowsReservas = $reservas->obterReservasAtuais($reservas);

        $data["reservas"] = $rowsReservas->result();

        $this->load->view('listarReservas', $data);
    }

    /**
     * Obtem um equipamento
     * sem parametros
     * @retorna <Template>
     */
    public function obterReservaPassadas() {

        if (!$this->access_rule->has_permission(3))
            $this->access_rule->no_access();

        $idPessoa = $this->session->userdata('idPessoa');

        $this->load->model('reservas');

        $reservas = new Reservas();
        $reservas->set("idPessoa", $idPessoa);
        $rowsReservas = $reservas->obterReservasPassadas($reservas);

        $data["reservas"] = $rowsReservas->result();

        $this->load->view('listarReservasPassadas', $data);
    }

    /**
     * Obtem um equipamento
     * sem parametros
     * @retorna <Template>
     */
    public function obterReservaCanceladas() {

        if (!$this->access_rule->has_permission(3))
            $this->access_rule->no_access();

        $idPessoa = $this->session->userdata('idPessoa');

        $this->load->model('reservas');

        $reservas = new Reservas();
        $reservas->set("idPessoa", $idPessoa);
        $rowsReservas = $reservas->obterReservaCanceladas($reservas);

        $data["reservas"] = $rowsReservas->result();

        $this->load->view('listarReservasCanceladas', $data);
    }

    /**
     * Deleta um registro
     * sem parametros
     * @retorna <json>
     */
    public function cancelar() {
        if (!$this->access_rule->has_permission(3))
            $this->access_rule->no_access();

        $this->load->model('reservas');

        $id = $_POST["id"];
        $idPessoa = $this->session->userdata('idPessoa');

        $reservas = new Reservas();
        $reservas->set("idReserva", $id);
        $reservas->set("idPessoa", $idPessoa);

        $reservas->cancelar($reservas);

        $array = array(
            "sucesso" => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro Cancelado com sucesso!!! ",
            "tipo" => "nSuccess"
        );

        print_r(json_encode($array));
    }

    /**
     * Detalha um registro
     * sem parametros
     * @retorna <Template>
     */
    public function detalhe() {
        if (!$this->access_rule->has_permission(3))
            $this->access_rule->no_access();

        $this->load->model('reservas');

        $id = $_POST["id"];
        $idPessoa = $this->session->userdata('idPessoa');

        $reservas = new Reservas();
        $reservas->set("idReserva", $id);
        $reservas->set("idPessoa", $idPessoa);

        $rowsReservas = $reservas->detalhe($reservas);
        $data["reservas"] = $rowsReservas->result();

        $this->load->view('detalheReservas', $data);
    }

    /**
     * Pesquisa um registro
     * sem parametros
     * @retorna <Template>
     */
    public function pesquisar() {

        if (!$this->access_rule->has_permission(3))
            $this->access_rule->no_access();

        $this->load->model('reservas');

        $idPessoa = $this->session->userdata('idPessoa');

        $reservas = new Reservas();
        $reservas->set("pesquisa", $_POST["pesquisa"]);
        $reservas->set("dataInicial", $_POST["dataInicial"]);
        $reservas->set("dataFinal", $_POST["dataFinal"]);
        $reservas->set("hora", $_POST["hora"]);
        $reservas->set("idPessoa", $idPessoa);

        $rowsReservas = $reservas->pesquisar($reservas);

        $data["reservas"] = $rowsReservas->result();

        $this->load->view('pesquisaReservas', $data);
    }

    /**
     * Pesquisa um registro
     * sem parametros
     * @retorna <Template>
     */
    public function formularioRelatorio() {

        $this->load->model('pessoas');
        $pessoas = new Pessoas();
        $rows = $pessoas->obterProfessor();

        $data["professores"] = $rows->result();

        $this->load->view('formularioRelatorioReservas', $data);
    }

    /**
     * Pesquisa um registro
     * sem parametros
     * @retorna <Template>
     */
    public function gerarRelatorioReservas() {

        $this->load->model('reservas');
        $reservas = new Reservas();
        if(isset($_POST["tudo"])){
            
            $rows     = $reservas->gerarRelatoriosReservas($_POST, 1);
            $data["relatorios"] = $rows->result();
            
        }else{
            $rows     = $reservas->gerarRelatoriosReservas($_POST, 0);
            $data["relatorios"] = $rows->result();
            
        }
        $this->load->view('relatorioReservas', $data);
    }

    /**
     * Pesquisa um registro
     * sem parametros
     * @retorna <Template>
     */
    public function pesquisarInfra() {

        $this->load->model('reservas');

        $idPessoa = $this->session->userdata('idPessoa');

        $reservas = new Reservas();
        $reservas->set("dataInicial", $_POST["dataInicial"]);
        $reservas->set("dataFinal", $_POST["dataFinal"]);

        $rowsReservas = $reservas->pesquisarInfra($reservas);

        $data["reservas"] = $rowsReservas->result();

        $this->load->view('pesquisaReservasInfra', $data);
    }

    /**
     * Pesquisa um registro
     * sem parametros
     * @retorna <Template>
     */
    public function pesquisarCancelada() {

        if (!$this->access_rule->has_permission(3))
            $this->access_rule->no_access();

        $this->load->model('reservas');

        $idPessoa = $this->session->userdata('idPessoa');

        $reservas = new Reservas();
        $reservas->set("pesquisa", $_POST["pesquisa"]);
        $reservas->set("dataInicial", $_POST["dataInicial"]);
        $reservas->set("dataFinal", $_POST["dataFinal"]);
        $reservas->set("hora", $_POST["hora"]);
        $reservas->set("idPessoa", $idPessoa);

        $rowsReservas = $reservas->pesquisarCanceladas($reservas);

        $data["reservas"] = $rowsReservas->result();

        $this->load->view('pesquisaReservasCanceladas', $data);
    }

    /**
     * Pesquisa um registro
     * sem parametros
     * @retorna <Template>
     */
    public function graficoReserva() {
        if (!$this->access_rule->has_permission(3))
            $this->access_rule->no_access();

        $this->load->model('reservas');

        $idPessoa = $this->session->userdata('idPessoa');

        $reservas = new Reservas();
        $reservas->set("idPessoa", $idPessoa);

        $rowsResAtiva = $reservas->obterReservasAtuais($reservas);
        $rowsResCance = $reservas->obterReservaCanceladas($reservas);

        $data["ativas"] = $rowsResAtiva->num_rows();
        $data["canceladas"] = $rowsResCance->num_rows();

        $this->load->view('graficoReserva', $data);
    }

    /**
     * Pesquisa um registro
     * sem parametros
     * @retorna <Template>
     */
    public function graficoEquipamentos() {
        if (!$this->access_rule->has_permission(3))
            $this->access_rule->no_access();

        $this->load->model('reservas');

        $idPessoa = $this->session->userdata('idPessoa');

        $reservas = new Reservas();
        $reservas->set("idPessoa", $idPessoa);

        $rows = $reservas->obterEquipamentosReserva($reservas);

        $data["rows"] = $rows->result();

        $a = "";
        foreach ($data["rows"] as $valor) {
            $a .= "{name:" . "'$valor->nome',";
            $a .= "data:" . "[$valor->total]},";
        }
        $data["a"] = $a;
        $this->load->view('graficoEquipamentos', $data);
    }

    /**
     * Pesquisa um registro
     * sem parametros
     * @retorna <Template>
     */
    public function graficoEquipamentosCancelados() {
        if (!$this->access_rule->has_permission(3))
            $this->access_rule->no_access();

        $this->load->model('reservas');

        $idPessoa = $this->session->userdata('idPessoa');

        $reservas = new Reservas();
        $reservas->set("idPessoa", $idPessoa);

        $rows = $reservas->obterEquipamentosReservaCancelados($reservas);

        $data["rows"] = $rows->result();

        $a = "";
        foreach ($data["rows"] as $valor) {
            $a .= "{name:" . "'$valor->nome',";
            $a .= "data:" . "[$valor->total]},";
        }
        $data["a"] = $a;
        $this->load->view('graficoEquipamentosCancelados', $data);
    }

    public function obterReservaParaInfra($tipo) {

        $this->load->model('reservas');
        $reservas = new Reservas();

        $rows = $reservas->obterReservasParaInfras($tipo);

        $data["titulo"] = "Reservas " . $tipo;
        $data["tipo"] = $tipo;

        $data["rows"] = $rows->result();
        $this->load->view('listarReservasInfra', $data);
    }

    public function mudarStatus($status) {

        $this->load->model('reservas');
        $reservas = new Reservas();

        $id = $_POST["id"];
        $reservas->mudarStatus($status, $id);

        $array = array(
            "sucesso" => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro Cancelado com sucesso!!! ",
            "tipo" => "nSuccess",
            "aUrl" => "reserva/obterReservaParaInfra/ativa"
        );

        print_r(json_encode($array));
    }

}

?>