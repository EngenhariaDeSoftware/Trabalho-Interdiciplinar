<script type="text/javascript" src="../theme/js/acoesComum.js"></script>
<!-- Search -->
<div class="searchWidget">
    <form action="reservaEvento/pesquisar" class="form" method="POST">
        <div class="formRight">
            <span class="oneTwo"><input name="dataInicial" type="text" placeholder="Data Inicial" class="datepicker" value="" /></span>
            <span class="oneTwo"><input name="dataFinal" type="text" placeholder="Data Final" class="datepicker" value="" /></span>
        </div>
        <input type="submit" name="pesquisar" class="pesquisarPessoas" value="" />
        <div class="clear"></div>
    </form>
</div>

<div class="body">
    <!-- Partners list widget -->
    <div class="widget">
        <div class="title"><img src="../theme/images/icons/dark/users.png" alt="" class="titleIcon" /><h6>Resultado Pesquisa Disciplinas</h6></div>
        <ul class="partners">
                <?php foreach($reservaEventos as $valor): ?>
                <li>
                    <div class="pInfo">
                        <p><strong>Codigo: <?php echo $valor->nomeReserva; ?></strong></p>
                        <i><strong>Nome: <?php echo $valor->status; ?></strong></i>
                        <i><strong>Data: <?php echo $valor->data; ?></strong></i>
                        <i><strong>Hora: <?php echo $valor->hora; ?></strong></i>
                        <i><strong>Professor: <?php echo $valor->pessoaNome; ?></strong></i>
                        <i><strong>Equipamento: <?php echo $valor->equipamentoNome; ?></strong></i>
                    </div>
                    <div class="clear"></div>
                    <?php endforeach; ?>
                </li>
              
        </ul>
    </div>                       
</div>
<input type="hidden" class="obter" id="disciplina/obterDisciplina" />
<script>
    oTable = $('.dTable').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>'
    });
    $("select, input:checkbox, input:radio, input:file").uniform();
    
    $(".hora").mask("99:99:99");
    
    $( ".datepicker" ).datepicker({ 
        defaultDate: +7,
        autoSize: true,
        appendText: '(dd/mm/yyyy)',
        dateFormat: 'dd/mm/yy'
    });	
</script>