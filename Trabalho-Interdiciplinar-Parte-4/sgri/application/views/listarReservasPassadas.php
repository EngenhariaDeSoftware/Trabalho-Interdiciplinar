<script type="text/javascript" src="../theme/js/acoesComum.js"></script>
<!-- Search -->
<div class="searchWidget">
    <form action="reserva/pesquisar" class="form" method="POST">
        <input type="text" name="pesquisa" class="pesquisa" id="pesquisa" placeholder="Pesquisar Reservas por: Turma, Predio, Andar, Numero e Observações..." />
        <input type="submit" name="pesquisar" class="pesquisarReservas" value="" />
        <div class="formRow dnone">
            <span class="oneThree"><input type="text" name="dataInicial" placeholder="Data Inicial" class="datepicker" value="" /></span>
            <span class="oneThree"><input type="text" name="dataFinal" placeholder="Data Final" class="datepicker" value="" /></span>
            <span class="oneThree"><input type="text" name="hora" placeholder="Hora" class="hora" value="" /></span>
            <div class="clear"></div>
        </div>
    </form>
</div>
<div class="widget">
    <div class="title"><img src="../theme/images/icons/dark/full2.png" alt="" class="titleIcon" /><h6>Lista de Suas Reservas Passadas</h6></div>                          
    <table cellpadding="0" cellspacing="0" border="0" class="display dTable">
        <thead>
            <tr>
                <th>Turma</th>
                <th>Predio</th>
                <th>Andar</th>
                <th>Numero</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservas as $valor): ?>
                <tr class="gradeC">
                    <td><?php echo $valor->turmaNome; ?></td>
                    <td><?php echo $valor->predio; ?></td>
                    <td><?php echo $valor->andar; ?></td>
                    <td><?php echo $valor->numero; ?></td>
                    <td class="center"><?php echo $this->query->dateBr($valor->data); ?></td>
                    <td class="center"><?php echo $valor->hora; ?></td>

                    <td class="actBtns">
                        <a href="<?php echo $valor->idReserva; ?>" id="reserva/detalhe/" title="Detalhes" class="tipS detalhe">
                            <img src="../theme/images/icons/grown.png" alt="" />
                        </a>
                        <a href="<?php echo $valor->idReserva; ?>" id="reserva/detalheEquipamento/" title="Ver Equipamentos" class="tipS detalhe">
                            <img src="../theme/images/icons/download.png" alt="" />
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>  
</div>
<input type="hidden" class="obter" id="reserva/obterReserva" />
<script>
    oTable = $('.dTable').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>'
    });
    
    $(".hora").mask("99:99:99");
    
    $( ".datepicker" ).datepicker({ 
        defaultDate: +7,
        autoSize: true,
        dateFormat: 'dd/mm/yy'
    });	
</script>