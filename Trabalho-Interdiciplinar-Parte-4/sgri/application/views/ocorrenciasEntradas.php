<script type="text/javascript" src="../theme/js/acoesComum.js"></script>
<!-- Search -->
<div class="searchWidget">
    <form action="ocorrencia/pesquisar" class="form" method="POST">
        <input type="text" name="pesquisa" class="pesquisa" id="pesquisa" placeholder="Pesquisar Ocorrencias..." />
        <input type="submit" name="pesquisar" class="pesquisar" value="" />
    </form>
</div>
<div class="widget">

    <div class="title"><img src="../theme/images/icons/dark/full2.png" alt="" class="titleIcon" /><h6>Ocorrências Recebidas</h6></div>                          
    <table cellpadding="0" cellspacing="0" border="0" class="display dTable">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Data</th>
                <th>Quem Enviou</th>
                <td>Ações</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $valor): ?>
                <tr class="gradeX">
                    <td><?php echo $valor->descricao; ?></td>
                    <td><?php echo $valor->data; ?></td>
                    <td><?php echo $valor->meEnviou; ?></td>
                    <td class="actBtns" >
                        <a href="<?php echo $valor->idOcorrencia; ?>" id="ocorrencia/deletar/" title="Remover" class="tipS deletar">
                            <img src="../theme/images/icons/remove.png" alt="" />
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>  
</div>
<input type="hidden" class="obter" id="ocorrencia/formularioOcorrencias" />
<script>
    oTable = $('.dTable').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>'
    });
</script>