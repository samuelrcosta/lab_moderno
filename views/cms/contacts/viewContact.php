<div class="card">
    <div class="card-header bg-light">
        Contato de <?= $contactData['name'] ?>
    </div>

    <div class="card-body">
        <?php if(isset($_GET['notification'])):?>
            <div class='alert <?php echo $_GET['status']; ?> notification'>
                <?php echo urldecode($_GET['notification']); ?>
            </div>
        <?php endif; ?>
        <div>
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-success answer"><i class="fas fa-envelope"></i> Responder</button><br><br>

                    <span><strong>Data do Contato</strong></span><br>
                    <span><?= $contactData['date'] ?></span><br><br>

                    <span><strong>Nome</strong></span><br>
                    <span><?= $contactData['name'] ?></span><br><br>
                </div>
                <div class="col-md-6">
                    <span><strong>E-mail</strong></span><br>
                    <span><?= $contactData['email'] ?></span><br><br>

                    <span><strong>Telefone</strong></span><br>
                    <span><?= $contactData['phone'] ?></span><br><br>

                    <span><strong>Celular</strong></span><br>
                    <span><?= $contactData['cell'] ?></span><br><br>
                </div>
                <div class="col-md-6">
                    <span><strong>Status</strong></span><br>
                    <select class="form-control" id="select-status">
                        <option value="1" style="font-weight: bold; color: #ef5350" <?= ($contactData['status'] == "1")? 'selected':'' ?>>Recebido</option>
                        <option value="2" style="font-weight: bold; color: #28a745" <?= ($contactData['status'] == "2")? 'selected':'' ?>>Respondido</option>
                    </select>
                    <br>
                </div>
                <div class="col-md-6">
                    <span><strong>Categoria</strong></span><br>
                    <span><?= $contactData['category'] ?></span><br><br>
                </div>
                <div class="col-md-12">
                    <span><strong>Assunto</strong></span><br>
                    <span><?= $contactData['subject'] ?></span><br><br>

                    <span><strong>Mensagem</strong></span><br>
                    <span style="white-space: pre-wrap;"><?= $contactData['message'] ?></span><br><br>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card card-answer" style="display: none;">
    <div class="card-header bg-light">
        Respondendo - <b><?= $contactData['email'] ?></b>
    </div>

    <div class="card-body">
        <form id="formEmail">
            <div class="form-group">
                <label for="subject">Assunto</label>
                <input type="text" class="form-control" name="subject" id="subject" data-validation="required" data-validation-error-msg="Digite um assunto"/>
            </div>

            <div class="form-group">
                <label for="message">Mensagem</label>
                <textarea name="message" class="form-control" id="message" data-validation="required" data-validation-error-msg="Digite uma mensagem"></textarea>
            </div>

            <div class="notice-container">

            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success sendAnswer"><i class="fas fa-check"></i> Enviar</button>
            </div>
        </form>
    </div>
</div>
<script src="<?php echo BASE_URL ?>vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/controllers/contactsCMSViewController.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        PageController.start(<?= $contactData['id'] ?>);
    });
</script>