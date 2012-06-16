<!-- Form -->
<script type="text/javascript" src="../theme/js/formulario.js"></script>
<div class="nNote nWarning">
    <p><strong>Aviso: </strong>Campos marcados com asterisco(*) são obrigatórios.</p>
</div>
<form action="pessoa/salvar" id="validate" class="form" method="POST">
    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/list.png" alt="" class="titleIcon" /><h6>Cadastro Usuarios</h6></div>
            <div class="formRow">
                <label>Nome:<span class="req">*</span></label>
                <div class="formRight"><input type="text" class="validate[required]" name="nome" id="nome" value="" /></div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label for="labelFor">Email<span class="req">*</span></label>
                <div class="formRight"><input type="text" class="validate[required,custom[email]]" name="email" id="emailValid" value="" /></div>
                <div class="clear"></div>
            </div>
            <div class="formRow dnone">
                <label>Telefones:</label>
                <div class="formRight">
                    <span class="oneTwo"><input name="telefone" class="maskPhone" id="telefone" placeholder="Telefone Residencial" type="text" value="" /></span>
                    <span class="oneTwo"><input name="celular" class="maskPhone" id="celular" placeholder="Telefone Celular"  type="text" value="" /></span>
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow dnone">
                <label>CPF - Data Nacimento - CEP:</label>
                <div class="formRight mt12">
                    <span class="oneThree"><input placeholder="CPF" name="cpf" class="cpf" type="text" id="cpf" value="" /></span>
                    <span class="oneThree"><input placeholder="Data Nacimento" name="dataNacimento" class="date" id="dataNacimento" type="text" value="" /></span>
                    <span class="oneThree"><input placeholder="cep" name="cep" type="text" class="cep" id="cep" value="" /></span>
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>Estado:<span class="req">*</span></label>
                <div class="formRight">
                    <select name="estado" id="estado" class="chzn-select" >
                        <option value="">Selecione um Estado</option>
                        <option value="1">Acre</option>
                        <option value="2">Alagoas</option>
                        <option value="3">Amazonas</option>
                        <option value="4">Amapá</option>
                        <option value="5">Bahia</option>
                        <option value="6">Ceará</option>
                        <option value="7">Distrito Federal</option>
                        <option value="8">Espírito Santo</option>
                        <option value="9">Goiás</option>
                        <option value="10">Maranhão</option>
                        <option value="13">Mato Grosso</option>
                        <option value="12">Mato Grosso do Sul</option>
                        <option value="11">Minas Gerais</option>
                        <option value="14">Pará</option>
                        <option value="15">Paraíba</option>
                        <option value="16">Paraná</option>
                        <option value="17">Pernambuco</option>
                        <option value="18">Piauí</option>
                        <option value="19">Rio de Janeiro</option>
                        <option value="20">Rio Grande do Norte</option>
                        <option value="21">Rondônia</option>
                        <option value="22">Rio Grande do Sul</option>
                        <option value="23">Roraima</option>
                        <option value="24">Santa Catarina</option>
                        <option value="25">Sergipe</option>
                        <option value="26">São Paulo</option>
                        <option value="27">Tocantins</option>
                    </select>           
                </div>             
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>Cidade:<span class="req">*</span></label>
                <div class="formRight">
                    <select name="cidade" id="cidade">
                    </select>           
                </div>             
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>Bairro</label>
                <div class="formRight"><input name="bairro" id="bairro" type="text" value="" /></div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>Endereço</label>
                <div class="formRight"><input name="endereco" id="endereco" type="text" value="" /></div>
                <div class="clear"></div>
            </div>
        </div>
    </fieldset>

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
                <div class="formRight"><input name="senha" id="senha" class="validate[required]" type="password" value="" /></div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>Tipo Usuario:<span class="req">*</span></label>
                <div class="formRight">
                    <select name="idAcesso" id="idAcesso" class="chzn-select idAcesso" >
                        <option value="">Selecione uma opção</option>
                        <?php foreach ($acessos as $data): ?>
                            <option value="<?php echo $data->idAcesso; ?>"><?php echo $data->nome; ?></option>
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
        </div>
    </fieldset>

</form>
<script>
   
    $(".maskPhone").mask("(99) 9999-9999");
    $(".cpf").mask("999.999.999-99");
    $(".date").mask("99/99/9999");
    $(".cep").mask("99 999-999");
    
    $("#validate").validationEngine();
    
    $( '#estado' ).change( function() {
    
        var idEstado = $( this ).val();
        var aUrl     = "estado/obterCidades"
        
        
        $.post("../"+aUrl, {idEstado : idEstado}, function(eData){
            
            var select = "";
            for(i in eData)
            {
                select += '<option value='+eData[i]['idCidade']+'>'+eData[i]['nome']+'</option>';
                
            }
            
            $("#cidade").html(select);
            
            $("#cidade").addClass("chzn-select");
            $( ".chzn-select" ).chosen();
        },"json");
        
    });

    $( ".chzn-select" ).chosen();

</script>