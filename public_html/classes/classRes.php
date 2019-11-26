<?php
/**
 * Description of classRes
 *
 * @author rory
 * 
 * $info: ( 
 * [0] => stdClass Object ( [id] => numDays  [value] => ) 
 * [1] => stdClass Object ( [id] => startDay [value] => ) 
 * [2] => stdClass Object ( [id] => endDay   [value] => ) 
 * [3] => stdClass Object ( [id] => AssetId  [value] => ) 
 * [4] => stdClass Object ( [id] => Tel      [value] => ) 
 * [5] => stdClass Object ( [id] => FName    [value] => ) 
 * [6] => stdClass Object ( [id] => SName    [value] => ) 
 * [7] => stdClass Object ( [id] => email    [value] => ))
 * 
 * reservations stored nightly - each night has own record with common Reservation Number
 * 
 */
class classRes extends mysqli {

	private $AssetList;
	private $currentId;
	public  $infoArray;

	public function __construct() {
		$this->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$this->fetchAssets();
	}
	
	public function getAssetList($start, $end, $duration, $pax) {
		// TODO ===> Check availability
		return $this->AssetList;
	}

	private function fetchAssets() {
		$result = $this->query("SELECT `id`, `Code`, `Description`, `Comment` FROM `Asset`");
		while ($row = mysqli_fetch_assoc($result)) {
			$this->AssetList[$row['id']] = $row;
		}
		mysqli_free_result($result);
	}
	
	public function findRes($searchString) {
		$sql = "SELECT DISTINCT c.`id`, c.`SName`, c.`FName`, c.`Tel`, c.`Email`, a.`Description`, r.`ReservationNumber`, r.`CheckInDate`, r.`CheckOutDate` 
				FROM `Client` c
				JOIN `Res` r   ON (c.`id` = r.`ClientId`)
				JOIN `Asset` a ON (r.`AssetId` = a.`id`)
				WHERE 
				c.`SName` LIKE '%$searchString%'
				OR c.`FName` LIKE '%$searchString%'
				OR c.`Tel` LIKE '%$searchString%'
				OR c.`Email` LIKE '%$searchString%'
				OR a.`Description` LIKE '%$searchString%'
				OR r.`CheckInDate` LIKE '%$searchString%'
				OR r.`CheckOutDate` LIKE '%$searchString%'";
		$result = $this->query($sql);
		$tBody = "";
		echo "<br>";
		while ($row = mysqli_fetch_assoc($result)) {
			$tBody .= "<tr id=" . $row[id] . ">";
			$tBody .= "<td>" . $row[SName] . "</td>"
					. "<td>" . $row[FName] . "</td>"
					. "<td>" . $row[Tel] . "</td>"
					. "<td>" . $row[Email] . "</td>"
					. "<td>" . $row[Description] . "</td>" 
					. "<td>" . $row[ReservationNumber] . "</td>" 
					. "<td>" . $row[CheckInDate] . "</td>" 
					. "<td>" . $row[CheckOutDate]  . "</td>";
			$tBody .= "</tr>";
		}
		echo $tBody;
	}
	
	public function getNextResNo() {
		$result = mysqli_fetch_row($this->query("SELECT DISTINCT `ReservationNumber` FROM `Res` ORDER BY `ReservationNumber` DESC  LIMIT 1"));
		return $result[0] + 1;
	}
	
	public function createReservation($info) {
		// TODO ===> Check for and prevent double bookings....
		$this->infoArray = $info;
		if (!$this->clientExists($info)) {
			$this->currentId = $this->insertRecord("Client", "4,5,6,7");
		}
		$numNights   = $info[0]->value;
		$reserveDate = date_create($info[1]->value);
		$startDate   = date_create($info[1]->value);
		$endDate     = date_create($info[2]->value);
		
		while ($reserveDate <= $endDate) {
			$dailySQL  = "INSERT INTO `Res` (`AssetId`, `ClientId`, `ReservationNumber`, `ReserveDate`, `CheckInDate`, `CheckOutDate`, `CreateDate`, `CreateUser`) ";
			$dailySQL .= "VALUES ('" . $info[3]->value . "', '" . $this->currentId . "', '" . $this->getNextResNo() . "', '" . date_format($reserveDate, "Y-m-d") . "', '" . date_format($startDate, "Y-m-d") . "', '" . date_format($endDate, "Y-m-d") . "', '" . substr(TODAY, 0, 10) . "', 'R')";
			mysqli_execute($this->prepare($dailySQL));
			date_add($reserveDate,date_interval_create_from_date_string("1 days"));
		}
	}
	
	private function clientExists($info) {
		$sql = "SELECT `id` "
				. "FROM `Client` "
				. "WHERE `Tel` LIKE '%" . $info[4]->value . "%' "
				. "AND `FName` LIKE '%" . $info[5]->value . "%' "
				. "AND `SNAME` LIKE '%" . $info[6]->value . "%' ";
		$result   = mysqli_fetch_row($this->query($sql));
		$this->currentId = $result[0];
		return $this->currentId;
	}

	private function insertRecord($table, $data) {
		$fieldList = explode(',', $data);
		$sql = "INSERT INTO `$table` (";
		$fields = '';
		$values = '';
		foreach ($fieldList as $field => $value) {
			$fields .= "`" . $this->infoArray[$value]->id . "`, ";
			$values .= "'" . $this->infoArray[$value]->value . "', ";
		}
		$fields .= "`CreateDate`, `CreateUser`)";
		$values .= "'" . substr(TODAY, 0, 10) . "', 'R'";
		$sql .= $fields . " VALUES ($values)";
		$result = mysqli_execute($this->prepare($sql));
		$this->currentId = $this->insert_id;
	}
	
}

?>
