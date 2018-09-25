const PageController = {
    // Ids
    SELECT_STATUS: '#select-status',
    CARD_ANSWER: '.card-answer',
    FORM_ANSWER: '#formEmail',
    INPUT_EMAIL: '#email',
    INPUT_SUBJECT: '#subject',
    INPUT_MESSAGE: 'message',

    // buttons
    BUTTON_ANSWER: '.answer',
    BUTTON_SEND: '.sendAnswer',

    // containers
    NOTICE_CONTAINER: '.notice-container',


    // Variables for control and storage

    _listeners: function _listeners(){
        // Validate fields
        PageController._validateFields();
    },

    // ---------------------------------------------- Utils --------------------------------------------------//
    _validateFields: function _validateFields(){
        $.validate({
            form : PageController.FORM_ANSWER,
            onError : function($form) {
                $(PageController.NOTICE_CONTAINER).html('<div class="alert alert-warning" role="alert"> Preencha todos os campos obrigatórios.</div>');
                return false;
            },
            onSuccess : function($form) {
                // Checks the message input
                if(CKEDITOR.instances.message.getData() == ""){
                    $(PageController.NOTICE_CONTAINER).html('<div class="alert alert-warning" role="alert"> Preencha todos os campos obrigatórios.</div>');
                }else{
                    $(PageController.NOTICE_CONTAINER).hide();
                    $(PageController.NOTICE_CONTAINER).html("");
                    // TurnOff the save button
                    $(PageController.BUTTON_SEND).attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Aguarde');
                    setTimeout(PageController._sendMail, 20);
                }
                return false; // Will stop the submission of the form
            }
        });
    },

    _sendMail: function _sendMail(){
        $("#message").val(CKEDITOR.instances.message.getData());
        let form = document.getElementById('formEmail');
        let formData = new FormData(form);
        let sending = JSON.parse(PageController.sendForm(formData));
        // Return sends button to normal
        $(PageController.BUTTON_SEND).attr('disabled', false).html('<i class="fas fa-check"></i> Enviar');
        if(sending === true){
            // Clean all fields
            CKEDITOR.instances.message.setData("");
            $(PageController.FORM_ANSWER).find('input').val("");
            // Reset FormValidator
            $(PageController.FORM_ANSWER).get(0).reset();
            $(PageController.NOTICE_CONTAINER).html('<div class="alert alert-success" role="alert">E-mail enviado com sucesso!</div>').show();
        }else{
            $(PageController.NOTICE_CONTAINER).html('<div class="alert alert-danger" role="alert">' + sending + '</div>').show();
        }
    },

    // ---------------------------------------------- SendForm --------------------------------------------------//
    sendForm: function sendForm(formData){
        let callback = false;
        $.ajax({
            url: BASE_URL + 'admin/sendMail',
            data: formData,
            async: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data){
                callback = data;
            }
        });
        return callback;
    },

    // ---------------------------------------------- Start --------------------------------------------------//

    start: function start(){
        //CKEDITOR
        CKEDITOR.replace('message');
        // Activate page listeners
        this._listeners();
    }
};