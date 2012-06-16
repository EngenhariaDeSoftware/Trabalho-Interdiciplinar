<script type="text/javascript" src="../theme/js/acoesComum.js"></script>
<!-- Search -->
<div class="searchWidget">
    <form action="reserva/pesquisarCancelada" class="form" method="POST">
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

<div class="body">
    <!-- Partners list widget -->
    <div class="widget">
        <div class="title"><img src="../theme/images/icons/dark/users.png" alt="" class="titleIcon" /><h6>Resultado Pesquisa Reservas Canceladas</h6></div>
        <ul class="partners">
                <?php foreach($reservas as $valor): ?>
                <li>
                    <div class="pInfo">
                        <i><strong>Turma:      <?php echo $valor->turmaNome; ?></strong></i>
                        <i><strong>Predio:     <?php echo $valor->predio; ?></strong></i>
                        <i><strong>Andar:      <?php echo $valor->andar; ?></strong></i>
                        <i><strong>Numero:     <?php echo $valor->numero; ?></strong></i>
                        <i><strong>Data:       <?php echo $valor->data; ?></strong></i>
                        <i><strong>Hora:       <?php echo $valor->hora; ?></strong></i>
                        <i><strong>Disciplina: <?php echo $valor->DisciplinaNome; ?></strong></i>
                        <i><strong>Curso:      <?php echo $valor->cursoNome; ?></strong></i>
                        <i><strong>Observação: <?php echo $valor->obs; ?></strong></i>
      
                        <p>
                            <a href="<?php echo $valor->idReserva; ?>" id="reserva/detalheEquipamento/" title="Ver Equipamentos" class="tipS detalhe">
                                <img src="../theme/images/icons/download.png" alt="" />
                            </a>
                        </p>	
                    </div>
                    <div class="clear"></div>
                </li>
                <?php endforeach; ?>
               
        </ul>
    </div>                       
</div>
<input type="hidden" class="obter" id="disciplina/obterDisciplina" />
<script>
    $(".hora").mask("99:99:99");
    
    $( ".datepicker" ).datepicker({ 
        defaultDate: +7,
        autoSize: true,
        dateFormat: 'dd/mm/yy'
    });	
</script>