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
class ReservaEvento extends CI_Controller {

    function index() {
        
    }
    
    
    public function detalheProfessores()
    {

        $this->load->model('reservaseventos');
        
        $reservaEventos = new reservaseventos();
        $rows = $reservaEventos->obterProfessores($_POST);

        $data['professor'] = $rows->result();
        
        $this->load->view('detalheProfessoresReservasEventos', $data);
    }
    
    public function detalheEquipamento()
    {

        $this->load->model('reservasequipamentos');
        
        $reservaEquipamento = new reservasequipamentos();
        $rows = $reservaEquipamento->obterEquipamentos($_POST);
        
        $data['equipamentos'] = $rows->result();
        
        $this->load->view('detalheEquipamentosReservasEventos', $data);
    }
    
    /**
     * Formulario de Equipamento
     * sem parametros
     * @retorna <Formulario>
     */
    public function obterReservaEventoParaInfraAll($tipo) {

       $this->load->model('reservaseventos');

        $reservaEventos = new reservaseventos();
        $rows           = $reservaEventos->obterReservasEventosAll($tipo);
        
        $data['canceladas'] = 1;
        $data['reservaEventos'] = $rows->result();
        
        $data['titulo'] = "Reserva Eventos ".$tipo;
        
        $this->load->view('listarReservasEventosInfra', $data);

    }
    
    /**
     * Formulario de Equipamento
     * sem parametros
     * @retorna <Formulario>
     */
    public function cancelar($status) {

        $this->load->model('reservaseventos');
        $reservasEventos = new reservaseventos();
        $reservasEventos->set("idReservaEvento", $_POST["id"]);
        $reservasEventos->cancelar($reservasEventos, $status);

        $array = array(
            "sucesso"  => true,
            "Mensagem" => "<strong>Sucesso: </strong> Operação Realizada!!! ",
            "tipo"     => "nSuccess"
        );

        print_r(json_encode($array));

    }
    
    /**
     * Formulario de Equipamento
     * sem parametros
     * @retorna <Formulario>
     */
    public function formularioReservaEvento() {
        if (!$this->access_rule->has_permission(2))
            $this->access_rule->no_access();
        
        $this->load->model('equipamentos');
        $equipamentos = new Equipamentos();
        $rows = $equipamentos->obterEquipamentos();
        $data['equipamentos'] = $rows->result();
        
        $this->load->model('pessoas');
        $pessoas = new Pessoas();
        $rows = $pessoas->obterProfessor();
        $data['professor'] = $rows->result();
        
        $this->load->model('salas');
        $salas = new Salas();
        $rows = $salas->obterSalas();
        $data['salas'] = $rows->result();


        $this->load->view('cadastroReservasEventos', $data);
    }

