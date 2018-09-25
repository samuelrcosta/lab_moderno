<?php
/**
 * This class is the Controller of the Admin Users panel.
 *
 * @author  samuelrcosta
 * @version 1.2.5, 05/24/2018
 * @since   1.0, 01/20/2017
 */

class usersCMSController extends Controller{

    // Models instances
    private $u;
    private $s;

    /**
     * Class constructor
     */
    public function __construct(){
        parent::__construct();
        // Initialize instances
        $this->u = new Administrators();
        $this->s = new Store();
    }

    /**
     * This function shows the Admin Users List page.
     */
    public function index(){
        $data = array();

        if($this->u->isLogged() && $this->u->havePermission('users')){
            $data['title'] = 'ADM - Usuários';
            $data['link'] = 'usersCMS/index';
            $data['userData'] = $this->u->getData(1, $_SESSION['adminLogin']);
            $data['usersData'] = $this->u->getList();

            $this->loadTemplateCMS('cms/users/index', $data);
        }else{
            header("Location: ".BASE_URL);
            exit;
        }
    }

    /**
     * This function shows the register page for a new user.
     */
    public function newUser(){
        $data = array();

        if($this->u->isLogged() && $this->u->havePermission('users')){
            $data['title'] = 'ADM - Novo usuário';
            $data['link'] = 'usersCMS/index';
            $data['userData'] = $this->u->getData(1, $_SESSION['adminLogin']);

            $this->loadTemplateCMS('cms/users/newUser', $data);
        }else{
            header("Location: ".BASE_URL);
            exit;
        }
    }

    /**
     * This function register a new user in database, with POST request
     */
    public function saveNewUser(){
        if($this->u->isLogged() && $this->u->havePermission('users')){
            if(!empty($_POST)){
                // Array for check the keys
                $keys = array('email', 'name', 'password', 'password_confirmation');
                if($this->s->array_keys_check($keys, $_POST)){
                    // Check if the array is completed
                    if($this->s->array_check_completed_keys($keys, $_POST)){
                        $email = addslashes($_POST['email']);
                        $name = addslashes($_POST['name']);
                        $password = addslashes($_POST['password']);
                        $password_confirmation = addslashes($_POST['password_confirmation']);
                        // Checks passwords
                        if($password == $password_confirmation){
                            // Build the permissions
                            $perms = "";
                            if(isset($_POST['menuUsers']))
                                $perms .= "users;";
                            if(isset($_POST['menuContacts']))
                                $perms .= "contacts;";
                            if(isset($_POST['menuCurriculos']))
                                $perms .= "curriculos;";
                            // Try to register
                            if($this->u->register($name, $email, $perms, $password)){
                                echo json_encode(true);
                            }else{
                                echo json_encode("E-mail já cadastrado.");
                            }
                        }else{
                            echo json_encode("Confirmação de senha inválida.");
                        }
                    }else{
                        echo json_encode("Dados incompletos.");
                    }
                }else{
                    echo json_encode("Dados corrompidos.");
                }
            }
        }
    }

    /**
     * This function shows users editPage
     */
    public function editUserPage($id){
        $data = array();

        if($this->u->isLogged() && $this->u->havePermission('users')){
            $id = addslashes(base64_decode(base64_decode($id)));
            $data['title'] = 'ADM - Editar Usuário';
            $data['link'] = 'usersCMS/index';
            $data['userData'] = $this->u->getData(1, $_SESSION['adminLogin']);
            $data['usData'] = $this->u->getData(1, $id);
            $this->loadTemplateCMS('cms/users/editUser', $data);
        }else{
            header("Location: ".BASE_URL);
            exit;
        }
    }

    /**
     * This function edit a user using POST request
     */
    public function editUser(){
        if($this->u->isLogged() && $this->u->havePermission('users')){
            if(!empty($_POST)){
                // Array for check the keys
                $keys = array('id', 'email', 'name');
                if($this->s->array_keys_check($keys, $_POST)){
                    // Check if the array is completed
                    if($this->s->array_check_completed_keys($keys, $_POST)){
                        $id = addslashes($_POST['id']);
                        $email = addslashes($_POST['email']);
                        $name = addslashes($_POST['name']);
                        $password = addslashes($_POST['password']);
                        $password_confirmation = addslashes($_POST['password_confirmation']);
                        // Checks passwords
                        if($password == $password_confirmation){
                            // Build the permissions
                            $perms = "";
                            if(isset($_POST['menuUsers']))
                                $perms .= "users;";
                            if(isset($_POST['menuContacts']))
                                $perms .= "contacts;";
                            if(isset($_POST['menuCurriculos']))
                                $perms .= "curriculos;";
                            // Try to register
                            if($this->u->edit($id, $name, $email, $perms, $password)){
                                echo json_encode(true);
                            }else{
                                echo json_encode("E-mail já cadastrado.");
                            }
                        }else{
                            echo json_encode("Confirmação de senha inválida.");
                        }
                    }else{
                        echo json_encode("Dados incompletos.");
                    }
                }else{
                    echo json_encode("Dados corrompidos.");
                }
            }
        }else{
            header("Location: ".BASE_URL);
            exit;
        }
    }

    /**
     * This function receive a user id on Base64 (2x),
     * execute delete function and headers to index page (usersCMS/index)
     */
    public function deleteUser($id){
        if($this->u->isLogged() && $this->u->havePermission('users')){
            $id = addslashes(base64_decode(base64_decode($id)));
            $this->u->delete($id);
            $msg = urlencode('Usuário deletado com sucesso.');
            header("Location: " . BASE_URL . "usersCMS?notification=".$msg."&status=alert-success");
        }else{
            header("Location: ".BASE_URL);
            exit;
        }
    }
}