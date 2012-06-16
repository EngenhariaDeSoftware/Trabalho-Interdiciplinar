<!-- InfraEstrutura -->
<?php if($this->session->userdata('idAcesso') == 2): ?>
<ul>
    <!--
    <li class="mUser">
        <a href="javascript:void(0);" title="Cadastrar e Listar Usuarios" class="tipN">
            <span class="users"></span>
        </a>
        <ul class="mSub1">
            <li><a href="#" title="">Adicionar Usuario</a></li>
            <li><a href="#" title="">Listar Usuarios</a></li>
        </ul>
    </li>
    
    <li class="mMessages">
        <a href="javascript:void(0);" title="Cadastrar e Listar Equipamentos" class="tipN">
            <span class="messages"></span>
        </a>
        <ul class="mSub2">
            <li><a href="#" title="">Adicionar Equipamentos</a></li>
            <li><a href="#" title="">Listar Equipamentos</a></li>
        </ul>
    </li>
    
    <li class="mFiles">
        <a href="javascript:void(0);" title="Cadastrar e Listar Salas" class="tipN">
            <span class="files"></span>
        </a>
        <ul class="mSub3">
            <li><a href="#" title="">Adicionar Salas</a></li>
            <li><a href="#" title="">Listar Salas</a></li>
        </ul>
    </li>
    -->
    <li class="mOrders">
        <a href="javascript:void(0);" title="Importar Usuarios" class="tipN">
            <span class="orders"></span>
        </a>
        <ul class="mSub4">
            <li><a href="importar/formularioImportarUsuarios" title="">Importar Usuarios</a></li>
        </ul>
    </li>
    <li class="mFiles">
        <a href="javascript:void(0);" title="Cadastrar e Listar Salas" class="tipN">
            <span class="files"></span>
        </a>
        <ul class="mSub3">
            <li><a href="importar/formularioImportarEtc" title="">Importar Salas/etc</a></li>
        </ul>
    </li>
    
</ul>
<div class="clear"></div>
<?php endif; ?>