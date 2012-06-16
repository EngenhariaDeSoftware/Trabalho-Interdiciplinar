<!-- Form -->
<?php foreach($cursos as $valor): ?>
<script type="text/javascript" src="../theme/js/formulario.js"></script>
<div class="nNote nWarning">
    <p><strong>Aviso: </strong>Campos marcados com asterisco(*) são obrigatórios.</p>
</div>
<form action="curso/atualizar" id="validate" class="form" method="POST">
    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/list.png" alt="" class="titleIcon" /><h6>Edição Cursos</h6></div>
            <div class="formRow">
                <label>Nome:<span class="req">*</span></label>
                <div class="formRight"><input type="text" class="validate[required]" name="nome" id="nome" value="<?php echo $valor->nome; ?>" /></div>
                <div class="clear"></div>
            </div>
            <div class="formSubmit">
                <input type="hidden" name="id" value="<?php echo $valor->idCurso; ?>" />
                <input type="submit" value="Salvar" class="blueB submit" />
                <input type="reset" id="curso/obterCurso" value="Voltar" class="redB voltar" />
            </div>
            <div class="clear"></div>
        </div>
    </fieldset>
</form>
<?php endforeach; ?>
<script>
    
    //Uma pra todos
    $(".voltar").click(function(){
        var aUrl = $(this).attr("id");
        $.post("../"+aUrl, function(eData){
            $(".conteudo").html(eData);
        });
    });
    
    $("#validate").validationEngine();
</script>