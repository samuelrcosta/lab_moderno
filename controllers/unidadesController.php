<?php
class unidadesController extends Controller{
  public function index(){
    $dados = array();
    $dados['titulo'] = 'Moderno Medicina Laboratorial - Unidades';
    $dados['active'] = 'unidades';
    $this->loadTemplate('unidades/index', $dados);
  }
}