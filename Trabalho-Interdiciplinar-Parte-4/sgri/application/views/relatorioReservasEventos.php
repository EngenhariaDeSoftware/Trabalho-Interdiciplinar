<div class="body">
    <!-- Partners list widget -->
    <div class="widget">
        <div class="title"><img src="../theme/images/icons/dark/users.png" alt="" class="titleIcon" /><h6>Resultado Relatorio Reservas</h6></div>
        <ul class="partners">
            <?php foreach ($relatorios as $valor): ?>
                <li>
                    <div class="pInfo">
                        <p><strong>Data: <?php echo $valor->data; ?></strong></p>
                        <strong>Hora: <?php echo $valor->hora; ?></strong><br />
                        
                        <strong>Email: <?php echo $valor->email; ?></strong><br />
                        <strong>Equipamento: <?php echo $valor->equipamentoNome; ?></strong><br />
                        <strong>Codigo Patrimonio: <?php echo $valor->codigoPatrimonio; ?></strong><br />
                        <strong>Nome Pessoa: <?php echo $valor->pessoaNome; ?></strong><br />
                        <strong>Nome Professor: <?php echo $valor->professorNome; ?></strong><br />
                        
                        <strong>totalEquipamento: <?php echo $valor->totalEquipamento; ?></strong><br />
                        
                       
                    </div>
                    <div class="clear"></div>
                </li>

            <?php endforeach; ?>
        </ul>
    </div>                       
</div>