<!-- Form -->
<script type="text/javascript" src="../theme/js/formulario.js"></script>
<div class="nNote nWarning">
    <p><strong>Aviso: </strong>Campos marcados com asterisco(*) são obrigatórios.</p>
</div>
<form action="reservaEvento/salvar" id="validate" class="form" method="POST">
    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/list.png" alt="" class="titleIcon" /><h6>Cadastro de Reservas Para Eventos</h6></div>
            <div class="formRow">
                <label>Nome:<span class="req">*</span></label>
                <div class="formRight"><input type="text" name="nome" value="" /></div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>Sala:<span class="req">*</span></label>
                <div class="formRight">
                    <select name="idSala" id="idSala" class="chzn-select" >
                        <?php foreach ($salas as $valor): ?>
                            <option value="<?php echo $valor->idSala; ?>">
                                Predio: <?php echo $valor->predio; ?> - 
                                Andar: <?php echo $valor->andar; ?> -
                                Numero: <?php echo $valor->numero; ?> -
                            </option>
                        <?php endforeach; ?>
                    </select>           
                </div>             
                <div class="clear"></div>
            </div>
            <div class="formRow dnone">
                <label>Data e Hora:<span class="req">*</span></label>
                <div class="formRight">
                    <span class="oneTwo"><input type="text" id="data" name="data" placeholder="Data" class="datepicker validate[required]" value="" /></span>
                    <span class="oneTwo"><input type="text" id="hora" name="hora" placeholder="Hora" class="hora validate[required]" value="" /></span>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <div class="formRow">
            <label>Professores:</label>
            <div class="formRight">
                <select id="idProfessor" name="idProfessor[]" data-placeholder="Selecione os Prof" style="" class="chzn-select" multiple="multiple" tabindex="6">
                    <option value=""></option>
                    <?php foreach ($professor as $valor): ?>
                        <option value="<?php echo $valor->idPessoa; ?>"><?php echo $valor->pessoaNome; ?></option>
                    <?php endforeach; ?>
                </select>  
            </div>             
            <div class="clear"></div>
        </div>
    </fieldset>

    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Selecione os Equipamentos</h6></div>
            <div class="body">
                <div class="leftPart">
                    <div class="filter"><span>Filtro: </span><input type="text" id="box1Filter" class="boxFilter" /><input type="button" id="box1Clear" class="fBtn" value="x" /><div class="clear"></div></div>

                    <select id="box1View" name="aessss" multiple="multiple" class="multiple" style="height:300px;">
                        <?php foreach ($equipamentos as $valor): ?>
                            <option value="<?php echo $valor->idEquipamento; ?>"><?php echo $valor->nome; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br/>
                    <span id="box1Counter" class="countLabel"></span>

                    <div class="dn"><select id="box1Storage" name="box1Storage"></select></div>
                </div>

                <div class="dualControl">
                    <button id="to2" type="button" class="basic mr5 mb15">&nbsp;&gt;&nbsp;</button>
                    <button id="allTo2" type="button" class="basic">&nbsp;&gt;&gt;&nbsp;</button><br />
                    <button id="to1" type="button" class="basic mr5">&nbsp;&lt;&nbsp;</button>
                    <button id="allTo1" type="button" class="basic">&nbsp;&lt;&lt;&nbsp;</button>
                </div>

                <div class="rightPart">
                    <div class="filter"><span>Filtro: </span><input type="text" id="box2Filter" class="boxFilter" /><input type="button" id="box2Clear" class="fBtn" value="x" /><div class="clear"></div></div>
                    <select id="box2View" multiple="multiple" class="multiple" id="idEquipamento" name="idEquipamento[]" style="height:300px;"></select><br/>
                    <span id="box2Counter" class="countLabel"></span>

                    <div class="dn"><select id="box2Storage"></select></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="formSubmit">
                <input type="submit" value="Salvar" class="blueB submit" />
                <input type="reset" value="Cancelar" class="redB" />
            </div>
            <div class="clear"></div>
        </div>
    </fieldset>
</form>
<script type="text/javascript">
   
    $(".hora").mask("99:99:99");
    
    $("#validate").validationEngine();

    $( ".chzn-select" ).chosen();
    
    $.configureBoxes();
    
    $( ".datepicker" ).datepicker({ 
        defaultDate: +7,
        autoSize: true,
        appendText: '(dd/mm/yyyy)',
        dateFormat: 'dd/mm/yy'
    });	

</script>