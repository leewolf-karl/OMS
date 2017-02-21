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
	

		<title>Admin | Reason</title>
		
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

                    var dataString = "cid=" + id + "&";
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

              
                $('#form_add_reason').on("submit" , function(e){

                  var reasonName = $('#new_reas_name').val();

                        if(checker(reasonName, isAlpha) == false){
                            var dataString = "reasonname=" + reasonName;
                                 
                                    $.ajax({
                                        type: "POST",
                                        url: "add_reason.php",
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
                                          $("#add_reason").modal('hide');
                                        }
                                   });

                                 
                        }
                        else{
                            $("#add_reason").modal('hide');
                            $("#error-mess").show().delay(5000).fadeOut();
                        }
                
                return false;
                  
                });

                

        //insert edit ajax
                $('#form_edit_reason').on("submit" , function(e){
                   
                    var id = $('#changing_id').text();
                    var reasName = $('#edit_reas_name').val();
                  
                            if(checker(reasName, isAlpha) == false){
                                  var dataString = "id=" + id + "&";
                                      dataString += "reasname=" + reasName;

                                        $.ajax({
                                            type: "POST",
                                            url: "edit_reason.php",
                                            data: dataString,
                                            cache: false,
                                            success: function(response){
                                              $('#reason_list').html(response);
                                              $("#edit_reason").modal('hide');
                                            }
                                          });
                            }
                            else{
                              $("#edit_reason").modal('hide');
                              $("#error-mess").show().delay(5000).fadeOut();
                            }

                  return false;
                    
                    
                  });

          //delete ajax
                 $('#form_delete_reason').on("submit" , function(e){
                   
                  var id = $('#delete_id').text();
                  var dataString = "id=" + id;
                    
                    $.ajax({
                      type: "POST",
                      url: "delete_reason.php",
                      data: dataString,
                      cache: false,
                      success: function(response){
                      $("#delete_reason").modal('hide');
                      $('#reason_list').html(response);

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
                          return /[a-zA-Z' ]+$/.test(str);
                        }

              function ChangeReason(reasID){

                    $('#changing_id').text($('#changeid_' + reasID).val());
                    $('#edit_reas_name').val($('#changename_' + reasID).val());
                    $('#edit_reason').modal('show');
                     
                  }

                function DeleteReason(reasID){
                
                  $('#delete_id').text($('#changeid_' + reasID).val());
                  $('#delete_reas_name').text($('#changename_' + reasID).val());
                  $('#delete_reason').modal('show');
                  
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
                                        <span style = "font-size:30px;" class = "slideanim slidetop" title = "Reason that are legally acceptable in accordance with the agreement"> Manage Reason for Termination of Client Agreement
                                        </span><br>
                                        <span style="position:relative;margin-left:20%; top:10px;font-size:15px;">*This page will let you to manage agency's Reason for Termination of Client Agreeement.
                                        </span> 
                                        <span class = "pull-right" style='position:relative;top:10px;'><a href = "#" data-toggle = "modal" data-target = "#add_reason" class = "btn btn-raised btn-success"> <span class = "glyphicon glyphicon-plus"></span> Add New</a> 
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

                            <div class = "panel-body" id = "reason_list">
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

                                      $query = mysql_query("Select * from valid_reason where Status != 3 and Name != ' '");
                                      
                                      while($res = mysql_fetch_assoc($query)){
                                        $reasonID = $res['ReasonID'];
                                        $reasonName = ucfirst($res['Name']);
                                        $reasonState = $res['Status'];

                                        if($reasonState == 0){
                                          $strstat = "Active";
                                          echo "<script>
                                                  $(function(){
                                                    $(document).ready(function(){
                                                      $('input[name=my_checkbox_$reasonID]').bootstrapSwitch('state', true, true);
                                                    })
                                                      
                                                  });
                                                    </script>";
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
                                                  echo "<input id='switch-state' name='my_checkbox_$reasonID' type='checkbox' value='$reasonID' >";
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
                            </div>
                      </div>

               </div>
          </div>
  </div> 

<div id="delete_reason" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_delete_reason">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-trash" style="margin-right:10px;"></span>Delete message </h2>
                    </div>

                    <div style = "margin-left:10%;margin-top:10px;margin-bottom:10px;">
                        <br><br>
                        
                          <div class="form-group" readonly>
                              <div class="col-xs-10">
                                  <font style="font-size:18px;">You are about to delete the following record on the list.<br>
                                    By clicking the delete button you will delete.. <br><br>Valid Reason ID: <font style="color:red;margin-left:6%;"><span id ="delete_id"></span></font>
                                    <br>Reason for Termination: <font style="color:red;margin-left:1%;"><span id ="delete_reas_name"></span></font>
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
<div id="edit_reason" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_edit_reason">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-edit" style="margin-right:10px;"></span>Edit Reason for Termination</h2>
                    </div>

                    <div style = "margin-left:10%;margin-bottom:10px;">
                        <br><br>
                        
                          <div class="form-group" readonly>
                              <div class="col-xs-10">
                                  <label for = "edit_vio_id">Reason ID: <span id ="changing_id"></span></label>
                              </div>
                          </div>

                          <div class="form-group">
                            <div class="col-xs-10">
                                <label for = "edit_reas_name">
                                  * Reason Name
                                </label>
                                <input type='text' maxlength='70' id = "edit_reas_name" class = "form-control" placeholder = "Enter Valid Reason Name" required>
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

<div id="add_reason" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_add_reason">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="fa fa-fw fa-edit" style="margin-right:10px;"></span>Add New Reason for Termination </h2>
                    </div>
                    <div class="modal-body">
                        <div style = "margin-left:10%;margin-bottom:10px;">
                            <br><br>
                            
                              <div class="form-group" readonly>
                                  <div class="col-xs-10">
                                      <label for = "new_reas_id" style='font-size:15px;'>
                                        Reason ID: 
                                      </label>

                                          <?php
                                            $sql_in= mysql_query("Select * from valid_reason");
                                            $row = mysql_num_rows($sql_in);
                                            $row += 6;
                                            
                                          ?>
                                          
                                          <span style='font-weight:bold;margin-left:2%;'><?php echo $row;?></span>
                                          
                                  </div>
                              </div>

                              <div class="form-group">
                                <div class="col-xs-10">
                                    <label for = "new_reas_name">
                                      * Reason Name
                                    </label>
                                    <input type='text' maxlength='70' id = "new_reas_name" class = "form-control" placeholder = "Enter Valid Reason Name" required>
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
