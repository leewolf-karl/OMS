<?php
  session_start();
  include "../php/dbconnect.php";
  //insert validation here
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Capstone">
    <meta name="author" content="Leewolf">

    <title>Admin | Skill</title>

    <link href="../bootstrap1/css/bootstrap.css" rel="stylesheet">
    <link href="../bootstrap1/css/dataTables.bootstrap.css" rel="stylesheet" media="screen">

    <link href="../bootstrap1/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap1/css/sb-admin.css" rel="stylesheet">

    <link href="../css/main.css" rel="stylesheet">
    <link href="../semantic/out/semantic.css" rel="stylesheet">

    <link href="../bootstrap1/css/custom_bootstrap_animation.css" rel="stylesheet">
    <link href="../bootstrap1/css/bootstrap-switch.css" rel="stylesheet">
   
    <script src="../bootstrap1/js/jquery-1.11.3.js"></script>
    <script src="../bootstrap1/js/bootstrap.min.js"></script>

    <script src="../bootstrap1/js/jquery.dataTables.js"></script>
    <script src="../bootstrap1/js/dataTables.bootstrap.js"></script>

    <script src="../bootstrap1/js/bootstrap-switch-highlight.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch.js"></script>

    <script src="../bootstrap1/js/bootstrap-switch-main.js"></script>


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

                    var dataString = "cid=" + id + "&";
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

              
                $('#form_add_skill').on("submit" , function(e){

                  var skillName = $('#new_skill_name').val();
                  var speId = $('#new_skill_speid').val();

                      if(checker(skillName, isAlpha) == false){
                            var dataString = "speid=" + speId + '&';
                                dataString += "skillname=" + skillName;
                                 
                                $.ajax({
                                    type: "POST",
                                    url: "add_skill.php",
                                    data: dataString,
                                    cache: false,
                                    success: function(response){
                                        if(response.trim() == "inserted"){
                                            $("#success-add-record").show().delay(5000).fadeOut();
                                            window.setTimeout(function(){location.reload()},500);
                                        }
                                        else if(response.trim() == "exist"){
                                            $("#error-exist").show().delay(5000).fadeOut();
                                        }
                                        $("#add_skill").modal('hide');
                                    }
                                   });
 
                      }
                      else{
                          $("#add_skill").modal('hide');
                          $("#error-mess").show().delay(5000).fadeOut();
                      }
                return false;
                });

                

        //insert edit ajax
                $('#form_edit_skill').on("submit" , function(e){
                   
                    var id = $('#changing_id').text();
                    var speId = $('#edit_skill_speid').val();
                    var skillName = $('#edit_skill_name').val();

                      if(checker(skillName, isAlpha) == false){
                            var dataString = "id=" + id + "&";
                                dataString += "speid=" + speId + "&";
                                dataString += "skillname=" + skillName;

                                $.ajax({
                                    type: "POST",
                                    url: "edit_skill.php",
                                    data: dataString,
                                    cache: false,
                                    success: function(response){
                                        $('#skill_list').html(response);
                                        $("#edit_skill").modal('hide');
                                    }
                                });
                      }
                      else{
                          $("#edit_skill").modal('hide');
                          $("#error-mess").show().delay(5000).fadeOut();
                      }
                return false;
                });

          //delete ajax
                $('#form_delete_skill').on("submit" , function(e){
                   
                  var id = $('#delete_id').text();
                  var dataString = "id=" + id;
                    
                    $.ajax({
                      type: "POST",
                      url: "delete_skill.php",
                      data: dataString,
                      cache: false,
                      success: function(response){
                      $("#delete_skill").modal('hide');
                      $('#skill_list').html(response);

                      }
                    });
                  
                return false;
                });
       });
             
              function checker(str, fn){
                  var hasError = false;
                  var containNum = false;
                      while(containNum == false){
                        for(var i=0;i<str.length;i++){
                              if(str[0] == ' '){
                                containNum = true;
                                hasError = true;
                              }
                              else if(fn(str[i]) == false){
                                    containNum = true;
                                    hasError = true;
                              }
                        }
                      containNum = true;
                  }
                  return hasError;
              }

              
              function isAlpha(str){
                          return /[a-zA-Z-#' ]+$/.test(str);
              }

              function ChangeSkill(skillID){

                    $('#changing_id').text($('#changeid_' + skillID).val());
                    $('#edit_skill_speid').val($('#changespeid_' + skillID).val());
                    $('#edit_skill_name').val($('#changename_' + skillID).val());
                    $('#edit_skill').modal('show');  
              }

              function DeleteSkill(skillID){
                
                    $('#delete_id').text($('#changeid_' + skillID).val());
                    $('#delete_skill_spename').text($('#changespename_' + skillID).val());
                    $('#delete_skill_name').text($('#changename_' + skillID).val());
                    $('#delete_skill').modal('show');
              }

      </script>


</head>

<body>
    
<?php
  include "../Navigation/nav_maintenance.php";
?>
        <br><br><br><br>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-13">
                      <div class = "panel panel-primary" style='border-radius:0px;'>
                            <div class = "panel-heading" >
                              <div class = "slideanim slideright">
                                  <span class = "panel-title" style = "line-height:2;border-bottom-color:black;">
                                        <span style = "font-size:30px;" class = "slideanim slidetop" title = "Abilities of a potential applicant"> Manage Skill
                                        </span>
                                        <span style="position:relative;margin-left:16%;top:15px;font-size:15px;">*This page will let you to manage agency's Skill.
                                        </span> 
                                        <span class = "pull-right" style='position:relative;top:40px;'><a href = "#" data-toggle = "modal" data-target = "#add_skill" class = "btn btn-raised btn-success"> <span class = "glyphicon glyphicon-plus"></span> Add New</a> 
                                        </span>
                                    </span>
                                  
                              </div>
                            </div>

                            
                            <div id = "error-mess" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You entered a not acceptable keys.
                                </panel>
                            </div>
                            <div id = "error-exist" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Data already exist.
                                </panel>
                            </div>
                            <div id = "success-add-record" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:rgb(64,183,47);"><span class="glyphicon glyphicon-ok" style = \"font-size:2em;color:rgba(0,0,0,0.8);\"></span> Good Job. Data Inserted.
                                </panel>
                            </div>
                            <div id = "success-edit-record" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:blue;"><span class="glyphicon glyphicon-ok" style = \"font-size:2em;color:rgba(0,0,0,0.8);\"></span> Good Job. Data Edited.
                                </panel>
                            </div>
                            <div id = "success-delete-record" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:rgb(199,102,31);"><span class="glyphicon glyphicon-ok" style = \"font-size:2em;color:rgba(0,0,0,0.8);\"></span> Good Job. Data Deleted.
                                </panel>
                            </div>

                            <div class = "panel-body" id = "skill_list">
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

                                      $query = mysql_query("SELECT sk.*, sp.Name as SName from skill sk join specialization sp on sk.SpecializationID = sp.SpecializationID where sk.Status != 3");
                                      
                                      while($res = mysql_fetch_assoc($query)){
                                        $skillID = $res['SkillID'];
                                        $speID = $res['SpecializationID'];
                                        $skillName = ucwords($res['Name']);
                                        $speName = ucwords($res['SName']);
                                        $skillState = $res['Status'];

                                        if($skillState == 0){
                                          $strstat = "Active";
                                          echo "<script>
                                                  $(function(){
                                                    $(document).ready(function(){
                                                      $('input[name=my_checkbox_$skillID]').bootstrapSwitch('state', true, true);
                                                    })
                                                      
                                                  });
                                                    </script>";
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
                                                  echo "<input id='switch-state' name='my_checkbox_$skillID' type='checkbox' value='$skillID' >";
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
                            </div>
                      </div>
                </div> 
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<div id="delete_skill" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_delete_skill">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-trash" style="margin-right:10px;"></span>Delete message </h2>
                    </div>

                    <div style = "margin-left:10%;margin-top:10px;margin-bottom:10px;">
                        <br><br>
                        
                          <div class="form-group" readonly>
                              <div class="col-xs-10">
                                  <font style="font-size:18px;">You are about to delete the following record on the list.<br>
                                    By clicking the delete button you will delete.. <br><br>Skill ID: <font style="color:red;margin-left:6%;"><span id ="delete_id"></span></font>
                                    <br>Specialization Name: <font style="color:red;margin-left:1%;"><span id ="delete_skill_spename"></span></font>
                                    <br>Skill Name: <font style="color:red;margin-left:1%;"><span id ="delete_skill_name"></span></font>
                                    <br><br>You can recover it in the system's archieve.
                                  </font>
                              </div>
                          </div>

                          
                      </div>
              
                   <div class="modal-footer">

                      <input type="submit" class="btn btn-success" value="Delete" name="submit"/>
                      <button type="reset" class="btn btn-danger" data-dismiss="modal"><span class = 'glyphicon glyphicon-remove' style="margin-right:10px;"></span>Cancel</button>
                      
                    </div>
          
  
         </form>
    </div>
  </div>
</div>


 <!-- edit department-->
<div id="edit_skill" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_edit_skill">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-edit" style="margin-right:10px;"></span>Edit Skill </h2>
                    </div>

                    <div style = "margin-left:10%;margin-bottom:10px;">
                        <br><br>
                        
                          <div class="form-group" readonly>
                              <div class="col-xs-10">
                                  <label for = "edit_skill_id">Skill ID: <span id ="changing_id"></span></label>
                              </div>
                          </div>

                          <div class="form-group">
                            <div class="col-xs-10">
                                <label for = "edit_skill_speid">
                                      * Specialization
                                </label>
                                <select id = 'edit_skill_speid' class= "form-control" required>
                                              <?php 
                                                
                                                    $sql_in= mysql_query("SELECT * from specialization where Status = 0 order by Name");
                                                    
                                                   
                                                    while ($r = mysql_fetch_assoc($sql_in)){
                                                      $speID = mysql_real_escape_string($r['SpecializationID']);
                                                      $speName = ucwords(mysql_real_escape_string($r['Name']));

                                              ?>
                                                  <option value = <?php echo $speID; ?>  required><?php echo $speName; ?></option>
                                              <?php
                                                }
                                              ?>
                                </select>
                                <br>
                                <label for = "edit_skill_name">
                                  * Skill Name
                                </label>
                                <input type='text' maxlength='70' id = "edit_skill_name" class = "form-control" placeholder = "Enter Skill Name" required>
                            </div>
                          </div>

                  
                      </div>
              
                   <div class="modal-footer">

                      <input type="submit" class="btn btn-success" value="Edit" name="submit" />
                      <button type="reset" class="btn btn-danger" data-dismiss="modal"><span class = 'glyphicon glyphicon-remove' style="margin-right:10px;"></span>Cancel</button>
                      
                       
                    </div>
          
  
         </form>
    </div>
  </div>
</div>

<!-- add department-->

<div id="add_skill" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_add_skill">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="fa fa-fw fa-wpforms" style="margin-right:10px;"></span>Add New Skill </h2>
                    </div>
                    <div class="modal-body">
                        <div style = "margin-left:10%;margin-bottom:10px;">
                            <br><br>
                            
                              <div class="form-group" readonly>
                                  <div class="col-xs-10">
                                      <label for = "new_skill_id" style='font-size:15px;'>
                                        Skill ID: 
                                      </label>

                                          <?php
                                            $sql_in= mysql_query("Select * from skill");
                                            $row = mysql_num_rows($sql_in);
                                            $row += 1;
                                            
                                          ?>
                                          
                                          <span style='font-weight:bold;margin-left:2%;'><?php echo $row;?></span>
                                          
                                  </div>
                              </div>

                              <div class="form-group">
                                <div class="col-xs-10">
                                    <label for = "new_skill_speid">
                                      * Specialization
                                    </label>
                                    <select id = 'new_skill_speid' class= "form-control" required>
                                              <option value = "" selected disabled>--- Select Specialization ---</option>
                                              <?php 
                                                
                                                    $sql_in= mysql_query("SELECT * from specialization where Status = 0 order by Name");
                                                    
                                                   
                                                    while ($r = mysql_fetch_assoc($sql_in)){
                                                      $speID = mysql_real_escape_string($r['SpecializationID']);
                                                      $speName = ucwords(mysql_real_escape_string($r['Name']));

                                              ?>
                                                  <option value = <?php echo $speID; ?>  required><?php echo $speName; ?></option>
                                              <?php
                                                }
                                              ?>
                                    </select>
                                    <br>
                                    <label for = "new_skill_name">
                                      * Skill Name
                                    </label>
                                    <input type='text' maxlength='70' id = "new_skill_name" class = "form-control" placeholder = "Enter Skill Name" required>
                                </div>
                              </div>

                          </div>
                    </div>
              
                   <div class="modal-footer">

                      <input type="submit" class="btn btn-success" value="Add" name="submit" />
                      <button type="reset" class="btn btn-info" ><span class = 'fa fa-fw fa-eraser' style="margin-right:10px;"></span>Clear</button>
                      <button type="reset" class="btn btn-danger" data-dismiss="modal"><span class = 'glyphicon glyphicon-remove' style="margin-right:10px;"></span>Cancel</button>
                      
                    </div>
          
  
         </form>
    </div>
  </div>
</div>


</body>
</html>
