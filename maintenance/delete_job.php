<head>
    <link href="../bootstrap1/css/bootstrap-switch.css" rel="stylesheet">
    <script src="../bootstrap1/js/bootstrap-switch-highlight.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch-main.js"></script>
</head>

<script>
		$(function() {
		$('#table_job').dataTable({
        "columns": [
        null,
        { "width": "8%" },
        { "width": "15%" },
        null,
        null,
        null,
        null,
        { "width": "26%" }
        ]
    });

    $('input[id="switch-state"]').on('switchChange.bootstrapSwitch', function(event, state) {
               
      var id = $(this).val();
      var value = state;

      if(value == true){
          value = 0;
      }
      else{
          value = 1;
      }

     var  dataString = "cid=" + id + "&";
          dataString += "state=" + value + "&";
          dataString += "columnId=" + "JobID" + "&";
          dataString += "columnState=" + "Status" + "&";
          dataString += "table=" + "job_title";
                       
          $.ajax({
              type: "POST",
              url: "switch.php",
              data: dataString,
              cache: false,
              success: function(response){
                $('#changeState_' + id).html(response);
              }
          });
    });

		});
</script>

<table class = "table table-hovered display" id = "table_job">
                                <thead>
                                  <tr>
                                    <th><center>State</center></th>
                                    <th><center>Category</center></th>
                                    <th><center>Job Title</center></th>
                                    <th><center>Service Fee</center></th>
                                    <th><center>Cola</center></th>
                                    <th><center>Min Salary</center></th>
                                    <th><center>Max Salary</center></th>
                                    <th><center>Action</center></th>
                                  </tr> 
                                </thead>
                                <tbody>

<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['id'])){
		
		$jobId = mysql_real_escape_string($_POST['id']);

		$query1 = mysql_query("Update `job_title` Set Status = 3 WHERE JobID = $jobId;");
            if ($query1 == FALSE){
                    die ("Error Program: " . mysql_error());
            }
            else{
              ?>
                <div>
                    <script>
                        $(function(){
                            $("#success-delete-record").show().delay(5000).fadeOut();
                       });
                    </script>
                </div>
              <?php
            }

		$query2 = mysql_query("SELECT j.*, c.Name as CName from job_title j join job_category c on j.CategoryID = c.CategoryID where j.Status != 3");
                                    if ($query2 == FALSE){
                                      die ("Error Program: " . mysql_error());
                                    }

                                    while($res = mysql_fetch_assoc($query2)){
                                        $jobID = $res['JobID'];
                                        $catID = $res['CategoryID'];
                                        $catName = ucwords($res['CName']);
                                        $jobName = ucwords($res['Name']);
                                        $jobSf = $res['Service_fee'];
                                        $jobminSalary = number_format($res['Min_Salary'], 2, '.', ',');
                                        $jobmaxSalary = number_format($res['Max_Salary'], 2, '.', ',');
                                        $jobCola = $res['Cola'];
                                        $jobState = $res['Status'];


                                      if($jobState == 0){
                                          $strstat = "Active";
                                        ?>
                                            <div>
                                                <script>
                                                  $(function(){
                                                      $(document).ready(function(){
                                                        $('input[name=delete_checkbox_<?php echo $jobID;?>]').bootstrapSwitch('state', true, true);
                                                      });
                                                  });
                                                </script>
                                            </div>
                                         <?php
                                      }
                                      else if($jobState == 1){
                                          $strstat = "Inactive";
                                      }

?>

<tr>
                                          <td>
                                            <center>
                                              <?php echo "<div id='changeState_$jobID'>
                                                              $strstat
                                                            </div>"; 
                                              ?>
                                              <?php echo "<input type = 'hidden' id = 'changeid_job_$jobID' value = '$jobID'>"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "$catName"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changecatname_job_$jobID' value = \"$catName\">"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changecatid_job_$jobID' value = '$catID'>"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <font style="font-size:20px;"><?php echo "$jobName"; ?></font>
                                              <?php echo "<input type = 'hidden' id = 'changename_job_$jobID' value = \"$jobName\">"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "$jobSf%"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changesf_job_$jobID' value = \"$jobSf\">"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "$jobCola%"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changecola_job_$jobID' value = \"$jobCola\">"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "P $jobminSalary"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changeminsalary_job_$jobID' value = \"$jobminSalary\">"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "P $jobmaxSalary"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changemaxsalary_job_$jobID' value = \"$jobmaxSalary\">"; ?>
                                            </center>
                                          </td>
                                          
                                          <td>
                                             <center>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-success' id = 'job_$jobID' onclick = 'ChangeJob(this.id);' title='Edit'>
                                                  <span class = 'glyphicon glyphicon-edit' ></span></button>"; 
                                              ?>
                                              <?php 
                                                  echo "<input id='switch-state' name='delete_checkbox_$jobID' type='checkbox' value='$jobID' >";
                                              ?>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-danger' id = 'job_$jobID' onclick = 'DeleteJob(this.id);' title='Delete'>
                                                  <span class = 'glyphicon glyphicon-trash' ></span></button>"; 
                                               ?>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-default' id = 'job_$jobID' onclick = 'ViewJob(this.id);' title='View'>
                                                  <span class = 'glyphicon glyphicon-zoom-in'></span></button>"; 
                                               ?>
                                            </center>
                                          </td>
</tr>

                                  <?php
                                    }
                                  ?>
							</tbody>
</table>
<?php
	}
?>