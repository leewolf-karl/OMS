<?php
	include("../../php/dbconnect.php");
	
?>
<!DOCTYPE html>
<html lang="en">
	
	<head>
	</head>

	<body>

		<?php
		include "nav.php";
		?>


		<div class  = "col-lg-6 reqLeft">
		</div>

		<div class  = "col-lg-6 reqRight">
			<br>
			<text style = "font-family: arial; font-weight: bold; font-size: 22px;">Notify us now by filling out this form!</text>
			<br><hr>
			<text style = "font-size: 20px; font-family: calibri light;"><i>Good day! We are very happy to have the chance to give you services with the highest quality as possible. Please fill out all the necessary fields to notify us that you are interested.</i></text>
			<br><br>
			<div id = "divJob" class = "col-lg-12">
					<br><br>
			</div>
			<br><br><br>				
			<form method="post" action = "joborder.php">
				<label style = "float: left; margin-right: 10px; margin-left: 18px; font-style: arial;">Your company's nature of business:</label>
				<select name = "bNature" class = "form-control clientext" style = "width: 55%;" onchange="showJobs(this.value)">
					<option class = "form-control" selected disabled>Choose</option>
					<?php
						$query = "select * from business_nature where status = 1";
						$exec = mysql_query($query);
						if($exec == false)
						{
							echo "Error:";
							die (print_r(mysql_error(), true));
						}
						while ($row = mysql_fetch_array($exec))
						{
							$id = $row['BusinessNatureID'];
							$name = $row['Name'];

							echo "<option value = '$id'>$name</option>";
						}
					?>
				</select>
				<br>
				<label style = "float: left; margin-right: 10px; margin-left: 21%;">Company Name: </label>
				<input type = "text" name = "companyName" class = "form-control" style = "width: 55%;"><br>
				<label style = "float: left; margin-right: 10px; margin-left: 22.5%;">Email Address: </label>
				<input type = "email" name = "emailAddress" class = "form-control" style = "width: 55%;"><br>
				<label style = "float: left; margin-right: 10px; margin-left: 28.8%;">Website: </label>
				<input type = "text" name = "website" class = "form-control" style = "width: 55%;"><br>		
				<label style = "float: left; margin-right: 10px; margin-left: 20.8%;">Representative: </label>
				<input type = "text" name = "rep" class = "form-control" style = "width: 55%;"><br>		
				<label style = "float: left; margin-right: 10px; margin-left: 28.8%;">Contact: </label>
				<input type = "text" name = "telNo" class = "form-control" style = "width: 25%; margin-right: 3%; float: left;" placeholder="Tel No">
				<input type = "text" name = "contactNumber" class = "form-control" style = "width: 27%;" placeholder="Phone No"><br><br>

				<label style = "float: left; margin-right: 10px;">Address (Main): </label>
				<input type = "text" name = "street" class = "form-control" style = "width: 77%;" placeholder="Street Address"><br>
				<input type = "text" name = "city" class = "form-control" style = "width: 27%; float: left; margin-left: 18%;" placeholder="City">
				<input type = "text" name = "state" class = "form-control" style = "width: 27%; float: left; margin-left: 4%;" placeholder="State">
				<input type = "text" name = "zip" class = "form-control" style = "width: 15%; float: left; margin-left: 4%;" placeholder="Zip Code">

				<br><br><br><br>
				<center>
					<input type = "submit" value = "Send Request" class = "btn btn-primary" style = "width: 20%;">
					<input type = "cancel" value = "Cancel" class = "btn btn-primary" style = "width: 20%;">
				</center>
			</form>
		</div>
		<script type="text/javascript">
			function showJobs(jobId) 
			{		   
		        if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("divJob").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","showJobList.php?jid="+jobId,true);
		        xmlhttp.send();
			}
		</script>

	</body>

</html>
