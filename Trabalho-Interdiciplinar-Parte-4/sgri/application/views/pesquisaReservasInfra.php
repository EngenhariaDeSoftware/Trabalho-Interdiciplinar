<script type="text/javascript" src="../theme/js/acoesComum.js"></script>
<!-- Search -->
<div class="searchWidget">
    <form action="reserva/pesquisarInfra" class="form" method="POST">
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
        <div class="title"><img src="../theme/images/icons/dark/users.png" alt="" class="titleIcon" /><h6>Resultado Pesquisa Reservas</h6></div>
        <ul class="partners">
            <?php foreach ($reservas as $valor): ?>
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
                        <i>
                            <strong>
                                Status:     
                                <?php if($valor->status == 0): ?>
                                    <span style="background: #008B00;">Reserva Ativa</span>
                                <?php endif; ?>
                                <?php if($valor->status == 1): ?>
                                    <span style="background: #FFFF00;">Reserva Cancelada</span>
                                <?php endif; ?>
                                <?php if($valor->status == 2): ?>
                                    <span style="background: #FF0000;">Reserva Negada</span>
                                <?php endif; ?>
                                <?php if($valor->status == 3): ?>
                                    <span style="background: #00FF00;">Reserva Aceita</span>
                                <?php endif; ?>
                            </strong>
                        </i>

                        <p>
                            <a href="<?php echo $valor->idReserva; ?>" id="reserva/detalheEquipamentoInfra/" title="Ver Equipamentos" class="tipS detalhe">
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