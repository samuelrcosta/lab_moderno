<?php
/**
 * This class is the Controller of the AdminPage.
 *
 * @author  samuelrcosta
 * @version 1.1.0, 05/05/2018
 * @since   1.0, 01/15/2017
 */

class adminController extends Controller{

    // Models instances
    private $u;
    private $s;
    private $configs;

    /**
     * Class constructor
     */
    public function __construct(){
        parent::__construct();
        // Initialize instances
        $this->s = new Store();
        $this->u = new Administrators();
        $this->configs = new Configs();
    }

    /**
     * This function shows the Admin login page.
     * Receive the input data and use the user's login method
     */
    public function index(){
        $data = array();

        $data['title'] = 'ADM - Login';

        if($this->u->isLogged()){
            header("Location: ".BASE_URL."admin/dashboard");
            exit;
        }else{
            if(isset($_POST['email']) && !empty($_POST['email'])){
                $email = addslashes($_POST['email']);
                $password = addslashes($_POST['password']);

                if($this->u->login($email, $password)){
                    header('Location:'.BASE_URL.'admin/dashboard');
                    exit;
                }else{
                    $dt = date("d/m/Y \à\s H:i:s");
                    $attempts = $this->configs->registerLoginAttempt();
                    $subject = 'Login Attempt #'.$attempts.' - Laboratório Moderno';
                    $message = '<html xmlns="http://www.w3.org/1999/xhtml">
                                <head>
                                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                    <title>'.$subject.'</title>
                                </head>
                                <body paddingwidth="0" paddingheight="0" bgcolor="#d1d3d4" style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;" offset="0" toppadding="0" leftpadding="0">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td>An attempt was made to log in to the <b>Moderno</b> website</td>
                                            </tr>
                                            <tr>
                                                <td>Data: '.$dt.'</td>
                                            </tr>
                                            <tr>
                                                <td>E-mail: '.$email.'</td>
                                            </tr>
                                            <tr>
                                                <td>Password: '.$password.'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </body>
                            </html>';
                    $recipients = array();
                    $recipients[] = array(
                        'email' => 'samu.rcosta@gmail.com',
                        'name' => 'Moderno Administration'
                    );
                    $this->s->sendMail($recipients, $subject, $message);
                    $data['email'] = $email;
                    $data['notice'] = '<div class="alert alert-warning">E-mail ou senha inválidos.</div>';
                }
            }

            $this->loadView('cms/login/index', $data);
        }
    }

    /**
     * This function shows the dashboard page
     */
    public function dashboard(){
        $data = array();

        if($this->u->isLogged()){
            $data['title'] = 'ADM - Dashboard';
            $data['link'] = 'admin/dashboard';
            $data['userData'] = $this->u->getData(1, $_SESSION['adminLogin']);

            $this->loadTemplateCMS('cms/home/dashboard', $data);
        }else{
            header("Location: ".BASE_URL);
            exit;
        }
    }

    /**
     * This function shows the sends mail page
     */
    public function sendMailPage(){
        $data = array();

        if($this->u->isLogged()){
            $data['title'] = 'ADM - Enviar E-mail';
            $data['link'] = 'admin';
            $data['userData'] = $this->u->getData(1, $_SESSION['adminLogin']);

            $this->loadTemplateCMS('cms/home/sendMail', $data);
        }else{
            header("Location: ".BASE_URL);
            exit;
        }
    }

