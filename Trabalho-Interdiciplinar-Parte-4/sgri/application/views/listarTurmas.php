<script type="text/javascript" src="../theme/js/acoesComum.js"></script>
<!-- Search -->
<div class="searchWidget">
    <form action="turma/pesquisar" class="form" method="POST">
        <input type="text" name="pesquisa" class="pesquisa" id="pesquisa" placeholder="Pesquisar Turmas..." />
        <input type="submit" name="pesquisar" class="pesquisarPessoas" value="" />
        <div class="formRow">
            <div class="formRight">
                <input type="radio" name="opcao" checked="checked" id="opcao" value="nome" /><label for="radio1">Nome</label>
                <input type="radio" name="opcao" id="opcao" value="grupo" /><label for="radio2">Grupo</label>
            </div><div class="clear"></div>
        </div>
    </form>
</div>

<div class="widget">
    <div class="title"><img src="../theme/images/icons/dark/full2.png" alt="" class="titleIcon" /><h6>Lista de Reservas</h6></div>                          
    <table cellpadding="0" cellspacing="0" border="0" class="display dTable">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Grupo</th>
                <th>Professor</th>
                <th>Disciplina</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($turmas as $valor): ?>
            <tr class="gradeX">
                <td><?php echo $valor->turmaNome; ?></td>
                <td><?php echo $valor->grupo; ?></td>
                <td class="center"><?php echo $valor->pessoaNome; ?></td>
                <td class="center"><?php echo $valor->disciplinaNome; ?></td>

                <td class="actBtns">
                    <?php if ($this->session->userdata('idAcesso') == 5): ?>
                    <a href="<?php echo $valor->idTurma; ?>" id="turma/formularioTurma/" title="Editar" class="tipS editar">
                        <img src="../theme/images/icons/edit.png" alt="" />
                    </a>
                    <a href="<?php echo $valor->idTurma; ?>" id="turma/deletar/" title="Remover" class="tipS deletar">
                        <img src="../theme/images/icons/remove.png" alt="" />
                    </a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>  
</div>
<input type="hidden" class="obter" id="turma/obterTurma" />
<script>
    oTable = $('.dTable').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>'
    });
    $("select, input:checkbox, input:radio, input:file").uniform();
    
    $(".hora").mask("99:99:99");
    
    $( ".datepicker" ).datepicker({ 
        defaultDate: +7,
        autoSize: true,
        appendText: '(dd/mm/yyyy)',
        dateFormat: 'dd/mm/yy'
    });	
</script>