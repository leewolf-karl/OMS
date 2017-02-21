<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['certname'])){
		
		$certName = strtolower(mysql_real_escape_string($_POST['certname']));

//check if exist
  		

  		$check = mysql_query("SELECT * from `certification` where Name = '$certName' ");
			$row = mysql_num_rows($check);


			if($row >= 1){
				while($res = mysql_fetch_assoc($check)){
					$certId = $res['CertificationID'];
					$certState = $res['Status'];
				
					if($certState == 3){
						$query1 = mysql_query("Update `certification` Set Status = 1 WHERE CertificationID = $certId;");
						echo "inserted";
					}
					else{
						echo "exist";
					}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `certification` (Name, Status) VALUES('$certName', 1)");
				if ($query == FALSE){
					die ("Error add certification: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}


   }
?>