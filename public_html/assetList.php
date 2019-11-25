<?php
	include_once 'config.php';
	include_once 'classes/classRes.php';
	var_dump($_REQUEST);
	$Res = new classRes();
	$AssetList = $Res->getAssetList();
?>
			<div class="row">
				<div class="col col-12">
					This is it
				</div>
			</div>
