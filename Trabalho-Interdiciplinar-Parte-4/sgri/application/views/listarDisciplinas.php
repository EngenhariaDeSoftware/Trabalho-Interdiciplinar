<script type="text/javascript" src="../theme/js/acoesComum.js"></script>
<!-- Search -->
<div class="searchWidget">
    <form action="disciplina/pesquisar" class="form" method="POST">
        <input type="text" name="pesquisa" class="pesquisa" id="pesquisa" placeholder="Pesquisar Cursos..." />
        <input type="submit" name="pesquisar" class="pesquisar" value="" />
    </form>
</div>
<div class="widget">
    <div class="title"><img src="../theme/images/icons/dark/full2.png" alt="" class="titleIcon" /><h6>Lista de Disciplinas</h6></div>                          
    <table cellpadding="0" cellspacing="0" border="0" class="display dTable">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Turno</th>
                <th>Hora Inicial</th>
                <th>Hora Final</th>
                <th>Curso</th>
                <td>Ações</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($disciplinas as $valor): ?>
                <tr class="gradeX">
                    <td><?php echo $valor->disciplinaNome; ?></td>
                    <td><?php echo ( $valor->turno == 1 ) ? "Manha" : ( $valor->turno == 2 ) ? "Tarde" : "Noite"; ?></td>
                    <td><?php echo $valor->horaInicial; ?></td>
                    <td><?php echo $valor->horaFinal; ?></td>
                    <td><?php echo $valor->cursoNome; ?></td>
                    <td class="actBtns" >
                        <?php if ($this->session->userdata('idAcesso') == 5): ?>
                        <a href="<?php echo $valor->idDisciplina; ?>" id="disciplina/formularioDisciplina/" title="Editar" class="tipS editar">
                            <img src="../theme/images/icons/edit.png" alt="" />
                        </a>
                        <a href="<?php echo $valor->idDisciplina; ?>" id="disciplina/deletar/" title="Remover" class="tipS deletar">
                            <img src="../theme/images/icons/remove.png" alt="" />
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>  
</div>
<input type="hidden" class="obter" id="disciplina/obterDisciplina" />
<script>
    oTable = $('.dTable').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>'
    });
</script>