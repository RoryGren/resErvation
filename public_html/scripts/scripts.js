//Javascript

function doSearch() {
	$.ajax({
		url: 'assetList.php',
		data: {
			start: $("#startDate").val(),
			end: $("#endDate").val(),
			duration: $("#duration").val(),
			pax: $("#pax").val(),
		},
		success: function(data) {
			$("#resultList").html(data);
		}
	})
}