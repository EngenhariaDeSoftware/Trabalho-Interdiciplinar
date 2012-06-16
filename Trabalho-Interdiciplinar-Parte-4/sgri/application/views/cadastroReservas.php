<!-- Form -->
<script type="text/javascript" src="../theme/js/formulario.js"></script>
<div class="nNote nWarning">
    <p><strong>Aviso: </strong>Campos marcados com asterisco(*) são obrigatórios.</p>
</div>
<form action="reserva/salvar" id="validate" class="form" method="POST">
    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/list.png" alt="" class="titleIcon" /><h6>Cadastro de Reservas</h6></div>
            <div class="formRow">
                <label>Turma:<span class="req">*</span></label>
                <div class="formRight">
                    <select name="idTurma" id="idTurma" class="chzn-select" >
                        <option value="">Selecione a Turma</option>
                        <?php foreach ($turmas as $valor): ?>
                            <option value="<?php echo $valor->idTurma; ?>">
                                Turma: <?php echo $valor->turmaNome; ?> - 
                                Grupo: <?php echo $valor->grupo; ?> -
                                Curso: <?php echo $valor->cursoNome; ?> -
                                Disciplina: <?php echo $valor->disciplinaNome; ?>
                                 - Horario: De: <?php echo $valor->horaInicial; ?>
                                 às <?php echo $valor->horaFinal; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>           
                </div>             
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <label>Sala:<span class="req">*</span></label>
                <div class="formRight">
                    <select name="idSala" id="idSala" class="chzn-select" >
                        <option value="">Selecione a Sala</option>
                        <?php foreach ($salas as $valor): ?>
                            <option value="<?php echo $valor->idSala; ?>">
                                Predio: <?php echo $valor->predio; ?> - Andar: <?php echo $valor->andar; ?>
                                Numero: <?php echo $valor->numero; ?> - Tipo Sala: <?php echo $valor->tipoSala; ?>
                            </option>
                        <?php endforeach; ?>    
                    </select>
                </div>             
                <div class="clear"></div>
            </div>
            <div class="formRow dnone">
                <label>Data e Hora:<span class="req">*</span></label>
                <div class="formRight">
                    <span class="oneTwo"><input type="text" name="data" placeholder="Data" class="datepicker validate[required]" value="<?php echo date("d/m/Y"); ?>" /></span>
                    <span class="oneTwo"><input type="text" name="hora" placeholder="Hora" class="hora validate[required]" value="" /></span>
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>Observação:</label>
                <div class="formRight"><textarea rows="8" cols="" name="obs"></textarea></div>
                <div class="clear"></div>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Selecione os Equipamentos</h6></div>
            <div class="body">
                <div class="leftPart">
                    <div class="filter"><span>Filtro: </span><input type="text" id="box1Filter" class="boxFilter" /><input type="button" id="box1Clear" class="fBtn" value="x" /><div class="clear"></div></div>

                    <select id="box1View" multiple="multiple" class="multiple" style="height:300px;">
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
                    <select id="box2View" multiple="multiple" class="multiple" name="idEquipamento[]" style="height:300px;"></select><br/>
                    <span id="box2Counter" class="countLabel"></span>

                    <div class="dn"><select name="" id="box2Storage"></select></div>
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
    $( '#idSala' ).change( function() {
    
        var id = $( this ).val();
        var aUrl = "salaProfessorDisciplina/obterHorarioDisciplina"
        
        
        $.post("../"+aUrl, {id : id}, function(eData){
            
            if( eData.sucesso )
            {
                if( eData.temMaisDoisRegistro )
                {
                    var i = 0;
                    var valores = new Array();
                    for(i in eData.idsDisciplina){
                        valores[i] = eData.idsDisciplina[i];
                        i++;
                    }
                    $(".bloqueador, .loading").css({
                        "display":"block"
                    }); 
                    var div = "<div/>";
                    $( div ).dialog({
                        modal: true,
                        width: 600,
                        title: "Detalhes",
                        open: 
                            function (){
                            var aThis = $(this);
                            $(this).html(eData.Mensagem);
                            
                            $.post("../"+eData.url, {'ids[]':valores}, function(eeData){
                                aThis.append(eeData);
                            });
      
                            $(".bloqueador, .loading").css({
                                "display":"none"
                            });
                        }, 
                        buttons: {
                            Cancelar: function() {
                                $( this ).dialog( "close" );
                            }
                        }
                    });   
                } else {
                    $(".hora").val(eData.horaInicial);
                }
                
            }
            /*
            var select = "";
            for(i in eData)
            {
                select += '<option value='+eData[i]['idCidade']+'>'+eData[i]['nome']+'</option>';
                
            }
            
            $("#cidade").html(select);
            
            $("#cidade").addClass("chzn-select");
            $( ".chzn-select" ).chosen();
             */
        },"json");
        
    });
    
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