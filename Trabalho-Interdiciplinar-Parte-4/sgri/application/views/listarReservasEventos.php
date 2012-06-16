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
<div class="widget">
    <div class="title"><img src="../theme/images/icons/dark/full2.png" alt="" class="titleIcon" /><h6><?php echo $titulo; ?></h6></div>                          
    <table cellpadding="0" cellspacing="0" border="0" class="display dTable">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Predio</th>
                <th>Andar</th>
                <th>Numero</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservaEventos as $valor): ?>
                <tr class="gradeX">
                    <td><?php echo $valor->nome; ?></td>
                    <td><?php echo $valor->data; ?></td>
                    <td><?php echo $valor->hora; ?></td>
                    <td><?php echo $valor->predio; ?></td>
                    <td><?php echo $valor->andar; ?></td>
                    <td><?php echo $valor->numero; ?></td>
                    <td class="actBtns">
                        <?php if($canceladas == 0): ?>
                        <a href="<?php echo $valor->idReservaEvento; ?>" id="ReservaEvento/cancelar/1" title="Cancelar Reserva" class="tipS deletar">
                            <img src="../theme/images/icons/taskDone.png" alt="" />
                        </a>
                        <?php endif; ?>
                        <a href="<?php echo $valor->idReservaEvento; ?>" id="ReservaEvento/detalheProfessores/" title="Ver Professores" class="tipS detalhe">
                            <img src="../theme/images/icons/grown.png" alt="" />
                        </a>
                        <a href="<?php echo $valor->idReservaEvento; ?>" id="ReservaEvento/detalheEquipamento/" title="Ver Equipamentos" class="tipS detalhe">
                            <img src="../theme/images/icons/download.png" alt="" />
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>  
</div>
<input type="hidden" class="obter" id="reservaEvento/obterReservaEvento" />

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