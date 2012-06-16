<script type="text/javascript" src="../theme/js/acoesComum.js"></script>
<!-- Search -->
<div class="searchWidget">
    <form action="pessoa/pesquisar" class="form" method="POST">
        <input type="text" name="pesquisa" class="pesquisa" id="pesquisa" placeholder="Pesquisar Usuarios..." />
        <input type="submit" name="pesquisar" class="pesquisarPessoas" value="" />
        <div class="formRow">
            <div class="formRight">
                <input type="radio" name="opcao" checked="checked" id="opcao" value="pessoas.nome" /><label for="radio1">Nome</label>
                <input type="radio" name="opcao" id="opcao" value="pessoas.email" /><label for="radio2">Email</label>
                <input type="radio" name="opcao" id="opcao" value="cidades.nome" /><label for="radio3">Cidade</label>
                <input type="radio" name="opcao" id="opcao" value="usuarios.usuario" /><label for="radio4">Usuarios</label>
            </div><div class="clear"></div>
        </div>
    </form>
</div>
<div class="widget">
    <div class="title"><img src="../theme/images/icons/dark/full2.png" alt="" class="titleIcon" /><h6>Lista de Usuarios</h6></div>                          
    <table cellpadding="0" cellspacing="0" border="0" class="display dTable">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Usuario</th>
                <th>Telefone</th>
                <th>Cidade</th>
                <th>Tipo Usuario</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pessoas as $valor): ?>
                <tr class="gradeX">
                    <td><?php echo $valor->pessoaNome; ?></td>
                    <td><?php echo $valor->email; ?></td>
                    <td><?php echo $valor->usuario; ?></td>
                    <td><?php echo $valor->telefone; ?></td>
                    <td class="center"><?php echo $valor->cidadeNome; ?></td>
                    <td class="center"><?php echo $valor->acessoNome; ?></td>
                    <td class="actBtns">
                        <a href="<?php echo $valor->idPessoa; ?>" id="pessoa/formularioPessoa/" title="Editar" class="tipS editar">
                            <img src="../theme/images/icons/edit.png" alt="" />
                        </a>
                        <a href="<?php echo $valor->idPessoa; ?>" id="pessoa/deletar/" title="Remover" class="tipS deletar">
                            <img src="../theme/images/icons/remove.png" alt="" />
                        </a>
                        <a href="<?php echo $valor->idPessoa; ?>" id="pessoa/detalhe/" title="Detalhes" class="tipS detalhe">
                            <img src="../theme/images/icons/grown.png" alt="" />
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>  
</div>
<input type="hidden" class="obter" id="pessoa/obterPessoa" />
<script>
 
    oTable = $('.dTable').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>'
    });
    $("select, input:checkbox, input:radio, input:file").uniform();
</script>