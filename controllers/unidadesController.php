<?php
class unidadesController extends controller{
  public function index(){
    $dados = array();
    $dados['titulo'] = 'Moderno Medicina Laboratorial - Unidades';
    $dados['active'] = 'unidades';
    $this->loadTemplate('unidades/index', $dados);
  }
}