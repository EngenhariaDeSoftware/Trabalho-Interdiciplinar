<script type="text/javascript" src="../theme/js/acoesComum.js"></script>
<!-- Search -->
<div class="searchWidget">
    <form action="curso/pesquisar" class="form" method="POST">
        <input type="text" name="pesquisa" class="pesquisa" id="pesquisa" placeholder="Pesquisar Equipamentos..." />
        <input type="submit" name="pesquisar" class="pesquisar" value="" />
        <div class="horControlB">
            <ul>
                <li><a href="curso/formularioCurso" title=""><img src="../theme/images/icons/control/16/database.png" alt="" /><span>Novo</span></a></li>
                <li><a href="curso/obterCurso" title=""><img src="../theme/images/icons/control/16/order-192.png" alt="" /><span>Listar</span></a></li>
            </ul>
        </div>
    </form>
</div>
<div class="body">
    <!-- Partners list widget -->
    <div class="widget">
        <div class="title"><img src="../theme/images/icons/dark/users.png" alt="" class="titleIcon" /><h6>Resultado Pesquisa Equipamentos</h6></div>
        <ul class="partners">
            <?php foreach ($cursos as $valor): ?>
                <li>
                    <div class="pInfo">
                        <p><strong>Nome Curso: <?php echo $valor->nome; ?></strong></p>
                        <?php if ($this->session->userdata('idAcesso') == 5): ?>  
                        <p>
                            <a href="<?php echo $valor->idCurso; ?>" id="curso/formularioCurso/" title="Editar" class="tipS editar">
                                <img src="../theme/images/icons/edit.png" alt="" />
                            </a>
                            <a href="<?php echo $valor->idCurso; ?>" id="curso/deletar/" title="Remover" class="tipS deletar">
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
<input type="hidden" class="obter" id="curso/obterCurso" />