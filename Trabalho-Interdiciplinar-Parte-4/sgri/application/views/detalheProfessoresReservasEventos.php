<table cellpadding="0" cellspacing="0" width="100%" class="sTable">
    <thead>
        <tr>
            <td colspan="1">Nome Professor</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($professor as $valor): ?>
        <tr>
            <td colspan="1"><?php echo $valor->nome; ?></td>
        </tr>
        <?php endforeach; ?>

    </tbody>
</table>
