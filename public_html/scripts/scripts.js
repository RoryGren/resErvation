//Javascript

function doSearch() {
	let numDays = $("#duration").val();
	$.ajax({
		url: "assetList.php",
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

function processBooking(bookingFormData) {
	let bookingArray = [];
	$.each(bookingFormData, function(i, field) {
		bookingArray.push({id: field.id, value: field.value});
	});
	bookingArray = JSON.stringify(bookingArray);
	$.ajax({
		url : "processBooking.php",
		type : "POST",
		data : {info : bookingArray},
		success : function(data) {
			$("#modal-body").html(data);
		}
	})
}

function findRes(searchString) {
	$.ajax({
		url : "searchResult.php",
		type : "GET",
		data : {searchString : searchString},
		success : function(data) {
			$("#tblSearchResult tbody").html(data);
		}
	})
}
