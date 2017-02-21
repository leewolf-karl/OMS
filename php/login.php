<?php
	session_start();
	include("dbconnect.php");
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$valid = false;
	if($user == 'admin' && $pass == 'admin')
	{
		
			echo "<script>window.alert('Welcome, Admin!')
					window.location.href = '../adminhome.php';</script>";
	}
	else
	{
		$query = "select ClientID, Name, Username, Password, BusinessNatureID from client";
		$exec = mysql_query($query);
		if(!$exec)
			die (print_r(mysql_error(), true));
		while($row = mysql_fetch_array($exec))
		{
			if($user == $row['Username'] && $pass == $row['Password'])
			{
				$_SESSION['company'] = $row['Name'];
				$_SESSION['clID'] = $row['ClientID'];
				$cid = $_SESSION['clID'];

				$_SESSION['bnature'] = $row['BusinessNatureID'];

				$checkAgreement = "select AgreementID, Status from client_agreement where ClientID = $cid";
				$exec = mysql_query($checkAgreement);
				if(!$exec)
					die (print_r(msql_error(), true));
				$res = mysql_fetch_array($exec);
				$_SESSION['agID'] = $res[0];
				$_SESSION['agStat'] = $res[1];	

				echo "<script>
					window.alert('Welcome, Client!');
					window.location.href = '../clienthome.php';
					</script>";
				$valid = true;
				break;
			}
		}
		if(!$valid)
		{
			echo "<script>
					window.alert('Invalid Username/Password!');
					window.location.href = '../index.html';
					</script>";
		}

	}
?>