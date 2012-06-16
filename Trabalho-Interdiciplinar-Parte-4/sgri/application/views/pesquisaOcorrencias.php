<div class="body">
    <!-- Partners list widget -->
    <div class="widget">
        <div class="title"><img src="../theme/images/icons/dark/users.png" alt="" class="titleIcon" /><h6>Resultado Pesquisa Equipamentos</h6></div>
        <ul class="partners">
            <?php foreach ($rows as $valor): ?>
                <li>
                    <div class="pInfo">
                        <p><strong>Descrição: <?php echo $valor->descricao; ?></strong></p>
                        <p><strong>Data: <?php echo $valor->data; ?></strong></p>
                    </div>
                    <div class="clear"></div>
                </li>

            <?php endforeach; ?>
        </ul>
    </div>                       
</div>