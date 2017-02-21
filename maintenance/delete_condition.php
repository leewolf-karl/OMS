<head>
    <link href="../bootstrap1/css/bootstrap-switch.css" rel="stylesheet">
    <script src="../bootstrap1/js/bootstrap-switch-highlight.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch-main.js"></script>
</head>

<script>
		$(function() {
		$('#table_condition').dataTable({
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
          dataString += "columnId=" + "ConditionID" + "&";
          dataString += "columnState=" + "Status" + "&";
          dataString += "table=" + "term_and_condition";
                       
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

<table class = "table table-hovered display" id = "table_condition">
                                <thead>
                                  <tr>
                                    <th><center>State</center></th>
                                    <th><center>For</center></th>
                                    <th><center>Description</center></th>
                                    <th><center>Action</center></th>
                                  </tr> 
                                </thead>
                                <tbody>

<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['id'])){
		
		$conId = mysql_real_escape_string($_POST['id']);

		$query1 = mysql_query("Update `term_and_condition` Set Status = 3 WHERE ConditionID = $conId;");
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

		$query2 = mysql_query("Select * from term_and_condition where Status != 3 and Description != ' '");
                                    if ($query2 == FALSE){
                                      die ("Error Program: " . mysql_error());
                                    }

                                    while($res = mysql_fetch_assoc($query2)){
                                        $conID = $res['ConditionID'];
                                        $conType = $res['Type'];
                                        $conDesc = ucfirst($res['Description']);
                                        $conState = $res['Status'];

                                        if($conType == 1)
                                          $strtype = "Agency";
                                        else if ($conType == 0)
                                          $strtype = "Client";
                                        else
                                          $strtype = "Staff";

                                      if($conState == 0){
                                          $strstat = "Active";
                                        ?>
                                            <div>
                                                <script>
                                                  $(function(){
                                                      $(document).ready(function(){
                                                        $('input[name=delete_checkbox_<?php echo $conID;?>]').bootstrapSwitch('state', true, true);
                                                      });
                                                  });
                                                </script>
                                            </div>
                                         <?php
                                      }
                                      else if($conState == 1){
                                          $strstat = "Inactive";
                                      }

?>

<tr>
                                          <td>
                                            <center>
                                              <?php echo "<div id='changeState_$conID'>
                                                              $strstat
                                                            </div>"; 
                                              ?>
                                              <?php echo "<input type = 'hidden' id = 'changeid_con_$conID' value = '$conID'>"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "$strtype"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changestrtype_con_$conID' value = \"$strtype\">"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changetype_con_$conID' value = \"$conType\">"; ?>
                                            </center>
                                          </td>
                                          
                                          <td>
                                             <font style="font-size:20px;"><?php echo "$conDesc"; ?></font>
                                              <?php echo "<input type = 'hidden' id = 'changedesc_con_$conID' value = \"$conDesc\">"; ?>
                                          </td>
                                          
                                          <td>
                                             <center>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-success' id = 'con_$conID' onclick = 'ChangeCondition(this.id);' title='Edit'>
                                                  <span class = 'glyphicon glyphicon-edit' ></span></button>"; 
                                              ?>
                                              <?php 
                                                  echo "<input id='switch-state' name='delete_checkbox_$conID' type='checkbox' value='$conID' >";
                                              ?>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-danger' id = 'con_$conID' onclick = 'DeleteCondition(this.id);' title='Delete'>
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