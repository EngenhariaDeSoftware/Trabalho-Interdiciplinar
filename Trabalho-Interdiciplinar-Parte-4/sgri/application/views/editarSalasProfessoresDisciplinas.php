<!-- Form -->
<?php foreach($datas as $data): ?>
<script type="text/javascript" src="../theme/js/formulario.js"></script>
<form action="salaProfessorDisciplina/atualizar" id="validate" class="form" method="POST">
    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/list.png" alt="" class="titleIcon" /><h6>Professores Disciplinas e Salas</h6></div>
            <div class="formRow">
                <label>Selecione o Professor:<span class="req">*</span></label>
                <div class="formRight">
                    <select name="idPessoa" id="idPessoa" class="chzn-select idPessoa" >
                        <option value="<?php echo $data->idPessoa; ?>"><?php echo $data->pessoaNome; ?></option>
                        <option>Selecione um Professor</option>
                        <?php foreach ($professores as $valor): ?>
                            <option value="<?php echo $valor->pessoaIdPessoa; ?>"><?php echo $valor->pessoaNome; ?></option>
                        <?php endforeach; ?>
                    </select>           
                </div>             
                <div class="clear"></div>
            </div>
        </div>
    </fieldset>
    
    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/list.png" alt="" class="titleIcon" /><h6>Professores Disciplinas e Salas</h6></div>
            <div class="formRow">
                <label>Selecione a Disciplina:<span class="req">*</span></label>
                <div class="formRight">
                    <select name="idDisciplina" id="idDisciplina" >
                        <option value="<?php echo $data->idDisciplina; ?>"><?php echo $data->disciplinaNome; ?></option>
                    </select>           
                </div>           
                <div class="clear"></div>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/list.png" alt="" class="titleIcon" /><h6>Professores Disciplinas e Salas</h6></div>
            <div class="formRow">
                <label>Selecione a Sala:<span class="req">*</span></label>
                <div class="formRight">
                    <select name="idSala" id="idSala" class="chzn-select" >
                        
                        <option value="<?php echo $data->idSala; ?>">
                            Predio: <?php echo $data->predio; ?>||
                            Andar:  <?php echo $data->andar; ?>||
                            Numero: <?php echo $data->numero; ?>||
                            Tipo Sala: 
                            <?php if ($data->tipoSala == 0): ?>
                                Sala Normal
                            <?php elseif ($data->tipoSala == 1): ?>
                                Laboratório
                            <?php elseif ($data->tipoSala == 2): ?>
                                Auditório
                            <?php elseif ($data->tipoSala == 3): ?>
                                Sala Especial
                            <?php endif; ?>||
                                Capacidade: <?php echo $data->capacidade; ?>
                        </option>
                        
                        <option>-------------------------------------</option>
                        
                        
                        <?php foreach ($salas as $valor): ?>
                            <option value="<?php echo $valor->idSala; ?>">
                                Predio: <?php echo $valor->predio; ?>||
                                Andar:  <?php echo $valor->andar; ?>||
                                Numero: <?php echo $valor->numero; ?>||
                                Tipo Sala: 
                                <?php if ($valor->tipoSala == 0): ?>
                                    Sala Normal
                                <?php elseif ($valor->tipoSala == 1): ?>
                                    Laboratório
                                <?php elseif ($valor->tipoSala == 2): ?>
                                    Auditório
                                <?php elseif ($valor->tipoSala == 3): ?>
                                    Sala Especial
                                <?php endif; ?>||
                                Capacidade: <?php echo $valor->capacidade; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>           
                </div>           
                <br />
                <br />
                <div class="formSubmit">
                    <input type="text" name="id" value="<?php echo $data->spdId; ?>" />
                    <input type="submit" value="Salvar" class="blueB submit" />
                    <input type="reset" value="Cancelar" class="redB" />
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </fieldset>
</form>
<?php endforeach; ?>
<script>
    
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
    
    $( ".chzn-select" ).chosen();
    $.configureBoxes();
</script>