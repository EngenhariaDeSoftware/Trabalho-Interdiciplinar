<div class="widget">
    <div class="title"><img src="../theme/images/icons/dark/full2.png" alt="" class="titleIcon" /><h6>Minhas Turmas</h6></div>                          
    <table cellpadding="0" cellspacing="0" border="0" class="display dTableTurmas">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Grupo</th>
                <th>Curso</th>
                <th>Disciplina</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($turmas as $valor): ?>            
            <tr class="gradeU">
                <td class="center"><?php echo $valor->turmaNome; ?></td>
                <td class="center"><?php echo $valor->grupo; ?></td>
                <td class="center"><?php echo $valor->cursoNome; ?></td>
                <td class="center"><?php echo $valor->disciplinaNome; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="widget">
    <div class="title"><img src="../theme/images/icons/dark/full2.png" alt="" class="titleIcon" /><h6>Equipamentos Disponíveis</h6></div>                          
    <table cellpadding="0" cellspacing="0" border="0" class="display dTableTurmas">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nome</th>
                <th>Data Cadastro</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($equipamentos as $valor): ?>            
            <tr class="gradeA">
                <td class="center"><?php echo $valor->codigoPatrimonio; ?></td>
                <td class="center"><?php echo $valor->nome; ?></td>
                <td class="center"><?php echo $valor->dataCadastro; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="widget">
    <div class="title"><img src="../theme/images/icons/dark/full2.png" alt="" class="titleIcon" /><h6>Equipamentos em Manutenção</h6></div>                          
    <table cellpadding="0" cellspacing="0" border="0" class="display dTableTurmas">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nome</th>
                <th>Data Cadastro</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($equipamentosManutencao as $valor): ?>            
            <tr class="gradeC">
                <td class="center"><?php echo $valor->codigoPatrimonio; ?></td>
                <td class="center"><?php echo $valor->nome; ?></td>
                <td class="center"><?php echo $valor->dataCadastro; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function(){
    
        oTable = $('.dTableTurmas').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "sDom": '<""l>t<"F"fp>'
        });
    })
</script>