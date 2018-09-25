const PageController = {
    // Ids
    INPUT_SEARCH: '#search',
    CONFIRM_DELETE: "#confirm-delete",
    BACKGROUND_DARK: "#background-dark",

    // buttons
    BUTTON_EDIT_USER: '.edit-user',
    BUTTON_DELETE_USER: '.delete-user',
    BUTTON_CONFIRM_DELETE: '#btn-confirm-delete',
    BUTTON_NOT_DELETE: "#btn-not-delete",

    // containers
    CONTAINER_LIST_USERS: "#users_result",

    // Templates
    TEMPLATE_TABLE_USERS: "template-table-users",

    // Variables for control and storage
    _usersList: null,
    _userId: null,

    // Variables to storage templates
    _templateTableUsers: '',

    // ---------------------------------------------- LoadTemplates --------------------------------------------------//
    _loadTemplates: function _loadTemplates(){
        this._templateTableUsers = document.getElementById(PageController.TEMPLATE_TABLE_USERS).innerHTML;
    },

    _listeners: function _listeners(){
        // On search input change
        $(PageController.INPUT_SEARCH).keyup(function(){
            PageController._searchUsers($(this).val());
        });

        // On confirm to delete
        $(PageController.BUTTON_CONFIRM_DELETE).click(function(){
            // Redirects to delete page
            let id = btoa(btoa(PageController._areaId));
            window.location.replace(BASE_URL + 'usersCMS/deleteUser/' + id);
        });

        // On not confirm to delete
        $(PageController.BUTTON_NOT_DELETE).click(function(){
            // Hide dark background and alert
            $(PageController.BACKGROUND_DARK).hide();
            $(PageController.CONFIRM_DELETE).hide();
        });
    },

    _listenersTableButtons: function _listenersTableButtons(){
        $(PageController.BUTTON_DELETE_USER).click(function(){
            PageController._areaId = $(this).parent().attr('data-id');
            // Shows dark background and alert
            $(PageController.BACKGROUND_DARK).show();
            $(PageController.CONFIRM_DELETE).show();
        });

        $(PageController.BUTTON_EDIT_USER).click(function(){
            // Redirects to view page
            let id = $(this).parent().attr('data-id');
            id = btoa(btoa(id));
            window.location.replace(BASE_URL + 'usersCMS/editUserPage/'+id);
        });
    },

    // ---------------------------------------------- renders --------------------------------------------------//
    _render: function _render(template, data){
        return Mustache.render(template, data);
    },

    _renderUsersList: function _renderUsersList(list){
        // Checks if the list have users
        if(list.length > 0){
            let render = PageController._render(PageController._templateTableUsers, list);
            $(PageController.CONTAINER_LIST_USERS).html(render);
            // Activate boostrap tooltip
            $('[data-toggle="tooltip"]').tooltip();
            // Activate buttons listeners
            PageController._listenersTableButtons();
        }else{
            let msg = "<tr><td colspan='6' style='text-align: center; font-weight: bold'>Nenhum usuário encontrado.</td></tr>";
            $(PageController.CONTAINER_LIST_USERS).html(msg);
        }
    },

    // ---------------------------------------------- Utils --------------------------------------------------//
    _saveUsersList: function _saveUsersList(usersList){
        PageController._usersList = usersList;
    },

    _searchUsers: function _searchUsers(term){
        term = term.toLowerCase();
        list = [];
        for(let i = 0; i < PageController._usersList.length; i++){
            let name = PageController._usersList[i].name.toLowerCase();
            let email = PageController._usersList[i].email.toLowerCase();
            if(name.search(term) !== -1 || email.search(term) !== -1){
                list.push(PageController._usersList[i]);
            }
        }

        PageController._renderUsersList(list);
    },

    // ---------------------------------------------- Start --------------------------------------------------//

    start: function start(usersList){
        // Load all templates
        this._loadTemplates();
        // Get users list
        this._saveUsersList(usersList);
        // Render all users
        this._renderUsersList(PageController._usersList);
        // Activate page listeners
        this._listeners();
    }
};