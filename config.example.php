<?php
require 'environment.php';
$config = array();
if(ENVIRONMENT == 'development'){
	define("BASE_URL", 'http://localhost/php/moderno/');
	define("SERVER_URL", '/php/moderno/');
	define("SUPPORT_MAIL", "email@email.com");
	define("SUPPORT_NAME", "User Suport Name");
	$config['dbname'] = 'moderno';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
} else{
	define("BASE_URL", 'http://laboratoriomoderno.com.br/');
	define("SERVER_URL", '/');
	define("SUPPORT_MAIL", "user@email.com.br");
	define("SUPPORT_NAME", "User Suport Name");
	$config['dbname'] = 'dname';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'user';
	$config['dbpass'] = 'password';
}

global $MailHost;
global $MailPort;
global $MailSecurity;
global $MailUsername;
global $MailPassword;
global $MailName;
$MailSecurity = "tls";
$MailHost = "mail.host.com";
$MailPort = "587";
$MailUsername = "email@email.com.br";
$MailPassword = "password";
$MailName = "User Mail Name";

global $instagram_token;
$instagram_token = "xxxxxxxxxxxxxxxxxxxxx";

global $db;
try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
}catch (PDOExeption $e){
	echo "ERRO: ".$e->getMessage();
}