<?php
class sobreController extends Controller{
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Moderno Medicina Laboratorial - Sobre';
        $dados['active'] = 'sobre';
        $this->loadTemplate('sobre/index', $dados);
    }
}