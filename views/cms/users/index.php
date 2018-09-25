<div class="card">
    <div class="card-header bg-light" style="display: flex;align-items: center;justify-content: space-between;">
        Usuários Cadastrados <a href="<?= BASE_URL ?>usersCMS/newUser" class="btn btn-success"><i class="fa fa-plus"></i> Novo Usuário</a>
    </div>

    <div class="card-body">
        <?php if(isset($_GET['notification'])):?>
            <div class='alert <?php echo $_GET['status']; ?> notification'>
                <?php echo urldecode($_GET['notification']); ?>
            </div>
        <?php endif; ?>
        <div class="input-group" style="margin-bottom: 20px">
            <input type="text" class="form-control" id="search" placeholder="Digite um nome ou e-mail">
            <span class="input-group-btn">
                <button type="button" class="btn btn-default" style="background-color: #CCCCCC;"><i class="fa fa-search"></i> Pesquisar</button>
            </span>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr style="text-align: center">
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody id="users_result">
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="background-dark" style="display: none"></div>
<div id="confirm-delete" style="display: none">
    <p>Tem certeza que deseja excluir o usuário?</p>
    <button id="btn-confirm-delete" class="btn btn-danger">Sim</button>
    <button id="btn-not-delete" class="btn btn-success" >Não</button>
</div>
<script src="<?php echo BASE_URL ?>assets/js/controllers/usersCMSController.js"></script>
<script type="text/template" id="template-table-users">
    {{#.}}
    <tr style="text-align: center">
        <td>{{name}}</td>
        <td>{{email}}</td>
        <td data-id="{{id}}">
            <button class='btn btn-info edit-user' data-toggle="tooltip" data-placement="bottom" title="Editar o usuário"><i class='icon icon-pencil'></i></button>
        </td>
        <td data-id="{{id}}">
            <button class='btn btn-danger delete-user' data-toggle="tooltip" data-placement="bottom" title="Excluir o usuário"><i class='icon icon-trash'></i></button>
        </td>
    </tr>
    {{/.}}
</script>
<script type="text/javascript">
    $(document).ready(function(){
        PageController.start(<?php echo json_encode($usersData) ?>);
    });
</script>