<?php
	session_start();
	include "../php/dbconnect.php";

	if( isset($_POST['id']) ){
		$selectId = mysql_real_escape_string($_POST['id']);
      	$ctr = 0;

		$sql_in = mysql_query("Select jq.*, q.Name as QName from job_qualification jq left join qualification q on jq.QualificationID = q.QualificationID where jq.JobID = $selectId order by QName");
     	$row = mysql_num_rows($sql_in);
?>
		Qualification Name:  
<?php
		if($row >= 1){
			while ($r = mysql_fetch_assoc($sql_in)){
                  $qualName = ucwords(mysql_real_escape_string($r['QName']));
                if($ctr < $row - 1){
                	echo "<font style='color:red;margin-left:1%;'>" . $qualName . "</font></br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                }
                else{
                	echo "<font style='color:red;margin-left:2%;'>" . $qualName . "</font>";
                }
               	
               	$ctr++;
          	}
        }
        else{
        		echo "<font style='color:red;margin-left:1%;'>N/A</font>";
        }
        $ctr = 0;
        $sql_in = mysql_query("Select jr.*, r.Name as RName from job_requirement jr left join requirement r on jr.RequirementID = r.RequirementID where jr.JobID = $selectId order by RName");
     	$row = mysql_num_rows($sql_in);
?>
		<br>
		Requirement Name:  
<?php
		if($row >= 1){
			     while ($r = mysql_fetch_assoc($sql_in)){
                  $reqName = ucwords(mysql_real_escape_string($r['RName']));

                if($ctr < $row - 1){
                	echo "<font style='color:red;margin-left:1%;'>" . $reqName . "</font></br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                }
                else{
                	echo "<font style='color:red;margin-left:2%;'>" . $reqName . "</font>";
                }
               	
               	$ctr++;
          	}
        }
        else{
        		echo "<font style='color:red;margin-left:1%;'>N/A</font>";
        }
        $ctr = 0;
        $sql_in = mysql_query("Select js.*, s.Name as SName from job_skill js left join skill s on js.SkillID = s.SkillID where js.JobID = $selectId order by SName");
     	$row = mysql_num_rows($sql_in);
?>
		<br>
		Skill Name:  
<?php
		if($row >= 1){
			while ($r = mysql_fetch_assoc($sql_in)){
                  $skillName = ucwords(mysql_real_escape_string($r['SName']));

                if($ctr < $row - 1){
                	echo "<font style='color:red;margin-left:1%;'>" . $skillName . "</font></br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                }
                else{
                	echo "<font style='color:red;margin-left:1%;'>" . $skillName . "</font>";
                }
               	
               	$ctr++;
          	}
        }
        else{
        		echo "<font style='color:red;margin-left:1%;'>N/A</font>";
        }
          	          
	}
?>