<?php
class notfoundController extends controller{
    public function index(){
        $this->loadTemplate('notfound/404', array('titulo'=>'Página não encontrada'));
    }
}
?>