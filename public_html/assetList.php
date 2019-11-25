<?php
	include_once 'config.php';
	include_once 'classes/classRes.php';
//	print_r($_REQUEST);
	$start = filter_input(INPUT_GET, 'start');
	$end   = filter_input(INPUT_GET, 'end');
	$duration = filter_input(INPUT_GET, 'duration');
	$pax = filter_input(INPUT_GET, 'pax');
//	print_r($start);
	$Res = new classRes();
	$AssetList = $Res->getAssetList();
	print_r($AssetList);
	
?>
			<div class="row">
				<div class="col col-12">
					This is it
				</div>
			</div>
