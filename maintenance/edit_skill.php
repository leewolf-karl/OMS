<head>
    <link href="../bootstrap1/css/bootstrap-switch.css" rel="stylesheet">
    <script src="../bootstrap1/js/bootstrap-switch-highlight.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch-main.js"></script>
</head>

<script>
		$(function() {
		$('#table_skill').dataTable({
        "columns": [
        null,
        { "width": "30%" },
        { "width": "35%" },
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
          dataString += "columnId=" + "SkillID" + "&";
          dataString += "columnState=" + "Status" + "&";
          dataString += "table=" + "skill";

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

<table class = "table table-hovered display" id = "table_skill">
                                <thead>
                                  <tr>
                                    <th><center>State</center></th>
                                    <th><center>Specialization Name</center></th>
                                    <th><center>Skill Name</center></th>
                                    <th><center>Action</center></th>
                                  </tr> 
                                </thead>
                                <tbody>

<?php
	session_start();
	include "../php/dbconnect.php";

	if((isset($_POST['id']) and isset($_POST['speid'])) and isset($_POST['skillname'])){
		
		$skillId = mysql_real_escape_string($_POST['id']);
    $speId = mysql_real_escape_string($_POST['speid']);
		$skillName = strtolower(mysql_real_escape_string($_POST['skillname']));


    $check = mysql_query("SELECT * from `skill` where Name = '$skillName' and SpecializationID = $speId");
    $row = mysql_num_rows($check);

    if($row >= 1){

        while($res = mysql_fetch_assoc($check)){
            $skillId = $res['SkillID'];
            $skillState = $res['Status'];
            
              if($skillState == 3){
                $query1 = mysql_query("Update `skill` Set Status = 1 WHERE SkillID = $skillId;");
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
        $query1 = mysql_query("Update `skill` Set Name = '$skillName', SpecializationID = $speId WHERE SkillID = $skillId;");
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
	
		$query2 = mysql_query("SELECT sk.*, sp.Name as SName from skill sk join specialization sp on sk.SpecializationID = sp.SpecializationID where sk.Status != 3");
                                    if ($query2 == FALSE){
                                      die ("Error Program: " . mysql_error());
                                    }

                                    while($res = mysql_fetch_assoc($query2)){
                                        $skillID = $res['SkillID'];
                                        $speID = $res['SpecializationID'];
                                        $skillName = ucwords($res['Name']);
                                        $speName = ucwords($res['SName']);
                                        $skillState = $res['Status'];

                                      if($skillState == 0){
                                          $strstat = "Active";
                                        ?>
                                            <div>
                                                <script>
                                                  $(function(){
                                                      $(document).ready(function(){
                                                        $('input[name=edit_checkbox_<?php echo $skillID;?>]').bootstrapSwitch('state', true, true);
                                                      });
                                                  });
                                                </script>
                                            </div>
                                         <?php
                                      }
                                      else if($skillState == 1){
                                          $strstat = "Inactive";
                                      }


?>

<tr>
                                          <td>
                                            <center>
                                              <?php echo "<div id='changeState_$skillID'>
                                                              $strstat
                                                            </div>"; 
                                              ?>
                                              <?php echo "<input type = 'hidden' id = 'changeid_skill_$skillID' value = '$skillID'>"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "$speName"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changespeid_skill_$skillID' value = '$speID'>"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changespename_skill_$skillID' value = \"$speName\">"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <font style="font-size:20px;"><?php echo "$skillName"; ?></font>
                                              <?php echo "<input type = 'hidden' id = 'changename_skill_$skillID' value = \"$skillName\">"; ?>
                                            </center>
                                          </td>
                                          
                                          
                                          <td>
                                             <center>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-success' id = 'skill_$skillID' onclick = 'ChangeSkill(this.id);' title='Edit'>
                                                  <span class = 'glyphicon glyphicon-edit' ></span></button>"; 
                                              ?>
                                              <?php 
                                                  echo "<input id='switch-state' name='edit_checkbox_$skillID' type='checkbox' value='$skillID' >";
                                              ?>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-danger' id = 'skill_$skillID' onclick = 'DeleteSkill(this.id);' title='Delete'>
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