    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
        <thead>
            <tr>
                <th>Turma</th>
                <th>Predio</th>
                <th>Andar</th>
                <th>Numero</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Disciplina</th>
                <th>Curso</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($reservas as $valor): ?>
            <tr>
                <td colspan="1"><?php echo $valor->turmaNome; ?></td>
                <td colspan="1"><?php echo $valor->predio; ?></td>
                <td colspan="1"><?php echo $valor->andar; ?></td>
                <td colspan="1"><?php echo $valor->numero; ?></td>
                <td colspan="1"><?php echo $this->query->dateBr($valor->data); ?></td>
                <td colspan="1"><?php echo $valor->hora; ?></td>
                <td colspan="1"><?php echo $valor->DisciplinaNome; ?></td>
                <td colspan="1"><?php echo $valor->cursoNome; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
        <thead>
            <tr>
                <th>Observação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($reservas as $valor): ?>
            <tr>
                <td colspan="8"><?php echo $valor->obs; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
