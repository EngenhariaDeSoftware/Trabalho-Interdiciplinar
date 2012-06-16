<table cellpadding="0" cellspacing="0" width="100%" class="sTable">
    <thead>
        <tr>
            <td colspan="1">Nome dos Equipamentos</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($equipamentos as $valor): ?>
        <tr>
            <td colspan="1"><?php echo $valor->nome; ?></td>
        </tr>
        <?php endforeach; ?>

    </tbody>
</table>
