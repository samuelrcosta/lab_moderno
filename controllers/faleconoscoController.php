<?php
class faleconoscoController extends controller{
    // Models instances
    private $c;
    private $s;

    /**
     * Class constructor
     */
    public function __construct(){
        parent::__construct();
        // Initialize instances
        $this->c = new Contacts();
        $this->s = new Store();
    }

    public function index(){
        $dados = array();
        $dados['titulo'] = 'Moderno Medicina Laboratorial - Fale Conosco';
        $dados['active'] = 'faleconosco';
        $this->loadTemplate('faleconosco/index', $dados);
    }

    public function registro(){
        if(!empty($_POST)){
            // Array for check the keys
            $keys = array('name', 'email', 'category', 'subject', 'phone', 'cell', 'message');
            $obr_keys = array('name', 'email', 'category', 'subject', 'message');
            if($this->s->array_keys_check($keys, $_POST)){
                // Check if the array is completed
                if($this->s->array_check_completed_keys($obr_keys, $_POST)){
                    $name = addslashes($_POST['name']);
                    $email = addslashes($_POST['email']);
                    $category = addslashes($_POST['category']);
                    $subject = addslashes($_POST['subject']);
                    $phone = addslashes($_POST['phone']);
                    $cell = addslashes($_POST['cell']);
                    $message = addslashes($_POST['message']);
                    // Register on database
                    $this->c->register($name, $email, $category, $phone, $cell, $subject, $message);
                    // Get mail template
                    $template = file_get_contents(BASE_URL."assets/templates/mail_template.htm");
                    // Send message to support
                    $support_subject = "Novo Contato no site";
                    $support_message = "Uma nova mensagem de contato foi recebida no site.<br>Detalhes da mensagem abaixo:<br><br>Nome: ".$name."<br>E-mail: ".$email."<br> Categoria: ".$this->s->formatCategory($category)."<br>Assunto: ".$subject."<br> Telefone: ".$phone."<br>Celular: ".$cell."<br>Mensagem: ".$message."<br><br><br><br>Visite o site para responder o cliente.";
                    $support_message = str_replace("{{MAIL_TEXT}}", $support_message, $template);
                    $support_message = str_replace("{{MAIL_TITLE}}", $support_subject, $support_message);
                    $support_recipient = array("name" => SUPPORT_NAME, "email" => SUPPORT_MAIL);
                    if($this->s->sendMail(array($support_recipient), $support_subject, $support_message)){
                        // Send message to client
                        $client_subject = "Mensagem recebida";
                        $client_message = "Olá ".$name."!<br>Recebemos sua mensagem, responderemos o mais rápido possível.<br><br><br><br>Agradecemos o contato.";
                        $client_message = str_replace("{{MAIL_TEXT}}", $client_message, $template);
                        $client_message = str_replace("{{MAIL_TITLE}}", $client_subject, $client_message);
                        $client_recipient = array("name" => $name, "email" => $email);
                        if($this->s->sendMail(array($client_recipient), $client_subject, $client_message)){
                            echo json_encode(true);
                        }else{
                            echo json_encode(true);
                        }
                    }else{
                        echo json_encode(true);
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