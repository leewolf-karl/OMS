<?php
	session_start();
	$aID = $_SESSION['agID'];
	include("../../../php/dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>

	</head>

	<body>

		<?php
			include "nav_client.php";
   
		?>
		<div id="page-wrapper" class = "frightclient">
			<div class="container-fluid" id = "data2">
				<a class = "clientext" style = "color: red; float: left;" onclick = "checkconditions()"><b>Accept Agreement Proposal</b></a>
				<text class = "col-sm-3 clientext" style = "font-size: 13px; float:right; color: gray; text-align: right;"><i>*Only those standard conditions and conditions accepted by both parties will be included in this preview. </i><br>
				<center><a href="preview.php" style="font-size: 13px; float: right;"><span class = "glyphicon glyphicon-print"></span>&nbsp;<u>Print Preview</u></a></center></text><br>
				<br><br>
				<br>
				<div class="col-xs-12">
					<div class="form-group">
						<center><h3>CLIENT AGREEMENT</h3></center>
						<hr style = "background-color: #BEBEBE; height: 1px;">
						<div>
							<text class = "col-lg-1 clientext" style = "font-size: 13px;"><b>NOTE: </b></text>
							<div class="col-lg-10">
								<text class = "clientext" style = "font-size: 13px;"><i>Those written in italic are the agency's <u>additional</u> terms and condition exclusive for <?php echo $_SESSION['company']?> only.</i></text>
								<text class = "clientext" style = "font-size: 13px;"><i>You can either disagree, agree or modify those additional condition.</i></text>
								<text class = "clientext" style = "font-size: 13px;">However, those written in normal text are the agency's standard content of an agreement and unmodifiable.</text>
								<text class = "clientext" style = "font-size: 13px; color: green;">Conditions in green are the conditions <u>accepted</u> by the agency</text>
								<text class = "clientext" style = "font-size: 13px; color: gray;">while conditions in gray are the conditions <u>disagreed</u> by the agency.</text>
							</div>
						</div><br><br><br><br><hr style = "background-color: #BEBEBE; height: 1px;">
					</div>
				</div>
				<h4>Agency's Duties and Responsibilities</h4>
					<div class = "col-lg-12 clientext" id = 'agency'>
						<?php
							$query = "select ConditionID, Status from client_term_and_condition where AgreementID = $aID and Status <> 11";
							$exec = mysql_query($query);
							if($exec == false)
							{
								echo "Error:";
								die (print_r(mysql_error(), true));
							}
							$i = 1;
							while($row = mysql_fetch_array($exec))
							{
								$con = $row['ConditionID'];
								$stat = $row['Status'];
								$getDesc = "select Type, Description from term_and_condition where ConditionID = $con";
								$execDesc = mysql_query($getDesc);
								if(!$exec)
									die (print_r(mysql_error(), true));

								$res = mysql_fetch_array($execDesc);
								$type = $res[0];
								$desc = $res[1];
								if($type == 1)
								{
									if($stat == 0)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$i' onmouseover = 'show(this.id)' onmouseout = 'hide(this.id)'>
											<div class = 'col-sm-1' style = 'float: left;'>$i.</div>
											<div class = 'col-lg-10' style = 'float: left;'>$desc</div>
										  </div><br>";
									}
									else if ($stat == 1)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$i' onmouseover = 'show(this.id)' onmouseout = 'hide(this.id)'>
											<div class = 'col-sm-1' style = 'float: left;'><i>$i.</i></div>
											<div id = 'agency$con' class = 'col-lg-10' style = 'float: left;'><i>$desc</i></div>
											<div id = 'b$i' class = 'col-lg-1 hiddenx' style = 'float: left;'><button onclick = 'agree($con)' class = 'simple-medium'><span class='glyphicon glyphicon-thumbs-up' title = 'Agree'></span></button>&nbsp;&nbsp;<button onclick = 'disagree($con)' class = 'simple-medium'><span title = 'Disagree' class='glyphicon glyphicon-thumbs-down' style = 'color: red'></span></button></div>
										  </div><br>";
									}
									else if ($stat == 2)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$i' onmouseover = 'show(this.id)' onmouseout = 'hide(this.id)'>
											<div class = 'col-sm-1' style = 'float: left;'>$i.</div>
											<div id = 'agency$con' class = 'col-lg-10' style = 'float: left;'>$desc</div>
											<div id = 'b$i' class = 'col-lg-1 hiddenx' style = 'float: left;'><button onclick = 'agree($con)' class = 'simple-medium'><span class='glyphicon glyphicon-thumbs-up' title = 'Agree'></span></button>&nbsp;&nbsp;<button onclick = 'disagree($con)' class = 'simple-medium'><span title = 'Disagree' class='glyphicon glyphicon-thumbs-down' style = 'color: red'></span></button></div>
										  </div><br>";
									}
									else if ($stat == 4)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$i' onmouseover = 'show(this.id)' onmouseout = 'hide(this.id)'>
											<div class = 'col-sm-1' style = 'float: left;'><b>$i</b></div>
											<div id = 'agency$con' class = 'col-lg-10' style = 'float: left;'><b>$desc</b></div>
											<div id = 'b$i' class = 'col-lg-1 hiddenx' style = 'float: left;'><button onclick = 'agree($con)' class = 'simple-medium'><span class='glyphicon glyphicon-thumbs-up' title = 'Agree'></span></button>&nbsp;&nbsp;<button onclick = 'disagree($con)' class = 'simple-medium'><span title = 'Disagree' class='glyphicon glyphicon-thumbs-down' style = 'color: red'></span></button></div>
										  </div><br>";
									}
									else if ($stat == 6)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$i' onmouseover = 'show(this.id)' onmouseout = 'hide(this.id)'>
										<div class = 'col-sm-1' style = 'float: left; color: red'>$i.</div>
										<div id = 'a$i' class = 'col-lg-10' style = 'float: left; color: red'>$desc</div>
										<div id = 'ae$i'class = 'col-lg-10 editarea' style = 'float: left;'><textarea id = 'edited$i' class = 'form-control'>$desc</textarea>
											<button onclick = 'submitedit($i, $con)' class = 'simple-small'><span class='glyphicon glyphicon-ok' title = 'Proceed'></span></button><button class = 'simple-small' onclick = 'cancel($i)'><span title = 'Cancel' class='glyphicon glyphicon-remove'></span></button>
										</div>
										<div id = 'b$i' class = 'col-lg-1 hiddenx' style = 'float: left;'><button class = 'simple-small' onclick = 'editable($i)'><span class='glyphicon glyphicon-pencil' title = 'Edit'></span></button><button onclick = 'removecondition($con)' class = 'simple-small'><span title = 'Remove' class='glyphicon glyphicon-trash'></span></button></div>
									  </div><br>";	
									}
									else if ($stat == 7)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$i' onmouseover = 'show(this.id)' onmouseout = 'hide(this.id)'>
										<div class = 'col-sm-1' style = 'float: left; color: green;'>$i.</div>
										<div id = 'a$i' class = 'col-lg-10' style = 'float: left; color: green;'>$desc</div>
										<div id = 'b$i' class = 'col-lg-1 hiddenx' style = 'float: left;'><button class = 'simple-small' onclick = 'read($i, $con)'><span class='glyphicon glyphicon-ok' title = 'Mark as Read'></span></button></div>
									  </div><br>";	
									}
									else if ($stat == 9)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$i' onmouseover = 'show(this.id)' onmouseout = 'hide(this.id)'>
										<div class = 'col-sm-1' style = 'float: left; color: gray'>$i.</div>
										<div id = 'a$i' class = 'col-lg-10' style = 'float: left; color: gray'>$desc</div>
										<div id = 'ae$i'class = 'col-lg-10 editarea' style = 'float: left;'><textarea id = 'edited$i' class = 'form-control'>$desc</textarea>
											<button onclick = 'submitedit($i, $con)' class = 'simple-small'><span class='glyphicon glyphicon-ok' title = 'Proceed'></span></button><button class = 'simple-small' onclick = 'cancel($i)'><span title = 'Cancel' class='glyphicon glyphicon-remove'></span></button>
										</div>
										<div id = 'b$i' class = 'col-lg-1 hiddenx' style = 'float: left;'><button class = 'simple-small' onclick = 'editable($i)'><span class='glyphicon glyphicon-pencil' title = 'Edit'></span></button><button onclick = 'removecondition($con)' class = 'simple-small'><span title = 'Remove' class='glyphicon glyphicon-trash'></span></button></div>
									  </div><br>";	
									}
									else
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$i' onmouseover = 'show(this.id)' onmouseout = 'hide(this.id)'>
											<div class = 'col-sm-1' style = 'float: left;'>$i.</div>
											<div class = 'col-lg-10' style = 'float: left; color: blue'>$desc</div>
											<div id = 'b$i' class = 'col-lg-1 hiddenx' style = 'float: left;'><button class = 'simple-small'><span class='glyphicon glyphicon-pencil' title = 'Edit'></span></button><button class = 'simple-small'><span title = 'Remove' class='glyphicon glyphicon-trash'></span></button></div>
										  </div><br>";
									}
									$i++;
								}
							}
								echo "<script>var count = $i-1;</script>";
							
						?>
						<center>
							<textarea id = 'additionalagency' class = "form-control" rows ="2" style ="width: 80%;"></textarea>
						</center>
						<button onclick = 'addagency()' class="simplesmall" style="width:5%; margin-left: 10%; margin-top: 1%;">Add</button><br><br>
					</div>
				<h4>Client's Duties and Responsibilities</h4>
					<div class = "col-lg-12 clientext" id = 'client'>
						<?php
							$query = "select ConditionID, Status from client_term_and_condition where AgreementID = $aID and Status <> 11";
							$exec = mysql_query($query);
							if($exec == false)
							{
								echo "Error:";
								die (print_r(mysql_error(), true));
							}
							$ci = 1;
							while($row = mysql_fetch_array($exec))
							{
								$con = $row['ConditionID'];
								$stat = $row['Status'];
								$getDesc = "select Type, Description from term_and_condition where ConditionID = $con";
								$execDesc = mysql_query($getDesc);
								if(!$exec)
									die (print_r(mysql_error(), true));

								$res = mysql_fetch_array($execDesc);
								$type = $res[0];
								$desc = $res[1];
								if($type == 0)
								{
									if($stat == 0)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$ci' onmouseover = 'show(this.id)' onmouseout = 'hide(this.id)'>
											<div class = 'col-sm-1' style = 'float: left;'>$ci.</div>
											<div class = 'col-lg-10' style = 'float: left;'>$desc</div>
										  </div><br>";
									}
									else if ($stat == 1)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$ci' onmouseover = 'cshow(this.id)' onmouseout = 'chide(this.id)'>
											<div class = 'col-sm-1' style = 'float: left;'><i>$ci.</i></div>
											<div id = 'client$con' class = 'col-lg-10' style = 'float: left;'><i>$desc</i></div>
											<div id = 'cb$ci' class = 'col-lg-1 hiddenx' style = 'float: left;'><button onclick = 'cagree($con)' class = 'simple-medium'><span class='glyphicon glyphicon-thumbs-up' title = 'Agree'></span></button>&nbsp;&nbsp;<button onclick = 'cdisagree($con)' class = 'simple-medium'><span title = 'Disagree' class='glyphicon glyphicon-thumbs-down' style = 'color: red'></span></button></div>
										  </div><br>";
									}
									else if ($stat == 2)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$ci' onmouseover = 'show(this.id)' onmouseout = 'chide(this.id)'>
											<div class = 'col-sm-1' style = 'float: left;'>$ci.</div>
											<div id = 'client$con' class = 'col-lg-10' style = 'float: left;'>$desc</div>
											<div id = 'cb$ci' class = 'col-lg-1 hiddenx' style = 'float: left;'><button onclick = 'cagree($con)' class = 'simple-medium'><span class='glyphicon glyphicon-thumbs-up' title = 'Agree'></span></button>&nbsp;&nbsp;<button onclick = 'cdisagree($con)' class = 'simple-medium'><span title = 'Disagree' class='glyphicon glyphicon-thumbs-down' style = 'color: red'></span></button></div>
										  </div><br>";
									}
									else if ($stat == 4)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$ci' onmouseover = 'cshow(this.id)' onmouseout = 'chide(this.id)'>
											<div class = 'col-sm-1' style = 'float: left;'><b>$ci</b></div>
											<div id = 'client$con' class = 'col-lg-10' style = 'float: left;'><b>$desc</b></div>
											<div id = 'cb$ci' class = 'col-lg-1 hiddenx' style = 'float: left;'><button onclick = 'cagree($con)' class = 'simple-medium'><span class='glyphicon glyphicon-thumbs-up' title = 'Agree'></span></button>&nbsp;&nbsp;<button onclick = 'cdisagree($con)' class = 'simple-medium'><span title = 'Disagree' class='glyphicon glyphicon-thumbs-down' style = 'color: red'></span></button></div>
										  </div><br>";
									}

									else if ($stat == 6)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$ci' onmouseover = 'cshow(this.id)' onmouseout = 'chide(this.id)'>
										<div class = 'col-sm-1' style = 'float: left; color: red'>$ci.</div>
										<div id = 'c$ci' class = 'col-lg-10' style = 'float: left; color: red'>$desc</div>

										<div id = 'ce$ci'class = 'col-lg-10 editarea' style = 'float: left;'><textarea id = 'cedited$ci' class = 'form-control'>$desc</textarea>
											<button onclick = 'csubmitedit($ci, $con)' class = 'simple-small'><span class='glyphicon glyphicon-ok' title = 'Proceed'></span></button><button class = 'simple-small' onclick = 'ccancel($ci)'><span title = 'Cancel' class='glyphicon glyphicon-remove'></span></button>
										</div>
										<div id = 'cb$ci' class = 'col-lg-1 hiddenx' style = 'float: left;'><button class = 'simple-small' onclick = 'ceditable($ci)'><span class='glyphicon glyphicon-pencil' title = 'Edit'></span></button><button onclick = 'cremovecondition($con)' class = 'simple-small'><span title = 'Remove' class='glyphicon glyphicon-trash'></span></button></div>
									  </div><br>";	
									}
									else if ($stat == 9)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$ci' onmouseover = 'cshow(this.id)' onmouseout = 'chide(this.id)'>
											<div class = 'col-sm-1' style = 'float: left; color: gray;'>$ci.</div>
											<div id = 'client$con' class = 'col-lg-10' style = 'float: left; color: gray;'>$desc</div>
											<div id = 'ce$ci'class = 'col-lg-10 editarea' style = 'float: left;'><textarea id = 'cedited$ci' class = 'form-control'>$desc</textarea>
											<button onclick = 'csubmitedit($ci, $con)' class = 'simple-small'><span class='glyphicon glyphicon-ok' title = 'Proceed'></span></button><button class = 'simple-small' onclick = 'ccancel($ci)'><span title = 'Cancel' class='glyphicon glyphicon-remove'></span></button>
										</div>
										<div id = 'cb$ci' class = 'col-lg-1 hiddenx' style = 'float: left;'><button class = 'simple-small' onclick = 'ceditable($ci)'><span class='glyphicon glyphicon-pencil' title = 'Edit'></span></button><button onclick = 'cremovecondition($con)' class = 'simple-small'><span title = 'Remove' class='glyphicon glyphicon-trash'></span></button></div>
										  </div><br>";
									}
									else if($stat == 7)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$ci' onmouseover = 'cshow(this.id)' onmouseout = 'chide(this.id)'>
										<div class = 'col-sm-1' style = 'float: left; color: green;'>$ci.</div>
										<div id = 'c$ci' class = 'col-lg-10' style = 'float: left; color: green;'>$desc</div>
										<div id = 'cb$ci' class = 'col-lg-1 hiddenx' style = 'float: left;'><button class = 'simple-small' onclick = 'cread($ci, $con)'><span class='glyphicon glyphicon-ok' title = 'Mark as Read'></span></button></div>
									  </div><br>";	
									}
									else
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$ci' onmouseover = 'cshow(this.id)' onmouseout = 'chide(this.id)'>
											<div class = 'col-sm-1' style = 'float: left;'>$ci.</div>
											<div class = 'col-lg-10' style = 'float: left; color: blue'> $desc</div>
											<div id = 'cb$ci' class = 'col-lg-1 hiddenx' style = 'float: left;'><button class = 'simple-small'><span class='glyphicon glyphicon-pencil' title = 'Edit'></span></button><button class = 'simple-small'><span title = 'Remove' class='glyphicon glyphicon-trash'></span></button></div>
										  </div><br>";
									}
									$ci++;
								}
							}

								echo "<script>var ccount = $ci-1;</script>";
							
						?>
						<center>
							<textarea id = 'additionalclient' class = "form-control" rows ="2" style ="width: 80%;"></textarea>
						</center>
						<button onclick = 'addclient()' class="simplesmall" style="width:5%; margin-left: 10%; margin-top: 1%;">Add</button><br><br>
					</div>
					<br><br>
				<br>
			</div>
		</div>
		<script type="text/javascript">
			function checkconditions()
			{
				window.location.href = "validateagreement.php";
			}
			function editable(id)
			{
				var newID;
				var newest;
				var a;
				for (a = 1; a <= count; a++)
				{
					newID = 'ae'+a;
					newest = 'a'+a;
					if(a == id)
					{
						document.getElementById(newest).style.display = "none";
						document.getElementById(newID).style.display = "block";
						document.getElementById(newID).focus();
					}
					else
					{
						if($("#" + newID).length != 0)
						{  	
							document.getElementById(newest).style.display = "block";
							document.getElementById(newID).style.display = "none";
						}

					}
				}

			}
			function read(id, tid) 
			{	
				var hard = 'a'+id;
				if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("agency").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","readcondition.php?&termID="+tid,true);
		        xmlhttp.send();
		        alert("Marked as read.");
			}

			function cancel(id)
			{
				var newID = 'ae'+id;
				var newest = 'a'+id;
				document.getElementById(newest).style.display = "block";
				document.getElementById(newID).style.display = "none";

			}
			function submitedit(id, tid) 
			{	
				var edit = 'ae'+id;
				var hard = 'a'+id;
				var text = 'edited'+id;
				var editversion = document.getElementById(text).value;
				if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		            	document.getElementById(edit).style.display = "none";
		                document.getElementById(hard).innerHTML = xmlhttp.responseText;
		            	document.getElementById(hard).style.display = "block";
		            }
		        };
		        xmlhttp.open("GET","editcondition.php?&e="+editversion+"&termID="+tid,true);
		        xmlhttp.send();
			}
			function agree(id)
			{
				var newID = 'agency'+id;
				var bool = confirm("Are you sure you want to accept this condition?");
				if(bool == true)
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
			                document.getElementById(newID).innerHTML = xmlhttp.responseText;
			            }
			        };
			        xmlhttp.open("GET","clientagree.php?&conID="+id,true);
			        xmlhttp.send();
			    }
			}
			function cagree(id)
			{
				var newID = 'client'+id;
				var bool = confirm("Are you sure you want to accept this condition?");
				if(bool == true)
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
			                document.getElementById(newID).innerHTML = xmlhttp.responseText;
			            }
			        };
			        xmlhttp.open("GET","cclientagree.php?&conID="+id,true);
			        xmlhttp.send();
			    }
			}
			function removecondition(tid) 
			{	
				var proceed = confirm("Are you sure you want to to delete this condition?");
				if(proceed == true)
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
			                document.getElementById("agency").innerHTML = xmlhttp.responseText;
			            }
			        };
			        xmlhttp.open("GET","deletecondition.php?&termID="+tid,true);
			        xmlhttp.send();
			        alert("You have deleted the condition.");
		    	}
			}
			function cremovecondition(tid) 
			{	
				var proceed = confirm("Are you sure you want to to delete this condition?");
				if(proceed == true)
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
			                document.getElementById("client").innerHTML = xmlhttp.responseText;
			            }
			        };
			        xmlhttp.open("GET","cdeletecondition.php?&termID="+tid,true);
			        xmlhttp.send();
			        alert("You have deleted the condition.");
		    	}
			}
			function disagree(id)
			{
				var bool = confirm("Are you sure you want to disagree to this condition?");
				if(bool == true)
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
			                document.getElementById("agency").innerHTML = xmlhttp.responseText;
			            }
			        };
			        xmlhttp.open("GET","clientdisagree.php?&conID="+id,true);
			        xmlhttp.send();
			    }
			}
			function cdisagree(id)
			{
				var bool = confirm("Are you sure you want to disagree to this condition?");
				if(bool == true)
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
			                document.getElementById("client").innerHTML = xmlhttp.responseText;
			            }
			        };
			        xmlhttp.open("GET","cclientdisagree.php?&conID="+id,true);
			        xmlhttp.send();
			    }
			}
			function show(val)
			{
				var newID = 'b'+val;
				document.getElementById(newID).style.display = "block";
			}
			function hide(val)
			{
				var newID = 'b'+val;
				document.getElementById(newID).style.display = "none";
			}

			function cshow(val)
			{
				var newID = 'cb'+val;
				document.getElementById(newID).style.display = "block";
			}
			function chide(val)
			{
				var newID = 'cb'+val;
				document.getElementById(newID).style.display = "none";
			}

			function addagency() 
			{	
				var condition = document.getElementById('additionalagency').value;

				if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("agency").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","cagencyList.php?&condi="+condition,true);
		        xmlhttp.send();
			}		
			function addclient() 
			{	
				var condition = document.getElementById('additionalclient').value;

				if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("client").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","cclientList.php?&condi="+condition,true);
		        xmlhttp.send();
			}
			function ceditable(id)
			{
				var newID;
				var newest;
				var a;
				for (a = 1; a <= ccount; a++)
				{
					newID = 'ce'+a;
					newest = 'c'+a;

					if(a == id)
					{
						document.getElementById(newest).style.display = "none";
						document.getElementById(newID).style.display = "block";
					}
					else
					{
						if($("#" + newID).length != 0)
						{  	
							document.getElementById(newest).style.display = "block";
							document.getElementById(newID).style.display = "none";
						}

					}
				}

			}
			function addagency() 
			{	
				var condition = document.getElementById('additionalagency').value;

				if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("agency").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","agencyList.php?&condi="+condition,true);
		        xmlhttp.send();
			}		
			function csubmitedit(id, tid) 
			{	
				var edit = 'ce'+id;
				var hard = 'c'+id;
				var text = 'cedited'+id;
				var editversion = document.getElementById(text).value;
				if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		            	document.getElementById(edit).style.display = "none";
		                document.getElementById(hard).innerHTML = xmlhttp.responseText;
		            	document.getElementById(hard).style.display = "block";
		            }
		        };
		        xmlhttp.open("GET","ceditcondition.php?&e="+editversion+"&termID="+tid,true);
		        xmlhttp.send();
			}
			function ccancel(id)
			{
				var newID = 'ce'+id;
				var newest = 'c'+id;
				document.getElementById(newest).style.display = "block";
				document.getElementById(newID).style.display = "none";

			}
			function cread(id, tid) 
			{	
				var hard = 'c'+id;
				if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("client").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","creadcondition.php?&termID="+tid,true);
		        xmlhttp.send();
		        alert("Marked as read.");
			}
		</script>

		<div id = "years" class = "modalogin fade" role = "dialog">
			<div class = "modal-dialog">
				<div class = "modal-content">
					<div class = "modal-header">						
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title"><center>ACCEPT CLIENT AGREEMENT</center></h3>
					</div>
					<div class = "modal-body">
					<form method="post" action = "clientaccepted.php" class="clientext">
						<label style="margin-top: 8px;">Contract Span: </label><br>
						<input type = "number" class="form-control" min = "1" style="width: 30%; float: left;" name = "span"><br>
						<text style = "float: left;">&nbsp;&nbsp;&nbsp;year/s</text><br>
						<input type = "number" class="form-control" min = "1" style="width: 30%; float: left;" name = "spanM"><br>
						<text>&nbsp;&nbsp;&nbsp;month/s</text><br>
						<center>
							<input type="submit" value="Send" class="btn btn-primary" style = "width: 45%; margin-top: 8px; float:right;"><br><br>
						</center>
					</form>
					</div>
				</div>
			</div>
		</div>
	</body>

</html>
