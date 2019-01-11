<div class="row">
    <?php if(isset($feed) && !empty($feed)): ?>
      <div class="col-md-12">
        <div class="outter-feed-container">
          <h3 style="margin-top: 10px; margin-bottom: 20px;">Destaques</h3>
          <div class="feed-container">
	          <?php foreach ($feed as $fd): ?>
                <div class="feed-item-container">
                  <div class="feed-item-container-inner">
                    <img src="<?= $fd['url']; ?>">
                    <div class="feed-texts">
                      <div><?= $fd['caption'];  ?></div>
                    </div>
                  </div>
                </div>
	          <?php endforeach; ?>
        </div>
        </div>
        <div class="social-toolbar-home">
          <div class="widget-container widget_social_contacts">
            <div class="social-box">
              <div class="row social-facebook">
                <span><text>Facebook.com/</text></span><a href="https://www.facebook.com/labmoderno/" target="_blank">LabModerno</a>
              </div>
              <div class="row social-instagram" style="border-top: 1px solid #CCC;">
                <span><text>Instagram.com/</text></span><a href="https://www.instagram.com/LaboratorioModerno/" target="_blank">LaboratorioModerno</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
    <div class="col-md-4">
        <div class="title_icon">
            <img src="<?= BASE_URL ?>assets/imgs/col_icon_1.png" alt="" width="87" height="87" border="0">
            <h3>Atendimento Fácil e Rápido</h3>
        </div>
        <p>Nosso laboratório conta com uma ampla rede de atendimento em toda a região metropolitana de <strong>Goiânia</strong>. Dúvidas? Fale conosco:</p>
        <div class="jumbotron jumbotron-contact jumb-pc" style="padding: 30px;font-style: italic;">
            <div class="contact-phone">
                <label><i class="fas fa-phone"></i> Telefone: </label>
                <strong style="color: #ae2945;">(62) 3233 5826</strong>
            </div>
            <hr style="margin-top: 20px;margin-bottom: 20px;">
            <div class="contact-phone">
                <label><i class="fab fa-whatsapp"></i> Whatsapp: </label>
                <strong style="color: #1a7e9e">(62) 98583-0028</strong>
            </div>
            <hr style="margin-top: 20px;margin-bottom: 20px;">
            <div class="contact-mail">
                <label><i class="fas fa-envelope"></i> E-mail: </label>
                <a href="mailto:atendimento@laboratoriomoderno.com.br" style="color: #1a7e9e;font-weight: bold; word-wrap: break-word;">atendimento@laboratoriomoderno.com.br</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="title_icon">
            <img src="<?= BASE_URL ?>assets/imgs/col_icon_2.png" alt="" width="87" height="87" border="0">
            <h3>Ampla rede de convênios</h3>
        </div>
        <p>Sempre pensando em você, o Laboratório Moderno mantém parceria com os principais Planos de Saúde: </p>
        <div class="list_dots_blue">
            <ul>
                <li>IMAS</li>
                <li>IPASGO</li>
                <li>UNIMED</li>
                <li>SUS</li>
                <li>PAX SILVA</li>
                <li>PAZ UNIVERSAL</li>
            </ul>
        </div>
    </div>
    <div class="col-md-4">
        <div class="title_icon">
            <img src="<?= BASE_URL ?>assets/imgs/col_icon_3.png" alt="" width="87" height="87" border="0">
            <h3>Conheça a nossa equipe</h3>
        </div>
        <p>Formada por profissionais capacitados que ao longo dos anos deram ao Laboratório Moderno excelêntes avaliações junto ao <strong>DICQ e PNCQ</strong></p>
        <p><img src="<?= BASE_URL ?>assets/imgs/fotofernanda.jpg" style="width: 100%" alt="Imagem de Médicos"></p>
        <a href="<?= BASE_URL; ?>equipe" class="btn btn-sm btn-pink">NOSSA EQUIPE</a>
    </div>
    <div class="col-md-5">
        <div class="jumbotron jumbotron-contact jumb-mobile" style="font-style: italic;">
            <div class="contact-phone">
                <label><i class="fas fa-phone"></i> Telefone: </label>
                <strong style="color: #ae2945;">(62) 3233 5826</strong>
            </div>
            <hr style="margin-top: 20px;margin-bottom: 20px;">
            <div class="contact-phone">
                <label><i class="fab fa-whatsapp"></i> Whatsapp: </label>
                <strong style="color: #1a7e9e">(62) 98583-0028</strong>
            </div>
            <hr style="margin-top: 20px;margin-bottom: 20px;">
            <div class="contact-mail">
                <label><i class="fas fa-envelope"></i> E-mail: </label>
                <a href="mailto:atendimento@laboratoriomoderno.com.br" style="color: #1a7e9e;font-weight: bold; word-wrap: break-word;">atendimento@laboratoriomoderno.com.br</a>
            </div>
        </div>
    </div>
</div>
<script>
  $(window).ready(function(){
    $('.feed-container').slick({
      infinite: true,
      adaptiveHeight: false,
      speed: 300
    });

    $(".slick-next").css("left", $('.feed-item-container').find('img').first().width() - 30);
  });
  $(window).resize(function(){
    $(".slick-next").css("left", $('.feed-item-container').find('img').first().width() - 30);
  });
</script>