<?php
class controller{

    protected $db;
    protected $MailName;
    protected $MailUsername;

    public function __construct() {
        global $config;
        global $MailName;
        global $MailUsername;
        $this->MailName = $MailName;
        $this->MailUsername = $MailUsername;
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