<?php
class homeController extends controller{
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Moderno Medicina Laboratorial';
        $dados['active'] = 'home';
        $this->loadTemplate('home/index', $dados);
    }
}