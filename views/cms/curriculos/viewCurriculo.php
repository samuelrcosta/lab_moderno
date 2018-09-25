<div class="card">
    <div class="card-header bg-light">
        Currículo do <?= $curriculoData['name'] ?>
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
                    <span><?= $curriculoData['date'] ?></span><br><br>

                    <span><strong>Nome</strong></span><br>
                    <span><?= $curriculoData['name'] ?></span><br><br>
                </div>
                <div class="col-md-6">
                    <span><strong>E-mail</strong></span><br>
                    <span><?= $curriculoData['email'] ?></span><br><br>

                    <span><strong>Telefone</strong></span><br>
                    <span><?= $curriculoData['phone'] ?></span><br><br>

                    <span><strong>Celular</strong></span><br>
                    <span><?= $curriculoData['cell'] ?></span><br><br>
                </div>
                <div class="col-md-12">
                    <span><strong>Currículo</strong></span><br>
                    <a target="_blank" href="<?= BASE_URL; ?>assets/curriculos/<?= $curriculoData['file'] ?>">Arquivo</a><br><br>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card card-answer" style="display: none;">
    <div class="card-header bg-light">
        Respondendo - <b><?= $curriculoData['email'] ?></b>
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
<script src="<?php echo BASE_URL ?>assets/js/controllers/curriculoCMSViewController.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        PageController.start(<?= $curriculoData['id'] ?>);
    });
</script>