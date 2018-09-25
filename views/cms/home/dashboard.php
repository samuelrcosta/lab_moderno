<h1>Dashboard</h1>
<div class="row">
    <div class="col-md-3">
        <div class="card bg-primary">
            <a style="display: block; color: white" href="<?= BASE_URL ?>admin/sendMailPage">
                <div class="card-body d-flex justify-content-between text-white flex-column">
                    <div class="font-weight-bold" style="text-align: center">
                        <span>Enviar E-mail</span><br>
                        <span style="font-size: 22px"><i class="fas fa-envelope"></i></span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success">
            <a style="display: block; color: white" href="<?= BASE_URL ?>admin/profilePage">
                <div class="card-body d-flex justify-content-between text-white flex-column">
                    <div class="font-weight-bold" style="text-align: center">
                        <span>Perfil</span><br>
                        <span style="font-size: 22px"><i class="fas fa-user"></i></span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger">
            <a style="display: block; color: white" href="<?= BASE_URL ?>admin/logoff">
                <div class="card-body d-flex justify-content-between text-white flex-column">
                    <div class="font-weight-bold" style="text-align: center">
                        <span>Sair</span><br>
                        <span style="font-size: 22px"><i class="fas fa-sign-out-alt"></i></span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>