<!-- Form -->
<script type="text/javascript" src="../theme/js/formulario.js"></script>
<form action="reserva/gerarRelatorioReservas" id="validate" class="formRelatorio" method="POST">
    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/list.png" alt="" class="titleIcon" /><h6>Relatorios</h6></div>
            <div class="formRow">
                <label>Desejo Gerar um Relatório de Tudo:</label>
                <div class="formRight">
                    <input type="checkbox" name="tudo" value="1" />       
                </div>             
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <label>Selecione Professor:</label>
                <div class="formRight">
                    <select name="idPessoa" class="chzn-select" >
                        <option value="opt1">Selecione um Professor</option>
                        <?php foreach ($professores as $valor): ?>
                            <option value="<?php echo $valor->idPessoa; ?>"><?php echo $valor->pessoaNome; ?></option>
                        <?php endforeach; ?>
                    </select>           
                </div>             
                <div class="clear"></div>
            </div>
            
            <div class="formRow dnone">
                <label>Datas:</label>
                <div class="formRight">
                    <span class="oneTwo"><input type="text" name="dataInicial" class="datepicker" placeholder="Data Inicial" /></span>
                    <span class="oneTwo"><input type="text" name="dataFinal" class="datepicker" placeholder="Data Final" /></span>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formSubmit">
                <input type="submit" value="Gerar" class="blueB submit" />
            </div>
            <div class="clear"></div>
        </div>
    </fieldset>
</form>
<script>
    $("#validate").validationEngine();
    $( ".chzn-select" ).chosen();
    $( ".datepicker" ).datepicker({ 
        defaultDate: +7,
        autoSize: true,
        appendText: '(dd/mm/yyyy)',
        dateFormat: 'dd/mm/yy'
    });	
</script>