<script type="text/javascript" src="../theme/js/acoesComum.js"></script>
<div class="widget">

    <div class="title"><img src="../theme/images/icons/dark/full2.png" alt="" class="titleIcon" /><h6>Lista de Professores Relacionadas a sua Sala e Disciplina</h6></div>                          

    <table cellpadding="0" cellspacing="0" border="0" class="display dTable">
        <thead>
            <tr>
                <td>Predio</td>
                <td>Andar</td>
                <td>Numero</td>
                <td>Tipo</td>
                <td>Capacidade</td>
                <td>Professores</td>
                <td>Disciplinas</td>
                <td>Horarios</td>
                <td>Ações</td>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($datas as $valor): ?>
                <tr class="gradeX">
                    <td><?php echo $valor->predio; ?></td>
                    <td><?php echo $valor->andar; ?></td>
                    <td><?php echo $valor->numero; ?></td>
                    <td>
                        <?php if ($valor->tipoSala == 0): ?>
                            Sala Normal
                        <?php elseif ($valor->tipoSala == 1): ?>
                            Laboratório
                        <?php elseif ($valor->tipoSala == 2): ?>
                            Auditório
                        <?php elseif ($valor->tipoSala == 3): ?>
                            Sala Especial
                        <?php endif; ?>
                    </td>
                    <td><?php echo $valor->capacidade; ?></td>
                    <td><?php echo $valor->pessoaNome; ?></td>
                    <td><?php echo $valor->disciplinaNome; ?></td>
                    <td>De: <?php echo $valor->horaInicial; ?> às <?php echo $valor->horaFinal; ?></td>
                    <td class="actBtns">
                        <?php if ($this->session->userdata('idAcesso') == 5): ?>
                        <a href="<?php echo $valor->idSalaProfessorDisciplina; ?>" id="salaProfessorDisciplina/formularioSalaProfessorDisciplina/" title="Editar" class="tipS editar">
                            <img src="../theme/images/icons/edit.png" alt="" />
                        </a>
                        <a href="<?php echo $valor->idSalaProfessorDisciplina; ?>" id="sala/deletar/" title="Remover" class="tipS deletar">
                            <img src="../theme/images/icons/remove.png" alt="" />
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
    oTable = $('.dTable').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>'
    });
</script>