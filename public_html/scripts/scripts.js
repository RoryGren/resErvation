//Javascript

function doSearch() {
	$.ajax({
		url: 'assetList.php',
		data: {
			start: $("#startDate").val(),
			end:   $("#endDate").val(),
			end:   $("#duration").val(),
			pax:   $("#pax").val(),
		},
		success: function(data) {
			$("#resultList").html(data);
		}
	})
}