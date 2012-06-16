<div class="widgets">
    <div class="oneTwo">
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/timer.png" alt="" class="titleIcon" /><h6>Ultimos Cursos</h6><div class="num"><a href="javascript:void(0);" class="blueNum">Total de <?php echo $cursosTotal; ?> cursos</a></div></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable taskWidget">
                <thead>
                    <tr>
                        <td width="30">ID</td>
                        <td width="30">Nome</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cursos as $valor): ?>
                        <tr>
                            <td class="taskPr"><a href="javascript:void(0);" title=""><?php echo $valor->idCurso; ?></a></td>
                            <td><span class="green f11"><?php echo $valor->nome; ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table> 
        </div>                     
    </div>

    <div class="oneTwo">

        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/timer.png" alt="" class="titleIcon" /><h6>Ultimas Disciplinas</h6><div class="num"><a href="javascript:void(0);" class="blueNum">Total de <?php echo $disciplinasTotal; ?> disciplinas</a></div></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable taskWidget">
                <thead>
                    <tr>
                        <td width="30">Nome</td>
                        <td width="30">Curso</td>
                    </tr>
                </thead>      

                <tbody>
                    <?php foreach ($disciplinas as $valor): ?>
                        <tr>
                            <td class="taskPr"><a href="javascript:void(0);" title=""><?php echo $valor->disciplinaNome; ?></a></td>
                            <td><span class="green f11"><?php echo $valor->cursoNome; ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table> 
        </div>
        <div class="clear"></div>

    </div>
    <div class="clear"></div>
</div>

<div class="widgets">
    <div class="widget">
        <div class="title"><img src="../theme/images/icons/dark/timer.png" alt="" class="titleIcon" /><h6>Ultimas Turmas</h6><div class="num"><a href="javascript:void(0);" class="blueNum">Total de <?php echo $turmasTotal; ?> turmas</a></div></div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable taskWidget">
            <thead>
                <tr>
                    <td width="30">Nome</td>
                    <td width="30">Grupo</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($turmas as $valor): ?>
                    <tr>
                        <td class="taskPr"><a href="javascript:void(0);" title=""><?php echo $valor->turmaNome; ?></a></td>
                        <td><span class="green f11"><?php echo $valor->grupo; ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table> 
    </div>
    <div class="clear"></div>
</div>


<div class="widget">
    <div class="title"><img src="../theme/images/icons/dark/full2.png" alt="" class="titleIcon" /><h6>Tabelas de Salas</h6><div class="num"><a href="javascript:void(0);" class="blueNum">Total de <?php echo $salasTotal; ?> salas</a></div></div>                          
    <table cellpadding="0" cellspacing="0" border="0" class="display taskWidget">
        <thead>
            <tr>
                <th>Predio</th>
                <th>Andar</th>
                <th>Numero</th>
                <th>Tipo Sala</th>
                <th>Data Cadastro</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ultimasSalas as $valor): ?>            
                <tr class="gradeX">
                    <td class="center"><?php echo $valor->predio; ?></td>
                    <td class="center"><?php echo $valor->andar; ?></td>
                    <td class="center"><?php echo $valor->numero; ?></td>
                    <td class="center"><?php echo ( $valor->tipoSala == 0 ) ? "Sala Normal" : ( $valor->tipoSala == 1 ) ? "Laboratorio" : ( $valor->tipoSala == 2 ) ? "Auditório" : "Sala Especial"; ?></td>
                    <td class="center"><?php echo $valor->dataCadastro; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>  
</div>
