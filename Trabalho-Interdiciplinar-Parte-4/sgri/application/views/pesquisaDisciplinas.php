<script type="text/javascript" src="../theme/js/acoesComum.js"></script>
<!-- Search -->
<div class="searchWidget">
    <form action="disciplina/pesquisar" class="form" method="POST">
        <input type="text" name="pesquisa" class="pesquisa" id="pesquisa" placeholder="Pesquisar Cursos..." />
        <input type="submit" name="pesquisar" class="pesquisar" value="" />
        <div class="horControlB">
            <ul>
                <li><a href="disciplina/formularioDisciplina" title=""><img src="../theme/images/icons/control/16/database.png" alt="" /><span>Novo</span></a></li>
                <li><a href="disciplina/obterDisciplina" title=""><img src="../theme/images/icons/control/16/order-192.png" alt="" /><span>Listar</span></a></li>
            </ul>
        </div>
    </form>
</div>

<div class="body">
    <!-- Partners list widget -->
    <div class="widget">
        <div class="title"><img src="../theme/images/icons/dark/users.png" alt="" class="titleIcon" /><h6>Resultado Pesquisa Disciplinas</h6></div>
        <ul class="partners">
            <?php foreach ($disciplinas as $valor): ?>
                <li>
                    <div class="pInfo">
                        <p><strong>Nome: <?php echo $valor->disciplinaNome; ?></strong></p>
                        <i><strong>Turno: <?php echo $valor->turno; ?></strong></i>
                        <i><strong>Hora Inicial: <?php echo $valor->horaInicial; ?></strong></i>
                        <i><strong>Hora Final: <?php echo $valor->horaFinal; ?></strong></i>
                        <i><strong>Curso: <?php echo $valor->cursoNome; ?></strong></i>
                        <p>
                            <a href="<?php echo $valor->idDisciplina; ?>" id="disciplina/formularioDisciplina/" title="Editar" class="tipS editar">
                                <img src="../theme/images/icons/edit.png" alt="" />
                            </a>
                            <a href="<?php echo $valor->idDisciplina; ?>" id="disciplina/deletar/" title="Remover" class="tipS deletar">
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
<input type="hidden" class="obter" id="disciplina/obterDisciplina" />
<script>
    oTable = $('.dTable').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>'
    });
    $("select, input:checkbox, input:radio, input:file").uniform();
</script>