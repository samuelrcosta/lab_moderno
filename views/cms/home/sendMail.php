<div class="card card-answer">
    <div class="card-header bg-light">
        Enviar E-mail
    </div>

    <div class="card-body">
        <form id="formEmail">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" id="name" data-validation="required" data-validation-error-msg="Digite um nome"/>
            </div>


            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" class="form-control" name="email" id="email" data-validation="email required" data-validation-error-msg="Digite um e-mail válido"/>
            </div>

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
                <button type="submit" class="btn btn-success sendAnswer"><i class="fas fa-envelope"></i> Enviar</button>
            </div>
        </form>
    </div>
</div>
<script src="<?php echo BASE_URL ?>vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/controllers/sendMailCMSController.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        PageController.start();
    });
</script>