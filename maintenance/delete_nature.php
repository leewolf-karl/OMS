<head>
    <link href="../bootstrap1/css/bootstrap-switch.css" rel="stylesheet">
    <script src="../bootstrap1/js/bootstrap-switch-highlight.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch-main.js"></script>
</head>

<script>
		$(function() {
		$('#table_nature').dataTable({
        "columns": [
        null,
        { "width": "65%" },
        null
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
          dataString += "columnId=" + "BusinessNatureID" + "&";
          dataString += "columnState=" + "Status" + "&";
          dataString += "table=" + "business_nature";
                       
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

<table class = "table table-hovered display" id = "table_nature">
                                <thead>
                                  <tr>
                                    <th><center>State</center></th>
                                    <th><center>Nature of Business Name</center></th>
                                    <th><center>Action</center></th>
                                  </tr> 
                                </thead>
                                <tbody>

<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['id'])){
		
		$natureId = mysql_real_escape_string($_POST['id']);

		$query1 = mysql_query("Update `business_nature` Set Status = 3 WHERE BusinessNatureID = $natureId;");
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

		$query2 = mysql_query("SELECT * from business_nature where Status != 3");
                                    if ($query2 == FALSE){
                                      die ("Error Program: " . mysql_error());
                                    }

                                    while($res = mysql_fetch_assoc($query2)){
                                        $natureID = $res['BusinessNatureID'];
                                        $natureDesc = ucwords($res['Name']);
                                        $natureState = $res['Status'];


                                      if($natureState == 0){
                                          $strstat = "Active";
                                        ?>
                                            <div>
                                                <script>
                                                  $(function(){
                                                      $(document).ready(function(){
                                                        $('input[name=delete_checkbox_<?php echo $natureID;?>]').bootstrapSwitch('state', true, true);
                                                      });
                                                  });
                                                </script>
                                            </div>
                                         <?php
                                      }
                                      else{
                                          $strstat = "Inactive";
                                      }

?>

<tr>
                                          <td>
                                            <center>
                                              <?php echo "<div id='changeState_$natureID'>
                                                              $strstat
                                                            </div>"; 
                                              ?>
                                              <?php echo "<input type = 'hidden' id = 'changeid_nature_$natureID' value = '$natureID'>"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <font style="font-size:20px;"><?php echo "$natureDesc"; ?></font>
                                              <?php echo "<input type = 'hidden' id = 'changedesc_nature_$natureID' value = \"$natureDesc\">"; ?>
                                            </center>
                                          </td>
                                          
                                          <td>
                                             <center>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-success' id = 'nature_$natureID' onclick = 'ChangeNature(this.id);' title='Edit'>
                                                  <span class = 'glyphicon glyphicon-edit' ></span></button>"; 
                                              ?>
                                              <?php 
                                                  echo "<input id='switch-state' name='delete_checkbox_$natureID' type='checkbox' value='$natureID' >";
                                              ?>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-danger' id = 'nature_$natureID' onclick = 'DeleteNature(this.id);' title='Delete'>
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