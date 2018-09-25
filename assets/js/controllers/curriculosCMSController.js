const PageController = {
    // Ids
    INPUT_SEARCH: '#search',
    CONFIRM_DELETE: "#confirm-delete",
    BACKGROUND_DARK: "#background-dark",

    // buttons
    BUTTON_VIEW_CURRICULO: '.view-curriculo',
    BUTTON_DELETE_CURRICULO: '.delete-curriculo',
    BUTTON_CONFIRM_DELETE: '#btn-confirm-delete',
    BUTTON_NOT_DELETE: "#btn-not-delete",

    // containers
    CONTAINER_LIST_CURRICULOS: "#curriculos_result",

    // Templates
    TEMPLATE_TABLE_CURRICULOS: "template-table-curriculos",

    // Variables for control and storage
    _curriculosList: null,
    _curriculoId: null,

    // Variables to storage templates
    _templateTableCurriculos: '',

    // ---------------------------------------------- LoadTemplates --------------------------------------------------//
    _loadTemplates: function _loadTemplates(){
        this._templateTableCurriculos = document.getElementById(PageController.TEMPLATE_TABLE_CURRICULOS).innerHTML;
    },

    _listeners: function _listeners(){
        // On search input change
        $(PageController.INPUT_SEARCH).keyup(function(){
            PageController._searchCurriculos($(this).val());
        });

        // On confirm to delete
        $(PageController.BUTTON_CONFIRM_DELETE).click(function(){
            // Redirects to delete page
            let id = btoa(btoa(PageController._contactId));
            window.location.replace(BASE_URL + 'curriculosCMS/delete/'+id);
        });

        // On not confirm to delete
        $(PageController.BUTTON_NOT_DELETE).click(function(){
            // Hide dark background and alert
            $(PageController.BACKGROUND_DARK).hide();
            $(PageController.CONFIRM_DELETE).hide();
        });
    },

    _listenersTableButtons: function _listenersTableButtons(){
        $(PageController.BUTTON_DELETE_CURRICULO).click(function(){
            PageController._contactId = $(this).parent().attr('data-id');
            // Shows dark background and alert
            $(PageController.BACKGROUND_DARK).show();
            $(PageController.CONFIRM_DELETE).show();
        });

        $(PageController.BUTTON_VIEW_CURRICULO).click(function(){
            // Redirects to view page
            let id = $(this).parent().attr('data-id');
            id = btoa(btoa(id));
            window.location.replace(BASE_URL + 'curriculosCMS/viewCurriculo/'+id);
        });
    },

    // ---------------------------------------------- renders --------------------------------------------------//
    _render: function _render(template, data){
        return Mustache.render(template, data);
    },

    _renderCurriculoList: function _renderCurriculoList(list){
        // Checks if the list have curriculum
        if(list.length > 0){
            let render = PageController._render(PageController._templateTableCurriculos, list);
            $(PageController.CONTAINER_LIST_CURRICULOS).html(render);
            // Activate boostrap tooltip
            $('[data-toggle="tooltip"]').tooltip();
            // Activate buttons listeners
            PageController._listenersTableButtons();
        }else{
            let msg = "<tr><td colspan='6' style='text-align: center; font-weight: bold'>Nenhum currículo encontrado.</td></tr>";
            $(PageController.CONTAINER_LIST_CURRICULOS).html(msg);
        }
    },

    // ---------------------------------------------- Utils --------------------------------------------------//
    _saveCurriculoList: function _saveCurriculoList(curriculosList){
        PageController._curriculosList = curriculosList;
    },

    _searchCurriculos: function _searchCurriculos(term){
        term = term.toLowerCase();
        list = [];
        for(let i = 0; i < PageController._curriculosList.length; i++){
            let name = PageController._curriculosList[i].name.toLowerCase();
            let email = PageController._curriculosList[i].email.toLowerCase();
            if((name.search(term) !== -1) || (email.search(term) !== -1)){
                list.push(PageController._curriculosList[i]);
            }
        }

        PageController._renderCurriculoList(list);
    },

    // ---------------------------------------------- Start --------------------------------------------------//

    start: function start(curriculosList){
        // Load all templates
        this._loadTemplates();
        // Get contacts list
        this._saveCurriculoList(curriculosList);
        // Render all contacts
        this._renderCurriculoList(PageController._curriculosList);
        // Activate page listeners
        this._listeners();
    }
};