const FaleConosco = {
    URL_AJAX: "ajax/ajaxGerenciaItens.php?tipo=",
    URL_AJAX_POST: BASE_URL + "faleconosco/registro",
    ASYNC: false,

    // INPUTS
    NAME: "#name",
    CATEGORY: "#category",
    EMAIL: "#email",
    PHONE: "#phone",
    CELL: "#cell",
    SUBJECT: "#subject",
    MESSAGE: "#message",

    // BUTTONS
    BOTAO_LIMPAR_FORM: "#limparForm",

    // CONTAINERS
    CONTAINER_RESULT: "#notification",

    // FORM
    FORM_CONTACT: "#contactForm",

    _data: null,

    _loadTemplates: function _loadTemplates(){  },

    _getTemplate: function _getTemplate(template){
    },

    _listeners: function _listeners(){
        $(FaleConosco.PHONE).mask("(00) 0000-00009");
        $(FaleConosco.CELL).mask("(00) 0000-00009");

        FaleConosco._validacaoContact();
    },

    _validacaoContact: function _validacaoContact(){
        $(FaleConosco.FORM_CONTACT).formValidation({
            framework: 'bootstrap4',
            icon: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-sync'
            },
            row: {
                valid: 'has-success',
                invalid: 'has-danger'
            },
            excluded: ':disabled',
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'Preencha seu nome'
                        }
                    }
                },
                category: {
                    validators: {
                        notEmpty: {
                            message: 'Selecione uma categoria'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Digite seu e-mail'
                        },
                        emailAddress: {
                            message: 'Digite um e-mail válido'
                        }
                    }
                },
                subject: {
                    validators: {
                        notEmpty: {
                            message: 'Digite o assunto'
                        }
                    }
                },
                message: {
                    validators: {
                        notEmpty: {
                            message: 'Digite a mensagem'
                        }
                    }
                }
            }
        })
        .on('success.field.fv err.field.fv', function(e, data) { data.fv.disableSubmitButtons(false); })
        //.on('err.field.fv', function(e, data) { data.fv.disableSubmitButtons(false); })
        .on('success.form.fv', function(e) {
            // Bloqueia o reload da página quando o formulário for enviado
            e.preventDefault();
            // Muda o botao
            FaleConosco._loadingButton();
            // Envia os dados
            setTimeout(FaleConosco._registerContact, 100);
        });
    },

    _registerContact: function _registerContact(){
        // Limpta os erros
        $(FaleConosco.CONTAINER_RESULT).html("");
        // Monta o form
        let form = new FormData($(FaleConosco.FORM_CONTACT)[0]);
        let response = FaleConosco._submitForm(form);
        if(response === true){
            $(FaleConosco.BOTAO_LIMPAR_FORM).trigger('click');
            // Volta o botao
            FaleConosco._resetButton();
            // Reseta o form
            $(FaleConosco.FORM_CONTACT).data('formValidation').resetForm();
            let msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                '<strong>Mensagem recebida! Entraremos em contato assim que possível.</strong>' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '    <span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>';
            $(FaleConosco.CONTAINER_RESULT).html(msg);
        }else{
            // Volta o botao
            FaleConosco._resetButton();
            let msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                '<strong>Ocorreu um erro ao enviar a mensagem, tente novamente mais tarde.</strong>' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '    <span aria-hidden="true">&times;</span>'+
                '</button>'+
                '</div>';
            $(FaleConosco.CONTAINER_RESULT).html(msg);
        }
    },

    _loadingButton: function _loadingButton(){
        $("#send").html("<i class='fas fa-spinner fa-spin'></i> Aguarde por favor").attr('disabled', true);
    },

    _resetButton: function _resetButton(){
        $("#send").html("<i class='fas fa-envelope'></i> Enviar Mensagem").attr('disabled', false);
    },

    _getDados: function _getDados(request){
        $.ajax({
            url: FaleConosco.URL_AJAX + request,
            async: FaleConosco.ASYNC,
            success: function(data){
                FaleConosco._data = data;
            }
        });
    },

    _submitForm: function _submitForm(formulario){
        let retorno = false;
        $.ajax({
            url: FaleConosco.URL_AJAX_POST,
            method: 'POST',
            processData: false,
            contentType: false,
            async: FaleConosco.ASYNC,
            data: formulario,
            success: function(data){
                retorno = JSON.parse(data);
            }
        });
        return retorno;
    },

    start: function start(){
        // Carrega os templates
        this._loadTemplates();
        // Ativa os listeners fixos
        this._listeners();
    }
};