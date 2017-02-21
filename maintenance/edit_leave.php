<head>
    <link href="../bootstrap1/css/bootstrap-switch.css" rel="stylesheet">
    <script src="../bootstrap1/js/bootstrap-switch-highlight.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch-main.js"></script>
</head>

<script>
		$(function() {
		$('#table_leave').dataTable({
        "columns": [
        null,
        { "width": "40%" },
        { "width": "20%" },
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
          dataString += "columnId=" + "LeaveID" + "&";
          dataString += "columnState=" + "Status" + "&";
          dataString += "table=" + "leave";

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

<table class = "table table-hovered display" id = "table_leave">
                                <thead>
                                  <tr>
                                    <th><center>State</center></th>
                                    <th><center>Name</center></th>
                                    <th><center>Number of Days</center></th>
                                    <th><center>Action</center></th>
                                  </tr> 
                                </thead>
                                <tbody>

<?php
	session_start();
	include "../php/dbconnect.php";

	if(isset($_POST['id'])){
		
		$leaveId = mysql_real_escape_string($_POST['id']);
		$leaveName = strtolower(mysql_real_escape_string($_POST['leavename']));
    $leaveNoday = mysql_real_escape_string($_POST['leavenoday']);


    $check = mysql_query("SELECT * from `leave` where Name = '$leaveName' and NoDay = $leaveNoday");
    $row = mysql_num_rows($check);

    if($row >= 1){

        while($res = mysql_fetch_assoc($check)){
            $leaveId = $res['LeaveID'];
            $leaveState = $res['Status'];
            
              if($leaveState == 3){
                $query1 = mysql_query("Update `leave` Set Status = 1 WHERE LeaveID = $leaveId;");
                ?>
                  <div>
                      <script>
                        $(function(){
                           $("#success-edit-record").show().delay(5000).fadeOut();
                        });
                      </script>
                  </div>
                <?php
              }
              else{
                    ?>
                      <div>
                          <script>
                              $(function(){
                                  $(document).ready(function(){
                                   $("#error-exist").show().delay(5000).fadeOut();
                                  });
                              });
                          </script>
                      </div>
                    <?php
              }
        }
    }
    else{
        $query1 = mysql_query("Update `leave` Set Name = '$leaveName', NoDay = $leaveNoday WHERE LeaveID = $leaveId;");
        ?>
          <div>
              <script>
                  $(function(){
                      $("#success-edit-record").show().delay(5000).fadeOut();
                 });
              </script>
          </div>
        <?php
    }
	
		$query2 = mysql_query("Select * from `leave` where Status != 3 and Name != ' '");
                                    if ($query2 == FALSE){
                                      die ("Error Program: " . mysql_error());
                                    }

                                    while($res = mysql_fetch_assoc($query2)){
                                        $leaveID = $res['LeaveID'];
                                        $leaveName = ucfirst($res['Name']);
                                        $leaveNoday = $res['NoDay'];
                                        $leaveState = $res['Status'];

                                      if($leaveState == 0){
                                          $strstat = "Active";
                                        ?>
                                            <div>
                                                <script>
                                                  $(function(){
                                                      $(document).ready(function(){
                                                        $('input[name=edit_checkbox_<?php echo $leaveID;?>]').bootstrapSwitch('state', true, true);
                                                      });
                                                  });
                                                </script>
                                            </div>
                                         <?php
                                      }
                                      else if($leaveState == 1){
                                          $strstat = "Inactive";
                                      }


?>

<tr>
                                          <td>
                                            <center>
                                              <?php echo "<div id='changeState_$leaveID'>
                                                              $strstat
                                                            </div>"; 
                                              ?>
                                              <?php echo "<input type = 'hidden' id = 'changeid_leave_$leaveID' value = '$leaveID'>"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <font style="font-size:20px;"><?php echo "$leaveName"; ?></font>
                                              <?php echo "<input type = 'hidden' id = 'changename_leave_$leaveID' value = \"$leaveName\">"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "$leaveNoday"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changenoday_leave_$leaveID' value = '$leaveNoday'>"; ?>
                                            </center>
                                          </td>
                                          
                                          <td>
                                             <center>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-success' id = 'leave_$leaveID' onclick = 'ChangeLeave(this.id);' title='Edit'>
                                                  <span class = 'glyphicon glyphicon-edit' ></span></button>"; 
                                              ?>
                                              <?php 
                                                  echo "<input id='switch-state' name='edit_checkbox_$leaveID' type='checkbox' value='$leaveID' >";
                                              ?>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-danger' id = 'leave_$leaveID' onclick = 'DeleteLeave(this.id);' title='Delete'>
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