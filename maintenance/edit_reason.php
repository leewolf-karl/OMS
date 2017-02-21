<head>
    <link href="../bootstrap1/css/bootstrap-switch.css" rel="stylesheet">
    <script src="../bootstrap1/js/bootstrap-switch-highlight.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch-main.js"></script>
</head>

<script>
		$(function() {
		$('#table_reason').dataTable({
        "columns": [
        null,
        { "width": "65%" },
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
          dataString += "columnId=" + "ReasonID" + "&";
          dataString += "columnState=" + "Status" + "&";
          dataString += "table=" + "valid_reason";

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

<table class = "table table-hovered display" id = "table_reason">
                                <thead>
                                  <tr>
                                    <th><center>State</center></th>
                                    <th><center>Name</center></th>
                                    <th><center>Action</center></th>
                                  </tr> 
                                </thead>
                                <tbody>

<?php
	session_start();
	include "../php/dbconnect.php";

	if(isset($_POST['id'])){
		
		$reasonId = mysql_real_escape_string($_POST['id']);
		$reasonName = strtolower(mysql_real_escape_string($_POST['reasname']));


    $check = mysql_query("SELECT * from `valid_reason` where Name = '$reasonName'");
    $row = mysql_num_rows($check);

    if($row >= 1){

        while($res = mysql_fetch_assoc($check)){
            $reasonId = $res['ReasonID'];
            $reasonState = $res['Status'];
            
              if($reasonState == 3){
                $query1 = mysql_query("Update `valid_reason` Set Status = 1 WHERE ReasonID = $reasonId;");
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
        $query1 = mysql_query("Update `valid_reason` Set Name = '$reasonName' WHERE ReasonID = $reasonId;");
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
	
		$query2 = mysql_query("Select * from `valid_reason` where Status != 3 and Name != ' '");
                                    if ($query2 == FALSE){
                                      die ("Error Program: " . mysql_error());
                                    }

                                    while($res = mysql_fetch_assoc($query2)){
                                        $reasonID = $res['ReasonID'];
                                        $reasonName = ucfirst($res['Name']);
                                        $reasonState = $res['Status'];

                                      if($reasonState == 0){
                                          $strstat = "Active";
                                        ?>
                                            <div>
                                                <script>
                                                  $(function(){
                                                      $(document).ready(function(){
                                                        $('input[name=edit_checkbox_<?php echo $reasonID;?>]').bootstrapSwitch('state', true, true);
                                                      });
                                                  });
                                                </script>
                                            </div>
                                         <?php
                                      }
                                      else if($reasonState == 1){
                                          $strstat = "Inactive";
                                      }


?>

<tr>
                                          <td>
                                            <center>
                                              <?php echo "<div id='changeState_$reasonID'>
                                                              $strstat
                                                            </div>"; 
                                              ?>
                                              <?php echo "<input type = 'hidden' id = 'changeid_reas_$reasonID' value = '$reasonID'>"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <font style="font-size:20px;"><?php echo "$reasonName"; ?></font>
                                              <?php echo "<input type = 'hidden' id = 'changename_reas_$reasonID' value = \"$reasonName\">"; ?>
                                            </center>
                                          </td>
                                          
                                          <td>
                                             <center>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-success' id = 'reas_$reasonID' onclick = 'ChangeReason(this.id);' title='Edit'>
                                                  <span class = 'glyphicon glyphicon-edit' ></span></button>"; 
                                              ?>
                                              <?php 
                                                  echo "<input id='switch-state' name='edit_checkbox_$reasonID' type='checkbox' value='$reasonID' >";
                                              ?>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-danger' id = 'reas_$reasonID' onclick = 'DeleteReason(this.id);' title='Delete'>
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