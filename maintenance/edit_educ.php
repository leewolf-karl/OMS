<head>
    <link href="../bootstrap1/css/bootstrap-switch.css" rel="stylesheet">
    <script src="../bootstrap1/js/bootstrap-switch-highlight.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch-main.js"></script>
</head>

<script>
		$(function() {
		$('#table_educ').dataTable({
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
          dataString += "columnId=" + "EducationID" + "&";
          dataString += "columnState=" + "Status" + "&";
          dataString += "table=" + "education";

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


<table class = "table table-hovered display" id = "table_educ">
                                <thead>
                                  <tr>
                                    <th><center>State</center></th>
                                    <th><center>Educational Attainment Name</center></th>
                                    <th><center>Action</center></th>
                                  </tr> 
                                </thead>
                                <tbody>

<?php
	session_start();
	include "../php/dbconnect.php";

	if(isset($_POST['id'])){
		
		$educId = mysql_real_escape_string($_POST['id']);
		$educName = strtolower(mysql_real_escape_string($_POST['educname']));


    $check = mysql_query("SELECT * from `education` where Name = '$educName'");
    $row = mysql_num_rows($check);

    if($row >= 1){
       
          while($res = mysql_fetch_assoc($check)){
            $educId = $res['EducationID'];
            $educState = $res['Status'];
            
              if($educState == 3){
                $query1 = mysql_query("Update `education` Set Status = 1 WHERE EducationID = $educId;");
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
        $query1 = mysql_query("Update `education` Set Name = '$educName' WHERE EducationID = $educId;");
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
	
		$query2 = mysql_query("SELECT * from education where Status != 3");
                                    if ($query2 == FALSE){
                                      die ("Error Program: " . mysql_error());
                                    }

                                    while($res = mysql_fetch_assoc($query2)){
                                        $educID = $res['EducationID'];
                                        $educName = ucwords($res['Name']);
                                        $educState = $res['Status'];

                                      if($educState == 0){
                                          $strstat = "Active";
                                        ?>
                                            <div>
                                                <script>
                                                  $(function(){
                                                      $(document).ready(function(){
                                                        $('input[name=edit_checkbox_<?php echo $educID;?>]').bootstrapSwitch('state', true, true);
                                                      });
                                                  });
                                                </script>
                                            </div>
                                         <?php
                                      }
                                      else if($educState == 1){
                                          $strstat = "Inactive";
                                      }


?>

<tr>
                                          <td>
                                            <center>
                                              <?php echo "<div id='changeState_$educID'>
                                                              $strstat
                                                            </div>"; 
                                              ?>
                                              <?php echo "<input type = 'hidden' id = 'changeid_educ_$educID' value = '$educID'>"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <font style="font-size:20px;"><?php echo "$educName"; ?></font>
                                              <?php echo "<input type = 'hidden' id = 'changename_educ_$educID' value = \"$educName\">"; ?>
                                            </center>
                                          </td>
                                          
                                          <td>
                                             <center>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-success' id = 'educ_$educID' onclick = 'ChangeEducation(this.id);' title='Edit'>
                                                  <span class = 'glyphicon glyphicon-edit' ></span></button>"; 
                                              ?>
                                              <?php 
                                                  echo "<input id='switch-state' name='edit_checkbox_$educID' type='checkbox' value='$educID' >";
                                              ?>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-danger' id = 'educ_$educID' onclick = 'DeleteEducation(this.id);' title='Delete'>
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