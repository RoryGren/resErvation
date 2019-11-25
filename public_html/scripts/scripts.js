//Javascript

function doSearch() {
	let numDays = $("#duration").val();
	$.ajax({
		url: 'assetList.php',
		data: {
			start: $("#startDate").val(),
			end: $("#endDate").val(),
			duration: numDays,
			pax: $("#pax").val(),
		},
		success: function(data) {
			$("#resultList").html(data);
		}
	})
}