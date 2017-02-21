<head>
    <link href="../bootstrap1/css/bootstrap-switch.css" rel="stylesheet">
    <script src="../bootstrap1/js/bootstrap-switch-highlight.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch-main.js"></script>
</head>

<script>
		$(function() {
		$('#table_dept').dataTable({
        "columns": [
        null,
        null,
        { "width": "35%" },
        null
        ]
    });
		$.material.init();

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
          dataString += "columnId=" + "DepartmentID" + "&";
          dataString += "columnState=" + "Status" + "&";
          dataString += "table=" + "department";
                       
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

<table class = "table table-hovered display" id = "table_dept">
                                <thead>
                                  <tr>
                                    <th><center>State</center></th>
                                    <th><center>Nature of Business</center></th>
                                    <th><center>Name</center></th>
                                    <th><center>Action</center></th>
                                  </tr> 
                                </thead>
                                <tbody>

<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['id'])){
		
		$deptId = mysql_real_escape_string($_POST['id']);

		$query1 = mysql_query("Update `department` Set Status = 3 WHERE DepartmentID = $deptId;");
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

		$query2 = mysql_query("Select d.*, b.Description from department d join business_nature b on d.BusinessNatureID = b.BusinessNatureID where d.Status != 3 and Name != ' '");
                                    if ($query2 == FALSE){
                                      die ("Error Program: " . mysql_error());
                                    }

                                    while($res = mysql_fetch_assoc($query2)){
                                        $deptID = $res['DepartmentID'];
                                        $busID = $res['BusinessNatureID'];
                                        $busName = ucfirst($res['Description']);
                                        $deptName = ucfirst($res['Name']);
                                        $deptState = $res['Status'];


                                      if($deptState == 0){
                                          $strstat = "Active";
                                        ?>
                                            <div>
                                                <script>
                                                  $(function(){
                                                      $(document).ready(function(){
                                                        $('input[name=delete_checkbox_<?php echo $deptID;?>]').bootstrapSwitch('state', true, true);
                                                      });
                                                  });
                                                </script>
                                            </div>
                                         <?php
                                      }
                                      else if($deptState == 1){
                                          $strstat = "Inactive";
                                      }

?>

<tr>
                                          <td>
                                            <center>
                                              <?php echo "<div id='changeState_$deptID'>
                                                              $strstat
                                                            </div>"; 
                                              ?>
                                              <?php echo "<input type = 'hidden' id = 'changeid_dept_$deptID' value = '$deptID'>"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "$busName"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changebusid_dept_$deptID' value = '$busID'>"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changebusname_dept_$deptID' value = \"$busName\">"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <font style="font-size:20px;"><?php echo "$deptName"; ?></font>
                                              <?php echo "<input type = 'hidden' id = 'changename_dept_$deptID' value = \"$deptName\">"; ?>
                                            </center>
                                          </td>
                                          
                                          <td>
                                             <center>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-success' id = 'dept_$deptID' onclick = 'ChangeDept(this.id);' title='Edit'>
                                                  <span class = 'glyphicon glyphicon-edit' ></span></button>"; 
                                              ?>
                                              <?php 
                                                  echo "<input id='switch-state' name='delete_checkbox_$deptID' type='checkbox' value='$deptID' >";
                                              ?>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-danger' id = 'dept_$deptID' onclick = 'DeleteDept(this.id);' title='Delete'>
                                                  <span class = 'glyphicon glyphicon-trash' ></span></button>"; 
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