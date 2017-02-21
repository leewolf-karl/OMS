<head>
	<script src="select_functions.js"></script>
</head>

<?php
	session_start();
	include "../php/dbconnect.php";

	if( isset($_POST['id']) ){
		$selectId = mysql_real_escape_string($_POST['id']);
        $ctr = 1;

        echo "<input type='text' id='edit_job_qualid' value='1' />
        		<label class='control-label' for='edit_job_qual'>* Job Qualification</label><br>";   
		$sql_in = mysql_query("SELECT jq.*, q.Name as QName from job_qualification jq left join qualification q on jq.QualificationID = q.QualificationID where jq.JobID = $selectId order by QName");
       	$row = mysql_num_rows($sql_in);

       		if($row >= 1){
       			?>
       				<div>
       					<script>
       						$(function(){
       							$('#edit_job_qualid').val('');
       						});
       					</script>
       				</div>
       			<?php
       			while ($r = mysql_fetch_assoc($sql_in)){
                  $qualID = mysql_real_escape_string($r['QualificationID']);
                  $qualName = ucwords(mysql_real_escape_string($r['QName']));
                  ?>
                  	<div>
                  		<script>
                  			$(function(){
                  				$('#edit_job_qualid').val($('#edit_job_qualid').val() + <?php echo $ctr?>);
                  			});
                  		</script>
                  	</div>
                  <?php
	                if($ctr <= $row - 1){
						echo "<select id = 'edit_job_qual". $ctr ."' name = 'edit_job_qual". $ctr ."' class= 'form-control' onchange = 'SelectValQual(this.id)' >
								<option value = ". $qualID ." required>". $qualName ."</option>
							</select>
							<button id='edit_job_qual_remove". $ctr ."' style='position:relative;left:100%;top:-35px;' class='btn btn-danger remove-me2' ><span class='glyphicon glyphicon-minus'></span></button><div id='field'></div>";
	          			$ctr++;
	          		}
	          		else{
			       		echo "<select id = 'edit_job_qual". $ctr ."' name = 'edit_job_qual". $ctr ."' class= 'form-control' onchange = 'SelectValQual(this.id)' >
									<option value = ". $qualID ." required>". $qualName ."</option>
							</select>
							<button id='edit_job_qual_btn2' style='position:relative;left:100%;top:-35px;' class='btn btn-success' ><span class='glyphicon glyphicon-plus'></span></button>";
	          		} 
          		} 

       		}
       		else{
       			
       			$sql_in = mysql_query("SELECT * from qualification where Status = 0 order by Name");
       			echo "<select id = 'edit_job_qual1' name = 'edit_job_qual1' class= 'form-control' onchange = 'SelectValQual(this.id)' >
       					<option value = '' selected disabled>-----Select Default Job Qualification-----</option>";
	       			while ($r = mysql_fetch_assoc($sql_in)){
	                  $qualID = mysql_real_escape_string($r['QualificationID']);
	                  $qualName = ucwords(mysql_real_escape_string($r['Name']));

						echo "<option value = ". $qualID ." required>". $qualName ."</option>";
	          		}
          		echo "</select>
          			<button id='edit_job_qual_btn' style='position:relative;left:100%;top:-35px;' class='btn btn-success' ><span class='glyphicon glyphicon-plus'></span></button>";
       		}
          	        
	}

?>