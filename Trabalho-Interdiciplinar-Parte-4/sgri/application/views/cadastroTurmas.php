<!-- Form -->
<script type="text/javascript" src="../theme/js/formulario.js"></script>
<div class="nNote nWarning">
    <p><strong>Aviso: </strong>Campos marcados com asterisco(*) são obrigatórios.</p>
</div>
<form action="turma/salvar" id="validate" class="form" method="POST">
    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/list.png" alt="" class="titleIcon" /><h6>Cadastro de Turmas</h6></div>

            <div class="formRow">
                <label>Nome<span class="req">*</span></label>
                <div class="formRight"><input name="nome" id="nome" type="text" class="validate[required]" /></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <label>Grupo<span class="req">*</span></label>
                <div class="formRight"><input name="grupo" id="grupo" type="text" class="validate[required]" /></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <label>Professor:<span class="req">*</span></label>
                <div class="formRight">
                    <select name="idPessoa" id="idPessoa" class="chzn-select idPessoa" >
                        <option>Selecione um Professor</option>
                        <?php foreach($professores as $valor): ?>
                        <option value="<?php echo $valor->idPessoa; ?>"><?php echo $valor->pessoaNome; ?></option>
                        <?php endforeach; ?>
                    </select>           
                </div>            
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>Disciplina:<span class="req">*</span></label>
                <div class="formRight">
                    <select name="idDisciplina" id="idDisciplina" >
                    </select>  
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
<script type="text/javascript">
   $(".idPessoa").change(function(){
       var aId = $(this).val();
       var aUrl = "ProfessorDisciplina/obterDisciplinaProfessor";
       
       $.post("../"+aUrl, {id : aId }, function(eData){
           
           var select = "";
            for(i in eData)
            {
                select += '<option value='+eData[i]['disciplinaId']+'>'
                    +eData[i]['disciplinaNome']+": >> :"+eData[i]['cursoNome']+
                    '</option>';
                
            }
            
            $("#idDisciplina").html(select);
            
            $("#idDisciplina").addClass("chzn-select");
            $( ".chzn-select" ).chosen();
           
       }, "json");
       
    });
    
    $("#validate").validationEngine();    
    $( ".chzn-select" ).chosen();


</script>