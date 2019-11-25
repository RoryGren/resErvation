<?php
/**
 * Description of classRes
 *
 * @author rory
 */
class classRes extends mysqli {

	private $AssetList;
	
	public function __construct() {
		$this->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$this->fetchAssets();
	}
	
	public function getAssetList() {
		return $this->AssetList;
	}

	private function fetchAssets() {
		$result = $this->query('SELECT `id`, `Code`, `Description`, `Comment` FROM `Asset`');
		while ($row = mysqli_fetch_assoc($result)) {
			$this->AssetList[$row['id']] = $row;
		}
		mysqli_free_result($result);
	}
	
	public function findRes() {
//		TODO ===> Search for reservations
	}
	
	public function addRes($data) {
//		TODO ===> Add reservation
	}
	
	public function addCustomer($data) {
//		TODO ===> add customer
	}

	private function insertRecord($table, $data) {
//		TODO ===> insert data
	}
	
}

?>
