<?php
	include_once 'config.php';
	include_once 'classes/classRes.php';
	$searchString = filter_input(INPUT_GET, 'searchString');
	$Res = new classRes();
	$result = $Res->findRes($searchString);
?>
