<?php
/**
 * This class is the Controller of the Admin receives curriculum panel.
 *
 * @author  samuelrcosta
 * @version 1.0.0, 05/08/2018
 * @since   1.0, 05/08/2018
 */

class curriculosCMSController extends controller{

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
        $this->c = new Curriculos();
        $this->s = new Store();
    }

    /**
     * This function shows the Contacts List page.
     */
    public function index(){
        $data = array();

        if($this->u->isLogged() && $this->u->havePermission('curriculos')){
            $data['title'] = 'ADM - Currículos';
            $data['link'] = 'curriculosCMS/index';
            $data['userData'] = $this->u->getData(1, $_SESSION['adminLogin']);
            $data['curriculosData'] = $this->c->getList();

            $this->loadTemplateCMS('cms/curriculos/index', $data);
        }else{
            header("Location: ".BASE_URL);
            exit;
        }
    }

    /**
     * This function shows the curriculo details page.
     */
    public function viewCurriculo($id){
        $data = array();

        if ($this->u->isLogged() && $this->u->havePermission('curriculos')) {
            $id = addslashes(base64_decode(base64_decode($id)));
            $data['title'] = 'ADM - Visualizar Currículo';
            $data['link'] = 'curriculosCMS/index';
            $data['userData'] = $this->u->getData(1, $_SESSION['adminLogin']);
            $data['curriculoData'] = $this->c->getDataById($id);
            if (!empty($data['curriculoData'])) {
                $this->loadTemplateCMS('cms/curriculos/viewCurriculo', $data);
            } else {
                $msg = urlencode('Erro, currículo não encontrado.');
                header("Location: " . BASE_URL . "curriculosCMS?notification=" . $msg . "&status=alert-danger");
                exit;
            }
        } else {
            header("Location: " . BASE_URL);
            exit;
        }
    }

    /**
     * This function sends a email to contact
     */
    public function sendAnswer(){
        if($this->u->isLogged() && $this->u->havePermission('curriculos')){
            if(!empty($_POST)){
                // Array for check the keys
                $keys = array('id', 'subject', 'message');
                if($this->s->array_keys_check($keys, $_POST)){
                    // Check if the array is completed
                    if($this->s->array_check_completed_keys($keys, $_POST)){
                        $id = addslashes($_POST['id']);
                        $subject = addslashes($_POST['subject']);
                        $message = addslashes($_POST['message']);
                        // get curriculo data
                        $curriculoData = $this->c->getDataById($id);
                        if(!empty($curriculoData)){
                            // Sends the message
                            $template = file_get_contents(BASE_URL."assets/templates/mail_template.htm");
                            $msg = str_replace("{{MAIL_TEXT}}", $message, $template);
                            $msg = str_replace("{{MAIL_TITLE}}", $subject, $msg);
                            $recipient = array("name" => $curriculoData['name'], "email" => $curriculoData['email']);
                            if($this->s->sendMail(array($recipient), $subject, $msg)){
                                echo json_encode(true);
                            }else{
                                echo json_encode("Erro no envio do e-mail.");
                            }
                        }else{
                            echo json_encode("Erro: Currículo não encontrado.");
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
     * This function receive a curriculo id on Base64 (2x),
     * execute delete function and headers to index page (curriculosCMS/index)
     */
    public function delete($id){
        if($this->u->isLogged() && $this->u->havePermission('curriculos')){
            $id = addslashes(base64_decode(base64_decode($id)));
            // try to delete
            if($this->c->delete($id)){
                $msg = urlencode('Currículo excluído com sucesso!');
                header("Location: ".BASE_URL."curriculosCMS?notification=".$msg."&status=alert-info");
                exit;
            }else{
                $msg = urlencode('Falha ao excluir, currículo não encontrado.');
                header("Location: ".BASE_URL."curriculosCMS?notification=".$msg."&status=alert-danger");
                exit;
            }
        }else{
            header("Location: ".BASE_URL);
            exit;
        }
    }
}