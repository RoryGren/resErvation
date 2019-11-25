<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<link href="style/bootstrap.css" rel="stylesheet" type="text/css"/>
		<link href="style/styleMain.css" rel="stylesheet" type="text/css"/>
        <title></title>
    </head>
    <body>
		<div class="container-fluid">
			<div class="row">
				<div class="col col-12">
					<h1>ResErvation</h1>
					<p></p>
					<form class="form-horizontal" id="frmRes">
						<div class="form-group row">
							<div class="col-sm-3">
								<label for='startDate' class='control-label'>Check-in Date</label>
								<input type="date" class="form-control datePicker" id="startDate" placeholder="Enter Reservation Start Date">
							</div>
							<div class="col-sm-3">
								<label for='endDate' class='control-label'>Check-out Date</label>
								<input type="date" class="form-control datePicker" id="endDate">
							</div>
							<div class="col-sm-3">
								<label for='duration' class='control-label'>Length of stay (days)</label>
								<input type="text" class="form-control" id="duration" placeholder="0">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3">
								<label for='pax' class='control-label'>Number of People</label>
								<input type="number" class="form-control" id="pax" value="2" min="1" max="6">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="container-fluid" id="resultList">
		</div>
		
		<script src="scripts/jquery-3.3.1.min.js" type="text/javascript"></script>
		<script src="scripts/bootstrap.js" type="text/javascript"></script>
		<script src="scripts/scripts.js" type="text/javascript"></script>
		<script>
			var d = new Date();
			var duration;
			$(document).ready(function() {
				$('#startDate').val(d.toLocaleDateString('en-CA'));
				$('#endDate').val(d.toLocaleDateString('en-CA'));
			})
			$('input.datePicker').change(function(e) {
				if (e.target.id === 'startDate') {
					var newEnd = new Date($('#startDate').val());
					$('#endDate').val(newEnd.toLocaleDateString('en-CA'));
				}
				var start = new Date($("#startDate").val());
				var end   = new Date($("#endDate").val());
				var diff  = new Date(end - start);
				var days  = diff/1000/60/60/24;
				$('#duration').val(days);
				doSearch();
			})
			$('#pax').change(function() {
				if (this.value > 5) {
					alert("For bulk bookings of more than 5 people, please contact us by phone.");
					this.value = 2;
				}
				doSearch();
			})
		</script>
    </body>
</html>
