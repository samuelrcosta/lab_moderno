const PageController = {
    // Ids
    CARD_ANSWER: '.card-answer',
    FORM_ANSWER: '#formEmail',
    INPUT_SUBJECT: '#subject',
    INPUT_MESSAGE: 'message',

    // buttons
    BUTTON_ANSWER: '.answer',
    BUTTON_SEND: '.sendAnswer',

    // containers
    NOTICE_CONTAINER: '.notice-container',

    // Templates

    // Variables for control and storage
    _contactId: null,
    // Variables to storage templates

    // ---------------------------------------------- LoadTemplates --------------------------------------------------//
    _loadTemplates: function _loadTemplates(){
    },

    _listeners: function _listeners(){
        // Button to shows answer form
        $(PageController.BUTTON_ANSWER).click(function(){
            // Shows form card
            $(PageController.CARD_ANSWER).slideDown(400, function(){
                this.scrollIntoView(false);
            });
        });

        // Validate fields
        PageController._validateFields();
    },

    // ---------------------------------------------- renders --------------------------------------------------//
    _render: function _render(template, data){
        return Mustache.render(template, data);
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
                    setTimeout(PageController._sendAnswer, 20);
                }
                return false; // Will stop the submission of the form
            }
        });
    },

    _sendAnswer: function _sendAnswer(){
        let formData = new FormData();
        // Creates the formData
        formData.append('id', PageController._contactId);
        formData.append('subject', $(PageController.INPUT_SUBJECT).val());
        formData.append('message', CKEDITOR.instances.message.getData());
        let sending = JSON.parse(PageController.sendForm(formData));
        // Return sends button to normal
        $(PageController.BUTTON_SEND).attr('disabled', false).html('<i class="fas fa-check"></i> Enviar');
        if(sending === true){
            let urlData = encodeURI("?notification=Mensagem enviada com sucesso&status=alert-success");
            window.location.replace(BASE_URL + 'curriculosCMS' + urlData);
        }else{
            $(PageController.NOTICE_CONTAINER).html('<div class="alert alert-danger" role="alert">' + sending + '</div>').show();
        }
    },

    // ---------------------------------------------- SendForm --------------------------------------------------//
    sendForm: function sendForm(formData){
        let callback = false;
        $.ajax({
            url: BASE_URL + 'curriculosCMS/sendAnswer',
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

    start: function start(contactId){
        //CKEDITOR
        CKEDITOR.replace('message');
        this._contactId = contactId;
        // Load all templates
        this._loadTemplates();
        // Activate page listeners
        this._listeners();
    }
};