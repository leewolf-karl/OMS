<?php

	include("../../../php/dbconnect.php");
	
	$agreementID=$_POST['agreementID'];
	if(isset($_POST['accept']))
	{	$query = mysql_query("UPDATE client_agreement SET Status=4 WHERE ClientID='$_POST[id]'") or die(mysql_error());
		echo "<script>
				window.location.href=\"SendAgreement.php?agreementID=\"+$agreementID;
		</script>";
		
		}
    else if(isset($_POST['reject']))
	{	$query = mysql_query("UPDATE client_agreement SET Status=4 WHERE ClientID='$_POST[id]'") or die(mysql_error());
		$query2 = mysql_query("UPDATE client SET Status=4 WHERE ClientID='$_POST[id]'") or die(mysql_error());
		echo "<script>
				window.location.href='agreementRequest.php';
				alert('Status Updated!');
		</script>";
		}
  
?>
