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
	

		<title>Admin | Department</title>
		
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
              $('#table_dept').dataTable({
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
                        dataString += "columnId=" + "DepartmentID" + "&";
                        dataString += "columnState=" + "Status" + "&";
                        dataString += "table=" + "department";
                       
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

              
                $('#form_add_dept').on("submit" , function(e){

                  var busId = $('#new_bus_id').val();
                  var deptName = $('#new_dept_name').val();

                        if(checker(deptName, isAlpha) == false){
                            var dataString = "busid=" + busId + '&';
                                dataString += "deptname=" + deptName;
                                 
                                    $.ajax({
                                        type: "POST",
                                        url: "add_depart.php",
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
                                          $("#add_dept").modal('hide');
                                        }
                                   });

                                 
                        }
                        else{
                            $("#add_dept").modal('hide');
                            $("#error-mess").show().delay(5000).fadeOut();
                        }
                
                return false;
                  
                });

                

        //insert edit ajax
                $('#form_edit_dept').on("submit" , function(e){
                   
                    var id = $('#changing_id').text();
                    var busId = $('#edit_dept_busid').val();
                    var deptName = $('#edit_dept_name').val();
                  
                            if(checker(deptName, isAlpha) == false){
                                  var dataString = "id=" + id + "&";
                                      dataString += "busid=" + busId + "&";
                                      dataString += "deptname=" + deptName;

                                        $.ajax({
                                            type: "POST",
                                            url: "edit_depart.php",
                                            data: dataString,
                                            cache: false,
                                            success: function(response){
                                              $('#dept_list').html(response);
                                              $("#edit_dept").modal('hide');
                                            }
                                          });
                            }
                            else{
                              $("#edit_dept").modal('hide');
                              $("#error-mess").show().delay(5000).fadeOut();
                            }

                  return false;
                    
                    
                  });

          //delete ajax
                 $('#form_delete_dept').on("submit" , function(e){
                   
                  var id = $('#delete_id').text();
                  var dataString = "id=" + id;
                    
                    $.ajax({
                      type: "POST",
                      url: "delete_depart.php",
                      data: dataString,
                      cache: false,
                      success: function(response){
                      $("#delete_dept").modal('hide');
                      $('#dept_list').html(response);

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
                      containNum = true;
                  }
                  return hasError;
                }
              }

              function isAlpha(str){
                          return /[a-zA-Z' ]+$/.test(str);
                        }

              function ChangeDept(deptID){

                    $('#changing_id').text($('#changeid_' + deptID).val());
                    $('#edit_dept_busid').val($('#changebusid_' + deptID).val());
                    $('#edit_dept_name').val($('#changename_' + deptID).val());
                    $('#edit_dept').modal('show');
                     
                  }

                function DeleteDept(deptID){
                
                  $('#delete_id').text($('#changeid_' + deptID).val());
                  $('#delete_dept_busname').text($('#changebusname_' + deptID).val());
                  $('#delete_dept_name').text($('#changename_' + deptID).val());
                  $('#delete_dept').modal('show');
                  
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
                                        <span style = "font-size:30px;" class = "slideanim slidetop" title = "A special skill, knowledge or experience that applicants should have"> Manage Department
                                        </span>
                                        <span style="position:relative;margin-left:13%;top:15px;font-size:15px;">*This page will let you to manage agency's Department.
                                        </span> 
                                        <span class = "pull-right" style='position:relative;top:40px;'><a href = "#" data-toggle = "modal" data-target = "#add_dept" class = "btn btn-raised btn-success"> <span class = "glyphicon glyphicon-plus"></span> Add New</a> 
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

                            <div class = "panel-body" id = "dept_list">
                              <table class = "table table-hovered display" id = "table_dept">
                                  <thead>
                                    <tr>
                                      <th><center>State</center></th>
                                      <th><center>Nature of Business</center></th>
                                      <th><center>Name</center></th>
                                      <th><center>Action</center></th>
                                    </tr> 
                                  </thead>

                                  <tbody>
                                    <?php 

                                      $query = mysql_query("Select d.*, b.Description from department d join business_nature b on d.BusinessNatureID = b.BusinessNatureID where d.Status != 3 and d.Name != ' '");
                                      
                                      while($res = mysql_fetch_assoc($query)){
                                        $deptID = $res['DepartmentID'];
                                        $busID = $res['BusinessNatureID'];
                                        $busName = ucfirst($res['Description']);
                                        $deptName = ucfirst($res['Name']);
                                        $deptState = $res['Status'];

                                        if($deptState == 0){
                                          $strstat = "Active";
                                          echo "<script>
                                                  $(function(){
                                                    $(document).ready(function(){
                                                      $('input[name=my_checkbox_$deptID]').bootstrapSwitch('state', true, true);
                                                    })
                                                      
                                                  });
                                                    </script>";
                                        }
                                        else if($deptState == 1){
                                            $strstat = "Inactive";  
                                        }
                                    ?>
                                        <tr>
                                          <td>
                                            <center>
                                              <?php echo "<div id='changeState_$deptID'>
                                                              $strstat
                                                            </div>"; 
                                              ?>
                                              <?php echo "<input type = 'hidden' id = 'changeid_dept_$deptID' value = '$deptID'>"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "$busName"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changebusid_dept_$deptID' value = '$busID'>"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changebusname_dept_$deptID' value = \"$busName\">"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <font style="font-size:20px;"><?php echo "$deptName"; ?></font>
                                              <?php echo "<input type = 'hidden' id = 'changename_dept_$deptID' value = \"$deptName\">"; ?>
                                            </center>
                                          </td>
                                          
                                          <td>
                                             <center>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-success' id = 'dept_$deptID' onclick = 'ChangeDept(this.id);' title='Edit'>
                                                  <span class = 'glyphicon glyphicon-edit' ></span></button>"; 
                                              ?>
                                              <?php 
                                                  echo "<input id='switch-state' name='my_checkbox_$deptID' type='checkbox' value='$deptID' >";
                                              ?>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-danger' id = 'dept_$deptID' onclick = 'DeleteDept(this.id);' title='Delete'>
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

<div id="delete_dept" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_delete_dept">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-trash" style="margin-right:10px;"></span>Delete message </h2>
                    </div>

                    <div style = "margin-left:10%;margin-top:10px;margin-bottom:10px;">
                        <br><br>
                        
                          <div class="form-group" readonly>
                              <div class="col-xs-10">
                                  <font style="font-size:18px;">You are about to delete the following record on the list.<br>
                                    By clicking the delete button you will delete.. <br><br>Department ID: <font style="color:red;margin-left:6%;"><span id ="delete_id"></span></font>
                                    <br>Nature of Business: <font style="color:red;margin-left:1%;"><span id ="delete_dept_busname"></span></font>
                                    <br>Department Name: <font style="color:red;margin-left:1%;"><span id ="delete_dept_name"></span></font>
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
<div id="edit_dept" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_edit_dept">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-edit" style="margin-right:10px;"></span>Edit Department </h2>
                    </div>

                    <div style = "margin-left:10%;margin-bottom:10px;">
                        <br><br>
                        
                          <div class="form-group" readonly>
                              <div class="col-xs-10">
                                  <label for = "edit_course_id">Department ID: <span id ="changing_id"></span></label>
                              </div>
                          </div>

                          <div class="form-group">
                            <div class="col-xs-10">
                                <label for = "edit_dept_busid">
                                      * Nature of Business
                                </label>
                                        <select id = 'edit_dept_busid' class= "form-control" required>
                                              <?php 
                                                
                                                    $sql_in= mysql_query("Select * from business_nature where Status = 0 and Description != ' ' order by Description");
                                                    
                                                   
                                                    while ($r = mysql_fetch_assoc($sql_in)){
                                                      $busID = mysql_real_escape_string($r['BusinessNatureID']);
                                                      $busDesc = ucfirst(mysql_real_escape_string($r['Description']));


                                              ?>
                                                  <option value = <?php echo $busID; ?>  required><?php echo $busDesc; ?> </option>
                                              <?php
                                                }
                                              ?>
                                         </select>
                                <br>
                                <label for = "edit_dept_name">
                                  * Department Name
                                </label>
                                <input type='text' maxlength='70' id = "edit_dept_name" class = "form-control" placeholder = "Enter Department Name" required>
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

<div id="add_dept" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_add_dept">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-tasks" style="margin-right:10px;"></span>Add New Department </h2>
                    </div>
                    <div class="modal-body">
                        <div style = "margin-left:10%;margin-bottom:10px;">
                            <br><br>
                            
                              <div class="form-group" readonly>
                                  <div class="col-xs-10">
                                      <label for = "new_dept_id" style='font-size:15px;'>
                                        Department ID: 
                                      </label>

                                          <?php
                                            $sql_in= mysql_query("Select * from course");
                                            $row = mysql_num_rows($sql_in);
                                            $row += 11;
                                            
                                          ?>
                                          
                                          <span style='font-weight:bold;margin-left:2%;'><?php echo $row;?></span>
                                          
                                  </div>
                              </div>

                              <div class="form-group">
                                <div class="col-xs-10">
                                    <label for = "new_bus_id">
                                      * Nature of Business
                                    </label>
                                        <select id = 'new_bus_id' class= "form-control" required>
                                              <option value = "" selected disabled>-----Select Nature of Business-----</option>
                                              <?php 
                                                
                                                    $sql_in= mysql_query("Select * from business_nature where Status = 0 and Description != ' ' order by Description");
                                                    
                                                   
                                                    while ($r = mysql_fetch_assoc($sql_in)){
                                                      $busID = mysql_real_escape_string($r['BusinessNatureID']);
                                                      $busDesc = ucfirst(mysql_real_escape_string($r['Description']));


                                              ?>
                                                  <option value = <?php echo $busID; ?>  required><?php echo $busDesc; ?> </option>
                                              <?php
                                                }
                                              ?>
                                         </select>
                                    <br>
                                    <label for = "new_dept_name">
                                      * Department Name
                                    </label>
                                    <input type='text' maxlength='70' id = "new_dept_name" class = "form-control" placeholder = "Enter Department Name" required>
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
