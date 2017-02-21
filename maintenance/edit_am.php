<head>
    <link href="../bootstrap1/css/bootstrap-switch.css" rel="stylesheet">
    <script src="../bootstrap1/js/bootstrap-switch-highlight.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch-main.js"></script>
</head>

<script>
		$(function() {
		$('#table_am').dataTable({
        "columns": [
        null,
        { "width": "10%" },
        { "width": "15%" },
        { "width": "10%" },
        { "width": "10%" },
        { "width": "10%" },
        null,
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
          dataString += "columnId=" + "UserID" + "&";
          dataString += "columnState=" + "Status" + "&";
          dataString += "table=" + "user_admin";

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

<table class = "table table-hovered display" id = "table_am">
                                <thead>
                                  <tr>
                                    <th><center>State</center></th>
                                    <th><center>Image</center></th>
                                    <th><center>Name</center></th>
                                    <th><center>Address</center></th>
                                    <th><center>Username</center></th>
                                    <th><center>Password</center></th>
                                    <th><center>Role Name</center></th>
                                    <th><center>Action</center></th>
                                  </tr> 
                                </thead>
                                <tbody>

<?php
	session_start();
	include "../php/dbconnect.php";

	if(isset($_POST['id'])){
		
		$amId = mysql_real_escape_string($_POST['id']);
    $amRoleID = mysql_real_escape_string($_POST['amroleid']);
		$amImg = mysql_real_escape_string($_POST['amimg']);
    $amFname = strtolower(mysql_real_escape_string($_POST['amfname']));
    $amMname = strtolower(mysql_real_escape_string($_POST['ammname']));
    $amLname = strtolower(mysql_real_escape_string($_POST['amlname']));
    $amAddress = strtolower(mysql_real_escape_string($_POST['amaddress']));
    $amUser = strtolower(mysql_real_escape_string($_POST['amuser']));
    $amPass = mysql_real_escape_string($_POST['ampass']);

    $check1 = mysql_query("SELECT * from `user_admin` where Username = '$amUser'");
    $check2 = mysql_query("SELECT * from `user_admin` where (FName = '$amFname' and Address = '$amAddress') and (MName = '$amMname' and LName = '$amLname' ) and (Picture = '$amImg' and RoleID = $amRoleID)");
    
    $row1 = mysql_num_rows($check1);
    $row2 = mysql_num_rows($check2);

    if($row1 >= 1){
          if($row2 >= 1){
            while($res = mysql_fetch_assoc($check1)){
              $amId = $res['UserID'];
              $amState = $res['Status'];
              
                if($amState == 3){
                  $query1 = mysql_query("Update `user_admin` Set Status = 1 WHERE UserID = $amId;");
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
          $query1 = mysql_query("Update `user_admin` Set FName = '$amFname', MName = '$amMname', LName = '$amLname', Address = '$amAddress', Picture = '$amImg', RoleID = $amRoleID WHERE UserID = $amId;");
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
    }
    else{
        $query1 = mysql_query("Update `user_admin` Set Username = '$amUser', Password = '$amPass' WHERE UserID = $amId;");
       
        ?>
          <div>
              <script>
                  $(function(){
                      $("#success-edit-record").show().delay(5000).fadeOut();
                 });
              </script>
          </div>
        <?php

        if($row2 >= 1){
            while($res = mysql_fetch_assoc($check1)){
              $amId = $res['UserID'];
              $amState = $res['Status'];

              
                if($amState == 3){
                  $query1 = mysql_query("Update `user_admin` Set Status = 1 WHERE UserID = $amId;");
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
          $query1 = mysql_query("Update `user_admin` Set FName = '$amFname', MName = '$amMname', LName = '$amLname', Picture = '$amImg', RoleID = $amRoleID WHERE UserID = $amId;");
        }

    }
	
		$query2 = mysql_query("Select a.*, r.Name as RName from user_admin a join user_role r on a.RoleID = r.RoleID where a.Status != 3");
                                    if ($query2 == FALSE){
                                      die ("Error Program: " . mysql_error());
                                    }

                                    while($res = mysql_fetch_assoc($query2)){
                                        $aID = $res['UserID'];
                                        $aFName = ucwords($res['FName']);
                                        $aMName = str_replace('N/a','',ucwords($res['MName']));
                                        $aLName = ucwords($res['LName']);
                                        $aUser = ucfirst($res['Username']);
                                        $aAddress = ucfirst($res['Address']);
                                        $imgLoc = $res['Picture'];
                                        $aPassLen = strlen($res['Password']);
                                        $aPassword = $res['Password'];
                                        $roleId = $res['RoleID'];
                                        $roleName = ucwords($res['RName']);
                                        $aState = $res['Status'];
                                        $aPass = '';

                                        for($i=0;$i<$aPassLen;$i++){
                                          $aPass .= '•';
                                        }

                                      if($aState == 0){
                                          $strstat = "Active";
                                        ?>
                                            <div>
                                                <script>
                                                  $(function(){
                                                      $(document).ready(function(){
                                                        $('input[name=edit_checkbox_<?php echo $aID;?>]').bootstrapSwitch('state', true, true);
                                                      });
                                                  });
                                                </script>
                                            </div>
                                         <?php
                                      }
                                      else if($aState == 1){
                                          $strstat = "Inactive";
                                      }


?>

<tr>
                                          <td>
                                            <center>
                                              <?php echo "<div id='changeState_$aID'>
                                                              $strstat
                                                            </div>"; 
                                              ?>
                                              <?php echo "<input type = 'hidden' id = 'changeid_a_$aID' value = '$aID'>"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <img style="width:90px;height:80px;" src = <?php echo $imgLoc; ?> >
                                              <?php echo "<input type = 'hidden' id = 'changeimg_a_$aID' value = \"$imgLoc\">"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <font style="font-size:20px;"><?php echo "$aLName"; ?>, <?php echo "$aFName"; ?> <?php echo "$aMName"; ?></font>
                                              <?php echo "<input type = 'hidden' id = 'changefname_a_$aID' value = \"$aFName\">"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changemname_a_$aID' value = \"$aMName\">"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changelname_a_$aID' value = \"$aLName\">"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "$aAddress"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changeaddress_a_$aID' value = \"$aAddress\">"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "$aUser"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changeauser_a_$aID' value = \"$aUser\">"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "$aPass"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changepasslen_a_$aID' value = \"$aPass\">"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changepass_a_$aID' value = \"$aPassword\">"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "$roleName"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changerolename_a_$aID' value = \"$roleName\">"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changeroleid_a_$aID' value = '$roleId'>"; ?>
                                            </center>
                                          </td>
                                          
                                          <td>
                                             <center>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-success' id = 'a_$aID' onclick = 'ChangeAM(this.id);' title='Edit'>
                                                  <span class = 'glyphicon glyphicon-edit' ></span></button>"; 
                                              ?>
                                              <?php 
                                                  echo "<input id='switch-state' name='edit_checkbox_$aID' type='checkbox' value='$aID' >";
                                              ?>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-danger' id = 'a_$aID' onclick = 'DeleteAM(this.id);' title='Delete'>
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