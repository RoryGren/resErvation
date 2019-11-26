<?php
	include_once 'config.php';
	include_once 'classes/classRes.php';
	$Res = new classRes();
	
	$Res->createReservation(json_decode(filter_input(INPUT_POST, 'info')));
//	$formInfo = json_decode(filter_input(INPUT_POST, 'info'));
//	print_r($formInfo[0]->id);
//	foreach ($formInfo as $key => $data) {
//		print_r($data);
//		echo "<br>";
//	}
//	$AssetList = $Res->getAssetList();

?>
