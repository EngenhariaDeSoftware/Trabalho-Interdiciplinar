<div class="logo">
    <a href="<?php echo $urlInicial; ?>"><img src="../theme/images/logo.png" alt="" /></a>
</div>
<div class="sidebarSep mt0"></div>

<!-- ******************************************************************************** -->

<!-- Coordenador Pesquisa -->
<?php if ($this->session->userdata('idAcesso') == 2): ?>
    <form action="pesquisa/glob" class="sidebarSearch">
        <input type="text" name="pesquisaGlobal" placeholder="pesquisar global..." id="pesquisaGlobal" />
        <input type="submit" value="" />            
    </form>
    <div class="sidebarSep"></div>
<?php endif; ?>

    
<!-- ******************************************************************************** -->

<!-- Menu Esquerça Navegação -->
<ul id="menu" class="nav">
    <!-- ********************************************************* -->
    <li class="dash">
        <a href="<?php echo $urlInicial; ?>" title="Pagina Inicial" class="active">
            <span>Home</span>
        </a>
    </li>
    <!-- ********************************************************* -->
    
    <!-- ********************************************************* -->
    <!-- Coordenador -->
    <?php if ($this->session->userdata('idAcesso') == 1): ?>
        <li class="tables">
            <a href="javascript:void(0);" title="Reservas" class="exp">
                <span>Reservas Eventos</span><strong>+ 2</strong>
            </a>
            <ul class="sub selected">
                <li><a href="reservaEvento/formularioReservaEvento" title="">Reserva Evento</a></li>
                <li><a href="reservaEvento/obterReservaEvento" title="">Listar Evento Ativos</a></li>
                <li><a href="reservaEvento/obterReservaEventoPassadas" title="">Listar Evento Passados</a></li>
                <li><a href="reservaEvento/obterReservaEventoCanceladas" title="">Canceladas</a></li>
            </ul>
        </li>    
    <?php endif; ?>
    <!-- ********************************************************* -->
    
    <!-- ********************************************************* -->
    <!-- Professor -->
    <?php if ($this->session->userdata('idAcesso') == 3): ?>
        <li class="tables">
            <a href="javascript:void(0);" title="Reservas" class="exp">
                <span>Reservas</span><strong>+ 6</strong>
            </a>
            <ul class="sub selected">
                <li><a href="reserva/formularioReserva" title="">Cadastrar Reserva</a></li>
                <li><a href="reserva/obterReserva" title="">Reserva Ativas</a></li>
                <li><a href="reserva/obterReservaCanceladas" title="">Reserva Canceladas</a></li>
                <li><a href="reserva/obterReservaPassadas/" title="">Reserva Passadas</a></li>
                
                <li><a href="reserva/obterReservaAll/2" title="">Reserva Negada</a></li>
                <li><a href="reserva/obterReservaAll/3" title="">Reserva Aceitas</a></li>
            </ul>
        </li>
        <li class="tables">
            <a href="javascript:void(0);" title="Reservas" class="exp">
                <span>Eventos</span><strong>+ 3</strong>
            </a>
            <ul class="sub selected">
                <li><a href="reservaEvento/listaMinhaReservaEventoProfessor" title="">Atual</a></li>
                <li><a href="reservaEvento/listaMinhaReservaEventoProfessorPassados" title="">Passados</a></li>
                <li><a href="reservaEvento/listaMinhaReservaEventoProfessorCancelados" title="">Cancelados</a></li>
                
                <li><a href="reservaEvento/listaMinhaReservaEventoProfessorAll/2" title="">Negados</a></li>
                <li><a href="reservaEvento/listaMinhaReservaEventoProfessorAll/3" title="">Aceitos</a></li>
            </ul>
        </li>
        <div class="sidebarSep"></div>
        <a href="reserva/graficoReserva" title="" class="sButton sBlue btnClickPage"><img src="../theme/images/icons/sPlus.png" alt="" /><span>Grafico Reservas</span></a>
        <a href="reserva/graficoEquipamentos" title="" class="sButton sRed btnClickPage" style="margin-top: 12px;"><img src="../theme/images/icons/sPlus.png" alt="" /><span>Grafico Equipamentos</span></a>
        <a href="reserva/graficoEquipamentosCancelados" title="" class="sButton sGreen btnClickPage" style="margin-top: 12px;"><img src="../theme/images/icons/sPlus.png" alt="" /><span>Equip Canceladas</span></a>
    <?php endif; ?>
    <!-- ********************************************************* -->
    
    <!-- ********************************************************* -->
    <!-- InfraEstrutura -->
    <?php if ($this->session->userdata('idAcesso') == 2): ?>    
        <li class="ui">
            <a href="javascript:void(0);" title="Usuarios" class="exp">
                <span>Usuarios</span><strong>+ 3 Links</strong>
            </a>
            <ul class="sub selected">
                <li><a href="pessoa/formularioPessoa" title="">Novo Usuario</a></li>
                <li><a href="pessoa/obterPessoa" title="">Listar Usuarios</a></li>
                <li><a href="pessoa/obterPessoaXml" title="">Usuarios XML</a></li>
            </ul>
        </li>
        
        <li class="typo">
            <a href="javascript:void(0);" title="Equipamentos" class="exp">
                <span>Equipamentos</span><strong>+ 2 Links</strong>
            </a>
            <ul class="sub selected">
                <li><a href="equipamento/formularioEquipamento" title="">Novo Equipamento</a></li>
                <li><a href="equipamento/obterEquipamento" title="">Listar Equipamentos</a></li>
            </ul>
        </li>
        
        <br />
        
        <div class="sidebarSep mt0"></div>
        
        <li class="typo">
            <a href="javascript:void(0);" title="Equipamentos" class="exp">
                <span>Eventos</span><strong>+ 5 Links</strong>
            </a>
            <ul class="sub selected">
                <li><a href="reservaEvento/obterReservaEventoParaInfra" title="">Proximos Eventos</a></li>
                <li><a href="reservaEvento/obterReservaEventoParaInfraPassados" title="">Eventos Passados</a></li>
                <li><a href="reservaEvento/obterReservaEventoParaInfraCancelados" title="">Eventos Cancelados</a></li>
                <li><a href="reservaEvento/obterReservaEventoParaInfraAll/negado" title="">Eventos Negado</a></li>
                <li><a href="reservaEvento/obterReservaEventoParaInfraAll/aceito" title="">Eventos Aceito</a></li>
            </ul>
        </li>
        
        <li class="typo">
            <a href="javascript:void(0);" title="Equipamentos" class="exp">
                <span>Reservas</span><strong>+ 5 Links</strong>
            </a>
            <ul class="sub selected">
                <li><a href="reserva/obterReservaParaInfra/ativa" title="">Proximas Reservas</a></li>
                <li><a href="reserva/obterReservaParaInfra/passado" title="">Reservas Passadas</a></li>
                <li><a href="reserva/obterReservaParaInfra/cancelado" title="">Reservas Canceladas</a></li>
                <li><a href="reserva/obterReservaParaInfra/negada" title="">Reservas Negadas</a></li>
                <li><a href="reserva/obterReservaParaInfra/aceita" title="">Reservas Aceitas</a></li>
            </ul>
        </li>
        
        <br />
        
        <div class="sidebarSep mt0"></div>

        <li class="tables">
            <a href="javascript:void(0);" title="Salas" class="exp">
                <span>Salas</span><strong>+ 1 Links</strong>
            </a>
            <ul class="sub selected">
                <li><a href="sala/obterSala" title="">Listar Salas</a></li>
            </ul>
        </li>

        <li class="tables">
            <a href="javascript:void(0);" title="Cursos" class="exp">
                <span>Cursos</span><strong>+ 1 Links</strong>
            </a>
            <ul class="sub selected">
                <li><a href="curso/obterCurso" title="">Listar Curso</a></li>
            </ul>
        </li>
        
        <li class="tables">
            <a href="javascript:void(0);" title="Cursos" class="exp">
                <span>Disciplinas</span><strong>+ 2 Links</strong>
            </a>
            <ul class="sub selected">
                <li><a href="disciplina/obterDisciplina" title="">Listar Disciplinas</a></li>
                <li><a href="professorDisciplina/obterProfessorDisciplina" title="">Lista de Professores e Disciplinas</a></li>
            </ul>
        </li>

        <li class="tables">
            <a href="javascript:void(0);" title="Cursos" class="exp">
                <span>Professor + Salas</span><strong>+ 1</strong>
            </a>
            <ul class="sub selected">
                <li><a href="salaProfessorDisciplina/obterSalaProfessorDisciplina" title="">Listar Professor e Salas</a></li>
            </ul>
        </li>    

        <li class="tables">
            <a href="javascript:void(0);" title="Turmas" class="exp">
                <span>Turmas</span><strong>+ 1</strong>
            </a>
            <ul class="sub selected">
                <li><a href="turma/obterTurma" title="">Listar Turmas</a></li>
            </ul>
        </li>
        <div class="sidebarSep"></div>
        <a href="reserva/formularioRelatorio" title="" class="sButton sBlue btnClickPage">
            <img src="../theme/images/icons/sPlus.png" alt="" />
            <span>Relatorio Reservas</span>
        </a>
        <a href="reservaevento/formularioRelatorio" title="" class="sButton sGreen btnClickPage">
            <img src="../theme/images/icons/sPlus.png" alt="" />
            <span>Relatorio Eventos</span>
        </a>
        
        <div class="sidebarSep"></div>
        <a href="equipamento/equipamentoUtilizado" title="" class="sButton sRed btnClickPage">
            <img src="../theme/images/icons/sPlus.png" alt="" />
            <span>Equipamentos Utilizados</span>
        </a>
        <a href="equipamento/equipamentoUtilizadoEventos" title="" class="sButton sRed btnClickPage">
            <img src="../theme/images/icons/sPlus.png" alt="" />
            <span>Equipamentos p/Eventos</span>
        </a>
        <a href="ocorrencia/relatorio" title="" class="sButton sButton btnClickPage">
            <img src="../theme/images/icons/sPlus.png" alt="" />
            <span>Relatorio ocorrencias</span>
        </a>
    <?php endif; ?>
    <!-- ********************************************************* -->
    
    <!-- ********************************************************* -->
    <!-- Recursos Humanos -->
    <?php if ($this->session->userdata('idAcesso') == 4): ?>
        <li class="ui">
            <a href="javascript:void(0);" title="Usuarios" class="exp">
                <span>Usuarios</span><strong>+ 2 Links</strong>
            </a>
            <ul class="sub selected">
                <li><a href="pessoa/formularioPessoa" title="">Novo Usuario</a></li>
                <li><a href="pessoa/obterPessoa" title="">Listar Usuarios</a></li>
            </ul>
        </li>

        <li class="ui">
            <a href="javascript:void(0);" title="Importar" class="exp">
                <span>XML Importação</span><strong>+ 1 Links</strong>
            </a>
            <ul class="sub selected">
                <li><a href="xml/formularioPessoaXml" title="">Criar XML</a></li>
            </ul>
        </li>
    <?php endif; ?>
    <!-- ********************************************************* -->
    
    <!-- ********************************************************* -->
    <!-- Controle academico -->
    <?php if ($this->session->userdata('idAcesso') == 5): ?>
        <li class="tables">
            <a href="javascript:void(0);" title="Salas" class="exp">
                <span>Salas</span><strong>+ 2 Links</strong>
            </a>
            <ul class="sub selected">
                <li><a href="sala/formularioSala" title="">Cadastrar Sala</a></li>
                <li><a href="sala/obterSala" title="">Listar Salas</a></li>
            </ul>
        </li>

        <li class="tables">
            <a href="javascript:void(0);" title="Cursos" class="exp">
                <span>Cursos</span><strong>+ 2 Links</strong>
            </a>
            <ul class="sub selected">
                <li><a href="curso/formularioCurso" title="">Cadastrar Curso</a></li>
                <li><a href="curso/obterCurso" title="">Listar Curso</a></li>
            </ul>
        </li>
        
        <li class="tables">
            <a href="javascript:void(0);" title="Cursos" class="exp">
                <span>Disciplinas</span><strong>+ 4 Links</strong>
            </a>
            <ul class="sub selected">
                <li><a href="disciplina/formularioDisciplina" title="">Cadastrar Disciplinas</a></li>
                <li><a href="disciplina/obterDisciplina" title="">Listar Disciplinas</a></li>
                <li><a href="professorDisciplina/formularioProfessorDisciplina" title="">Relacionar Disciplina Professor</a></li>
                <li><a href="professorDisciplina/obterProfessorDisciplina" title="">Lista de Professores e Disciplinas</a></li>
            </ul>
        </li>

        <li class="tables">
            <a href="javascript:void(0);" title="Cursos" class="exp">
                <span>Professor + Salas</span><strong>+ 1</strong>
            </a>
            <ul class="sub selected">
                <li><a href="salaProfessorDisciplina/formularioSalaProfessorDisciplina" title="">Professor e Salas</a></li>
                <li><a href="salaProfessorDisciplina/obterSalaProfessorDisciplina" title="">Listar Professor e Salas</a></li>
            </ul>
        </li>    

        <li class="tables">
            <a href="javascript:void(0);" title="Turmas" class="exp">
                <span>Turmas</span><strong>+ 2</strong>
            </a>
            <ul class="sub selected">
                <li><a href="turma/formularioTurma" title="">Cadastro Turma</a></li>
                <li><a href="turma/obterTurma" title="">Listar Turmas</a></li>
            </ul>
        </li>
    <?php endif; ?>
    <!-- ********************************************************* -->
</ul>
<script>
    $(".sidebarSearch").submit(function(event){
        event.preventDefault();
        if( $("#pesquisaGlobal").val() == "" )
        {
            var div = "<div/>";
            $( div ).dialog({
                modal: true,
                title:"Alerta",
                width: 400,
                open: function (){
                    $(this).html("<h5>Digite algo para ser pesquisado...</h5>");
                }, 
                buttons: {
                    Fechar: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
            return false;
        }
        $(".bloqueador, .loading").css({
            "display":"block"
        }); 
        var data = $(".sidebarSearch").serialize();
        var aUrl = $(".sidebarSearch").attr("action");
        
        $.post("../"+aUrl, data, function(eData){
            $(".conteudo").html(eData);
            $(".bloqueador, .loading").css({
                "display":"none"
            }); 
        });
    });
    
    $('#pesquisaGlobal').bind('keyup', function(){
        var data = $(".sidebarSearch").serialize();
        var aUrl = "pesquisa/autoCompletar/"
        $.post("../"+aUrl, data, function(eData){
            var availableTags = eData
            $( "#pesquisaGlobal" ).autocomplete({
                source: eData
            });
        }, "json")
    });

</script>