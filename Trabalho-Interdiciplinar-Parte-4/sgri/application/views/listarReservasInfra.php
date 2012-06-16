<script type="text/javascript" src="../theme/js/acoesComum.js"></script>
<!-- Search -->
<div class="searchWidget">
    <form action="reservaEvento/pesquisarInfra" class="form" method="POST">
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
                <th>Coodenador</th>
                <th>Nome Evento</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Predio</th>
                <th>Andar</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($rows as $valor): ?>
                <tr class="gradeX">
                    <td><?php echo $valor->pessoaNome; ?></td>
                    <td><?php echo $valor->predio; ?></td>
                    <td><?php echo $valor->andar; ?></td>
                    <td><?php echo $valor->numero; ?></td>
                    <td><?php echo $valor->turmaNome; ?></td>
                    <td><?php echo $valor->grupo; ?></td>
                    <td><?php echo $valor->data; ?></td>
                    <td><?php echo $valor->hora; ?></td>
                    <td class="actBtns">
                        <a href="<?php echo $valor->reservaId; ?>" id="reserva/detalheEquipamentoInfra/" title="Ver Equipamentos" class="tipS detalhe">
                            <img src="../theme/images/icons/download.png" alt="" />
                        </a>
                        <?php if($tipo == "ativa"): ?>
                        <a href="<?php echo $valor->reservaId; ?>" id="reserva/mudarStatus/2" title="Negar Pedido" class="tipS mudarStatus">
                            <img src="../theme/images/icons/dropped.png" alt="" />
                        </a>
                        <a href="<?php echo $valor->reservaId; ?>" id="reserva/mudarStatus/3" title="Aceitar Pedido" class="tipS mudarStatus">
                            <img src="../theme/images/icons/grown.png" alt="" />
                        </a>
                        <?php endif; ?>
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