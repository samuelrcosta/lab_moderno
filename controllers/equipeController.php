<?php
class equipeController extends controller{
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Moderno Medicina Laboratorial - Equipe';
        $dados['active'] = 'equipe';
        $this->loadTemplate('/equipe/index', $dados);
    }
}