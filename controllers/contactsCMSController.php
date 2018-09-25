<?php
/**
 * This class is the Controller of the Admin receives contacts panel.
 *
 * @author  samuelrcosta
 * @version 1.0.0, 05/02/2018
 * @since   1.0, 05/02/2018
 */

class contactsCMSController extends Controller{

    // Models instances
    private $u;
    private $c;
    private $s;

    /**
     * Class constructor
     */
    public function __construct(){
        parent::__construct();
        // Initialize instances
        $this->u = new Administrators();
        $this->c = new Contacts();
        $this->s = new Store();
    }

    /**
     * This function shows the Contacts List page.
     */
    public function index(){
        $data = array();

        if($this->u->isLogged() && $this->u->havePermission('contacts')){
            $data['title'] = 'ADM - Contatos';
            $data['link'] = 'contactsCMS/index';
            $data['userData'] = $this->u->getData(1, $_SESSION['adminLogin']);
            $data['contactsData'] = $this->c->getList();

            $this->loadTemplateCMS('cms/contacts/index', $data);
        }else{
            header("Location: ".BASE_URL);
            exit;
        }
    }

    /**
     * This function shows the contact details page.
     */
    public function viewContact($id){
        $data = array();

        if($this->u->isLogged() && $this->u->havePermission('contacts')){
            $id = addslashes(base64_decode(base64_decode($id)));
            $data['title'] = 'ADM - Visualizar Contato';
            $data['link'] = 'contactsCMS/index';
            $data['userData'] = $this->u->getData(1, $_SESSION['adminLogin']);
            $data['contactData'] = $this->c->getDataById($id);
            if(!empty($data['contactData'])){
                $data['contactData']['category'] = $this->s->formatCategory($data['contactData']['category']);
                $this->loadTemplateCMS('cms/contacts/viewContact', $data);
            }else{
                $msg = urlencode('Erro, contato não encontrado.');
                header("Location: ".BASE_URL."contactsCMS?notification=".$msg."&status=alert-danger");
                exit;
            }
        }else{
            header("Location: ".BASE_URL);
            exit;
        }
    }

    /**
     * This function edit the contact status by POST request.
     */
    public function editStatus(){
        if($this->u->isLogged() && $this->u->havePermission('contacts')){
            if(!empty($_POST)){
                // Array for check the keys
                $keys = array('id', 'status');
                if($this->s->array_keys_check($keys, $_POST)){
                    // Check if the array is completed
                    if($this->s->array_check_completed_keys($keys, $_POST)){
                        $id = addslashes($_POST['id']);
                        $status = addslashes($_POST['status']);
                        // Check if status its a true value
                        if($status == "1" || $status == "2"){
                            if($this->c->setStatus($id, $status)){
                                // Returns true
                                echo json_encode(true);
                            }else{
                                echo json_encode("Status não encontrado.");
                            }
                        }else{
                            echo json_encode("Status inválido.");
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
     * This function sends a email to contact
     */
    public function sendAnswer(){
        if($this->u->isLogged() && $this->u->havePermission('contacts')){
            if(!empty($_POST)){
                // Array for check the keys
                $keys = array('id', 'subject', 'message');
                if($this->s->array_keys_check($keys, $_POST)){
                    // Check if the array is completed
                    if($this->s->array_check_completed_keys($keys, $_POST)){
                        $id = addslashes($_POST['id']);
                        $subject = addslashes($_POST['subject']);
                        $message = addslashes($_POST['message']);
                        // get contact data
                        $contactData = $this->c->getDataById($id);
                        if(!empty($contactData)){
                            // Change status if its equals 1
                            if($contactData['status'] == "1"){
                                $this->c->setStatus($id, "2");
                            }
                            // Sends the message
                            $template = file_get_contents(BASE_URL."assets/templates/mail_template.htm");
                            $msg = str_replace("{{MAIL_TEXT}}", $message, $template);
                            $msg = str_replace("{{MAIL_TITLE}}", $subject, $msg);
                            $recipient = array("name" => $contactData['name'], "email" => $contactData['email']);
                            if($this->s->sendMail(array($recipient), $subject, $msg)){
                                echo json_encode(true);
                            }else{
                                echo json_encode("Erro no envio do e-mail.");
                            }
                        }else{
                            echo json_encode("Erro: Contato não encontrado.");
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
     * This function receive a contact id on Base64 (2x),
     * execute delete function and headers to index page (contactsCMS/index)
     */
    public function delete($id){
        if($this->u->isLogged() && $this->u->havePermission('contacts')){
            $id = addslashes(base64_decode(base64_decode($id)));
            // try to delete
            if($this->c->delete($id)){
                $msg = urlencode('Contato excluído com sucesso!');
                header("Location: ".BASE_URL."contactsCMS?notification=".$msg."&status=alert-info");
                exit;
            }else{
                $msg = urlencode('Falha ao excluir, contato não encontrado.');
                header("Location: ".BASE_URL."contactsCMS?notification=".$msg."&status=alert-danger");
                exit;
            }
        }else{
            header("Location: ".BASE_URL);
            exit;
        }
    }
}