    /**
     * This function sends a mail based in
     */
    public function sendMail(){
        if($this->u->isLogged()){
            if(!empty($_POST)){
                // Array for check the keys
                $keys = array('name', 'email','subject', 'message');
                if($this->s->array_keys_check($keys, $_POST)){
                    // Check if the array is completed
                    if($this->s->array_check_completed_keys($keys, $_POST)){
                        $name = addslashes($_POST['name']);
                        $email = addslashes($_POST['email']);
                        $subject = addslashes($_POST['subject']);
                        $message = addslashes($_POST['message']);
                        // Sends the message
                        $template = file_get_contents(BASE_URL."assets/templates/mail_template.htm");
                        $msg = str_replace("{{MAIL_TEXT}}", $message, $template);
                        $msg = str_replace("{{MAIL_TITLE}}", $subject, $msg);
                        $recipient = array("name" => $name, "email" => $email);
                        if($this->s->sendMail(array($recipient), $subject, $msg)){
                            echo json_encode(true);
                        }else{
                            echo json_encode("Erro no envio do e-mail.");
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
     * This function shows the profile Page
     */
    public function profilePage(){
        $data = array();

        if($this->u->isLogged()){
            $data['title'] = 'ADM - Meu Perfil';
            $data['link'] = 'admin';
            $data['userData'] = $this->u->getData(1, $_SESSION['adminLogin']);

            $this->loadTemplateCMS('cms/home/profilePage', $data);
        }else{
            header("Location: ".BASE_URL);
            exit;
        }
    }

    /**
     * This function edit a profile using a POST request
     */
    public function editProfile(){
        if($this->u->isLogged()){
            if(!empty($_POST)){
                // Array for check the keys
                $keys = array('name', 'email', 'current_password', 'password', 'password_confirmation');
                $needKeys = array('name', 'email');
                if($this->s->array_keys_check($keys, $_POST)){
                    // Check if the array is completed
                    if($this->s->array_check_completed_keys($needKeys, $_POST)){
                        $id =$_SESSION['adminLogin'];
                        $name = addslashes($_POST['name']);
                        $email = addslashes($_POST['email']);
                        $currentPassword = addslashes($_POST['current_password']);
                        $password = addslashes($_POST['password']);
                        $passwordConfirmation = addslashes($_POST['password_confirmation']);
                        if($password == $passwordConfirmation){
                            $userData = $this->u->getData(1, $id);
                            // Checks if the password
                            if(!empty($currentPassword) && !empty($password)){
                                if($userData['password'] != md5($currentPassword)){
                                    echo json_encode("Senha atual não confere");
                                    exit;
                                }
                            }
                            // try to edit
                            if($this->u->edit($id, $name, $email, $userData['perms'], $password)){
                                if(isset($_FILES) && !empty($_FILES['image']['tmp_name'])){
                                    echo json_encode($this->u->saveAvatar($id, $userData['avatar'], $_FILES));
                                    exit;
                                }else{
                                    echo json_encode(true);
                                    exit;
                                }
                            }else{
                                echo json_encode("Erro ao editar.");
                                exit;
                            }
                        }
                    }else{
                        echo json_encode("Dados incompletos.");
                        exit;
                    }
                }else{
                    echo json_encode("Dados corrompidos.");
                    exit;
                }
            }
        }else{
            header("Location: ".BASE_URL);
            exit;
        }
    }

	private function getInstagramFeed(){
		$retorno = array();

		// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'https://api.instagram.com/v1/users/self/media/recent/?access_token='.$this->instagram_token."&count=7"
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		curl_close($curl);
		$result = json_decode($resp);

		if(!empty($result)){
			$result = $result->data;

			for($i = 0; $i < count($result); $i++){
				$item_data = array();
				$item_data['url'] = $result[$i]->images->standard_resolution->url;
				$item_data['caption'] = $result[$i]->caption->text;
				$retorno[] = $item_data;
			}
		}

		return $retorno;
	}

	public function updateInstagram(){
    	$instagram_feed = new Instagram_feed();
    	$data = self::getInstagramFeed();

		$instagram_feed->deleteAllData();

    	for($i = 0; $i < count($data); $i++){
		    $instagram_feed->setData($i, $data[$i]['url'], $data[$i]['caption']);
	    }
	}

    /**
     * This function use the Admin user's logoff method and redirects to homepage
     */
    public function logoff(){
        $this->u->logoff();
        header("Location: ".BASE_URL);
        exit;
    }

}