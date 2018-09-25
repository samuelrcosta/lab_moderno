<?php
class qualidadeController extends Controller{
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Moderno Medicina Laboratorial - Gestão da Qualidade';
        $dados['active'] = 'qualidade';
        $this->loadTemplate('qualidade/index', $dados);
    }
}