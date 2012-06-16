<!-- Search -->
<div class="searchWidget">
    <form action="pessoa/pesquisar" class="form" method="POST">
        <input type="text" name="pesquisa" class="pesquisa" id="pesquisa" placeholder="Pesquisar Usuarios..." />
        <input type="submit" name="pesquisar" class="pesquisarPessoas" value="" />
        <div class="formRow">
            <div class="formRight">
                <input type="radio" name="opcao" checked="checked" id="opcao" value="pessoas.nome" /><label for="radio1">Nome</label>
                <input type="radio" name="opcao" id="opcao" value="pessoas.email" /><label for="radio2">Email</label>
                <input type="radio" name="opcao" id="opcao" value="cidades.nome" /><label for="radio3">Cidade</label>
                <input type="radio" name="opcao" id="opcao" value="usuarios.usuario" /><label for="radio4">Usuarios</label>
            </div><div class="clear"></div>
        </div>
        <div class="horControlB">
            <ul>
                <li><a href="pessoa/formularioPessoa" title=""><img src="../theme/images/icons/control/16/database.png" alt="" /><span>Novo</span></a></li>
                <li><a href="pessoa/obterPessoa" title=""><img src="../theme/images/icons/control/16/order-192.png" alt="" /><span>Listar</span></a></li>
            </ul>
        </div>
    </form>
</div>

<div class="body">
    <!-- Partners list widget -->
    <div class="widget">
        <div class="title"><img src="../theme/images/icons/dark/users.png" alt="" class="titleIcon" /><h6>Resultado Pesquisa Pessoas</h6></div>
        <ul class="partners">
            <?php foreach ($pessoas as $valor): ?>
                <li>
                    <div class="pInfo">
                        <p><strong>Nome: <?php echo $valor->pessoaNome; ?></strong></p>
                        <i><strong>Cargo: <?php echo $valor->acessoNome; ?></strong></i>
                        <i><strong>Email: <?php echo $valor->email; ?></strong></i>
                        <i><strong>Telefone: <?php echo $valor->telefone; ?></strong></i>
                        <i><strong>Celular: <?php echo $valor->celular; ?></strong></i>
                        <i><strong>CPF: <?php echo $valor->cpf; ?></strong></i>
                        <i><strong>Data Nacimento: <?php echo $valor->dataNacimento; ?></strong></i>
                        <i><strong>CEP: <?php echo $valor->cep; ?></strong></i>
                        <i><strong>Cidade: <?php echo $valor->cidadeNome; ?> ||| <?php echo $valor->uf; ?></strong></i>
                        <i><strong>Bairro: <?php echo $valor->bairro; ?></strong></i>
                        <i><strong>Endereço: <?php echo $valor->endereco; ?></strong></i>
                        <i><strong>Data Cadastro: <?php echo $valor->dataCadastro; ?></strong></i>
                        <p>
                            <a href="<?php echo $valor->idPessoa; ?>" title="Editar" class="tipS editar">
                                <img src="../theme/images/icons/edit.png" alt="" />
                            </a>
                            <a href="<?php echo $valor->idPessoa; ?>" title="Remover" class="tipS deletar">
                                <img src="../theme/images/icons/remove.png" alt="" />
                            </a>
                        </p>	
                    </div>
                    <div class="clear"></div>
                </li>

            <?php endforeach; ?>
        </ul>
    </div>                       
</div>
<script>

    $(".deletar").click(function(event){
        event.preventDefault();
        $(".bloqueador, .loading").css({
            "display":"block"
        }); 
        var aId = $(this).attr("href");
        var aUrl = "pessoa/deletar/";
        
        var hRef = $(this);
       
        var div = "<div/>";
        $( div ).dialog({
            modal: true,
            title:"Confirmação de Exclusão",
            width: 400,
            open: function (){
                $(this).html("<h6>Tem certeza que deseja excluir???<br /> Essa operação não será desfeita...</h6>");
                $(".bloqueador, .loading").css({
                    "display":"none"
                }); 
            }, 
            buttons: {
                Excluir: function() {
                    $(".bloqueador, .loading").css({
                        "display":"block"
                    }); 
                    $( this ).dialog( "close" );
                    $.post("../"+aUrl, { id : aId}, function(eData){
                        if(eData.sucesso)
                        {   
                            var cUrl = "pessoa/obterPessoa";
                            $.post("../"+cUrl, function(eeData){
                                $(".conteudo").html(eeData)
                            })
                        }
                        $(".bloqueador, .loading").css({
                            "display":"none"
                        }); 
                        
                    }, "json");
                },
                Cancelar: function() {
                    $( this ).dialog( "close" );
                }
            }
        });      
    });
    
    
    $(".editar").click(function(event){
        event.preventDefault();
        $(".bloqueador, .loading").css({
            "display":"block"
        }); 
        var aId = $(this).attr("href");
        var aUrl = "pessoa/formularioPessoa/";

        $.post("../"+aUrl, { id : aId}, function(eData){

            $(".conteudo").html(eData);
            $(".bloqueador, .loading").css({
                "display":"none"
            }); 
        });        
    });

    $(".pesquisarPessoas").click(function(event){
        event.preventDefault();
        
        var aUrl   = $(".form").attr("action");
        var data   = $(".form").serialize();
        var aValor = $(".pesquisa").val();

        if(aValor == "")
        {
            var div = "<div/>";
            $( div ).dialog({
                modal: true,
                title:"Alerta",
                width: 400,
                open: function (){
                    $(this).html("<h5>Digite algo para ser pesquisado...</h5>");
                }, 
                buttons: {
                    Fechar: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
            return false;
        }
        $(".bloqueador, .loading").css({
            "display":"block"
        }); 
        $.post("../"+aUrl, data, function(eData){
            $(".conteudo").html(eData);
            $(".bloqueador, .loading").css({
                "display":"none"
            }); 
 
        });


    });
    
    oTable = $('.dTable').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>'
    });
    $("select, input:checkbox, input:radio, input:file").uniform();
    
    $(".horControlB ul li a").click(function(event){

        $(".selected").children("li").removeClass("this");
        $(this).parent().addClass("this");
        event.preventDefault();
        var aUrl = $(this).attr("href");
        window.location.hash = aUrl;

        if(aUrl == "javascript:void(0);"){
            window.location.hash = "#inicio/inicial";
            return false;
        }

        $(".bloqueador, .loading").css({
            "display":"block"
        });        

        $.post("../"+aUrl, function(eData){
            $(".conteudo").html(eData);
            $(".bloqueador, .loading").css({
                "display":"none"
            }); 
        }).error(function() { 
            var div = "<div/>";
            $( div ).dialog({
                modal: true,
                width: 600,
                title: "Alerta de Informação",
                close: function(){
                    window.location.hash = "#inicio/inicial";
                    $.post("../inicio/inicial", function(eData){
                        $(".conteudo").html(eData);
                        $(".bloqueador, .loading").css({
                            "display":"none"
                        });
                    });
                } ,
                open: 
                function (){
                    $(".bloqueador, .loading").css({
                        "display":"none"
                    });
                    $(this).html("<center><h4 style='color:#FF0000;'>O endereço requisitado não existe!!!</h4></center");
                },
                buttons: {
                    Fechar: function() {
                        $( this ).dialog( "close" );
                    }
                }
            }); 
        });    
    });
</script>