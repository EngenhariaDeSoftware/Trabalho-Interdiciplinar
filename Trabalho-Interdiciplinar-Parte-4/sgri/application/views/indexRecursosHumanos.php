<div class="widget">
    <div class="title"><img src="../theme/images/icons/dark/users.png" alt="" class="titleIcon" /><h6>Ultimos Usuarios</h6><div class="num"><a href="javascript:void(0);" class="blueNum">Total de <?php echo $pessoasTotal; ?> pessoas</a></div></div>
    <ul class="partners">
        <?php foreach ($pessoas as $valor): ?>
            <li>
                <a href="javascript:void(0);" title="" class="floatL"><img src="../theme/images/usuario.png" alt="" /></a>
                <div class="pInfo">
                    <strong><?php echo $valor->pessoaNome; ?></strong>
                    <i><?php echo $valor->acessoNome; ?></i>	
                </div>

                <div class="clear"></div>
            </li>
        <?php endforeach; ?>


    </ul>
</div>
