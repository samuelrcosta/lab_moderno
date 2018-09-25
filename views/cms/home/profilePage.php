<div class="card">
    <form method="POST" id="profileForm">
        <div class="card-header bg-light">
            Meu Perfil
        </div>

        <div class="card-body">
            <div class="row mb-5">
                <div class="col-md-4 mb-4">
                    <div>Informações Pessoais</div>
                    <div class="text-muted small">Nome do usuário e o e-mail de acesso (obrigatórios)</div>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name"><span style="color: red;font-weight: bold">*</span> Nome</label>
                                <input class="form-control" id="name" name="name" data-validation="required" data-validation-error-msg="Digite seu nome">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="email"><span style="color: red;font-weight: bold">*</span> Email</label>
                                <input class="form-control" id="email" name="email" data-validation="email required" data-validation-error-msg="Digite um e-mail válido">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div>Avatar</div>
                    <div class="text-muted small">Imagem de perfil</div>
                </div>

                <div class="col-md-8">

                    <div class="progress">
                        <div class="progress-bar progress-bar-success progresso" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> Nenhum arquivo enviado
                        </div>
                    </div>

                    <label for="image" class="form-control-label">Arquivo da Imagem</label>
                    <input type="file" class="form-control" id="image" name="image" data-validation-allowing="jpg, png, jpeg" data-validation-max-size="2M" data-validation-error-msg="Insira um arquivo de imagem válido de até 2Mb"/>
                    <div class="image-area" style="width: 100%;max-width: 100%;text-align: center;">

                    </div>

                </div>

            </div>

            <hr>

            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div>Credenciais de Acesso</div>
                    <div class="text-muted small">Preencha os campos caso queira alterar a senha.</div>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="current_password"> Senha Atual</label>
                                <input type="password" class="form-control" id="current_password" name="current_password">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation"> Nova Senha</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password"> Confirmação da nova senha</label>
                                <input type="password" class="form-control" id="password" name="password" data-validation="confirmation" data-validation-error-msg="Confirmação de senha inválida">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-notices"></div>
        </div>

        <div class="card-footer bg-light text-right">
            <button type="submit" class="btn btn-success save-button"><i class="fas fa-save"></i> Salvar</button>
        </div>
    </form>
</div>
<script src="<?php echo BASE_URL ?>assets/js/resize_image.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/controllers/profilePageController.js"></script>
<script>
    $(document).ready(function(){
        PageController.start('<?php echo json_encode($userData); ?>');
    });
</script>