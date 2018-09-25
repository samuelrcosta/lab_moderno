const TrabalheConosco = {
  URL_AJAX: "ajax/ajaxGerenciaItens.php?tipo=",
  URL_AJAX_POST: BASE_URL + "trabalheconosco/registro",
  ASYNC: false,

  // INPUTS
  NAME: "#name",
  EMAIL: "#email",
  PHONE: "#phone",
  CELL: "#cell",
  FILE: "#curriculo",

  // BUTTONS
  BOTAO_LIMPAR_FORM: "#limparForm",
  
  // CONTAINERS
  CONTAINER_RESULT: "#notification",
  
  // FORM
  FORM_JOB: "#jobForm",
  
  _data: null,

  _loadTemplates: function _loadTemplates(){  },

  _getTemplate: function _getTemplate(template){
  },

  _listeners: function _listeners(){
    $(TrabalheConosco.PHONE).mask("(00) 0000-00009");
    $(TrabalheConosco.CELL).mask("(00) 0000-00009");

    TrabalheConosco._validacaoCurriculum();
  },

  _validacaoCurriculum: function _validacaoCurriculum(){
    $(TrabalheConosco.FORM_JOB).formValidation({
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
        cell: {
          validators: {
            notEmpty: {
              message: 'Preencha seu celular'
            }
          }
        },
        curriculo: {
          validators: {
            notEmpty: {
              message: 'Envie o currículo'
            },
            file: {
              extension: 'jpeg,jpg,png,pdf,doc,docx',
              type: 'image/jpeg,image/png,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
              maxSize: 5242880,
              message: 'O arquivo deve ser no formato jpeg, pdf ou doc, e não pode ultrapassar 5mb'
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
      TrabalheConosco._loadingButton();
      // Envia os dados
      setTimeout(TrabalheConosco._registerCurriculum, 100);
    });
  },

  _registerCurriculum: function _registerCurriculum(){
    // Limpta os erros
    $(TrabalheConosco.CONTAINER_RESULT).html("");
    // Monta o form
    let form = new FormData($(TrabalheConosco.FORM_JOB)[0]);
    let response = TrabalheConosco._submitForm(form);
    if(response === true){
      $(TrabalheConosco.BOTAO_LIMPAR_FORM).trigger('click');
      // Volta o botao
      TrabalheConosco._resetButton();
      // Reseta o form
      $(TrabalheConosco.FORM_JOB).data('formValidation').resetForm();
      let msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
        '<strong>Currículo recebido! Entraremos em contato assim que possível.</strong>' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '    <span aria-hidden="true">&times;</span>' +
        '</button>' +
        '</div>';
      $(TrabalheConosco.CONTAINER_RESULT).html(msg);
    }else{
      // Volta o botao
      TrabalheConosco._resetButton();
      let msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
        '<strong>Ocorreu um erro ao enviar o currículo, tente novamente mais tarde.</strong>' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '    <span aria-hidden="true">&times;</span>'+
        '</button>'+
        '</div>';
      $(TrabalheConosco.CONTAINER_RESULT).html(msg);
    }
  },

  _loadingButton: function _loadingButton(){
    $("#send").html("<i class='fas fa-spinner fa-spin'></i> Aguarde por favor").attr('disabled', true);
  },

  _resetButton: function _resetButton(){
    $("#send").html("<i class='fas fa-envelope'></i> Enviar Currículo").attr('disabled', false);
  },

  _getDados: function _getDados(request){
    $.ajax({
      url: TrabalheConosco.URL_AJAX + request,
      async: TrabalheConosco.ASYNC,
      success: function(data){
        TrabalheConosco._data = data;
      }
    });
  },

  _submitForm: function _submitForm(formulario){
    let retorno = false;
    $.ajax({
      url: TrabalheConosco.URL_AJAX_POST,
      method: 'POST',
      processData: false,
      contentType: false,
      async: TrabalheConosco.ASYNC,
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