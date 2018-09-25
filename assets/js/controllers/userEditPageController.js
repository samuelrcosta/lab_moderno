const PageController = {
    // ids
    FORM: "#edit",
    // buttons
    BUTTON_SAVE_USER: "#save-button",

    // containers
    NOTICE_CONTAINER: '.container-notices',

    // Resize

    // storage and controller variables
    _userData: null,

    _listeners: function _listeners(){
        // Fill inputs
        PageController._fillData();
        // Fields validation
        PageController._validateFields();
    },

    _fillData: function _fillData(){
        let data = PageController._userData;
        let perms = data.perms.split(";");
        $("#name").val(data.name);
        $("#email").val(data.email);
        if(perms.includes("ads")){
            $("#menuAds").prop("checked", true);
        }
        if(perms.includes("users")){
            $("#menuUsers").prop("checked", true);
        }
        if(perms.includes("contacts")){
            $("#menuContacts").prop("checked", true);
        }
        if(perms.includes("areas")){
            $("#menuAreas").prop("checked", true);
        }
        if(perms.includes("categories")){
            $("#menuCategories").prop("checked", true);
        }
        if(perms.includes("subcats")){
            $("#menuSubcategories").prop("checked", true);
        }
        if(perms.includes("homeTutorial")){
            $("#menuHomeTutorial").prop("checked", true);
        }
    },

    _validateFields: function _validateFields(){
        $.validate({
            form : PageController.FORM,
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
        let form = document.getElementById('edit');
        let formData = new FormData(form);
        formData.append('id', PageController._userData.id);
        let sending = JSON.parse(PageController.sendForm(formData));
        if(sending === true){
            let urlData = encodeURI("?notification=Usuário editado com sucesso!&status=alert-success");
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
            url: BASE_URL + 'usersCMS/editUser',
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

    start: function start(userData){
        this._userData = JSON.parse(userData);
        this._listeners();
    }
};