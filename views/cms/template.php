<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $viewData['title']; ?></title>
    <link rel="shortcut icon" href="<?php echo BASE_URL;?>assets/imgs/favicon.png" type="image/png" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>vendor/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>vendor/font-awesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/styleCMS.css">
    <script src="<?php echo BASE_URL; ?>vendor/chart.js/chart.min.js"></script>
    <!--!>BASE URL</!-->
    <script type="text/javascript">var BASE_URL = '<?php echo BASE_URL; ?>';</script>
    <!--!>Jquery</!-->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.2.1.min.js"></script>
    <!--!>Popper</!-->
    <script src="<?php echo BASE_URL; ?>vendor/popper.js/popper.min.js"></script>
    <!--!>Bootstrap 4</!-->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--!>Jquery Mask</!-->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>vendor/igorescobar/jquery-mask-plugin/src/jquery.mask.js"></script>
    <!--!>FormValidator</!-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css" rel="stylesheet" type="text/css" />
    <!--!>FormValidation</!-->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>vendor/formValidation/formValidation.min.css"/>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>vendor/formValidation/formValidation.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>vendor/formValidation/bootstrap.js"></script>
    <!--!>Mustache</!-->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>vendor/mustache/mustache.min.js"></script>
    <!--!>Jquery DataTable</!-->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
</head>
<body class="sidebar-fixed header-fixed">
<div class="page-wrapper">
    <nav class="navbar page-header">
        <a href="#" class="btn btn-link sidebar-mobile-toggle d-md-none mr-auto">
            <i class="fa fa-bars"></i>
        </a>

        <a style="height: 100%; padding: 0;" class="navbar-brand" href="<?php echo BASE_URL; ?>admin">
            <img src="<?php echo BASE_URL; ?>assets/imgs/logo.png" alt="logo" style="height: 100%">
        </a>

        <a href="#" class="btn btn-link sidebar-toggle d-md-down-none">
            <i class="fa fa-bars"></i>
        </a>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img style="object-fit: cover;" src="<?php echo BASE_URL; ?>assets/imgs/users_profile/<?= $viewData['userData']['avatar']; ?>" class="avatar avatar-sm" alt="logo">
                    <span class="small ml-1 d-md-down-none"><?php echo $viewData['userData']['name']; ?></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="<?php echo BASE_URL; ?>admin/sendMailPage" class="dropdown-item">
                        <i class="fa fa-envelope"></i> Enviar E-mail
                    </a>

                    <a href="<?php echo BASE_URL; ?>admin/profilePage" class="dropdown-item">
                        <i class="fas fa-user"></i> Meu Perfil
                    </a>

                    <a href="<?php echo BASE_URL; ?>admin/logoff" class="dropdown-item">
                        <i class="fa fa-lock"></i> Logout (Sair)
                    </a>
                </div>
            </li>
        </ul>
    </nav>

    <div class="main-container">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-title">Navegação</li>

                    <li class="nav-item">
                        <a href="<?php echo BASE_URL; ?>admin/dashboard" class="nav-link <?php echo ($viewData['link'] == 'admin/dashboard')?'active':''; ?>">
                            <i class="icon icon-speedometer"></i> Dashboard
                        </a>
                    </li>
                    <?php if(strpos($viewData['userData']['perms'], 'users') !== false): ?>
                    <li class="nav-item">
                        <a href="<?php echo BASE_URL; ?>usersCMS" class="nav-link <?php echo ($viewData['link'] == 'usersCMS/index')?'active':''; ?>">
                            <i class="icon icon-people"></i> Usuários
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(strpos($viewData['userData']['perms'], 'contacts') !== false): ?>
                    <li class="nav-item">
                        <a href="<?php echo BASE_URL; ?>contactsCMS" class="nav-link <?php echo ($viewData['link'] == 'contactsCMS/index')?'active':''; ?>">
                            <i class="icon icon-envelope-open"></i> Contatos
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(strpos($viewData['userData']['perms'], 'curriculos') !== false): ?>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>curriculosCMS" class="nav-link <?php echo ($viewData['link'] == 'curriculosCMS/index')?'active':''; ?>">
                                <i class="fas fa-address-card"></i> Currículos
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>

        <div class="content">
            <div class="container-fluid">
                <?php $this->loadViewInTemplate($viewName, $viewData); ?>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>assets/js/carbon.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/scriptCMS.js"></script>
</body>
</html>
