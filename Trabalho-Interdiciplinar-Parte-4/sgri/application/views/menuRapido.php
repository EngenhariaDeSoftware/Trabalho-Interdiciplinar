<!-- InfraEstrutura -->
<?php if($this->session->userdata('idAcesso') == 2): ?>
<div class="wrapper">
    <div class="controlB">
        <ul>
            <li><a href="<?php echo $urlInicial; ?>" title=""><img src="../theme/images/icons/control/32/home.png" alt="" /><span>Inicio</span></a></li>
            <li><a href="pessoa/formularioPessoa" title=""><img src="../theme/images/icons/control/32/hire-me.png" alt="" /><span>Novo Usuario</span></a></li>
            <li><a href="equipamento/formularioEquipamento" title=""><img src="../theme/images/icons/control/32/database.png" alt="" /><span>Novo Equipamento</span></a></li>            
        </ul>
        <div class="clear"></div>
    </div>
</div>
<?php endif; ?>

<!-- coordenador -->
<?php if($this->session->userdata('idAcesso') == 1): ?>
<div class="wrapper">
    <div class="controlB">
        <ul>
            <li><a href="<?php echo $urlInicial; ?>" title=""><img src="../theme/images/icons/control/32/home.png" alt="" /><span>Inicio</span></a></li>
            <li><a href="reservaEvento/formularioReservaEvento" title=""><img src="../theme/images/icons/control/32/hire-me.png" alt="" /><span>Reserva Eventos</span></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<?php endif; ?>

<!-- profgessor -->
<?php if($this->session->userdata('idAcesso') == 3): ?>
<div class="wrapper">
    <div class="controlB">
        <ul>
            <li><a href="<?php echo $urlInicial; ?>" title=""><img src="../theme/images/icons/control/32/home.png" alt="" /><span>Inicio</span></a></li>
            <li><a href="reserva/formularioReserva" title=""><img src="../theme/images/icons/control/32/hire-me.png" alt="" /><span>Cadastrar Reservas</span></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<?php endif; ?>

<!-- Recursos Humanos -->
<?php if($this->session->userdata('idAcesso') == 4): ?>
<div class="wrapper">
    <div class="controlB">
        <ul>
            <li><a href="<?php echo $urlInicial; ?>" title=""><img src="../theme/images/icons/control/32/home.png" alt="" /><span>Inicio</span></a></li>
            <li><a href="pessoa/formularioPessoa" title=""><img src="../theme/images/icons/control/32/hire-me.png" alt="" /><span>Novo Usuario</span></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<?php endif; ?>

<!-- controler Academico -->
<?php if($this->session->userdata('idAcesso') == 5): ?>
<div class="wrapper">
    <div class="controlB">
        <ul>
            <li><a href="<?php echo $urlInicial; ?>" title=""><img src="../theme/images/icons/control/32/home.png" alt="" /><span>Inicio</span></a></li>
            <li><a href="sala/formularioSala" title=""><img src="../theme/images/icons/control/32/hire-me.png" alt="" /><span>Novo Sala</span></a></li>
            <li><a href="curso/formularioCurso" title=""><img src="../theme/images/icons/control/32/database.png" alt="" /><span>Novo Curso</span></a></li>            
            
            <li><a href="disciplina/formularioDisciplina" title=""><img src="../theme/images/icons/control/32/edit-column.png" alt="" /><span>Novo Disciplina</span></a></li>            
            <li><a href="professorDisciplina/formularioProfessorDisciplina" title=""><img src="../theme/images/icons/control/32/order-149.png" alt="" /><span>Disciplina Professor</span></a></li>            
            <li><a href="salaProfessorDisciplina/formularioSalaProfessorDisciplina" title=""><img src="../theme/images/icons/control/32/plus.png" alt="" /><span>Sala Prof Disciplina</span></a></li>            
            <li><a href="turma/formularioTurma" title=""><img src="../theme/images/icons/control/32/comment.png" alt="" /><span>Nova Turma</span></a></li>            
        </ul>
        <div class="clear"></div>
    </div>
</div>
<?php endif; ?>