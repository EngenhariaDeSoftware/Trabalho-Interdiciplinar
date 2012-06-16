<div class="welcome">
    <a href="javascript:void(0);" title="Bem vindo ">
        <img src="../theme/images/userPic.png" alt="" />
    </a>
    <span><?php echo $this->session->userdata('nome'); ?></span>
</div>
<div class="userNav">
    <ul>
        <li><a href="#" title=""><img src="../theme/images/icons/topnav/profile.png" alt="" /><span>Perfil</span></a></li>
        <li class="dd"><a href="ocorrencia/checkTotal" class="setTotal" title=""><img src="../theme/images/icons/topnav/messages.png" alt="" /><span>Ocorrências</span><span class="numberTop">X</span></a>
            <ul class="userDropdown">
                <li><a href="ocorrencia/formularioOcorrencias" title="" class="sAdd">Nova</a></li>
                <li><a href="ocorrencia/entrada" title="" class="sInbox">Entrada</a></li>
                <li><a href="ocorrencia/saida" title="" class="sOutbox">Saida</a></li>
            </ul>
        </li>
        <li><a href="#" title=""><img src="../theme/images/icons/topnav/settings.png" alt="" /><span>Opções</span></a></li>
        <li><a href="../usuario/sair/" title=""><img src="../theme/images/icons/topnav/logout.png" alt="" /><span>Sair</span></a></li>
    </ul>
</div>
<div class="clear"></div>
<script>
    $(".setTotal").click(function(event){
        event.preventDefault();
        
        var aUrl = $(this).attr("href");
        
        $.post("../"+aUrl, function(eData){
            
            $(".numberTop").html(eData.total);
           
        }, "json");
    });
</script>