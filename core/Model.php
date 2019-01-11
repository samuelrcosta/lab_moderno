<?php
class Model{
    protected $db;

    protected $MailHost;
    protected $MailPort;
    protected $MailSecurity;
    protected $MailUsername;
    protected $MailPassword;
    protected $MailName;

    protected $instagram_token;

    public function __construct(){
        global $db;
        global $MailHost;
        global $MailPort;
        global $MailSecurity;
        global $MailUsername;
        global $MailPassword;
        global $MailName;

        global $instagram_token;

        $this->db = $db;
        $this->MailHost = $MailHost;
        $this->MailPort = $MailPort;
        $this->MailSecurity = $MailSecurity;
        $this->MailUsername = $MailUsername;
        $this->MailPassword = $MailPassword;
        $this->MailName = $MailName;
        $this->instagram_token = $instagram_token;;
    }
}