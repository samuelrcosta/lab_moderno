<?php
class notfoundController extends Controller{
    public function index(){
        $this->loadTemplate('notfound/404', array('titulo'=>'Página não encontrada'));
    }
}
?>