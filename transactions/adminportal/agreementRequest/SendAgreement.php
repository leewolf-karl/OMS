<!DOCTYPE html>
<html lang="en">
	<head>

	</head>

	<body>

	<?php include("nav_admin.php");
	$agreementID = $_GET['agreementID'];
	?>
	<div id="page-wrapper" class = "frightclient">
		<br><br><br><br><br><br><br>
		<h1><center>Send Final Agreement</center></h1>

		<div id = "loginModal" class = "modalogin fade" role = "dialog">
			<div class = "modal-dialog">
				<div class = "modal-content">
					<div class = "modal-header">					
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title"><img src = "icon/lock.png" height = "50" id = "lock"><center>LOG IN</center></h3>
					</div>
					<div class = "modal-body">
						<form action = "php/login.php" method = 'post'>
							<input type="text" class="form-control" id="username" placeholder="Username" name = "username" required><br>
							<input type="password" class="form-control" id="password" placeholder="Password" name = "password" required>
							<input type="submit" id = "logbut" class="btn btn-default" value = "Log in">
						</form>
					</div>
				</div>
			</div>
		</div>	
		
		
		<form action = "submitAgreement.php" method = 'post' enctype="multipart/form-data" >
		<div class="container-fluid" id = "data">
					<label for="comment">Comment:</label>
					<textarea class="form-control" style="width:94%;" rows="5" id="comment"></textarea>
		</div>
		
		<center>
		<div class="row">
				<label for="inputfile">Attach your Agreement Proposal here. PDF format only!</label>
				<input type="file" id="inputfile" name="inputfile">
				<input type="hidden" value="<?php echo $agreementID;?>" id="agreementID" name="agreementID">
				<br>
					<button type="submit" class="btn btn-default" name="submit" >Submit</button>
					<a type="reset" class="btn btn-default" href="agreementRequest.php">Cancel</a>
		</div>
		
		</form>
		</center>
		
		

		</div>			
		</body>
		</html>