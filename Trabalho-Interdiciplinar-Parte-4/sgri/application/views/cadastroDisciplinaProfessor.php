<!-- Form -->
<script type="text/javascript" src="../theme/js/formulario.js"></script>
<form action="professorDisciplina/salvar" id="validate" class="form" method="POST">
    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/list.png" alt="" class="titleIcon" /><h6>Cadastro de Cursos</h6></div>
            <div class="formRow">
                <label>Selecione o Professor:<span class="req">*</span></label>
                <div class="formRight">
                    <select name="idPessoa" id="idPessoa" class="chzn-select" >
                        <?php foreach($professores as $valor): ?>
                        <option value="<?php echo $valor->idPessoa; ?>"><?php echo $valor->pessoaNome; ?></option>
                        <?php endforeach; ?>
                    </select>           
                </div>             
                <div class="clear"></div>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Selecione as Disciplinas</h6></div>
            <div class="body">
                <div class="leftPart">
                    <div class="filter"><span>Filtro: </span><input type="text" id="box1Filter" class="boxFilter" /><input type="button" id="box1Clear" class="fBtn" value="x" /><div class="clear"></div></div>

                    <select  style="font-size: 12px; !important" id="box1View" multiple="multiple" class="multiple" style="height:300px;">
                        <?php foreach($desciplinas as $valor): ?>
                            <option value="<?php echo $valor->idDisciplina; ?>"><?php echo $valor->disciplinaNome." - ".$valor->cursoNome." - ".$valor->horaInicial." à ".$valor->horaFinal;; ?></option>
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
                    <select id="box2View" multiple="multiple" name="idDiciplina[]" class="multiple" style="height:300px;">
                            
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
    $( ".chzn-select" ).chosen();
    $.configureBoxes();
</script>