<div class="widget">
    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
        <thead>
            <tr>
                <td>Cursos</td>
                <td>Disciplinas</td>
                <td>Horarios</td>
                <td>Ações</td>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($datas as $valor): ?>
                <tr class="gradeX">
                    <td><?php echo $valor->cursoNome; ?></td>
                    <td><?php echo $valor->disciplinaNome; ?></td>
                    <td>De: <?php echo $valor->horaInicial; ?> às <?php echo $valor->horaFinal; ?></td>
                    <td>
                        <?php if ($this->session->userdata('idAcesso') == 5): ?>
                        <a href="<?php echo $valor->idProfessorDisciplina; ?>" id="professorDisciplina/deletar" title="Excluir" class="tipS excluirProfessorDisciplina">
                            <img src="../theme/images/icons/notifications/exclamation.png" alt="" />
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <hr />
</div>
<input type="hidden" class="obter" id="curso/obterCurso" />
<script>
    
    $(".excluirProfessorDisciplina").click(function(event){
       var hThis = $( this );
        
        var cUrl = $(this)
        event.preventDefault();
        $(".bloqueador, .loading").css({
            "display":"block"
        }); 
        var aId = $(this).attr("href");
        var aUrl = $(this).attr("id");
        
        var hRef = $(this);
       
        var div = "<div/>";
        $( div ).dialog({
            modal: true,
            title:"Confirmação de Exclusão",
            width: 400,
            open: function (){
                $(this).html("<h5>Tem certeza que deseja excluir???<br /> Essa operação não será desfeita...</h5>");
                $(".bloqueador, .loading").css({
                    "display":"none"
                }); 
            }, 
            buttons: {
                Excluir: function() {
                    hThis.parent().parent().parent().parent().parent().parent().dialog( "close" );
                    $(".bloqueador, .loading").css({
                        "display":"block"
                    }); 
                    $( this ).dialog( "close" );
                    $.post("../"+aUrl, {
                        id : aId
                    }, function(eData){
                        if(eData.sucesso)
                        {
                            var cUrl = $(".obter").attr("id");
                            $.post("../"+cUrl, function(eeData){
                                $(".conteudo").html(eeData)
                            })
                        }
                        $(".bloqueador, .loading").css({
                            "display":"none"
                        }); 
                        $(".mensagem").removeClass("nSuccess");
                        $(".mensagem").removeClass("nFailure");
                        $(".mensagem").addClass(eData.tipo);
                        $(".mensagem").css({
                            "display":"block"
                        });
                        $(".notificacao").html(eData.Mensagem);

                        
                    }, "json");
                },
                Cancelar: function() {
                    $( this ).dialog( "close" );
                }
            }
        });     
    });

</script>