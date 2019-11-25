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
								<label for='duration' class='control-label'>Nights</label>
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
		
		<!-- Modal -->
		<div id="modalDetail" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="modal-title">Reserve your Accommodation</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<!--<p class="btn-danger text-center" style="margin-bottom: 0px;">Changes made will be implemented immediately.</p>-->
					<div class="modal-body" id="modal-body">
 <!-- TODO ===> Booking form -->
						<form class="form-horizontal" id="frmBook">
							<div class="form-group row">
								<div class="col-sm-6">
									<label for='FName' class='control-label'>Name</label>
									<input type="text" class="form-control" id="FName" placeholder="First / Given Name">
								</div>
								<div class="col-sm-6">
									<label for='SName' class='control-label'>Surname</label>
									<input type="text" class="form-control" id="SName" placeholder="Surname / Family Name">
								</div>
<!--							</div>
							<div class="form-group row">-->
								<div class="col-sm-6">
									<label for='Tel' class='control-label'>Telephone</label>
									<input type="number" class="form-control" id="Tel" placeholder="Telephone">
								</div>
								<div class="col-sm-6">
									<label for='email' class='control-label'>Email</label>
									<input type="number" class="form-control" id="email" placeholder="xxx@yyyy.com">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12">
									<h4>Booking Confirmation:</h4>
									<p>Nights:</p>
									<p>From date To date</p>
								</div>
							</div>
						</form>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-success" id="btnSave">Book</button>
						<button type="button" class="btn btn-default" id="btnCancel" data-dismiss="modal">Cancel</button>
					</div>
				</div>

			</div>
		</div>

		
		<script src="scripts/jquery-3.3.1.min.js" type="text/javascript"></script>
		<script src="scripts/bootstrap.js" type="text/javascript"></script>
		<script src="scripts/scripts.js" type="text/javascript"></script>
		<script>
//	TODO ===> Prevent start date being earlier than today.
			var d = new Date();
			var duration;
			$(document).ready(function() {
				$('#startDate').val(d.toLocaleDateString('en-CA'));
				$('#endDate').val(d.toLocaleDateString('en-CA'));
			})
			$('input.datePicker').change(function(e) {
				var newStart = new Date($("#startDate").val());
				var newEnd   = new Date($("#endDate").val());
				if (e.target.id === 'startDate' && newEnd < newStart) {
					$('#endDate').val(newStart.toLocaleDateString('en-CA'));
					newEnd   = new Date($("#endDate").val());
				}
				var diff  = new Date(newEnd - newStart);
				var days  = diff/1000/60/60/24;
				if (days < 0) {
					alert("Cannot check-out before you check-in!\n Please check your dates.");
					$('#endDate').val(newStart.toLocaleDateString('en-CA'))
					$('#duration').val('0');
					$("#endDate").focus();
				}
				else if (days > 0) {
					$('#duration').val(days);
					doSearch();
				}
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
