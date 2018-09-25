<?php
class trabalheconoscoController extends controller{
  // Models instances
  private $c;
  private $s;

  /**
   * Class constructor
   */
  public function __construct(){
    parent::__construct();
    // Initialize instances
    $this->c = new Curriculos();
    $this->s = new Store();
  }

  public function index(){
    $dados = array();
    $dados['titulo'] = 'Moderno Medicina Laboratorial - Trabalhe Conosco';
    $dados['active'] = 'trabalheconosco';
    $this->loadTemplate('trabalheconosco/index', $dados);
  }

  public function registro(){
    if(!empty($_POST) && !empty($_FILES)){
      // Array for check the keys
      $keys = array('name', 'email', 'phone', 'cell');
      $obr_keys = array('name', 'email', 'cell');
      if(!$this->s->array_keys_check($keys, $_POST)){
        echo json_encode("Dados corrompidos.");
        exit;
      }
      // Check if the array is completed
      if(!$this->s->array_check_completed_keys($obr_keys, $_POST)){
        echo json_encode("Dados incompletos.");
        exit;
      }
      // Check curriculum file
      if(isset($_FILES['curriculo']) && !empty($_FILES['curriculo'])){
        $name = addslashes($_POST['name']);
        $email = addslashes($_POST['email']);
        $phone = addslashes($_POST['phone']);
        $cell = addslashes($_POST['cell']);
        $file = $_FILES['curriculo'];

        // Check the file extension
        if(!$this->s->validateFileType($file)){
          echo json_encode("Tipo de arquivo inválido");
          exit;
        }

        // Register on database
        if($this->c->register($name, $email, $phone, $cell, $file)){
          // Get mail template
          $template = file_get_contents(BASE_URL."assets/templates/mail_template.htm");
          // Send message to support
          $support_subject = "Novo Currículo no site";
          $support_message = "Uma novo currículo foi cadastrado no site.<br>Detalhes da mensagem abaixo:<br><br>Nome: ".$name."<br>E-mail: ".$email."<br>Telefone: ".$phone."<br>Celular: ".$cell."<br><br><br><br>Visite o site para baixar o arquivo do currículo.";
          $support_message = str_replace("{{MAIL_TEXT}}", $support_message, $template);
          $support_message = str_replace("{{MAIL_TITLE}}", $support_subject, $support_message);
          $support_recipient = array("name" => SUPPORT_NAME, "email" => SUPPORT_MAIL);
          // Send message to client
          $client_subject = "Currículo Recebido";
          $client_message = "Olá ".$name."!<br>Recebemos seu currículo, entraremos em contato assim que possível.<br><br><br><br>Agradecemos o contato.";
          $client_message = str_replace("{{MAIL_TEXT}}", $client_message, $template);
          $client_message = str_replace("{{MAIL_TITLE}}", $client_subject, $client_message);
          $client_recipient = array("name" => $name, "email" => $email);
          // Send emails
          $ok = false;
          if($this->s->sendMail(array($support_recipient), $support_subject, $support_message)){
            $ok = true;
          }else{
            $ok = "Erro no envio da notificação";
          }
          if($this->s->sendMail(array($client_recipient), $client_subject, $client_message)){
            $ok = true;
          }else{
            $ok = "Erro no envio da notificação";
          }
          echo json_encode($ok);
        }else{
          echo json_encode("Ocorreu um erro ao gravar o arquivo do currículo");
        }
      }else{
        echo json_encode("Arquivo obrigatório");
      }
    }
  }
}