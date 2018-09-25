const PageController = {
    // Ids
    INPUT_SEARCH: '#search',
    CONFIRM_DELETE: "#confirm-delete",
    BACKGROUND_DARK: "#background-dark",

    // buttons
    BUTTON_VIEW_CONTACT: '.view-contact',
    BUTTON_DELETE_CONTACT: '.delete-contact',
    BUTTON_CONFIRM_DELETE: '#btn-confirm-delete',
    BUTTON_NOT_DELETE: "#btn-not-delete",

    // containers
    CONTAINER_LIST_CONTACTS: "#contacts_result",

    // Templates
    TEMPLATE_TABLE_CONTACTS: "template-table-contacts",

    // Variables for control and storage
    _contactsList: null,
    _contactId: null,

    // Variables to storage templates
    _templateTableContacts: '',

    // ---------------------------------------------- LoadTemplates --------------------------------------------------//
    _loadTemplates: function _loadTemplates(){
        this._templateTableContacts = document.getElementById(PageController.TEMPLATE_TABLE_CONTACTS).innerHTML;
    },

    _listeners: function _listeners(){
        // On search input change
        $(PageController.INPUT_SEARCH).keyup(function(){
            PageController._searchContacts($(this).val());
        });

        // On confirm to delete
        $(PageController.BUTTON_CONFIRM_DELETE).click(function(){
            // Redirects to delete page
            let id = btoa(btoa(PageController._contactId));
            window.location.replace(BASE_URL + 'contactsCMS/delete/'+id);
        });

        // On not confirm to delete
        $(PageController.BUTTON_NOT_DELETE).click(function(){
            // Hide dark background and alert
            $(PageController.BACKGROUND_DARK).hide();
            $(PageController.CONFIRM_DELETE).hide();
        });
    },

    _listenersTableButtons: function _listenersTableButtons(){
        $(PageController.BUTTON_DELETE_CONTACT).click(function(){
            PageController._contactId = $(this).parent().attr('data-id');
            // Shows dark background and alert
            $(PageController.BACKGROUND_DARK).show();
            $(PageController.CONFIRM_DELETE).show();
        });

        $(PageController.BUTTON_VIEW_CONTACT).click(function(){
            // Redirects to view page
            let id = $(this).parent().attr('data-id');
            id = btoa(btoa(id));
            window.location.replace(BASE_URL + 'contactsCMS/viewContact/'+id);
        });
    },

    // ---------------------------------------------- renders --------------------------------------------------//
    _render: function _render(template, data){
        return Mustache.render(template, data);
    },

    _renderContactsList: function _renderContactsList(list){
        // Checks if the list have contacts
        if(list.length > 0){
            let render = PageController._render(PageController._templateTableContacts, list);
            $(PageController.CONTAINER_LIST_CONTACTS).html(render);
            // Activate boostrap tooltip
            $('[data-toggle="tooltip"]').tooltip();
            // Activate buttons listeners
            PageController._listenersTableButtons();
        }else{
            let msg = "<tr><td colspan='6' style='text-align: center; font-weight: bold'>Nenhum contato encontrado.</td></tr>";
            $(PageController.CONTAINER_LIST_CONTACTS).html(msg);
        }
    },

    // ---------------------------------------------- Utils --------------------------------------------------//
    _saveContactList: function _saveContactList(contactList){
        PageController._contactsList = contactList;
        for(let i = 0; i < PageController._contactsList.length; i++){
            if(PageController._contactsList[i].status === '1'){
                PageController._contactsList[i].status = "Recebido";
                PageController._contactsList[i].cod_status = "1";
            }else if(PageController._contactsList[i].status === '2'){
                PageController._contactsList[i].status = "Respondido";
                PageController._contactsList[i].cod_status = "2";
            }
        }
    },

    _searchContacts: function _searchContacts(term){
        term = term.toLowerCase();
        list = [];
        for(let i = 0; i < PageController._contactsList.length; i++){
            let name = PageController._contactsList[i].name.toLowerCase();
            let email = PageController._contactsList[i].email.toLowerCase();
            let subject = PageController._contactsList[i].subject.toLowerCase();
            if((name.search(term) !== -1) || (email.search(term) !== -1) || (subject.search(term) !== -1)){
                list.push(PageController._contactsList[i]);
            }
        }

        PageController._renderContactsList(list);
    },

    // ---------------------------------------------- Start --------------------------------------------------//

    start: function start(contactList){
        // Load all templates
        this._loadTemplates();
        // Get contacts list
        this._saveContactList(contactList);
        // Render all contacts
        this._renderContactsList(PageController._contactsList);
        // Activate page listeners
        this._listeners();
    }
};