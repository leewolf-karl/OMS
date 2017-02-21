<?php
	session_start();
	include "../php/dbconnect.php";

	if ((isset($_POST['amimg']) and isset($_POST['amfname'])) and (isset($_POST['ammname']) and isset($_POST['amlname'])) and (isset($_POST['amuser']) and isset($_POST['ampass'])) and (isset($_POST['amroleid']) and isset($_POST['amaddress']))){
		
		$amImg = mysql_real_escape_string($_POST['amimg']);
		$amRoleID = mysql_real_escape_string($_POST['amroleid']);
		$amFname = strtolower(mysql_real_escape_string($_POST['amfname']));
		$amMname = strtolower(mysql_real_escape_string($_POST['ammname']));
		$amLname = strtolower(mysql_real_escape_string($_POST['amlname']));
		$amUser = strtolower(mysql_real_escape_string($_POST['amuser']));
		$amPass = mysql_real_escape_string($_POST['ampass']);
		$amAddress = strtolower(mysql_real_escape_string($_POST['amaddress']));

//check if exist
  		

  		$check1 = mysql_query("SELECT * from `user_admin` where Username = '$amUser'");
  		$check2 = mysql_query("SELECT * from `user_admin` where (FName = '$amFname' and Address = '$amAddress') and (MName = '$amMname' and LName = '$amLname' ) and (Picture = '$amImg' and RoleID = $amRoleID)");
			
		$row1 = mysql_num_rows($check1);
    	$row2 = mysql_num_rows($check2);

    	if($row1 >= 1){
          	if($row2 >= 1){
	            while($res = mysql_fetch_assoc($check1)){
	              	$amId = $res['UserID'];
					$amState = $res['Status'];
					
						if($amState == 3){
							$query1 = mysql_query("Update `user_admin` Set Status = 1 WHERE UserID = $amId;");
							echo "inserted";
						}
						else{
							echo "exist";
						}
	                      
	            }
        	}
        	else{
        		echo "user_exist";
        	}
        
	    }
	    else{
	        $query = mysql_query("INSERT INTO `user_admin` (FName, MName, LName, Address, Picture, Username, Password, RoleID, Status) VALUES('$amFname', '$amMname', '$amLname', '$amAddress', '$amImg', '$amUser', '$amPass', $amRoleID, 1)");
					if ($query == FALSE){
						die ("Error add am: " . mysql_error());
					}
	             	else{
	                	echo "inserted";
	             	}

	    }
   }
?>