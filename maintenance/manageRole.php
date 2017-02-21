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

    <title>Admin | Role</title>

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
              $('#table_role').dataTable({
                "columns": [
                  null,
                  { "width": "67%" },
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
                        dataString += "columnId=" + "RoleID" + "&";
                        dataString += "columnState=" + "Status" + "&";
                        dataString += "table=" + "user_role";
                       
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

              
                $('#form_add_role').on("submit" , function(e){
                  var roleName = $('#new_role_name').val();

                        if(checker(roleName, isAlphaNum) == false){
                            var dataString = "rolename=" + roleName;
                                 
                                    $.ajax({
                                        type: "POST",
                                        url: "add_role.php",
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
                                          $("#add_role").modal('hide');
                                        }
                                   });
                        }
                        else{
                            $("#add_role").modal('hide');
                            $("#error-mess").show().delay(5000).fadeOut();
                        }
                return false;
                });

                

        //insert edit ajax
                $('#form_edit_role').on("submit" , function(e){
                    var id = $('#changing_id').text();
                    var roleName = $('#edit_role_name').val();
                  
                            if(checker(roleName, isAlphaNum) == false){
                                  var dataString = "id=" + id + "&";
                                      dataString += "rolename=" + roleName;

                                        $.ajax({
                                            type: "POST",
                                            url: "edit_role.php",
                                            data: dataString,
                                            cache: false,
                                            success: function(response){
                                              $('#role_list').html(response);
                                              $("#edit_role").modal('hide');
                                            }
                                          });
                            }
                            else{
                              $("#edit_role").modal('hide');
                              $("#error-mess").show().delay(5000).fadeOut();
                            }
                  return false;
              });

              //delete ajax
              $('#form_delete_role').on("submit" , function(e){
                  var id = $('#delete_id').text();
                  var dataString = "id=" + id;
                    
                        $.ajax({
                          type: "POST",
                          url: "delete_role.php",
                          data: dataString,
                          cache: false,
                              success: function(response){
                              $("#delete_role").modal('hide');
                              $('#role_list').html(response);
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

              function isAlphaNum(str){
                  return /[a-zA-Z-0-9' ]+$/.test(str);
              }

              function ChangeRole(roleID){
                    $('#changing_id').text($('#changeid_' + roleID).val());
                    $('#edit_role_name').val($('#changename_' + roleID).val());
                    $('#edit_role').modal('show');
              }

              function DeleteRole(roleID){
                    $('#delete_id').text($('#changeid_' + roleID).val());
                    $('#delete_role_name').text($('#changename_' + roleID).val());
                    $('#delete_role').modal('show');
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
                                        <span style = "font-size:30px;" class = "slideanim slidetop" title = "Different role in the agency">Manage Role
                                        </span>
                                        <span style="position:relative;margin-left:16%;top:15px;font-size:15px;">*This page will let you to manage agency's different role.
                                        </span> 
                                        <span class = "pull-right" style='position:relative;top:40px;'><a href = "#" data-toggle = "modal" data-target = "#add_role" class = "btn btn-raised btn-success"> <span class = "glyphicon glyphicon-plus"></span> Add New</a>                                        </span>
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

                            <div class = "panel-body" id = "role_list">
                              <table class = "table table-hovered display" id = "table_role">
                                  <thead>
                                    <tr>
                                      <th><center>State</center></th>
                                      <th><center>Role Name</center></th>
                                      <th><center>Action</center></th>
                                    </tr> 
                                  </thead>

                                  <tbody>
                                    <?php 

                                      $query = mysql_query("SELECT * from user_role where Status != 3");
                                      
                                      while($res = mysql_fetch_assoc($query)){
                                        $roleID = $res['RoleID'];
                                        $roleName = ucwords($res['Name']);
                                        $roleState = $res['Status'];

                                        if($roleState == 0){
                                          $strstat = "Active";
                                          echo "<script>
                                                  $(function(){
                                                    $(document).ready(function(){
                                                      $('input[name=my_checkbox_$roleID]').bootstrapSwitch('state', true, true);
                                                    })
                                                      
                                                  });
                                                </script>";
                                        }
                                        else if($roleState == 1){
                                            $strstat = "Inactive";  
                                        }
                                    ?>
                                        <tr>
                                          <td>
                                            <center>
                                              <?php echo "<div id='changeState_$roleID'>
                                                              $strstat
                                                            </div>"; 
                                              ?>
                                              <?php echo "<input type = 'hidden' id = 'changeid_role_$roleID' value = '$roleID'>"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                               <font style="font-size:20px;"><?php echo "$roleName"; ?></font>
                                              <?php echo "<input type = 'hidden' id = 'changename_role_$roleID' value = \"$roleName\">"; ?>
                                            </center>
                                          </td>
                                          
                                          <td>
                                             <center>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-success' id = 'role_$roleID' onclick = 'ChangeRole(this.id);' title='Edit'>
                                                  <span class = 'glyphicon glyphicon-edit' ></span></button>"; 
                                              ?>
                                              <?php 
                                                  echo "<input id='switch-state' name='my_checkbox_$roleID' type='checkbox' value='$roleID' >";
                                              ?>
                                              <?php 
                                                  echo "<button class = 'btn btn-raised btn-danger' id = 'role_$roleID' onclick = 'DeleteRole(this.id);' title='Delete'>
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

<div id="delete_role" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_delete_role">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-trash" style="margin-right:10px;"></span>Delete message </h2>
                    </div>

                    <div style = "margin-left:10%;margin-top:10px;margin-bottom:10px;">
                        <br><br>
                        
                          <div class="form-group" readonly>
                              <div class="col-xs-10">
                                  <font style="font-size:18px;">You are about to delete the following record on the list.<br>
                                    By clicking the delete button you will delete.. <br><br>Role ID: <font style="color:red;margin-left:6%;"><span id ="delete_id"></span></font>
                                    <br>Role Name: <font style="color:red;margin-left:1%;"><span id ="delete_role_name"></span></font>
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
<div id="edit_role" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_edit_role">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-edit" style="margin-right:10px;"></span>Edit Role</h2>
                    </div>

                    <div style = "margin-left:10%;margin-bottom:10px;">
                        <br><br>
                        
                          <div class="form-group" readonly>
                              <div class="col-xs-10">
                                  <label for = "edit_role_id">Role ID: <span id ="changing_id"></span></label>
                              </div>
                          </div>

                          <div class="form-group">
                            <div class="col-xs-10">
                                <label for = "edit_role_name">
                                  * Role Name
                                </label>
                                <input type='text' maxlength='70' id = "edit_role_name" class = "form-control" placeholder = "Enter Role Name" required>
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

<div id="add_role" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_add_role">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="fa fa-fw fa-lightbulb-o" style="margin-right:10px;"></span>Add New Role </h2>
                    </div>
                    <div class="modal-body">
                        <div style = "margin-left:10%;margin-bottom:10px;">
                            <br><br>
                            
                              <div class="form-group" readonly>
                                  <div class="col-xs-10">
                                      <label for = "new_con_id" style='font-size:15px;'>
                                        Role ID: 
                                      </label>

                                          <?php
                                            $sql_in= mysql_query("Select * from user_role");
                                            $row = mysql_num_rows($sql_in);
                                            $row += 1;
                                            
                                          ?>
                                          
                                          <span style='font-weight:bold;margin-left:2%;'><?php echo $row;?></span>
                                          
                                  </div>
                              </div>

                              <div class="form-group">
                                <div class="col-xs-10">
                                    <label for = "new_role_name">
                                      * Role Name
                                    </label>
                                    <input type='text' maxlength='70' id = "new_role_name" class = "form-control" placeholder = "Enter Role Name" required>
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
