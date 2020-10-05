<html>
<head>
  <title><?php echo $titulo ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="author" content="Samuel Costa" />
  <meta name="Description" content="A short description of your company" />
  <meta name="Keywords" content="Some keywords that best describe your business" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" href="<?php echo BASE_URL;?>assets/imgs/favicon.png" type="image/png" />
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>assets/css/fontawesome-all.min.css">
  <script type="text/javascript">
    const BASE_URL = "<?= BASE_URL; ?>";
  </script>
  <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/tether.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>vendor/igorescobar/jquery-mask-plugin/src/jquery.mask.js"></script>
  <?php if(isset($feed)): ?>
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/slick.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/slick-theme.css"/>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/slick.min.js"></script>
  <?php endif; ?>
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>assets/css/style.css?v=1.0.4">
</head>
<body>
  <div class="body_wrap">
    <div class="header">
      <div class="header_top">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="logo">
                <a href="<?php echo BASE_URL;?>" style="display: block"><img style="max-width: 255px" src="<?php echo BASE_URL;?>assets/imgs/logo.png" alt="Medica" /></a>
              </div>
            </div>
            <div class="col-md-4 resultado">
              <a href="http://189.112.63.207/" target="_blank" class="btn btn-sm">CONSULTE SEUS RESULTADOS</a>
            </div>
            <div class="col-md-4 header_contacts">
              <div><br><br>
                <p>Atendimento ao Cliente:  <span class="icon_phone">(62) 3233-5826</span></p>
                <p>Vai fazer exames? <a href="<?= BASE_URL;?>unidades" class="icon_map">Conheça nossas Unidades</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container container-website">
      <div class="topmenu">
        <div class="mobile-button-toggle"><i class="fas fa-bars"></i></div>
        <div class="container-menu">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link <?= ($active == 'home') ? 'active' : '' ?>" href="<?= BASE_URL ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= ($active == 'sobre') ? 'active' : '' ?>" href="<?= BASE_URL ?>sobre">Sobre</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= ($active == 'qualidade') ? 'active' : '' ?>" href="<?= BASE_URL ?>qualidade">Gestão da Qualidade</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= ($active == 'unidades') ? 'active' : '' ?> " href="<?= BASE_URL ?>unidades">Unidades</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= ($active == 'equipe') ? 'active' : '' ?> " href="<?= BASE_URL ?>equipe">Equipe</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= ($active == 'faleconosco') ? 'active' : '' ?> " href="<?= BASE_URL ?>faleconosco">Fale Conosco</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= ($active == 'trabalheconosco') ? 'active' : '' ?> " href="<?= BASE_URL ?>trabalheconosco">Trabalhe Conosco</a>
            </li>
          </ul>
        </div>
      </div>
      <section class="inner-website">
        <?php $this->loadViewInTemplate($viewName, $viewData) ?>
      </section>
    </div>
  </div>
  <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/script.js"></script>
</body>
</html>
