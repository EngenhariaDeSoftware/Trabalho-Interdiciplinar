<!-- Form -->
<script type="text/javascript" src="../theme/js/formulario.js"></script>
<div class="nNote nWarning">
    <p><strong>Aviso: </strong>Campos marcados com asterisco(*) são obrigatórios.</p>
</div>
<form action="disciplina/salvar" id="validate" class="form" method="POST">
    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/list.png" alt="" class="titleIcon" /><h6>Cadastro Disciplinas</h6></div>
            <div class="formRow">
                <label>Nome:<span class="req">*</span></label>
                <div class="formRight"><input type="text" class="validate[required]" name="nome" id="nome" value="" /></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <label>Turno:<span class="req">*</span></label>
                <div class="formRight">
                    <select name="turno" id="turno" class="chzn-select" >
                        <option value="1">Manhã</option>
                        <option value="2">Tarde</option>
                        <option value="3">Noite</option>
                    </select>           
                </div>             
                <div class="clear"></div>
            </div>

            <div class="formRow dnone">
                <label>Data Inicial e Final:</label>
                <div class="formRight mt12">
                    <span class="oneThree"><input placeholder="Hora Inicial" name="horaInicial" class="hora" type="text" id="horaInicial" value="" /></span>
                    <span class="oneThree"><input placeholder="Hora Final" name="horaFinal" class="hora" id="horaFinal" type="text" value="" /></span>
                </div>
                <div class="clear"></div>
            </div>

            <div class="clear"></div>
        </div>
    </fieldset>
    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Selecione as Disciplinas</h6></div>
            <div class="body">
                <div class="leftPart">
                    <div class="filter"><span>Filtro: </span><input type="text" id="box1Filter" class="boxFilter" /><input type="button" id="box1Clear" class="fBtn" value="x" /><div class="clear"></div></div>

                    <select id="box1View" multiple="multiple" class="multiple" style="height:300px;">
                        <?php foreach($cursos as $valor): ?>
                            <option value="<?php echo $valor->idCurso; ?>"><?php echo $valor->nome; ?></option>
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
                    <select id="box2View" multiple="multiple" name="idCurso[]" class="multiple" style="height:300px;">
                            
                    </select><br/>
                    <span id="box2Counter" class="countLabel"></span>

                    <div class="dn"><select id="box2Storage" name=""></select></div>
                </div>
                <div class="clear"></div>
                <div class="formSubmit">
                    <input type="submit" value="Salvar" class="blueB submit" />
                    <input type="reset" value="Cancelar" class="redB" />
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </fieldset>
</form>
<script>
    $(".hora").mask("99:99:99");
    $.configureBoxes();
    $("select, input:checkbox, input:radio, input:file").uniform();
    $("#validate").validationEngine();
</script>