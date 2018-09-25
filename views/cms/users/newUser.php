<div class="card">
    <div class="card-header bg-light">
        Novo usuário
    </div>
    <form id="register">
        <div class="card-body">
            <a href="<?php echo BASE_URL; ?>usersCMS" class="btn btn-primary" style="margin-bottom: 20px;"><i class="icon icon-arrow-left-circle"></i>&nbsp;Voltar</a>
            <div class="row mb-5">
                <div class="col-md-4 mb-4">
                    <div>Informações Pessoais</div>
                    <div class="text-muted small">Nome do usuário e o e-mail de acesso (obrigatórios)</div>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"><span style="color: red;font-weight: bold">*</span> Nome</label>
                                <input class="form-control" id="name" name="name" data-validation="required" data-validation-error-msg="Digite seu nome">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label"><span style="color: red;font-weight: bold">*</span> Email</label>
                                <input class="form-control" id="email" name="email" data-validation="email required" data-validation-error-msg="Digite um e-mail válido">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div>Permissões de Acesso</div>
                    <div class="text-muted small">Marque os menus nos quais deseja que o usuário tenha acesso.</div>
                </div>

                <div class="col-md-8">
                    <div class="checkbox">
                        <label><input type="checkbox" name="menuUsers" id="menuUsers" value="True">&nbsp;Usuários</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="menuContacts" id="menuContacts" value="True">&nbsp;Contatos</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="menuCurriculos" id="menuCurriculos" value="True">&nbsp;Currículos</label>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div>Credenciais de Acesso</div>
                    <div class="text-muted small">Preencha os campos corretamente.</div>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation"> Senha</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" data-validation="required" data-validation-error-msg="Digite uma senha">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password"> Confirmação de senha</label>
                                <input type="password" class="form-control" id="password" name="password" data-validation="confirmation" data-validation-error-msg="Confirmação de senha inválida">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="notice-container">
            </div>
        </div>

        <div class="card-footer bg-light text-right">
            <button type="submit" class="btn btn-success" id="save-button"><i class="fas fa-save"></i> Salvar</button>
        </div>
    </form>
</div>
<script src="<?php echo BASE_URL ?>assets/js/controllers/userRegisterController.js"></script>
<script>
    PageController.start();
</script>