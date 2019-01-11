<?php
class Controller{

    protected $db;
    protected $MailName;
    protected $MailUsername;
    protected $instagram_token;

    public function __construct() {
        global $config;
        global $MailName;
        global $MailUsername;
        global $instagram_token;

        $this->MailName = $MailName;
        $this->MailUsername = $MailUsername;
        $this->instagram_token = $instagram_token;
    }

    public function loadView($viewName, $viewData = array()){
        extract($viewData);
        require 'views/'.$viewName.'.php';
    }
    public function loadTemplate($viewName, $viewData = array()){
        extract($viewData);
        require 'views/template.php';
    }
    public function loadTemplateCMS($viewName, $viewData = array()){
        include 'views/cms/template.php';
    }
    public function loadViewInTemplate($viewName, $viewData = array()){
        extract($viewData);
        require 'views/'.$viewName.'.php';
    }
}