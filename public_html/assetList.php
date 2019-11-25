<?php
	include_once 'config.php';
	include_once 'classes/classRes.php';
	$start = filter_input(INPUT_GET, 'start');
	$end   = filter_input(INPUT_GET, 'end');
	$duration = filter_input(INPUT_GET, 'duration');
	$pax = filter_input(INPUT_GET, 'pax');
	$Res = new classRes();
	$AssetList = $Res->getAssetList();
	foreach ($AssetList as $key => $info) {
		echo "<div class='row assetList' id='$key'>";
		echo "<div class='col-3'>" . $info['Description'] . "</div>";
		echo "<div class='col-9'>" . $info['Comment'] . "</div>";
		echo "</div>";
	}
?>
<script>
	$(".assetList div").on('click', function(e) {
		var assetId = e.target.parentElement.id;
		$(".modal").modal();
		$("#modal-body").html()
		alert(assetId);
	});
</script>