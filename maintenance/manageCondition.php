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
	

		<title>Admin | Terms and Condition</title>
		
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
              $('#table_condition').dataTable({
                "columns": [
                  null,
                  null,
                  { "width": "35%" },
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
                        dataString += "columnId=" + "ConditionID" + "&";
                        dataString += "columnState=" + "Status" + "&";
                        dataString += "table=" + "term_and_condition";
                       
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

              
                $('#form_add_condition').on("submit" , function(e){

                  var catID = $('#new_con_cat').val();
                  var conDesc = $('#new_con_desc').val();
                  var conFor = $('#new_con_for').val();
                  var err_val = '';

                      err_val = fnvalidate(err_val, conDesc, isAlphaNum);
                    
                        if(!err_val){
                            var dataString = "condesc=" + conDesc + "&";
                                dataString += "confor=" + conFor;
                                 
                                    $.ajax({
                                        type: "POST",
                                        url: "add_condition.php",
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
                                          $("#add_condition").modal('hide');
                                        }
                                   });

                                 
                        }
                        else{
                            for(var i = 0;i < err_val.length; i++){
                                fnError(err_val[i]);
                            }
                            $("#add_condition").modal('hide');
                        }
                
                return false;
                  
                });

                

        //insert edit ajax
                $('#form_edit_condition').on("submit" , function(e){
                   
                    var id = $('#changing_id').text();
                    var conDesc = $('#edit_con_desc').val();
                    var conFor = $('#edit_con_for').val();
                    var err_val = '';

                      err_val = fnvalidate(err_val, conDesc, isAlphaNum);
                    
                            if(!err_val){
                                  var dataString = "id=" + id + "&";
                                      dataString += "condesc=" + conDesc + "&";
                                      dataString += "confor=" + conFor;

                                        $.ajax({
                                            type: "POST",
                                            url: "edit_condition.php",
                                            data: dataString,
                                            cache: false,
                                            success: function(response){
                                              $('#condition_list').html(response);
                                              $("#edit_condition").modal('hide');
                                            }
                                          });
                            }
                            else{
                              for(var i = 0;i < err_val.length; i++){
                                  fnError(err_val[i]);
                              }
                              $("#edit_condition").modal('hide');
                            }

                  return false;
                    
                    
                  });

          //delete ajax
                 $('#form_delete_condition').on("submit" , function(e){
                   
                  var id = $('#delete_id').text();
                  var dataString = "id=" + id;
                    
                    $.ajax({
                      type: "POST",
                      url: "delete_condition.php",
                      data: dataString,
                      cache: false,
                      success: function(response){
                      $("#delete_condition").modal('hide');
                      $('#condition_list').html(response);

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

              function fnvalidate(err_val, conDesc, isAlphaNum){
                  if(checker(conDesc, isAlphaNum) == true){
                          err_val += '0';
                  }
                  return err_val;
              }

              function fnError(error){
                if(error == '0'){
                    $("#error-condesc").show().delay(5000).fadeOut();
                }
              }

              function isAlphaNum(str){
                          return /[a-zA-Z-()"/0-9,:;'. ]+$/.test(str);
                        }

              function ChangeCondition(conID){

                    $('#changing_id').text($('#changeid_' + conID).val());
                    $('#edit_con_desc').val($('#changedesc_' + conID).val());
                    $('#edit_con_for').val($('#changetype_' + conID).val());
                    $('#edit_condition').modal('show');
                     
                  }

                function DeleteCondition(conID){

                  $('#delete_id').text($('#changeid_' + conID).val());
                  $('#delete_con_desc').text($('#changedesc_' + conID).val());
                  $('#delete_con_type').text($('#changestrtype_' + conID).val());
                  $('#delete_condition').modal('show');
                  
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
                                        <span style = "font-size:30px;" class = "slideanim slidetop" title = "Something extra (such as vacation time or health insurance) that is given by an employer to workers in addition to their regular pay"> Manage Terms and Condition
                                        </span>
                                        <span style="position:relative;margin-left:4%;top:15px;font-size:15px;">*This page will let you to manage agency's Terms and Condition.
                                        </span> 
                                        <span class = "pull-right" style='position:relative;top:40px;'><a href = "#" data-toggle = "modal" data-target = "#add_condition" class = "btn btn-raised btn-success"> <span class = "glyphicon glyphicon-plus"></span> Add New</a> 
                                          <a href = "viewClientAgreement.php" class = 'btn btn-raised btn-warning' id = 'viewCA' title='View Client Agreement' target='_blank'><span class = 'glyphicon glyphicon-inbox' ></span></a>
                                          <a href = "viewEmploymentContract.php" class = 'btn btn-raised btn-info' id = 'viewEC' title='View Employment Contract' target='_blank'><span class = 'fa fa-fw fa-suitcase' ></span></a>
                                        </span>
                                    </span>
                                  
                              </div>
                            </div>

                            
                            <div id = "error-contitle" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You entered a not acceptable keys on Terms and Condition Condition Title.
                                </panel>
                            </div>
                            <div id = "error-condesc" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You entered a not acceptable keys on Terms and Condition Description.
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

                            <div class = "panel-body" id = "condition_list">
                              <table class = "table table-hovered display" id = "table_condition">
                                  <thead>
                                    <tr>
                                      <th><center>State</center></th>
                                      <th><center>For</center></th>
                                      <th><center>Description</center></th>
                                      <th><center>Action</center></th>
                                    </tr> 
                                  </thead>

                                  <tbody>
                                    <?php 

                                      $query = mysql_query("Select * from term_and_condition where Status != 3 and Description != ' '");
                                      
                                      while($res = mysql_fetch_assoc($query)){
                                        $conID = $res['ConditionID'];
                                        $conType = $res['Type'];
                                        $conDesc = ucfirst($res['Description']);
                                        $conState = $res['Status'];

                                        if($conType == 1)
                                          $strtype = "Agency";
                                        else if ($conType == 0)
                                          $strtype = "Client";
                                        else
                                          $strtype = "Staff";

                                        if($conState == 0){
                                          $strstat = "Active";
                                          echo "<script>
                                                  $(function(){
                                                    $(document).ready(function(){
                                                      $('input[name=my_checkbox_$conID]').bootstrapSwitch('state', true, true);
                                                    })
                                                      
                                                  });
                                                    </script>";
                                        }
                                        else if($conState == 1){
                                            $strstat = "Inactive";  
                                        }
                                    ?>
                                        <tr>
                                          <td>
                                            <center>
                                              <?php echo "<div id='changeState_$conID'>
                                                              $strstat
                                                            </div>"; 
                                              ?>
                                              <?php echo "<input type = 'hidden' id = 'changeid_con_$conID' value = '$conID'>"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "$strtype"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changestrtype_con_$conID' value = \"$strtype\">"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changetype_con_$conID' value = \"$conType\">"; ?>
                                            </center>
                                          </td>
                                          
                                          <td>
                                             <font style="font-size:20px;"><?php echo "$conDesc"; ?></font>
                                              <?php echo "<input type = 'hidden' id = 'changedesc_con_$conID' value = \"$conDesc\">"; ?>
                                          </td>
                                          
                                          <td>
                                             <center>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-success' id = 'con_$conID' onclick = 'ChangeCondition(this.id);' title='Edit'>
                                                  <span class = 'glyphicon glyphicon-edit' ></span></button>"; 
                                              ?>
                                              <?php 
                                                  echo "<input id='switch-state' name='my_checkbox_$conID' type='checkbox' value='$conID' >";
                                              ?>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-danger' id = 'con_$conID' onclick = 'DeleteCondition(this.id);' title='Delete'>
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

<div id="delete_condition" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_delete_condition">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-trash" style="margin-right:10px;"></span>Delete message </h2>
                    </div>

                    <div style = "margin-left:10%;margin-top:10px;margin-bottom:10px;">
                        <br><br>
                        
                          <div class="form-group" readonly>
                              <div class="col-xs-10">
                                  <font style="font-size:18px;">You are about to delete the following record on the list.<br>
                                    By clicking the delete button you will delete.. <br><br>Terms and Condition ID: <font style="color:red;margin-left:6%;"><span id ="delete_id"></span></font>
                                    <br>Terms and Condition Description: <font style="color:red;margin-left:1%;"><span id ="delete_con_desc"></span></font>
                                    <br>For: <font style="color:red;margin-left:1%;"><span id ="delete_con_type"></span></font>
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
<div id="edit_condition" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_edit_condition">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-edit" style="margin-right:10px;"></span>Edit Terms and Condition </h2>
                    </div>

                    <div style = "margin-left:10%;margin-bottom:10px;">
                        <br><br>
                        
                          <div class="form-group" readonly>
                              <div class="col-xs-10">
                                  <label for = "edit_con_id">Terms and Condition ID: <span id ="changing_id"></span></label>
                              </div>
                          </div>

                          <div class="form-group">
                            <div class="col-xs-10">
                               
                                <br>
                                <label for = "edit_con_desc">
                                  * Terms and Condition Description
                                </label>
                                <textarea rows = "5" maxlength='500' id = "edit_con_desc" class = "form-control" placeholder = "Enter Terms and Condition Description" required></textarea>
                                <br>
                                <label for = "edit_con_for">
                                  * For
                                </label>
                                <select id = "edit_con_for" class= "form-control" required>
                                        <option value = '1'  required>Agency</option>
                                        <option value = '0'  required>Client</option>
                                        <option value = '2'  required>Staff</option>
                                </select>
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

<div id="add_condition" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_add_condition">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-envelope" style="margin-right:10px;"></span>Add New Condition </h2>
                    </div>
                    <div class="modal-body">
                        <div style = "margin-left:10%;margin-bottom:10px;">
                            <br><br>
                            
                              <div class="form-group" readonly>
                                  <div class="col-xs-10">
                                      <label for = "new_con_id" style='font-size:15px;'>
                                        Terms and Condition ID: 
                                      </label>

                                          <?php
                                            $sql_in= mysql_query("Select * from term_and_condition");
                                            $row = mysql_num_rows($sql_in);
                                            $row += 240;
                                            
                                          ?>
                                          
                                          <span style='font-weight:bold;margin-left:2%;'><?php echo $row;?></span>
                                          
                                  </div>
                              </div>

                              <div class="form-group">
                                <div class="col-xs-10">
                                   
                                    <br>
                                    <label for = "new_con_desc">
                                      * Terms and Condition Description
                                    </label>
                                    <textarea rows = "5" maxlength='500' id = "new_con_desc" class = "form-control" placeholder = "Enter Terms and Condition Description" required></textarea>
                                    <br>
                                    <label for = "new_con_for">
                                      * For
                                    </label>
                                    <select id = "new_con_for" class= "form-control" required>
                                          <option value='' selected disabled>--- Select Applied for ---</option>
                                          <option value = '1'  required>Agency</option>
                                          <option value = '0'  required>Client</option>
                                          <option value = '2'  required>Staff</option>
                                    </select>
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
