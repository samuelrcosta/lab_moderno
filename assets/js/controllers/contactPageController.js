const PageController = {

    // ids
    FORM: '#contactForm',
    INPUT_PHONE: "#phone",

    // buttons
    BUTTON_SAVE_CONTACT: ".save-contact-button",

    // containers
    NOTICE_CONTAINER: '.container-notices',
    CONTAINER_SUCCESS: '.container-success-notice',

    // Resize

    _listeners: function _listeners(){
        // Fields masks
        $(PageController.INPUT_PHONE).mask("(00) 0000-00009");
        // Fields validation
        PageController._validateFields();
    },

    _validateFields: function _validateFields(){
        $.validate({
            form : PageController.FORM,
            modules : 'file',
            onError : function($form) {
                return false;
            },
            onSuccess : function($form) {
                $(PageController.NOTICE_CONTAINER).hide();
                $(PageController.NOTICE_CONTAINER).html("");
                // TurnOff the save button
                $(PageController.BUTTON_SAVE_CONTACT).attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Aguarde');
                setTimeout(PageController._saveContact, 0);
                return false; // Will stop the submission of the form
            }
        });
    },

    _saveContact: function _saveContact(){
        let formData = new FormData($(PageController.FORM).get(0));
        let sending = JSON.parse(PageController.sendForm(formData));
        // Return sends button to normal
        $(PageController.BUTTON_SAVE_CONTACT).attr('disabled', false).html('<i class="fa fa-envelope"></i> Enviar');
        if(sending === true){
            // Clean all inputs
            $(PageController.FORM).find('input').val("");
            $(PageController.FORM).find('textarea').val("");
            // Reset FormValidator
            $(PageController.FORM).get(0).reset();
            $(PageController.CONTAINER_SUCCESS).html('<div class="alert alert-success" style="border-radius: 0" role="alert">Sua mensagem foi enviada com sucesso.<br>Em breve responderemos.</div>').slideDown();
        }else{
            $(PageController.NOTICE_CONTAINER).html('<div class="alert alert-danger" style="border-radius: 0" role="alert">' + sending + '</div>').show();
        }
    },

    // ---------------------------------------------- sendForm --------------------------------------------------//
    sendForm: function sendForm(formData){
        let callback = false;
        $.ajax({
            url: BASE_URL + 'info/saveContact',
            data: formData,
            async: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                callback = data;
            }
        });
        return callback;
    },

    start: function start(){
        this._listeners();
    }
};