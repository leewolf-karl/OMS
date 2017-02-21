<?php
	session_start();
	include "../php/dbconnect.php";
	
	if ((isset($_POST['cid']) and isset($_POST['state'])) and (isset($_POST['table']) and isset($_POST['columnState'])) and isset($_POST['columnId'])){
	
    	$query1 = mysql_query("Update `$_POST[table]` Set $_POST[columnState] = $_POST[state] WHERE $_POST[columnId] = $_POST[cid];");
    	if ($query1 == FALSE){
								die ("Error : " . mysql_error());
		}

		$query = mysql_query("Select * from `$_POST[table]` where $_POST[columnId] = $_POST[cid];");
		while($res = mysql_fetch_assoc($query)){
			$State = $res['Status'];

			if($State == 0){
	            $strstat = "Active";
	        }
	        else{
	        	$strstat = "Inactive"; 
	        }

	        echo $strstat;
		}

	}
?>