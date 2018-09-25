<?php
/**
 * This class controls auxiliary methods of the system.
 *
 * @author  samuelrcosta
 * @version 1.3.0, 05/25/2018
 * @since   1.0, 01/11/2017
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Store extends Model{

  // Models instances
  private $c;

  /**
   * Class constructor
   */
  public function __construct() {
    parent::__construct();
    // Initialize instances
    $this->c = new Configs();
  }

  /**
   * This function sends a email to recipient.
   *
   * @param   $recipients         array for the recipients email and name.
   * @param   $subject            string for the email subject.
   * @param   $message            string for the email message.
   * @param   $atts               array with attachments
   *
   * @return  boolean true if its works, false if not.
   */
  public function sendMail($recipients, $subject, $message, $atts = array()){
    if(!empty($recipients)){
      $mail = new PHPMailer(true);                      // Passing `true` enables exceptions

      try{
        //Server settings
        $mail->SMTPDebug = 0;                                   // Enable verbose debug output
        $mail->isSMTP();                                        // Set mailer to use SMTP
        $mail->Host = $this->MailHost;                          // Specify main and backup SMTP servers
        $mail->CharSet = "UTF-8";
        $mail->SMTPAuth = true;                                 // Enable SMTP authentication
        $mail->Username = $this->MailUsername;                  // SMTP username
        $mail->Password = $this->MailPassword;                  // SMTP password
        $mail->SMTPSecure = $this->MailSecurity;                // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $this->MailPort;                          // TCP port to connect to

        //Recipients
        $mail->setFrom($this->MailUsername, $this->MailName);
        foreach($recipients as $recipient){
          $mail->addAddress($recipient['email'], $recipient['name']);       // Add a recipient
        }
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        if(!empty($atts)){
          foreach($atts as $att){
            $mail->addAttachment($att['tmp_name'], $att['name']);
          }
        }
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                    // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
        $mail->MsgHTML($message);
        $mail->send();

        return true;
      }catch(Exception $e) {
        return false;
      }
    }else{
      return false;
    }
  }

  /**
   * This function format a contact category.
   *
   * @param $category {String} category code
   *
   * @return {String} category on read mode
   */
  public function formatCategory($category) {
      switch ($category){
          case 'duvidas':
              return "Dúvidas";
          case 'criticas':
              return "Críticas";
          case 'sugestoes':
              return "Sugestões";
          case 'outras':
              return "Outras";
          default:
              return '';
      }
  }

  public function validateFileType($file){
      $mimetype = mime_content_type($file['tmp_name']);
      $permitted = array('image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
      if(in_array($mimetype, $permitted)) {
          return true;
      }else{
          return false;
      }
  }

  /**
   * This function verify if all keys in $keys exists in $array keys.
   *
   * @param   $keys array for the keys
   * @param   $array array for the check
   *
   * @return boolean
   */
  public function array_keys_check($keys, $array){
      if (count(array_intersect($keys,array_keys($array))) == count($keys)) {
          return true;
      }else{
          return false;
      }
  }

  /**
   * This function verify if all keys in $keys is completed in $array.
   *
   * @param   $keys array for the keys
   * @param   $array array for the check
   *
   * @return boolean
   */
  public function array_check_completed_keys($keys, $array){
      for($i = 0; $i < count($keys); $i++){
          if(strlen($array[$keys[$i]]) <= 0){
              return false;
          }
      }
      return true;
  }
}