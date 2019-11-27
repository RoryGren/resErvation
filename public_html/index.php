<!-- TODO ===> Add, edit new Assets -->
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
					<a href="resFind.php" class="float-right">Search Existing</a>					
					<h1>ResErvation</h1>
					
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
 						<form class="form-horizontal" id="frmBook">
							<div class="form-group row">
								<div class="col-sm-12">
									<h5>Booking details</h5>
									<table>
										<tr><td>Nights:</td><td><input type="text" class="borderless" id="numDays" readonly></td></tr>
										<tr><td>Check-in:</td><td><input type="text" class="borderless" id="startDay" readonly></td></tr>
										<tr><td>Check-out:</td><td><input type="text" class="borderless" id="endDay" readonly></td></tr>
									</table>
									<input type="hidden" class="form-control" id="AssetId">
								</div>
							</div>
							<div class="form-group row">
								<span>To finalise, please enter your contact information:</span><br>
								<div class="col-sm-6">
									<label for='Tel' class='control-label'>Telephone</label>
									<input type="number" class="form-control" id="Tel" placeholder="Telephone" required>
								</div>
								<div class="col-sm-6">
									<label for='FName' class='control-label'>Name</label>
									<input type="text" class="form-control" id="FName" placeholder="First / Given Name" required>
								</div>
								<div class="col-sm-6">
									<label for='SName' class='control-label'>Surname</label>
									<input type="text" class="form-control" id="SName" placeholder="Surname / Family Name" required>
								</div>
								<div class="col-sm-6">
									<label for='email' class='control-label'>Email</label>
									<input type="email" class="form-control" id="email" placeholder="xxx@yyyy.com" required>
								</div>
							</div>
						</form>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-modal btn-success" id="btnSave" disabled>Book</button>
						<button type="button" class="btn btn-default btn-modal" id="btnCancel" data-dismiss="modal">Cancel</button>
					</div>
				</div>

			</div>
		</div>

		
		<script src="scripts/jquery-3.3.1.min.js" type="text/javascript"></script>
		<script src="scripts/bootstrap.js" type="text/javascript"></script>
		<script src="scripts/scripts.js" type="text/javascript"></script>
		<script>
//	TODO ===> Prevent start date being earlier than today.
//	TODO ===> Validation of user input.
//	TODO ===> Make sure check-out date not before check-in date
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
				
				$('#startDay').val($("#startDate").val())
				$('#endDay').val($("#endDate").val())
				var diff  = new Date(newEnd - newStart);
				var days  = diff/1000/60/60/24;
				
				// ==== Check-out cannot be earlier than Check-in =====
				
				if (days < 0) {
					alert("Cannot check-out before you check-in!\n Please check your dates.");
					$('#endDate').val(newStart.toLocaleDateString('en-CA'))
					$('#duration').val('0');
					$("#endDate").focus();
				}
				else if (days > 0) {
					$('#duration').val(days);
					$('#numDays').val(days);
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
			
			$('.modal input').on("keyup", function() {
				
				// Check required fields are not null then enable Save button
				// Only validation done by html input type & 'required' attribs
				if (($("#FName").val() != '') && ($("#SName").val() != '') && ($("#Tel").val() != '') && ($("#email").val() != '')) {
					$("#btnSave").prop('disabled', false);				}
				else {
					$("#btnSave").prop('disabled', 'disabled');
				}
			});
			
			$('.btn-modal').on("click", function(e) {
				if (e.target.id === "btnSave") {
					processBooking($.find("#frmBook :input"));
				}
			});
		</script>
    </body>
</html>
