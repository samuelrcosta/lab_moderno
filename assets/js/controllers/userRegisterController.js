const PageController = {
    // buttons
    BUTTON_SAVE_USER: "#save-button",

    // containers
    NOTICE_CONTAINER: '.notice-container',

    // Resize

    _listeners: function _listeners(){
        // Filds validation
        PageController._validateFields();
    },

    _validateFields: function _validateFields(){
        $.validate({
            form : '#register',
            modules : 'security',
            onError : function($form) {
                $(PageController.NOTICE_CONTAINER).html('<div class="alert alert-warning" role="alert"> Preencha todos os campos obrigatórios.</div>');
                return false;
            },
            onSuccess : function($form) {
                $(PageController.NOTICE_CONTAINER).hide();
                $(PageController.NOTICE_CONTAINER).html("");
                // TurnOff the save button
                $(PageController.BUTTON_SAVE_USER).attr('disabled', true).html('<i class="fa fa-spinner"></i> Aguarde');
                setTimeout(PageController._saveUser, 0);
                return false; // Will stop the submission of the form
            }
        });
    },

    _saveUser: function _saveUser(){

        let form = document.getElementById('register');
        let formData = new FormData(form);
        let sending = JSON.parse(PageController.sendForm(formData));
        if(sending === true){
            let urlData = encodeURI("?notification=Usuário cadastrado com sucesso!&status=alert-success");
            window.location.replace(BASE_URL + 'usersCMS'+urlData);
        }else{
            $(PageController.NOTICE_CONTAINER).html('<div class="alert alert-warning" role="alert">' + sending + '</div>').show();
            $(PageController.BUTTON_SAVE_USER).attr('disabled', false).html('<i class="fa fa-save"></i> Salvar');
        }
    },



    // ---------------------------------------------- sendForm --------------------------------------------------//
    sendForm: function sendForm(formData){
        let callback = false;
        $.ajax({
            url: BASE_URL + 'usersCMS/saveNewUser',
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

    start: function start(){
        this._listeners();
    }
};