<!-- Search page -->
<!-- TODO ===> Add ability to Update User, Reservation, Asset -->
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
					<a href="index.php" class="float-right">Make Reservation</a>					
					<h1>ResErvation</h1>
					<form class="form-horizontal" id="frmSearch">
						<div class="form-group row">
							<div class="col-sm-12">
								<label for="searchString" class="control-label">Search: Name, Tel, Email or Room Number</label>
								<input type="text" class="form-control" id="searchString" placeholder="Enter Search value" autofocus>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col col-12">
					<table class="table table-hover table-responsive-sm" id="tblSearchResult">
						<thead>
							<tr>
								<th>Surname</th>
								<th>Name</th>
								<th>Tel</th>
								<th>Email</th>
								<th>Asset</th>
								<th>Res. No.</th>
								<th>Check-in</th>
								<th>Check-out</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
		
		<script src="scripts/jquery-3.3.1.min.js" type="text/javascript"></script>
		<script src="scripts/bootstrap.js" type="text/javascript"></script>
		<script src="scripts/scripts.js" type="text/javascript"></script>
		<script>
			$("#searchString").on("keyup", function() {
				findRes(this.value);
			})
		</script>
    </body>
</html>
