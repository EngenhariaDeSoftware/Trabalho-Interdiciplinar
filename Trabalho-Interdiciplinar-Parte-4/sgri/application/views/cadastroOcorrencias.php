<!-- Form -->
<script type="text/javascript" src="../theme/js/formulario.js"></script>
<div class="nNote nWarning">
    <p><strong>Aviso: </strong>Campos marcados com asterisco(*) são obrigatórios.</p>
</div>
<form action="ocorrencia/salvar" id="validate" class="form" method="POST">
    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/list.png" alt="" class="titleIcon" /><h6>Cadastro de Ocorrências</h6></div>
            <div class="formRow">
                <label>Descrição:<span class="req">*</span></label>
                <div class="formRight"><textarea rows="8" cols="" class="validate[required]" name="descricao"></textarea></div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>Selecione os Contatos:</label>
                <div class="formRight">
                    <select data-placeholder="Selecione os Contatos" name="para[]" style="" class="chzn-select" multiple="multiple" tabindex="6">
                        <?php foreach($rowsPessoas as $valor): ?>
                            <option value="<?php echo $valor->idPessoa; ?>"><?php echo $valor->pessoaNome; ?></option>
                        <?php endforeach; ?>
                    </select>  
                </div>             
                <div class="clear"></div>
            </div>
            <div class="formSubmit">
                <input type="submit" value="Salvar" class="blueB submit" />
                <input type="reset" value="Cancelar" class="redB" />
            </div>
            <div class="clear"></div>
            <br />
            <br />
            <br />
            <br />
            <br />
        </div>
    </fieldset>
</form>
<script>
    $( ".datepicker" ).datepicker({ 
        defaultDate: +7,
        autoSize: true,
        appendText: '(dd-mm-yyyy)',
        dateFormat: 'dd/mm/yy',
    });	
    $( ".chzn-select" ).chosen();
    $("#validate").validationEngine();
</script>