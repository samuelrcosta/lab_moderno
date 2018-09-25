<?php
/**
 * This class retrieves and saves data of the configs table.
 *
 * @author  samuelrcosta
 * @version 1.1.0, 05/22/2018
 * @since   1.0, 01/18/2017
 */


class Configs extends Model{

    /**
     * This function register a new fail attempt to login in Admin page.
     *
     * @return  int for the number of attempts.
     */
    public function registerLoginAttempt(){
        $name = 'admin_login_attempts';

        $sql = 'SELECT * FROM configs WHERE name = ?';
        $sql = $this->db->prepare($sql);
        $sql->execute(array($name));

        $attempts = $sql->fetch()['value'];
        $attempts = $attempts + 1;

        $sql = 'UPDATE configs SET value = ? WHERE name = ?';
        $sql = $this->db->prepare($sql);
        $sql->execute(array($attempts, $name));

        return $attempts;
    }

    /**
     * This function update a config data.
     *
     * @param   $name   String for the config name
     * @param   $value  String fot the config value
     */
    public function updateConfig($name, $value){
        $sql = 'UPDATE configs SET value = ? WHERE name = ?';
        $sql = $this->db->prepare($sql);
        $sql->execute(array($value, $name));
    }

    /**
     * This function retrieves a config data.
     *
     * @param   $name   String for the config name
     *
     * @return array with all data
     */
    public function getConfig($name){
        $return = array();
        $sql = 'SELECT * FROM configs WHERE name = ?';
        $sql = $this->db->prepare($sql);
        $sql->execute(array($name));
        if($sql->rowCount() > 0){
            $return = $sql->fetch()['value'];
        }
        return $return;
    }
}