    /**
     * Salva registro
     * sem parametros
     * @retorna <Nada>
     */
    public function salvar() {
        if (!$this->access_rule->has_permission(2))
            $this->access_rule->no_access();
        
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
        if (!$this->access_rule->has_permission(2))
            $this->access_rule->no_access();
        
        if( !isset($_POST["idProfessor"]) ){
            $array = array(
                "sucesso"  => false,
                "Mensagem" => "<strong>Impossivel: </strong>Selecione pelo menos 1 professor.",
                "tipo"     => "nFailure"
            );

            print_r(json_encode($array));
            return false;
        }
        
        if( !isset($_POST["idEquipamento"]) ){
            $array = array(
                "sucesso"  => false,
                "Mensagem" => "<strong>Impossivel: </strong>Selecione pelo menos 1 equipamento.",
                "tipo"     => "nFailure"
            );

            print_r(json_encode($array));
            return false;
        }
        
        if ( $_POST["nome"] == "" || $_POST["data"] == "" || $_POST["hora"] == "" ) {
            $array = array(
                "sucesso"  => false,
                "Mensagem" => "<strong>Impossivel: </strong>Campos como Nome, Data e Hora precisa ser preenchido.",
                "tipo"     => "nFailure"
            );

            print_r(json_encode($array));
            return false;
        }
        
        /*verificar se existe ja essa reserva com esse equipamento*/
        $this->load->model('reservas');
        $reservas = new Reservas();
        $reservas->set("idEquipamento", $_POST["idEquipamento"]);
        $reservas->set("data",          $_POST["data"]);
        $reservas->set("hora",          $_POST["hora"]);
        $rowsReservas = $reservas -> checarReservaExiste($reservas);
        

        if(isset($rowsReservas["num_rows"]))
        {
            if($rowsReservas["num_rows"])
            {
                $equip = "";
                foreach($rowsReservas as $valor){
                    $equip .= " | ".$valor['nome']. " | <br />";
                }

                $array = array(
                    "sucesso"  => false,
                    "Mensagem" => "<strong>Não foi possivel: </strong>
                        Existe reservas ja feitas para esses equipamentos nessa data e hora.".$equip,
                    "tipo"     => "nFailure"
                );
                print_r(json_encode($array));
                return false;
            }
        }
        /*verificar se existe ja essa reserva com esse equipamento*/

        $this->load->model('reservaseventos');
        $reservasEventos = new reservaseventos();
        
        $idPessoa = $this->session->userdata('idPessoa');
        
        $reservasEventos->set("nome",             $_POST["nome"]);
        $reservasEventos->set("data",             $_POST["data"]);
        $reservasEventos->set("hora",             $_POST["hora"]);
        $reservasEventos->set("idCoordenador",    $idPessoa);
        $reservasEventos->set("idSala",           $_POST["idSala"]);

        $reservasEventos->inserir($reservasEventos);
        
        $rows = $reservasEventos->obterIdReservaEvento();
        
        foreach($rows->result() as $valor){
            $idReservaEvento = $valor->idReservaEvento;
        }

      
        $this->load->model('reservaseventosprofessores');
        $rep  = new reservaseventosprofessores();        
        $rep->set("idProfessor",     $_POST["idProfessor"]);
        $rep->set("idReservaEvento", $idReservaEvento);
        $rep->inserir($rep);
        
        
        $this->load->model('reservasequipamentos');
        $rEquipamentos  = new reservasequipamentos();        
        $rEquipamentos->set("idEquipamento",     $_POST["idEquipamento"]);
        $rEquipamentos->set("idReservaEvento",   $idReservaEvento);
        $rEquipamentos->inserirEquipamentosReservas($rEquipamentos);
 
        $array = array(
            "sucesso"  => true,
            "Mensagem" => "<strong>Sucesso: </strong>Registro Cadastrado com sucesso!!! ",
            "tipo"     => "nSuccess"
        );

        print_r(json_encode($array));
    }
    
    

    /**
     * Obtem um equipamento
     * sem parametros
     * @retorna <Template>
     */
    public function obterReservaEventoParaInfraCancelados() {

        $this->load->model('reservaseventos');

        $reservaEventos = new reservaseventos();
        $rows           = $reservaEventos->obterReservasEventosCanceladosInfra();
        
        $data['canceladas'] = 1;
        $data['reservaEventos'] = $rows->result();
        
        $data['titulo'] = "Reserva Eventos Cancelados";
        
        $this->load->view('listarReservasEventosInfra', $data);
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

        $this->load->view('formularioRelatorioReservasEventos', $data);
    }
    
    
    /**
    * Obtem a ultima pessoa no banco
    * Sem parametros
    * @retorna <objeto>
    */
    public function gerarRelatorioReservasEventos() {
        
        $this->load->model('reservaseventos');
        $reservas = new reservaseventos();
        if(isset($_POST["tudo"])){
            
            $rows     = $reservas->gerarRelatorioReservasEventos($_POST, 1);
            $data["relatorios"] = $rows->result();
            
        }else{
            $rows     = $reservas->gerarRelatorioReservasEventos($_POST, 0);
            $data["relatorios"] = $rows->result();
            
        }
        $this->load->view('relatorioReservasEventos', $data);
    }
    
