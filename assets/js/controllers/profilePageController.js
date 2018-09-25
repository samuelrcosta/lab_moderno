const PageController = {
    // ids
    INPUT_IMAGE: "#image",
    SAVE_BUTTON: '.save-button',
    // containers
    NOTICE_CONTAINER: '.container-notices',
    // Resize
    RESIZE: new window.resize(),

    // Variables to storage data
    _userData: null,

    _listeners: function _listeners(){
        // Fill fields
        PageController._fillFields();
        // Fields validation
        PageController._validateFields();
        // When choose a image
        $(PageController.INPUT_IMAGE).change(PageController._renderizeImage);
    },

    _fillFields: function _fillFields(){
        let data = PageController._userData;
        $("#name").val(data.name);
        $("#email").val(data.email);
        $(".image-area").html("<img width='100' height='100' style='border-radius: 50px;object-fit: cover;' src='" + BASE_URL + "assets/imgs/users_profile/" + data.avatar + "' />");
    },

    _validateFields: function _validateFields(){
        $.validate({
            form : '#profileForm',
            modules : 'security, file',
            onError : function($form) {
                $(PageController.NOTICE_CONTAINER).html('<div class="alert alert-warning" role="alert"> Preencha todos os campos obrigatórios.</div>');
                return false;
            },
            onSuccess : function($form) {
                $(PageController.NOTICE_CONTAINER).hide();
                $(PageController.NOTICE_CONTAINER).html("");
                // TurnOff the save button
                $(PageController.SAVE_BUTTON).attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Aguarde');
                setTimeout(PageController._saveProfile, 20);
                return false; // Will stop the submission of the form
            }
        });
    },

    _saveProfile: function _saveProfile(){
        let form = document.getElementById('profileForm');
        let formData = new FormData(form);
        let sending = JSON.parse(PageController.sendForm(formData));
        if(sending === true){
            $(PageController.NOTICE_CONTAINER).html('<div class="alert alert-success" role="alert">Dados editados com sucesso</div>').show();
            $(PageController.SAVE_BUTTON).attr('disabled', false).html('<i class="fa fa-save"></i> Salvar');
        }else{
            $(PageController.NOTICE_CONTAINER).html('<div class="alert alert-warning" role="alert">' + sending + '</div>').show();
            $(PageController.SAVE_BUTTON).attr('disabled', false).html('<i class="fa fa-save"></i> Salvar');
        }
    },


    // -------------------------------------- Image rendering -------------------------------------- //
    // Renderiza a imagem
    _renderizeImage: function _renderizeImage() {
        let $elemento = $(this);
        let $container = $elemento.parent().parent();
        // Verify if the navegator have capacity
        if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
            alert('O navegador não suporta os recursos utilizados pelo aplicativo');
            return;
        }
        // Saving the image
        let image = $elemento[0].files;
        // If send at least one image
        if (image.length > 0) {
            // Set 0% in progress bar
            $container.find('.progresso').attr('aria-valuenow', 0).css('width', '0%');
            // Hinding image input
            $elemento.hide();
            // Start the image resizing
            if(PageController._resizeImage($elemento, image)){
                // Shows the finish image
                $container.find('.progresso').append('Imagen(s) enviada(s) com sucesso');
                // Showing the image input
                $elemento.show();
            }else{
                // Refresh the progress bar
                let progress = 100;
                $container.find('.progresso').text(Math.round(progress) + '%').attr('aria-valuenow', progress).css('width', progress + '%');
                // Shows the error
                $container.find('.progresso').append('Arquivo de imagem inválido');
            }
        }
    },

    _resizeImage: function _resizeImage($elemento, image) {
        let $container = $elemento.parent().parent();
        // If is not a valid image
        if ((typeof image[0] !== 'object') || (image[0] == null)) {
            // Returns error
            return false;
        }else{
            // Resizing the image
            PageController.RESIZE.photo(image[0], 800, 'dataURL', function (imagem) {
                // Creating the image tag
                let imageTag = "<h5>Pré-visulização da imagem:</h5><img width='100' height='100' style='border-radius: 50px;object-fit: cover;' src='" + imagem + "' >";
                // Show the selected image
                $container.find(".image-area").html(imageTag);
                // Refresh the progress bar
                let progress = 100;
                $container.find('.progresso').text(Math.round(progress) + '%').attr('aria-valuenow', progress).css('width', progress + '%');
            });
            // Return success
            return true;
        }
    },

    // ---------------------------------------------- sendForm --------------------------------------------------//
    sendForm: function sendForm(formData){
        let callback = false;
        $.ajax({
            url: BASE_URL + 'admin/editProfile',
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
        // Initializing resize library
        PageController.RESIZE.init();
        this._userData = JSON.parse(userData);
        // Activate listeners
        this._listeners();
    }
};