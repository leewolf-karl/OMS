<head>
    <link href="../bootstrap1/css/bootstrap-switch.css" rel="stylesheet">
    <script src="../bootstrap1/js/bootstrap-switch-highlight.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch-main.js"></script>
</head>

<script>
		$(function() {
		$('#table_qual').dataTable({
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
          dataString += "columnId=" + "QualificationID" + "&";
          dataString += "columnState=" + "Status" + "&";
          dataString += "table=" + "qualification";
                       
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

<table class = "table table-hovered display" id = "table_qual">
                                <thead>
                                  <tr>
                                    <th><center>State</center></th>
                                    <th><center>Qualification Name</center></th>
                                    <th><center>Action</center></th>
                                  </tr> 
                                </thead>
                                <tbody>

<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['id'])){
		
		$qualId = mysql_real_escape_string($_POST['id']);

		$query1 = mysql_query("Update `qualification` Set Status = 3 WHERE QualificationID = $qualId;");
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

		$query2 = mysql_query("SELECT * from qualification where Status != 3");
                                    if ($query2 == FALSE){
                                      die ("Error Program: " . mysql_error());
                                    }

                                    while($res = mysql_fetch_assoc($query2)){
                                        $qualID = $res['QualificationID'];
                                        $qualName = ucwords($res['Name']);
                                        $qualState = $res['Status'];


                                      if($qualState == 0){
                                          $strstat = "Active";
                                        ?>
                                            <div>
                                                <script>
                                                  $(function(){
                                                      $(document).ready(function(){
                                                        $('input[name=delete_checkbox_<?php echo $qualID;?>]').bootstrapSwitch('state', true, true);
                                                      });
                                                  });
                                                </script>
                                            </div>
                                         <?php
                                      }
                                      else if($qualState == 1){
                                          $strstat = "Inactive";
                                      }

?>

<tr>
                                          <td>
                                            <center>
                                              <?php echo "<div id='changeState_$qualID'>
                                                              $strstat
                                                            </div>"; 
                                              ?>
                                              <?php echo "<input type = 'hidden' id = 'changeid_qual_$qualID' value = '$qualID'>"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <font style="font-size:20px;"><?php echo "$qualName"; ?></font>
                                              <?php echo "<input type = 'hidden' id = 'changename_qual_$qualID' value = \"$qualName\">"; ?>
                                            </center>
                                          </td>
                                          
                                          <td>
                                             <center>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-success' id = 'qual_$qualID' onclick = 'ChangeQualification(this.id);' title='Edit'>
                                                  <span class = 'glyphicon glyphicon-edit' ></span></button>"; 
                                              ?>
                                              <?php 
                                                  echo "<input id='switch-state' name='delete_checkbox_$qualID' type='checkbox' value='$qualID' >";
                                              ?>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-danger' id = 'qual_$qualID' onclick = 'DeleteQualification(this.id);' title='Delete'>
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