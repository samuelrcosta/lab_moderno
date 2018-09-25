<?php
/**
 * This class retrieves and saves data of the Admin user.
 *
 * @author  samuelrcosta
 * @version 1.0.0, 01/15/2017
 * @since   1.0, 01/15/2017
 */

class Administrators extends Model{

    /**
     * This function verify if the input is valid for any administrator registered.
     * If valid returns True, otherwise return False for false.
     *
     * @param   $email    string for the email registered for the account.
     * @param   $password    string for the current password.
     * @return  boolean True for the correct user ID, or False for 'user not found'.
     */
    public function login($email, $password){
        $sql = "SELECT id FROM administrators WHERE email = ? AND password = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($email, md5($password)));
        $sql = $sql->fetch(PDO::FETCH_ASSOC);
        if($sql && count($sql)){
            $_SESSION['adminLogin'] = $sql['id'];
            return True;
        }else{
            return False;
        }
    }

    /**
     * This function register a new Admin user in database.
     * If this email already registered returns False, else returns True.
     *
     * @param   $name       string for the user's name.
     * @param   $email      string for the user's email.
     * @param   $perms      string for the users's permissions.
     * @param   $password   string for the user's password.
     * @return  boolean     boolean false for email already registered, or instead True.
     */
    public function register($name, $email, $perms, $password){
        $sql = "SELECT * FROM administrators WHERE email = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($email));
        $sql = $sql->fetchAll();
        if($sql && count($sql)){
            return false;
        }else{
            $sql = "INSERT INTO administrators (email, password, name, perms) VALUES (?, ?, ?, ?)";
            $sql = $this->db->prepare($sql);
            $sql->execute(array($email, md5($password), $name, $perms));
            return true;
        }
    }

    /**
     * This function edit a user in database.
     * If this email already registered returns False, else returns True.
     *
     * @param   $id             int for the user's ID number saved in the database.
     * @param   $name           string for the user's name.
     * @param   $email          string for the user's email.
     * @param   $perms          string for the users's menu permissions.
     * @param   $password       string for the user's password.
     *
     * @return  boolean False for email already registered, or instead True.
     */
    public function edit($id, $name, $email, $perms, $password){
        $sql = "SELECT * FROM administrators WHERE email = ? AND id != ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($email, $id));
        $sql = $sql->fetchAll();
        if($sql && count($sql)){
            return false;
        }else{
            if(empty($password)){
                $sql = "UPDATE administrators SET email = ?, name = ?, perms = ? WHERE id = ?";
                $sql = $this->db->prepare($sql);
                $sql->execute(array($email, $name, $perms, $id));
                return true;
            }else{
                $sql = "UPDATE administrators SET email = ?, password = ?, name = ?, perms = ? WHERE id = ?";
                $sql = $this->db->prepare($sql);
                $sql->execute(array($email, md5($password), $name, $perms, $id));
                return true;
            }
        }
    }

    /**
     * This function delete a Admin user in database.
     *
     * @param   $id       int for the user's ID number saved in the database.
     */
    public function delete($id){
        $sql = "DELETE FROM administrators WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
    }

    /**
     * Function used to logoff the Admin user in the session.
     */
    public function logOff(){
        unset($_SESSION['adminLogin']);
    }

    /**
     * Function checks if someone is logged.
     *
     * @return  boolean for the result.
     */
    public function isLogged(){
        if(isset($_SESSION['adminLogin']) && !empty($_SESSION['adminLogin'])){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Function checks if the user have permission.
     *
     * @return  boolean for the result.
    */
    public function havePermission($perm){
        if(isset($_SESSION['adminLogin']) && !empty($_SESSION['adminLogin'])){
            $data = $this->getData(1, $_SESSION['adminLogin']);
            if(strpos($data['perms'], $perm) !== false){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * This function retrieves all data from an Admin user, by using it's ID or it's Email.
     *
     * @param   $type          int for the type of search, 1 to ID and 2 to Email
     * @param   $idOrEmail     string user's ID number or Email saved in the database.
     * @return  array containing all data retrieved.
     */
    public function getData($type, $idOrEmail){
        $array = array();
        if($type == 1){
            $sql = "SELECT * FROM administrators WHERE id = ?";
            $sql = $this->db->prepare($sql);
            $sql->execute(array($idOrEmail));
            $sql = $sql->fetch();
            if($sql && count($sql)){
                $array = $sql;
            }
        }else{
            $sql = "SELECT * FROM administrators WHERE email = ?";
            $sql = $this->db->prepare($sql);
            $sql->execute(array($idOrEmail));
            $sql = $sql->fetch();
            if($sql && count($sql)){
                $array = $sql;
            }
        }

        return $array;
    }

    /**
     * This function retrieves all data from all users.
     *
     * @return  array containing all data retrieved.
     */
    public function getList(){
        $array = array();

        $sql = 'SELECT * FROM administrators ORDER BY name DESC';
        $sql = $this->db->prepare($sql);
        $sql->execute();
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }

    /**
     * This function saves a image into disk and this name on database.
     *
     * @return  mixed boolean true if saves correctly and String for error with this description
     */
    public function saveAvatar($id, $oldAvatar, $data){
        $exts_checks = array('jpg', 'png', 'jpeg');
        $ext = explode(".", $data['image']['name']);
        $ext = strtolower(end($ext));
        if(array_search($ext, $exts_checks) === false) {
            return "Extensão da imagem não permitida";
        }else{
            $new_name = $id.md5(time()).".".$ext;
            $dir = $_SERVER['DOCUMENT_ROOT'] . SERVER_URL . "assets/imgs/users_profile/";
            if(move_uploaded_file($data['image']['tmp_name'], $dir.$new_name)){
                if($oldAvatar != 'avatar_model.png'){
                    // Remove old avatar
                    unlink($_SERVER['DOCUMENT_ROOT'] . SERVER_URL . "assets/imgs/users_profile/".$oldAvatar);
                }
                $sql = "UPDATE administrators SET avatar = ? WHERE id = ?";
                $sql = $this->db->prepare($sql);
                $sql->execute(array($new_name, $id));
                return true;
            }else{
                return "Problema ao salvar a imagem";
            }
        }
    }

}
?>