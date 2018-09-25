<div class="card">
    <div class="card-header bg-light">
        Contatos
    </div>

    <div class="card-body">
        <?php if(isset($_GET['notification'])):?>
            <div class='alert <?php echo $_GET['status']; ?> notification'>
                <?php echo urldecode($_GET['notification']); ?>
            </div>
        <?php endif; ?>
        <div class="input-group" style="margin-bottom: 20px">
            <input type="text" class="form-control" id="search" placeholder="Digite um nome, e-mail ou assunto">
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
                        <th>Data</th>
                        <th>Assunto</th>
                        <th>Status</th>
                        <th style="text-align: center">Ações</th>
                    </tr>
                </thead>
                <tbody id="contacts_result">
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="background-dark" style="display: none"></div>
<div id="confirm-delete" style="display: none">
    <p>Tem certeza que deseja excluir o contato?</p>
    <button id="btn-confirm-delete" class="btn btn-danger">Sim</button>&nbsp;
    <button id="btn-not-delete" class="btn btn-success">Não</button>
</div>
<script src="<?php echo BASE_URL ?>assets/js/controllers/contactsCMSController.js"></script>
<script type="text/template" id="template-table-contacts">
    {{#.}}
    <tr style="text-align: center">
        <td>{{name}}</td>
        <td>{{email}}</td>
        <td>{{date}}</td>
        <td>{{subject}}</td>
        <td class="status-{{status}}">{{status}}</td>
        <td data-id="{{id}}">
            <button class='btn btn-info view-contact' data-toggle="tooltip" data-placement="bottom" title="Visualizar contato"><i class='icon icon-eye'></i></button>&nbsp;
            <button class='btn btn-danger delete-contact' data-toggle="tooltip" data-placement="bottom" title="Excluir contato"><i class='icon icon-trash'></i></button>
        </td>
    </tr>
    {{/.}}
</script>
<script type="text/javascript">
    $(document).ready(function(){
        PageController.start(<?php echo json_encode($contactsData) ?>);
    });
</script>