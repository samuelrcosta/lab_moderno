<?php
class Contacts extends Model {

    public function getList(){
        $array = array();

        $sql = "SELECT contacts.*, DATE_FORMAT(contacts.date_register, '%d/%m/%Y às %H:%i') as date FROM contacts ORDER BY id DESC";
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getDataById($id){
        $array = array();

        $sql = "SELECT contacts.*, DATE_FORMAT(contacts.date_register, '%d/%m/%Y às %H:%i') as date FROM contacts WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }

        return $array;
    }

    public function register($name, $email, $category, $phone, $cell, $subject, $message){
        $sql = "INSERT INTO contacts (name, email, category, phone, cell, subject, message) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($name, $email, $category, $phone, $cell, $subject, $message));
    }

    public function setStatus($id, $status){
        // Checks if the contact exists
        $sql = "SELECT COUNT(*) as TOTAL FROM contacts WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
        $sql = $sql->fetch();
        if($sql["TOTAL"] > 0){
            $sql = "UPDATE contacts SET status = ? WHERE id = ?";
            $sql = $this->db->prepare($sql);
            $sql->execute(array($status, $id));
            return true;
        }else{
            return false;
        }
    }

    public function delete($id){
        // Checks if the contact exists
        $sql = "SELECT COUNT(*) as TOTAL FROM contacts WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
        $sql = $sql->fetch();
        if($sql["TOTAL"] > 0){
            $sql = "DELETE FROM contacts WHERE id = ?";
            $sql = $this->db->prepare($sql);
            $sql->execute(array($id));
            return true;
        }else{
            return false;
        }
    }

}
?>