<?php
// ===== Reservation Booking =====

	include_once 'config.php';
	include_once 'classes/classRes.php';
	$Res = new classRes();
	
	$Res->createReservation(json_decode(filter_input(INPUT_POST, 'info')));

?>
