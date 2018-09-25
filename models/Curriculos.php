<?php
class Curriculos extends Model {

    public function getList(){
        $array = array();

        $sql = "SELECT curriculos.*, DATE_FORMAT(curriculos.date_register, '%d/%m/%Y às %H:%i') as date FROM curriculos ORDER BY id DESC";
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getDataById($id){
        $array = array();

        $sql = "SELECT curriculos.*, DATE_FORMAT(curriculos.date_register, '%d/%m/%Y às %H:%i') as date FROM curriculos WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }

        return $array;
    }

    public function register($name, $email, $phone, $cell, $file){
        // First save file
        $ext = explode(".", $file['name']);
        $ext = strtolower(end($ext));
        $dir = $_SERVER['DOCUMENT_ROOT'] . SERVER_URL . "assets/curriculos/";
        $milliseconds = round(microtime(true) * 1000);
        $file_name = "Curriculo_".$name."_".date("dmY")."".$milliseconds.".".$ext;
        if(move_uploaded_file($file['tmp_name'], $dir.$file_name)){
            $sql = "INSERT INTO curriculos (name, email, phone, cell, file) VALUES (?, ?, ?, ?, ?)";
            $sql = $this->db->prepare($sql);
            $sql->execute(array($name, $email, $phone, $cell, $file_name));
            return true;
        }else {
            return false;
        }
    }

    public function delete($id){
        // Checks if the curriculum exists
        $data = self::getDataById($id);
        if(!empty($data)){
            // Remove the curriculum file
            unlink($_SERVER['DOCUMENT_ROOT'] . SERVER_URL . "assets/curriculos/".$data['file']);
            // Remove from database
            $sql = "DELETE FROM curriculos WHERE id = ?";
            $sql = $this->db->prepare($sql);
            $sql->execute(array($id));
            return true;
        }else{
            return false;
        }
    }

}
?>