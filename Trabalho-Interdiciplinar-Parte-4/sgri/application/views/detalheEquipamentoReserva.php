<table cellpadding="0" cellspacing="0" width="100%" class="sTable">
    <thead>
        <tr>
            <td colspan="1">IDz</td>
            <td colspan="1">Nome</td>
            <td colspan="1">Codigo Patrimônico</td>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach ($reservas as $valor): ?>
            <tr>
                <td colspan="1"><?php echo $i; ?></td>
                <td colspan="1"><?php echo $valor->nome; ?></td>
                <td colspan="1"><?php echo $valor->codigoPatrimonio; ?></td>
            </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>


<table cellpadding="0" cellspacing="0" width="100%" class="sTable">
    <thead>
        <tr>
            <td colspan="1">IDz</td>
            <td colspan="3">Descrição</td>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach ($reservas as $valor): ?>
            <tr>
                <td colspan="1"><?php echo $i; ?></td>
                <td colspan="3"><?php echo $valor->descricao; ?></td>
            </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>
