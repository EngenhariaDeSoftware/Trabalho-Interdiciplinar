<script type="text/javascript" src="../theme/js/acoesComum.js"></script>
<div class="widget">

    <div class="title"><img src="../theme/images/icons/dark/full2.png" alt="" class="titleIcon" /><h6>Lista de Professores Relacionados ao Curso e Disciplina</h6></div>                          

    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
        <thead>
            <tr>
                <td>ID</td>
                <td>Professores</td>
                <td>Ações</td>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($datas as $valor): ?>
                <tr class="gradeX">
                    <td><?php echo $valor->idPessoa; ?></td>
                    <td><?php echo $valor->pessoaNome; ?></td>
                    <td>
                        <a href="professorDisciplina/obterDisciplinaPorProfessor/" id="<?php echo $valor->idPessoa; ?>" title="Ver Relação" class="tipS relacao">
                            <img src="../theme/images/icons/notifications/information.png" alt="" />
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <hr />

</div>
<input type="hidden" class="obter" id="professorDisciplina/obterProfessorDisciplina" />
<script>
    /*
    oTable = $('.sTable').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>'
    });*/
</script>