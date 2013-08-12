<script type="text/javascript">
    window.onload = setupRefresh;

    function setupRefresh() {
      setTimeout("refreshPage();", 60000); // milliseconds
    }
    function refreshPage() {
       window.location = location.href;
    }
</script>


<div class="dashboard-left">

    <ul class="row-fluid fluid general_statistics hidden-phone">
        <li class="gradient span3">
              <a href="#" onclick="openDashboardWin({c:'<?php echo $this->createAbsoluteUrl('/portal/mensagens'); ?>',i:'people', r:this},'<?php echo t('Mensagens');?>')">
                  <span>Mensagens</span>
              </a>
        </li>
        <li class="gradient span3">
              <a href="">
                  <span>Serviços</span>
              </a>              
        </li>
        <li class="gradient span3">
              <a href="">
                  <span>Resultados</span>
              </a>    
        </li>
        <li class="gradient span3">
              <a href="">
                  <span>Favoritos</span>
              </a>
        </li>
    </ul>

    <div class="notifications widget">
        <div class="title">
            <span><?php echo t('Ultimas Notificações')?></span>
        </div>
        <div class="items">
            <ul style="margin:5px 0 0 0;">
                
                <?php foreach ($notificacoes as $key => $notificacao): ?>
                    <li><a href="#" onclick="openDashboardWin({c:'<?php echo $this->createAbsoluteUrl('/portal/notificacoes/view/id/'.$notificacao->ID_USER.','.$notificacao->ID_NOTF); ?>',i:'people', r:this},'<?php echo t('Notificações');?>')" class="<?php echo ($notificacao->VISTA==0)?"new":""; ?>"><?php echo $notificacao->NOTIFICACAO->CONTEUDO; ?></a></li>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>
    <div class="widget">
        <div class="header">
            <span><span class="ico gray mail"></span><?php echo t('Mensagens Recentes')?></span>
        </div>
        <div class="content messages-widget" style="height: 200px; padding: 8px;"> 
            <ul style="margin-left:0;">
                
                <?php foreach ($mensagens as $key => $mensagem): ?>
                    <li>
                        <a href="#" onclick="openDashboardWin({c:'<?php echo $this->createAbsoluteUrl('/portal/mensagens/view/id/'.$mensagem->ID_MSG); ?>',i:'people', r:this},'<?php echo t('Mensagens');?>')" class="<?php echo ($mensagem->VISTA==0)?"new":"open"; ?>">
                            <?php if($mensagem->VISTA==0): ?>
                                <img src="http://aux.iconpedia.net/uploads/17177433672068601809.png" alt="Message" align="middle">
                            <?php else: ?>
                                <img src="http://aux.iconpedia.net/uploads/12847483161947683116.png" alt="Read Message" align="middle">
                            <?php endif; ?>
                                
                            <label><b><?php echo t('DE');?>:</b> <?php echo $mensagem->MENSAGEM->REMETENTE->NOME;?></label>
                            <span><?php echo $mensagem->MENSAGEM->DATA_ENVIO;?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
                    
                
            </ul>
        </div>
    </div>

</div>

<div class="dashboard-right">
    <div class="widget">
        <div class="header">
            <span><span class="ico gray calendar"></span>Serviços Agendados</span>
        </div>
        <div class="content" style="height: 207px;"> 

        </div>
    </div>

    <div class="widget">
        <div class="header">
            <span><span class="ico gray stats_lines"></span>Estatisticas de Serviços</span>
        </div>
        <div class="content" style="height: 186px;"> 

        </div>
    </div>

</div>