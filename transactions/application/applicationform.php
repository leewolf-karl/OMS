<?php
	include("../../php/dbconnect.php");
	$skill = mysql_query("SELECT * FROM skill Where Status  = 0");
?>
<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>We recruit | We hone</title>
		
		<link href="../../bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="../../bootstrap/css/full-slider.css" rel="stylesheet">
		<link href="../../semantic/out/semantic.css" rel="stylesheet">
		<link href="../../css/main.css" rel="stylesheet">
		
		<script src="../../bootstrap/js/jquery.js"></script>
		<script src="../../bootstrap/js/bootstrap.min.js"></script>
		<script src="../../semantic/out/semantic.min.js"></script>
		<script type="text/javascript">
		function getAge(){
				var birthdate = document.getElementById('date').value;
				birthdate = new Date(birthdate);
				var today = new Date();
				var age = Math.floor((today-birthdate) / (365.25 * 24 * 60 * 60 * 1000));
				document.getElementById('age').value=age;
			}
		</script>
	</head>

	<body>
	 <!-- Navigation -->
        <nav class="navbar navbar-inverse1 navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#" id = "head">Outsourcing Management System</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#">About</a>
                        </li>
                        <li>
                            <a href="#">Services</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                        <li>
                            <a href="#">Job Openings</a>
                        </li>
                    </ul>
                    <div class="dropdown" id = "app">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style = "color: white;"> Apply As <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="ClientContractRequests.php"><i class="fa fa-fw fa-user"></i> Client</a>
                            </li>
                            <li>
                                <a href="applicationform.php"><i class="fa fa-fw fa-envelope"></i> Applicant</a>
                            </li>
                        </ul>
                    </div>
                    <a href = "#" data-toggle="modal" data-target="#loginModal" id = "login">Log in</a>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        
        <div id = "loginModal" class = "modalogin fade" role = "dialog">
            <div class = "modal-dialog">
                <div class = "modal-content">
                    <div class = "modal-header">                        
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title"><img src = "../../icon/lock.png" height = "50" id = "lock"><center>LOG IN</center></h3>
                    </div>
                    <div class = "modal-body">
                        <form action = "../../php/login.php" method = 'post'>
                            <input type="text" class="form-control" id="username" placeholder="Username" name = "username" required><br>
                            <input type="password" class="form-control" id="password" placeholder="Password" name = "password" required>
                            <input type="submit" id = "logbut" class="btn btn-default" value = "Log in">
                        </form>
                    </div>
                </div>
            </div>
        </div>
		<br>
		<br>
		<h1><center>Application Form</center></h1>

		<form action = "php/sendcontReq.php" method = "post" >
		<fieldset>

		<div class="container">
			
			<div class="row">
				<div class="col-lg-3">
					<label>First Name</label>
					<input type="text" name="fName" class="form-control" placeholder="First Name">
				</div>
				<div class="col-lg-3">
					<label>Middle Name</label>
					<input type="text" name="mName" class="form-control" placeholder="Middle Name">
				</div>
				<div class="col-lg-3">
					<label>Last Name</label>
					<input type="text" name="lName" class="form-control" placeholder="Last Name">
				</div>
				<div class="col-lg-3">
					<label>Name Ext</label>
					<input type="text" name="nameExt" class="form-control" placeholder="Name Ext">
				</div>
			</div>



			<div class="row">
				<div class="col-lg-6">
				<label>Address:</label>
				<input type="text" name="streetaddress" class="form-control" placeholder="Street Address">
				</div>
				<div class="col-lg-6">
				<label>E-mail Address</label>
				<input type="text" name="email" class="form-control">
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<label>Cellphone Number</label>
					<input type="text" name="contact" class="form-control">
				</div>
				<div class="col-lg-6">
					<label>Telephone Number</label>
					<input type="text" name="tel" class="form-control">
				</div>	
			</div>

			<div class="row">
				<div class="col-lg-6">
					<label>Educational Attainment</label>
					<select name="education" class="form-control">
						<option value="0">Less than High School</option>
						<option value="1">Graduate from High School</option>
						<option value="2">Vocational Courses</option>
						<option value="3">Completed 1st Year of College</option>
						<option value="4">Completed 2nd Year of College</option>
						<option value="5">Completed 3rd Year of College</option>
						<option value="6">Graduated from College</option>
					</select>
				</div>
				<div class="col-lg-6">
					<label>Course</label>
					<select name="course" class="form-control">
						<option class = "form-control" selected disabled>Choose</option>
						<?php
						$query = "select * from course where status = 0";
						$exec = mysql_query($query);
						if($exec == false)
						{
							echo "Error:";
							die (print_r(mysql_error(), true));
						}
						while ($row = mysql_fetch_array($exec))
						{
							$id = $row['CourseID'];
							$name = $row['Name'];

							echo "<option value = '$id'>$name</option>";
						}
					?>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-3">
					<label>Gender</label><br>
					<label class="radio-inline">
						<input type="radio" name="gender" value="0"> Male
					</label>
					<label class="radio-inline">
						<input type="radio" name="gender" value="1"> Female
					</label>	
				</div>
				<div class="col-lg-3">
					<label>Date of Birth</label>
					<input type="date" id="date" name="birthdate" onblur="getAge();" class="form-control">
				</div>
				<div class="col-lg-3">
					<label>Age</label>
					<input type="text" id="age" name="age" class="form-control" disabled>
				</div>
				<div class="col-lg-3">
					<label>Civil Status</label>
						<select name="civilstatus" class="form-control">
							<option value="0">Single</option>
							<option value="1">Married</option>
							<option value="2">Widowed</option>
						</select>
					</div>
			</div>
				<br>
				<br>
			<div class="form-group">
				<label for="inputfile">Attach your Resume here. PDF format only!</label>
				<input type="file" id="inputfile" accept="application/pdf">
			</div>	

			<div class="row">	
				<div>
				<center>
					<button type="submit" class="btn btn-default">Submit</button>
					<button type="reset" class="btn btn-default">Reset</button>
				</center>
				</div>
			</div>	
		</div>






		</fieldset>
		</form>

		
		
	<script>
	
			var $datepicker = $( '#curDate' );
			$datepicker.datepicker();
			$datepicker.datepicker('setDate', new Date());

			var dateToday = new Date(); 
			$(function() {
			    $( '#curDate' ).datepicker({
			        minDate: dateToday,
			        dateFormat: "mm-dd-yyyy"
			    });
			});

    		var yrs = <?php echo json_encode($span, JSON_HEX_TAG); ?>;
    		var mos = <?php echo json_encode($mos, JSON_HEX_TAG); ?>;

    		dateToday.setFullYear(dateToday.getFullYear() + (+yrs));
    		dateToday.setMonth(dateToday.getMonth() + (+mos));

    		var $datepicker = $( '#expDate' );
			$datepicker.datepicker();
			$datepicker.datepicker('setDate', dateToday);

			function computeExp()
			{
				var s = document.getElementById('curDate').value;
				s.setFullYear(dateToday.getFullYear() + (+yrs));
	    		s.setMonth(dateToday.getMonth() + (+mos));

	    		var $datepicker = $( '#expDate' );
				$datepicker.datepicker();
				$datepicker.datepicker('setDate', s);
			}
		

			

	</script>


	</body>

</html>
