<div class="widget">
    <div class="title"><img src="../theme/images/icons/dark/full2.png" alt="" class="titleIcon" /><h6>Lista de Disciplinas</h6></div>                          
    <table cellpadding="0" cellspacing="0" border="0" class="display">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Hora Inicial</th>
                <th>Hora Final</th>
                <td>Selecionar</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($disciplinas as $valor): ?>
                <tr class="gradeX">
                    <td><?php echo $valor["nome"]; ?></td>
                    <td><?php echo $valor["horaInicial"]; ?></td>
                    <td><?php echo $valor["horaFinal"]; ?></td>
                    <td class="actBtns" >
                        <a href="<?php echo $valor["horaInicial"]; ?>" id="disciplina/formularioDisciplina/" title="Selecionar Esse" class="tipS selecionar">
                            <img src="../theme/images/icons/dropped.png" alt="" />
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>  
</div>
<script>
    $(".selecionar").click(function(event){
        event.preventDefault();
        $(".hora").val($(this).attr("href"));
        $( this ).parent().parent().parent().parent().parent().parent().dialog( "close" );
    });
</script>
