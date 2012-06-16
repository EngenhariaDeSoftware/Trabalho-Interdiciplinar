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
                        
                        <strong>Turma: <?php echo $valor->nome; ?></strong><br />
                        <strong>Predio: <?php echo $valor->predio; ?></strong><br />
                        <strong>Andar: <?php echo $valor->andar; ?></strong><br />
                        <strong>Numero: <?php echo $valor->numero; ?></strong><br />
                        <strong>Nome Pessoa: <?php echo $valor->pessoaNome; ?></strong><br />
                        
                        <strong>Sala Registrara: <?php echo $valor->totalSala; ?> vezes</strong><br />
                        <strong>Turma Registrada: <?php echo $valor->totalTurma; ?> vezes</strong>
                       
                    </div>
                    <div class="clear"></div>
                </li>

            <?php endforeach; ?>
        </ul>
    </div>                       
</div>