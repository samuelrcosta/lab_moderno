<?php
class Instagram_feed extends Model {

	public function getData(){
		$array = array();

		$sql = "SELECT * FROM instagram_feed ORDER BY id ASC";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function setData($id, $url, $caption){
		$sql = "INSERT INTO instagram_feed (id, url, caption) VALUES (?, ?, ?)";
		$sql = $this->db->prepare($sql);
		$sql->execute(array($id, $url, $caption));
	}

	public function deleteAllData(){
		$sql = "DELETE FROM instagram_feed WHERE id >= 0";
		$sql = $this->db->prepare($sql);
		$sql->execute(array());
	}
}
?>