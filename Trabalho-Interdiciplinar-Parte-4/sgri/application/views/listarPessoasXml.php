<script type="text/javascript" src="../theme/js/acoesComum.js"></script>
<div class="widget">
    <div class="title"><img src="../theme/images/icons/dark/full2.png" alt="" class="titleIcon" /><h6>Lista de Pessoas Sem Usuários</h6></div>                          
    <table cellpadding="0" cellspacing="0" border="0" class="display dTable">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pessoas as $valor): ?>
                <tr class="gradeX">
                    <td><?php echo $valor->nome; ?></td>
                    <td><?php echo $valor->email; ?></td>
                    <td><?php echo $valor->telefone; ?></td>
                    <td class="actBtns">
                        <a href="pessoa/formAddUsuario/" id="<?php echo $valor->idPessoa; ?>" title="Adicionar Usuario" class="tipS addUsers">
                            <img src="../theme/images/icons/add.png" alt="" />
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>  
</div>
<script>
    $(".addUsers").click(function(event){
        event.preventDefault();
        $(".bloqueador, .loading").css({
            "display":"block"
        }); 
        var aId = $(this).attr("id");
        var aUrl = $(this).attr("href");

        $.post("../"+aUrl, {
            id : aId
        }, function(eData){

            var div = "<div/>";
            $( div ).dialog({
                modal: true,
                width: 800,
                title: "Adicionar Usuarios",
                open: 
                function (){
                    
                    $(this).html(eData);
                    $(".bloqueador, .loading").css({
                        "display":"none"
                    });
                }, 
                buttons: {
                    Fechar: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        });
    });
    
    
    oTable = $('.dTable').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>'
    });
    $("select, input:checkbox, input:radio, input:file").uniform();
</script>