    /**
     * Obtem um equipamento
     * sem parametros
     * @retorna <Template>
     */
    public function pesquisarInfra() {

        $this->load->model('reservaseventos');
        
        
        $reservas = new reservaseventos();
        $reservas->set("dataInicial", $_POST["dataInicial"]);
        $reservas->set("dataFinal",   $_POST["dataFinal"]);
        
        $rowsReservas = $reservas->pesquisarInfra($reservas);
        
        $data["reservas"] = $rowsReservas->result();
        
        $this->load->view('pesquisaReservasInfra2', $data);
    }
    
    /**
     * Obtem um equipamento
     * sem parametros
     * @retorna <Template>
     */
    public function obterReservaEventoParaInfraPassados() {

        $this->load->model('reservaseventos');

        $reservaEventos = new reservaseventos();
        $rows           = $reservaEventos->obterReservasEventosPassadosInfra();
        
        $data['canceladas'] = 1;
        $data['reservaEventos'] = $rows->result();
        
        $data['titulo'] = "Reserva Eventos Passados";
        
        $this->load->view('listarReservasEventosInfra', $data);
    }
    
    /**
     * Obtem um equipamento
     * sem parametros
     * @retorna <Template>
     */
    public function obterReservaEventoParaInfra() {

        $this->load->model('reservaseventos');

        $reservaEventos = new reservaseventos();
        $rows           = $reservaEventos->obterReservasEventosAtivosInfra();
        
        $data['canceladas'] = 0;
        $data['reservaEventos'] = $rows->result();
        
        $data['titulo'] = "Reserva Eventos Ativos";
        
        $this->load->view('listarReservasEventosInfra', $data);
    }
    
    /**
     * Obtem um equipamento
     * sem parametros
     * @retorna <Template>
     */
    public function obterReservaEvento() {

        $this->load->model('reservaseventos');

        $reservaEventos = new reservaseventos();
        $rows           = $reservaEventos->obterMinhasReservasEventos();
        
        $data['canceladas'] = 0;
        $data['reservaEventos'] = $rows->result();
        
        $data['titulo'] = "Reserva Eventos Ativos";
        
        $this->load->view('listarReservasEventos', $data);
    }
    
    /**
     * Obtem um equipamento
     * sem parametros
     * @retorna <Template>
     */
    public function obterReservaEventoPassadas() {

        $this->load->model('reservaseventos');

        $reservaEventos = new reservaseventos();
        $rows           = $reservaEventos->obterReservaEventosPassadas();
        

        $data['canceladas'] = 1;
        $data['reservaEventos'] = $rows->result();
        
        $data['titulo'] = "Reserva Eventos Passados";
        
        $this->load->view('listarReservasEventos', $data);
    }
    
    /**
     * Obtem um equipamento
     * sem parametros
     * @retorna <Template>
     */
    public function obterReservaEventoCanceladas() {

        $this->load->model('reservaseventos');

        $reservaEventos = new reservaseventos();
        $rows           = $reservaEventos->obterMinhasReservasEventosCanceladas();
        
        $data['canceladas'] = 1;
        $data['reservaEventos'] = $rows->result();
        
        $data['titulo'] = "Reserva Eventos Cancelados";
        
        $this->load->view('listarReservasEventos', $data);
    }

    /**
     * Atualiza registro
     * sem parametros
     * @retorna <json>
     */
    public function atualizar() {

        $this->load->model('equipamentos');

        $equipamentos = new Equipamentos();
        
        $equipamentos->set("idEquipamento", $_POST["id"]);
        $equipamentos->set("nome",          $_POST["nome"]);
        $equipamentos->set("descricao",     $_POST["descricao"]);
        
        $equipamentos->atualizar($equipamentos);

        $array = array(
            "sucesso"      => true,
            "Mensagem"     => "<strong>Sucesso: </strong>Registro Atualizado com sucesso!!! ",
            "tipo"         => "nSuccess",
            "redirecionar" => true,
            "url"          => "equipamento/obterEquipamento"
        );

        print_r(json_encode($array));
    }

