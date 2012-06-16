<!-- Form -->
<div class="nNote nWarning">
    <p><strong>Aviso: </strong>Campos marcados com asterisco(*) são obrigatórios.</p>
</div>
<form action="usuario/salvarUsuarioXml" id="validate" class="form2" method="POST">
    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/record.png" alt="" class="titleIcon" /><h6>Acesso Sistema</h6></div>
            <div class="formRow">
                <label>Usuario<span class="req">*</span></label>
                <div class="formRight"><input name="usuario" id="usuario" class="validate[required]" type="text" value="" /></div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>Senha<span class="req">*</span></label>
                <div class="formRight">
                    <input name="senha" id="senha" class="validate[required]" type="password" value="<?php echo $senha; ?>" />
                    <span class="formNote">Esta é a Senha Gerada: <b><?php echo $senha; ?></b></span>
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>Tipo Usuario:<span class="req">*</span></label>
                <div class="formRight">
                    <select name="idAcesso" id="idAcesso" class="chzn-selects idAcesso" >
                        <?php foreach ($acessos as $data): ?>
                            <option value="<?php echo $data->idAcesso; ?>"><?php echo $data->nome; ?></option>
                        <?php endforeach; ?>
                    </select>           
                </div>             
                <div class="clear"></div>
            </div>

            <div class="formSubmit">
                <input type="hidden" value="<?php echo $id; ?>" name="idPessoa"/>
                <input type="submit" value="Salvar" class="blueB submit" />
            </div>
            <div class="clear"></div>
        </div>
    </fieldset>

</form>
<script>
    //$( ".chzn-selects" ).chosen();
   /*Submit formulario*/
    $(".form2").submit(function(){
        
        var aThis = $(this);
        //Ir para o topo
        $('html,body').animate({scrollTop: $('html,body').offset().top}, 500);
        var aUrl = $(this).attr("action");
        var data = $(this).serialize();

        $(".bloqueador, .loading").css({
            "display":"block"
        });        
        
        $.post( "../"+aUrl, data, function(eData){
            if(eData.sucesso){
                
                aThis.parent().dialog("close");
                if(eData.redirecionar)
                {
                    $.post("../"+eData.url, function(eeData){
                        $(".conteudo").html(eeData);
                    });
                }
            }

            $(".mensagem").removeClass("nSuccess");
            $(".mensagem").removeClass("nFailure");
            $(".mensagem").addClass(eData.tipo);
            $(".mensagem").css({
                "display":"block"
            });
            $(".notificacao").html(eData.Mensagem);
            $(".bloqueador, .loading").css({
                "display":"none"
            });

        }, "json" );

        return false;

    });
    
    $("#validate").validationEngine();
    
    

</script>