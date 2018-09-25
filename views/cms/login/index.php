<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?php echo $viewData['title']; ?></title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>vendor/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>vendor/font-awesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/styleCMS.css">
    <script src="<?php echo BASE_URL; ?>vendor/chart.js/chart.min.js"></script>
    <!--!>Jquery</!-->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>vendor/components/jquery/jquery.min.js"></script>
    <!--!>Popper</!-->
    <script src="<?php echo BASE_URL; ?>vendor/popper.js/popper.min.js"></script>
    <!--!>Bootstrap 4</!-->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--!>FormValidator</!-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="page-wrapper flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4">
                    <div class="card-header text-center text-uppercase h4 font-weight-light">
                        Login
                    </div>
                    <form id="login" method="POST">
                        <div class="card-body py-5">
                            <?php if(isset($_GET['notification'])):?>
                                <div class='alert <?php echo $_GET['status']; ?> notification'>
                                    <?php echo urldecode($_GET['notification']); ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label class="form-control-label">Email</label>
                                <input type="text" class="form-control" data-validation="email" data-validation-error-msg="Digite um e-mail válido" name="email" id="email" placeholder="E-mail" value="<?php echo(isset($email))?$email:''; ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Senha</label>
                                <input type="password" class="form-control" data-validation="required" data-validation-error-msg="Digite sua senha" name="password" id="password"  placeholder="Senha">
                            </div>
                            <?php if(!empty($notice)):?>
                                <?php echo $notice ?>
                            <?php endif; ?>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="submit" value="Login" class="btn btn-primary px-5">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>assets/js/carbon.js"></script>
<script>
    $.validate({
        form : '#login'
    });
</script>
</body>
</html>