    /**
     * Deleta um registro
     * sem parametros
     * @retorna <json>
     */
    public function deletar() {
        
        $this->load->model('equipamentos');
        
        $id           = $_POST["id"];
        $equipamentos = new Equipamentos();
        $equipamentos->set("idEquipamento", $id);
        
        $equipamentos->deletar($equipamentos);

        $array = array(
            "sucesso"   => true,
            "Mensagem"  => "<strong>Sucesso: </strong>Registro Cadastrado com sucesso!!! ",
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
        
        $this->load->model('reservaseventos');

        $reservaEventos = new reservaseventos();
        $rows           = $reservaEventos->obterPorData($_POST);

        $data['reservaEventos'] = $rows->result();
        $this->load->view('pesquisaReservasEventos', $data);
    }
    
    /**
     * Pesquisa um registro
     * sem parametros
     * @retorna <Template>
     */
    public function pesquisarPorProf() {
        
        $this->load->model('reservaseventos');

        $reservaEventos = new reservaseventos();
        $rows           = $reservaEventos->obterPorDataProf($_POST);

        $data['reservaEventos'] = $rows->result();
        $this->load->view('pesquisaReservasEventos', $data);
    }
    
    
    /**
     * Pesquisa um registro
     * sem parametros
     * @retorna <Template>
     */
    public function listaMinhaReservaEventoProfessor() {

        $this->load->model('reservaseventos');

        $reservaEventos = new reservaseventos();
        $rows           = $reservaEventos->listasMinhasReservasEventosProfessores();      
        
        $data['titulo'] = "Eventos que estou convidado";
        
        $data['reservaEventos'] = $rows->result();
        $this->load->view('listaProfessoresReservaEventos', $data);
    }
    
    /**
     * Pesquisa um registro
     * sem parametros
     * @retorna <Template>
     */
    public function listaMinhaReservaEventoProfessorPassados() {

        $this->load->model('reservaseventos');

        $reservaEventos = new reservaseventos();
        $rows           = $reservaEventos->listasMinhasReservasEventosProfessoresPassados();      
        
        $data['titulo'] = "Eventos que fui convidado";
        
        $data['reservaEventos'] = $rows->result();
        $this->load->view('listaProfessoresReservaEventos', $data);
    }
    
    /**
     * Pesquisa um registro
     * sem parametros
     * @retorna <Template>
     *//*
    public function listaMinhaReservaEventoProfessorPassados() {

        $this->load->model('reservaseventos');

        $reservaEventos = new reservaseventos();
        $rows           = $reservaEventos->listasMinhasReservasEventosProfessoresPassados();      
        
        $data['titulo'] = "Eventos que fui convidado";
        
        $data['reservaEventos'] = $rows->result();
        $this->load->view('listaProfessoresReservaEventos', $data);
    }*/
    /**
     * Pesquisa um registro
     * sem parametros
     * @retorna <Template>
     */
    public function listaMinhaReservaEventoProfessorCancelados() {

        $this->load->model('reservaseventos');

        $reservaEventos = new reservaseventos();
        $rows           = $reservaEventos->listasMinhasReservasEventosProfessoresCancelados();      
        
        $data['titulo'] = "Eventos que está cancelado";
        
        $data['reservaEventos'] = $rows->result();
        $this->load->view('listaProfessoresReservaEventos', $data);
    }
    
    /**
     * Pesquisa um registro
     * sem parametros
     * @retorna <Template>
     */
    public function listaMinhaReservaEventoProfessorAll($status) {

        $this->load->model('reservaseventos');

        $reservaEventos = new reservaseventos();
        $rows           = $reservaEventos->listaMinhaReservaEventoProfessorAlls($status);      
        
        $data['titulo'] = "Eventos que está ".$status;
        
        $data['reservaEventos'] = $rows->result();
        $this->load->view('listaProfessoresReservaEventos', $data);
    }
    
    

}

?>