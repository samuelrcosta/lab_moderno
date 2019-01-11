<?php
class homeController extends Controller{

	private $instagram_feed;

	public function __construct() {
		$this->instagram_feed = new Instagram_feed();
	}

	public function index(){
        $dados = array();
        $dados['titulo'] = 'Moderno Medicina Laboratorial';
        $dados['active'] = 'home';

        $dados['feed'] = $this->instagram_feed->getData();

        $this->loadTemplate('home/index', $dados);
    }
}