<?php
	session_start();
	include "../php/dbconnect.php";

	if( (isset($_POST['id']) and isset($_POST['table'])) and isset($_POST['columnid']) ){
		$selectId = mysql_real_escape_string($_POST['id']);
        $ifFind = false;
        $ctr = 0;

		$sql_in = mysql_query("SELECT * from $_POST[table] where Status = 0 order by Name");
        $options = "";  

          	while ($r = mysql_fetch_assoc($sql_in)){
                  $tableID = mysql_real_escape_string($r[$_POST['columnid']]);
                  $tableName = ucwords(mysql_real_escape_string($r['Name']));

                  
	                while($ifFind == false){
	                  	if($ctr < strlen($selectId)){
	                  		if($tableID == $selectId[$ctr]){
	                  			$ifFind = true;
	                  		}
	                  		else{
	                  			$ctr++;
	                  		}
	                  	}
	                  	else{
	                  		$options .= "<option value='{$tableID}'>{$tableName}</option>";

	                  		$ifFind = true;
	                  	}
	                }
	         		$ctr = 0;
	                $ifFind = false;
          	}
          	          echo $options;
	}
?>