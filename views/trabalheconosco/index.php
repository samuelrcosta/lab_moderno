<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/formValidation.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style_faleconosco.css">
<div class="inner-top-image">
    <img src="<?= BASE_URL; ?>assets/imgs/trabalhe_conosco.jpg" />
</div>
<div class="row">
    <div class="col-md-8">
        <div class="post-item">
            <h1>Preencha o formulário e envie seu currículo</h1>
            <div class="entry">
                <p>Seu currículo ficará guardado em nosso banco, entraremos em contato nas possíveis oportunidades que surgem na empresa.</p>
                <div class="contact-form">
                    <form class="ajax_form" name="jobForm" id="jobForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Seu nome(obrigatório):</label>
                                    <input name="name" id="name" class="form-control inputtext input_middle required" maxlength="255" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Seu e-mail (obrigatório):</label>
                                    <input name="email" id="email" class="form-control inputtext input_middle required" maxlength="255" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Telefone:</label>
                                    <input name="phone" id="phone" class="form-control inputtext input_middle required" maxlength="50" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Celular (obrigatório):</label>
                                    <input name="cell" id="cell" class="form-control inputtext input_middle required" maxlength="50" type="text">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Currículo (obrigatório):</label>
                                    <input type="file" id="curriculo" name="curriculo" class="form-control inputtext input_middle">
                                </div>
                            </div>
                            <div class="col-md-12" id="notification">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" title="send" class="btn btn-pink" id="send"><i class="fas fa-envelope"></i> Enviar Currículo</button>
                            </div>
                            <div class="col-md-6">
                                <span class="reset-link"><a id="limparForm" href="#" onclick="document.jobForm.reset();return false">limpar formulário</a></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 sidebar-contact">
        <div class="widget-container widget_social_contacts">
            <div class="social-box">
                <div class="row social-facebook"><span>Facebook.com/</span><a href="https://www.facebook.com/pages/Laborat%C3%B3rio-Moderno/409302379197476" target="_blank">Lab. Moderno</a></div>
                <div class="row social-instagram" style="border-top: 1px solid #CCC;"><span>Instagram.com/</span><a href="https://www.instagram.com/LaboratorioModerno/" target="_blank">LaboratorioModerno</a></div>
            </div>
        </div>
        <h3 style="margin-top: 35px; margin-bottom: 15px;">Contato</h3>
        <div class="jumbotron jumbotron-contact" style="padding: 30px;font-style: italic;">
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
            <hr style="margin-top: 20px;margin-bottom: 20px;">
            <div class="contact-local">
                <label><i class="fas fa-map-marker-alt"></i> Unidades: </label>
                <a href="<?= BASE_URL; ?>unidades" style="color: #1a7e9e;word-wrap: break-word; font-size: 17px; font-family: Georgia, 'Times New Roman', Times, serif;">Ver Unidades</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= BASE_URL;?>assets/js/formValidation/formValidation.min.js"></script>
<script type="text/javascript" src="<?= BASE_URL;?>assets/js/formValidation/framework/bootstrap4.min.js"></script>
<script type="text/javascript" src="<?= BASE_URL;?>assets/js/controllers/trabalhe_conosco.js"></script>
<script>
    $(document).ready(function() {
        TrabalheConosco.start();
    });
</script>