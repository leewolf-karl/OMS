<?php
  session_start();
  include "../php/dbconnect.php";
  //insert validation here
?>


<!DOCTYPE html>
<html lang="en">
	<head>
  
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	

		<title>Admin | Leave</title>
		
   <link href="../bootstrap1/css/bootstrap.css" rel="stylesheet">
    <link href="../bootstrap1/css/dataTables.bootstrap4.css" rel="stylesheet" media="screen">
    
    <link href="../bootstrap1/css/ripples.css" rel="stylesheet">

    <link href="../bootstrap1/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap1/css/sb-admin.css" rel="stylesheet">

    <link href="../css/main.css" rel="stylesheet">
    <link href="../semantic/out/semantic.css" rel="stylesheet">

    <link href="../bootstrap1/css/custom_bootstrap_animation.css" rel="stylesheet">
    <link href="../bootstrap1/css/bootstrap-switch.css" rel="stylesheet">
   
    <script src="../bootstrap1/js/jquery-1.11.3.js"></script>
    <script src="../bootstrap1/js/material.min.js"></script>

    <script src="../bootstrap1/js/ripples.js"></script>
    <script src="../bootstrap1/js/bootstrap.min.js"></script>

    <script src="../bootstrap1/js/jquery.dataTables.js"></script>
    <script src="../bootstrap1/js/dataTables.bootstrap4.js"></script>

    <script src="../bootstrap1/js/bootstrap-switch-highlight.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch.js"></script>

    <script src="../bootstrap1/js/bootstrap-switch-main.js"></script>
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

                    var dataString = "cid=" + id + "&";
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

              
                $('#form_add_leave').on("submit" , function(e){

                  var leaveName = $('#new_leave_name').val();
                  var leaveNoday = $('#new_leave_noday').val();
                  var err_val = '';

                        err_val = fnvalidate(err_val, leaveName, leaveNoday, isAlpha, isNumeric);

                        if(!err_val){
                            var dataString = "leavename=" + leaveName + "&";
                                dataString += "leavenoday=" + leaveNoday;
                                 
                                    $.ajax({
                                        type: "POST",
                                        url: "add_leave.php",
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
                                          $("#add_leave").modal('hide');
                                        }
                                   });

                                 
                        }
                        else{
                          for(var i = 0;i < err_val.length; i++){
                                fnError(err_val[i]);
                          }
                          $("#add_leave").modal('hide');
                        }
                
                return false;
                  
                });

                

        //insert edit ajax
                $('#form_edit_leave').on("submit" , function(e){
                   
                    var id = $('#changing_id').text();
                    var leaveName = $('#edit_leave_name').val();
                    var leaveNoday = $('#edit_leave_noday').val();
                    var err_val = '';

                        err_val = fnvalidate(err_val, leaveName, leaveNoday, isAlpha, isNumeric);

                        if(!err_val){
                              var dataString = "id=" + id + "&";
                                  dataString += "leavename=" + leaveName + "&";
                                  dataString += "leavenoday=" + leaveNoday;

                                  $.ajax({
                                      type: "POST",
                                      url: "edit_leave.php",
                                      data: dataString,
                                      cache: false,
                                      success: function(response){
                                          $('#leave_list').html(response);
                                          $("#edit_leave").modal('hide');
                                      }
                                  });
                        }
                        else{
                          for(var i = 0;i < err_val.length; i++){
                                fnError(err_val[i]);
                          }
                          $("#edit_leave").modal('hide');
                        }

                  return false;
                    
                    
                  });

          //delete ajax
                 $('#form_delete_leave').on("submit" , function(e){
                   
                  var id = $('#delete_id').text();
                  var dataString = "id=" + id;
                    
                    $.ajax({
                      type: "POST",
                      url: "delete_leave.php",
                      data: dataString,
                      cache: false,
                      success: function(response){
                      $("#delete_leave").modal('hide');
                      $('#leave_list').html(response);

                      }
                    });
                  
                  return false;
                    
                    
                  });
       });

              function fnvalidate(err_val, leaveName, leaveNoday, isAlpha, isNumeric){
                  if(checker(leaveName, isAlpha) == true){
                          err_val += '0';
                  }
                  if(checker(leaveNoday, isNumeric) == true){
                          err_val += '1';
                  }
                  return err_val;
              }

              function fnError(error){
                if(error == '0'){
                    $("#error-leavename").show().delay(5000).fadeOut();
                }
                if(error == '1'){
                    $("#error-leavenoday").show().delay(5000).fadeOut();
                }
              }

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

              function isNumeric(str){
                          return /[0-9.]+$/.test(str);
                        }
              function isAlpha(str){
                          return /[a-zA-Z-' ]+$/.test(str);
                        }

              function ChangeLeave(leaveID){

                    $('#changing_id').text($('#changeid_' + leaveID).val());
                    $('#edit_leave_name').val($('#changename_' + leaveID).val());
                    $('#edit_leave_noday').val($('#changenoday_' + leaveID).val());
                    $('#edit_leave').modal('show');
                     
                  }

                function DeleteLeave(leaveID){
                
                  $('#delete_id').text($('#changeid_' + leaveID).val());
                  $('#delete_leave_name').text($('#changename_' + leaveID).val());
                  $('#delete_leave_noday').text($('#changenoday_' + leaveID).val());
                  $('#delete_leave').modal('show');
                  
                }

      </script>
	</head>

	
		<!-- Navigation -->
<?php
  include "../Navigation/nav_maintenance.php";
   
?>

  <body style = "background-color:rgb(210,210,210); font-style: arial;">
  
     <br><br><br><br><br><br><br>
    <div> 
           <div class="col-sm-offset-2">

                  <div class = "col-md-13">
                      <div class = "panel panel-primary" style='border-radius:0px;'>
                        
                          
                            <div class = "panel-heading" >
                              <div class = "slideanim slideright">
                                  <span class = "panel-title" style = "line-height:2;border-bottom-color:black;">
                                        <span style = "font-size:30px;" class = "slideanim slidetop" title = "Leave accordance with the law"> Manage Leave
                                        </span>
                                        <span style="position:relative;margin-left:13%;top:15px;font-size:15px;">*This page will let you to manage agency's Leave.
                                        </span> 
                                        <span class = "pull-right" style='position:relative;top:40px;'><a href = "#" data-toggle = "modal" data-target = "#add_leave" class = "btn btn-raised btn-success"> <span class = "glyphicon glyphicon-plus"></span> Add New</a> 
                                        </span>
                                    </span>
                                  
                              </div>
                            </div>

                            
                            <div id = "error-leavename" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You entered a not acceptable keys on Leave Name.
                                </panel>
                            </div>
                            <div id = "error-leavenoday" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You entered a not acceptable keys on Number of Leave days.
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

                            <div class = "panel-body" id = "leave_list">
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

                                      $query = mysql_query("Select * from `leave` where Status != 3 and Name != ' '");
                                      
                                      while($res = mysql_fetch_assoc($query)){
                                        $leaveID = $res['LeaveID'];
                                        $leaveName = ucfirst($res['Name']);
                                        $leaveNoday = $res['NoDay'];
                                        $leaveState = $res['Status'];

                                        if($leaveState == 0){
                                          $strstat = "Active";
                                          echo "<script>
                                                  $(function(){
                                                    $(document).ready(function(){
                                                      $('input[name=my_checkbox_$leaveID]').bootstrapSwitch('state', true, true);
                                                    })
                                                      
                                                  });
                                                    </script>";
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
                                                  echo "<input id='switch-state' name='my_checkbox_$leaveID' type='checkbox' value='$leaveID' >";
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
                            </div>
                      </div>

               </div>
          </div>
  </div> 

<div id="delete_leave" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_delete_leave">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-trash" style="margin-right:10px;"></span>Delete message </h2>
                    </div>

                    <div style = "margin-left:10%;margin-top:10px;margin-bottom:10px;">
                        <br><br>
                        
                          <div class="form-group" readonly>
                              <div class="col-xs-10">
                                  <font style="font-size:18px;">You are about to delete the following record on the list.<br>
                                    By clicking the delete button you will delete.. <br><br>Leave ID: <font style="color:red;margin-left:6%;"><span id ="delete_id"></span></font>
                                    <br>Leave Name: <font style="color:red;margin-left:1%;"><span id ="delete_leave_name"></span></font>
                                    <br>Number of Leave days: <font style="color:red;margin-left:1%;"><span id ="delete_leave_noday"></span></font>
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
<div id="edit_leave" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_edit_leave">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-edit" style="margin-right:10px;"></span>Edit Leave </h2>
                    </div>

                    <div style = "margin-left:10%;margin-bottom:10px;">
                        <br><br>
                        
                          <div class="form-group" readonly>
                              <div class="col-xs-10">
                                  <label for = "edit_leave_id">Leave ID: <span id ="changing_id"></span></label>
                              </div>
                          </div>

                          <div class="form-group">
                            <div class="col-xs-10">
                                <label for = "edit_leave_name">
                                    * Leave Name
                                </label>
                                <input type='text' maxlength='70' id = "edit_leave_name" class = "form-control" placeholder = "Enter Leave Name" required>
                                <br>
                                <label for = "edit_leave_noday">
                                    * Number of Leave days
                                </label>
                                <input type='number' id = "edit_leave_noday" class = "form-control" placeholder = "Enter Number of Leave days" required>
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

<div id="add_leave" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_add_leave">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-plane" style="margin-right:10px;"></span>Add New Leave </h2>
                    </div>
                    <div class="modal-body">
                        <div style = "margin-left:10%;margin-bottom:10px;">
                            <br><br>
                            
                              <div class="form-group" readonly>
                                  <div class="col-xs-10">
                                      <label for = "new_leave_id" style='font-size:15px;'>
                                        Leave ID: 
                                      </label>

                                          <?php
                                            $sql_in= mysql_query("Select * from `leave`");
                                            $row = mysql_num_rows($sql_in);
                                            $row += 1;
                                            
                                          ?>
                                          
                                          <span style='font-weight:bold;margin-left:2%;'><?php echo $row;?></span>
                                          
                                  </div>
                              </div>

                              <div class="form-group">
                                <div class="col-xs-10">
                                    <label for = "new_leave_name">
                                      * Leave Name
                                    </label>
                                    <input type='text' maxlength='70' id = "new_leave_name" class = "form-control" placeholder = "Enter Leave Name" required>
                                    <br>
                                    <label for = "new_leave_noday">
                                      * Number of Leave days
                                    </label>
                                    <input type='number' id = "new_leave_noday" class = "form-control" placeholder = "Enter Number of Leave days" required>
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
