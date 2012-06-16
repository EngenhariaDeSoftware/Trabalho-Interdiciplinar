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
    <div class="horControlB">
        <ul>
            <li><a href="turma/formularioTurma" title=""><img src="../theme/images/icons/control/16/database.png" alt="" /><span>Novo</span></a></li>
            <li><a href="turma/obterTurma" title=""><img src="../theme/images/icons/control/16/order-192.png" alt="" /><span>Listar</span></a></li>
        </ul>
    </div>
</div>


<div class="body">
    <!-- Partners list widget -->
    <div class="widget">
        <div class="title"><img src="../theme/images/icons/dark/users.png" alt="" class="titleIcon" /><h6>Resultado Pesquisa Disciplinas</h6></div>
        <ul class="partners">
            <?php foreach ($turmas as $valor): ?>
            <li>
                <div class="pInfo">
                    <p><strong><?php echo $valor->turmaNome; ?></strong></p>
                    <i><strong><?php echo $valor->grupo; ?></strong></i>
                    <i><strong><?php echo $valor->pessoaNome; ?></strong></i>
                    <i><strong><?php echo $valor->disciplinaNome; ?></strong></i>
                    <?php if ($this->session->userdata('idAcesso') == 5): ?>
                    <p>
                        <a href="<?php echo $valor->idTurma; ?>" id="turma/formularioTurma/" title="Editar" class="tipS editar">
                            <img src="../theme/images/icons/edit.png" alt="" />
                        </a>
                        <a href="<?php echo $valor->idTurma; ?>" id="turma/deletar/" title="Remover" class="tipS deletar">
                            <img src="../theme/images/icons/remove.png" alt="" />
                        </a>
                    </p>	
                    <?php endif; ?>
                </div>
                <div class="clear"></div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>                       
</div>
<input type="hidden" class="obter" id="turma/obterTurma" />
<script>
    oTable = $('.dTable').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>'
    });
    $("select, input:checkbox, input:radio, input:file").uniform();
</script>