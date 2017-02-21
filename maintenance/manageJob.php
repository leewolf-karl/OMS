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

    <title>Admin | Job</title>

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
    <script src="select_functions.js"></script>
    

    <script>
        $(function() {
              $('#table_job').dataTable({
                "columns": [
                  null,
                  { "width": "8%" },
                  { "width": "15%" },
                  null,
                  null,
                  null,
                  null,
                  { "width": "26%" }
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
                        dataString += "columnId=" + "JobID" + "&";
                        dataString += "columnState=" + "Status" + "&";
                        dataString += "table=" + "job_title";
                       
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

              
                $('#form_add_job').on("submit" , function(e){
                  var jobCatId = $('#new_job_catid').val();
                  var jobName = $('#new_job_name').val();
                  var jobSf = $('#new_job_sf').val().replace('%','');
                  var jobCola = $('#new_job_cola').val().replace('%','');
                  var jobminSalary = $('#new_job_minsalary').val().replace(',','');       
                  var jobmaxSalary = $('#new_job_maxsalary').val().replace(',',''); 

                  var jobDefQualVal = valueTransfer($('#new_job_qualid').val(), '#new_job_qual');   
                  var jobDefSkillVal = valueTransfer($('#new_job_skillid').val(), '#new_job_skill');   
                  var jobDefReqVal = valueTransfer($('#new_job_reqid').val(), '#new_job_req');   
                  

                  var err_val = '';

                      err_val = fnvalidate(err_val, jobName, jobSf, jobCola, jobminSalary, jobmaxSalary, isAlpha, isNumeric);

                      if(!err_val){

                        var dataString = "catid=" + jobCatId + '&';
                            dataString += "jobname=" + jobName + '&';
                            dataString += "jobsf=" + jobSf + '&';
                            dataString += "jobcola=" + jobCola + '&';
                            dataString += "jobminsalary=" + jobminSalary + '&';
                            dataString += "jobmaxsalary=" + jobmaxSalary + '&';
                            dataString += "jobdefqualval=" + jobDefQualVal + '&';
                            dataString += "jobdefskillval=" + jobDefSkillVal + '&';
                            dataString += "jobdefreqval=" + jobDefReqVal;
                                 
                            $.ajax({
                                type: "POST",
                                url: "add_job.php",
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
                                    $("#add_job").modal('hide');
                                  }
                            });
                      }
                      else{
                          for(var i = 0;i < err_val.length; i++){
                                fnError(err_val[i]);
                          }
                          $("#add_job").modal('hide');
                      }
                
                return false;
                });

                

        //insert edit ajax
                $('#form_edit_job').on("submit" , function(e){
                   
                    var id = $('#changing_id').text();
                    var jobCatId = $('#edit_job_catid').val();
                    var jobName = $('#edit_job_name').val();
                    var jobSf = $('#edit_job_sf').val().replace('%','');
                    var jobCola = $('#edit_job_cola').val().replace('%','');
                    var jobminSalary = $('#edit_job_minsalary').val().replace(',','');
                    var jobmaxSalary = $('#edit_job_maxsalary').val().replace(',','');   
                    var err_val = '';

                      err_val = fnvalidate(err_val, jobName, jobSf, jobCola, jobminSalary, jobmaxSalary, isAlpha, isNumeric);
                  
                            if(!err_val){
                                  var dataString = "id=" + id + "&";
                                      dataString += "catid=" + jobCatId + "&";
                                      dataString += "jobname=" + jobName + "&";
                                      dataString += "jobsf=" + jobSf + "&";
                                      dataString += "jobcola=" + jobCola + "&";
                                      dataString += "jobminsalary=" + jobminSalary + "&";
                                      dataString += "jobmaxsalary=" + jobmaxSalary;

                                        $.ajax({
                                            type: "POST",
                                            url: "edit_job.php",
                                            data: dataString,
                                            cache: false,
                                            success: function(response){
                                              $('#job_list').html(response);
                                              $("#edit_job").modal('hide');
                                            }
                                          });
                            }
                            else{
                              for(var i = 0;i < err_val.length; i++){
                                fnError(err_val[i]);
                              }
                              $("#edit_job").modal('hide');
                            }

                  return false;
                  });

          //delete ajax
                 $('#form_delete_job').on("submit" , function(e){
                   
                    var id = $('#delete_id').text();
                    var dataString = "id=" + id;
                      
                      $.ajax({
                        type: "POST",
                        url: "delete_job.php",
                        data: dataString,
                        cache: false,
                        success: function(response){
                        $("#delete_job").modal('hide');
                        $('#job_list').html(response);

                        }
                      });
                  
                  return false;
                  });

       });
              
              function fnvalidate(err_val, jobName, jobSf, jobCola, jobminSalary, jobmaxSalary, isAlpha, isNumeric){
                  if(checker(jobName, isAlpha) == true){
                          err_val += '0';
                  }
                  if(checker(jobCola, isNumeric) == true){
                          err_val += '1';
                  }
                  if(checker(jobminSalary, isNumeric) == true){
                          err_val += '2';
                  }
                  if(checker(jobmaxSalary, isNumeric) == true){
                          err_val += '3';
                  }
                  if(checker(jobSf, isNumeric) == true){
                          err_val += '4';
                  }
                  if(jobminSalary >= jobmaxSalary){
                          err_val += '5';
                  }
                  return err_val;
              }

              function fnError(error){
                if(error == '0'){
                    $("#error-jobname").show().delay(5000).fadeOut();
                }
                if(error == '1'){
                    $("#error-jobcola").show().delay(5000).fadeOut();
                }
                if(error == '2'){
                    $("#error-jobminsalary").show().delay(5000).fadeOut();
                }
                if(error == '3'){
                    $("#error-jobmaxsalary").show().delay(5000).fadeOut();
                }
                if(error == '4'){
                    $("#error-jobsf").show().delay(5000).fadeOut();
                }
                if(error == '5'){
                    $("#error-jobminmaxsalary").show().delay(5000).fadeOut();
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
                          return /[0-9,.]+$/.test(str);
              }
              
              function isAlpha(str){
                          return /[a-zA-Z-' ]+$/.test(str);
              }

              function ChangeJob(jobID){

                    $('#changing_id').text($('#changeid_' + jobID).val());
                    $('#edit_job_catid').val($('#changecatid_' + jobID).val());
                    $('#edit_job_name').val($('#changename_' + jobID).val());
                    $('#edit_job_sf').val($('#changesf_' + jobID).val());
                    $('#edit_job_cola').val($('#changecola_' + jobID).val());
                    $('#edit_job_minsalary').val($('#changeminsalary_' + jobID).val());
                    $('#edit_job_maxsalary').val($('#changemaxsalary_' + jobID).val());

                    var jobId = $('#changeid_' + jobID).val();

                    var dataString = "id=" + jobId;

                    $.ajax({
                        type: "POST",
                        url: "edit_job_select.php",
                        data: dataString,
                        cache: false,
                        success: function(response){
                          $('#edit_job_list').html(response);
                        }
                    });
                    $('#edit_job').modal('show');
                     
              }

              function DeleteJob(jobID){
                    var jobId = $('#changeid_' + jobID).val();

                    var dataString = "id=" + jobId;
                     
                      $.ajax({
                          type: "POST",
                          url: "view_job.php",
                          data: dataString,
                          cache: false,
                          success: function(response){
                            $('#delete_job_list').html(response);
                          }
                      });
                    $('#delete_id').text($('#changeid_' + jobID).val());
                    $('#delete_job_catname').text($('#changecatname_' + jobID).val());
                    $('#delete_job_name').text($('#changename_' + jobID).val());
                    $('#delete_job_sf').text($('#changesf_' + jobID).val());
                    $('#delete_job_cola').text($('#changecola_' + jobID).val());
                    $('#delete_job_minsalary').text($('#changeminsalary_' + jobID).val());
                    $('#delete_job_maxsalary').text($('#changemaxsalary_' + jobID).val());
                    $('#delete_job').modal('show');
                  
              }

              function ViewJob(jobID){

                  var jobId = $('#changeid_' + jobID).val();

                  var dataString = "id=" + jobId;
                   
                    $.ajax({
                        type: "POST",
                        url: "view_job.php",
                        data: dataString,
                        cache: false,
                        success: function(response){
                          $('#view_job_list').html(response);
                        }
                    });
                  $('#view_id').text($('#changeid_' + jobID).val());
                  $('#view_job_catname').text($('#changecatname_' + jobID).val());
                  $('#view_job_name').text($('#changename_' + jobID).val());
                  $('#view_job_sf').text($('#changesf_' + jobID).val());
                  $('#view_job_cola').text($('#changecola_' + jobID).val());
                  $('#view_job_minsalary').text($('#changeminsalary_' + jobID).val());
                  $('#view_job_maxsalary').text($('#changemaxsalary_' + jobID).val());
                  $('#view_job').modal('show');
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
                                        <span style = "font-size:30px;" class = "slideanim slidetop" title = "List of jobs offerings">Manage Job
                                        </span>
                                        <span style="position:relative;margin-left:15%;top:15px;font-size:15px;">*This page will let you to manage agency's Job Offer.
                                        </span> 
                                        <span class = "pull-right" style='position:relative;top:40px;'><a href = "#" data-toggle = "modal" data-target = "#add_job" class = "btn btn-raised btn-success"> <span class = "glyphicon glyphicon-plus"></span> Add New</a>
                                        </span>
                                    </span>
                              </div>
                            </div>
                            

                            <div id = "error-exist-jobreq" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: Some Job Requirement already exist.
                                </panel>
                            </div>
                            <div id = "error-exist-jobqual" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: Some Job Qualification already exist.
                                </panel>
                            </div>
                            <div id = "error-exist-jobskill" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: Some Job Skill already exist.
                                </panel>
                            </div>
                            <div id = "error-jobname" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You entered a not acceptable keys on Job Title.
                                </panel>
                            </div>
                            <div id = "error-jobcola" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You entered a not acceptable keys on Job cola.
                                </panel>
                            </div>
                            <div id = "error-jobminmaxsalary" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You must set Maximum salary greater than Minimum salary.
                                </panel>
                            </div>
                            <div id = "error-jobminsalary" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You entered a not acceptable keys on Job min salary.
                                </panel>
                            </div>
                            <div id = "error-jobmaxsalary" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You entered a not acceptable keys on Job max salary.
                                </panel>
                            </div>
                            <div id = "error-jobsf" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You entered a not acceptable keys on Job service fee.
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


                            <div class = "panel-body" id = "job_list">
                              <table class = "table table-hovered display" id = "table_job">
                                  <thead>
                                    <tr>
                                      <th><center>State</center></th>
                                      <th><center>Category</center></th>
                                      <th><center>Job Title</center></th>
                                      <th><center>Service Fee</center></th>
                                      <th><center>Cola</center></th>
                                      <th><center>Min Salary</center></th>
                                      <th><center>Max Salary</center></th>
                                      <th><center>Action</center></th>
                                    </tr> 
                                  </thead>

                                  <tbody>
                                    <?php 

                                      $query = mysql_query("SELECT j.*, c.Name as CName from job_title j join job_category c on j.CategoryID = c.CategoryID where j.Status != 3");
                                      
                                      while($res = mysql_fetch_assoc($query)){
                                        $jobID = $res['JobID'];
                                        $catID = $res['CategoryID'];
                                        $catName = ucwords($res['CName']);
                                        $jobName = ucwords($res['Name']);
                                        $jobSf = $res['Service_fee'];
                                        $jobminSalary = number_format($res['Min_Salary'], 2, '.', ',');
                                        $jobmaxSalary = number_format($res['Max_Salary'], 2, '.', ',');
                                        $jobCola = $res['Cola'];
                                        $jobState = $res['Status'];

                                        if($jobState == 0){
                                          $strstat = "Active";
                                          echo "<script>
                                                  $(function(){
                                                    $(document).ready(function(){
                                                      $('input[name=my_checkbox_$jobID]').bootstrapSwitch('state', true, true);
                                                    })
                                                      
                                                  });
                                                    </script>";
                                        }
                                        else if($jobState == 1){
                                            $strstat = "Inactive";  
                                        }
                                    ?>
                                        <tr>
                                          <td>
                                            <center>
                                              <?php echo "<div id='changeState_$jobID'>
                                                              $strstat
                                                            </div>"; 
                                              ?>
                                              <?php echo "<input type = 'hidden' id = 'changeid_job_$jobID' value = '$jobID'>"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "$catName"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changecatname_job_$jobID' value = \"$catName\">"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changecatid_job_$jobID' value = '$catID'>"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <font style="font-size:20px;"><?php echo "$jobName"; ?></font>
                                              <?php echo "<input type = 'hidden' id = 'changename_job_$jobID' value = \"$jobName\">"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "$jobSf%"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changesf_job_$jobID' value = \"$jobSf\">"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "$jobCola%"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changecola_job_$jobID' value = \"$jobCola\">"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "P $jobminSalary"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changeminsalary_job_$jobID' value = \"$jobminSalary\">"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <?php echo "P $jobmaxSalary"; ?>
                                              <?php echo "<input type = 'hidden' id = 'changemaxsalary_job_$jobID' value = \"$jobmaxSalary\">"; ?>
                                            </center>
                                          </td>
                                          
                                          <td>
                                             <center>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-success' id = 'job_$jobID' onclick = 'ChangeJob(this.id);' title='Edit'>
                                                  <span class = 'glyphicon glyphicon-edit' ></span></button>"; 
                                              ?>
                                              <?php 
                                                  echo "<input id='switch-state' name='my_checkbox_$jobID' type='checkbox' value='$jobID' >";
                                              ?>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-danger' id = 'job_$jobID' onclick = 'DeleteJob(this.id);' title='Delete'>
                                                  <span class = 'glyphicon glyphicon-trash' ></span></button>"; 
                                               ?>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-default' id = 'job_$jobID' onclick = 'ViewJob(this.id);' title='View'>
                                                  <span class = 'glyphicon glyphicon-zoom-in'></span></button>"; 
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
                <!-- /.col-lg-13 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<div id="view_job" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-zoom-in" style="margin-right:10px;"></span>View Details </h2>
                    </div>

                    <div style = "margin-left:10%;margin-top:10px;margin-bottom:10px;">
                        <br><br>
                        
                          <div class="form-group" readonly>
                              <div class="col-xs-10">
                                  <font style="font-size:18px;">This is the full details of..
                                    <br><br>Job ID: <font style="color:red;margin-left:6%;"><span id ="view_id"></span></font>
                                    <br>Category: <font style="color:red;margin-left:1%;"><span id ="view_job_catname"></span></font>
                                    <br>Job Title: <font style="color:red;margin-left:1%;"><span id ="view_job_name"></span></font>
                                    <br>Job Service fee: <font style="color:red;margin-left:1%;"><span id ="view_job_sf"></span>%</font>
                                    <br>Job Cola: <font style="color:red;margin-left:1%;"><span id ="view_job_cola"></span>%</font>
                                    <br>Job Min Salary per hour: <font style="color:red;margin-left:1%;">P <span id ="view_job_minsalary"></span></font>
                                    <br>Job Max Salary per hour: <font style="color:red;margin-left:1%;">P <span id ="view_job_maxsalary"></span></font>
                                    <div id='view_job_list'>
                                    </div>
                                    
                                  </font>
                              </div>
                          </div>

                          
                      </div>
              
                   <div class="modal-footer">

                      <button type="button" class="btn btn-success" data-dismiss="modal"><span class = 'glyphicon glyphicon-ok' style="margin-right:10px;"></span>OK</button>
                      
                    </div>
          
  
         </form>
    </div>
  </div>
</div>

<div id="delete_job" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_delete_job">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-trash" style="margin-right:10px;"></span>Delete message </h2>
                    </div>

                    <div style = "margin-left:10%;margin-top:10px;margin-bottom:10px;">
                        <br><br>
                        
                          <div class="form-group" readonly>
                              <div class="col-xs-10">
                                  <font style="font-size:18px;">You are about to delete the following record on the list.<br>
                                    By clicking the delete button you will delete.. <br><br>Job ID: <font style="color:red;margin-left:6%;"><span id ="delete_id"></span></font>
                                    <br>Category: <font style="color:red;margin-left:1%;"><span id ="delete_job_catname"></span></font>
                                    <br>Job Title: <font style="color:red;margin-left:1%;"><span id ="delete_job_name"></span></font>
                                    <br>Job Service fee: <font style="color:red;margin-left:1%;"><span id ="delete_job_sf"></span>%</font>
                                    <br>Job Cola: <font style="color:red;margin-left:1%;"><span id ="delete_job_cola"></span>%</font>
                                    <br>Job Min Salary per hour: <font style="color:red;margin-left:1%;">P <span id ="delete_job_minsalary"></span></font>
                                    <br>Job Max Salary per hour: <font style="color:red;margin-left:1%;">P <span id ="delete_job_maxsalary"></span></font>
                                    <div id='delete_job_list'>
                                    </div>
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
<div id="edit_job" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_edit_job">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-edit" style="margin-right:10px;"></span>Edit Job </h2>
                    </div>

                    <div style = "margin-left:10%;margin-bottom:10px;">
                        <br><br>
                        
                          <div class="form-group" readonly>
                              <div class="col-xs-10">
                                  <div id = "error-edit-select-consume" class = "panel panel-danger" hidden>
                                          <br>
                                          <panel style="font-size:15px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> You already consume the allowed number of requirement.
                                          </panel>
                                  </div>
                                  <div id = "error-edit-select-fill" class = "panel panel-danger" hidden>
                                          <br>
                                          <panel style="font-size:14px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> You must select first the drop down before proceeding.
                                          </panel>
                                  </div>
                                  <div id = "error-edit-select-option" class = "panel panel-danger" hidden>
                                          <br>
                                          <panel style="font-size:14px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> There's no item to be selected.
                                          </panel>
                                  </div>
                                  <label for = "edit_job_id">Job ID: <span id ="changing_id"></span></label>
                              </div>
                          </div>

                          <div class="form-group">
                            <div class="col-xs-10">
                                <label for = "edit_job_catid">
                                      * Category
                                </label>
                                <select id = 'edit_job_catid' class= "form-control" required>
                                              <?php 
                                                
                                                    $sql_in= mysql_query("SELECT * from job_category where Status = 0 order by Name");
                                                    
                                                   
                                                    while ($r = mysql_fetch_assoc($sql_in)){
                                                      $catID = mysql_real_escape_string($r['CategoryID']);
                                                      $catName = ucfirst(mysql_real_escape_string($r['Name']));
                                              ?>
                                                  <option value = <?php echo $catID; ?>  required><?php echo $catName; ?></option>
                                              <?php
                                                }
                                              ?>
                                </select>
                                <br>
                                <label for = "edit_job_name">
                                      * Job Title
                                </label>
                                <input type='text' maxlength='70' id = "edit_job_name" class = "form-control" placeholder = "Enter Job Title" required>
                                <br>
                                <label for = "edit_job_sf">
                                      * Service fee
                                </label>
                                <input type='text' id = "edit_job_sf" class = "form-control" placeholder = "Enter rate of Job Service fee" required>
                                <br>
                                <label for = "edit_job_cola">
                                      * Cola
                                </label>
                                <input type='text' id = "edit_job_cola" class = "form-control" placeholder = "Enter rate of Job Cola" required>
                                <br>
                                <label for = "edit_job_minsalary">
                                * Min Salary per hour
                                </label>
                                <input type='text' id = "edit_job_minsalary" class = "form-control" placeholder = "Enter Job Min Salary" required>
                                <br>
                                <label for = "edit_job_maxsalary">
                                * Max Salary per hour
                                </label>
                                <input type='text' id = "edit_job_maxsalary" class = "form-control" placeholder = "Enter Job Max Salary" required>
                                <br>
                                <div id='edit_job_list'>
                                </div>
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

<div id="add_job" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_add_job">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="fa fa-fw fa-list-alt" style="margin-right:10px;"></span>Add New Job </h2>
                    </div>
                    <div class="modal-body">
                        <div style = "margin-left:10%;margin-bottom:10px;">
                            <br><br>
                              
                              <div class="form-group" readonly>
                                  <div class="col-xs-10">
                                      <div id = "error-add-select-consume" class = "panel panel-danger" hidden>
                                          <br>
                                          <panel style="font-size:15px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> You already consume the allowed number of requirement.
                                          </panel>
                                      </div>
                                      <div id = "error-add-select-fill" class = "panel panel-danger" hidden>
                                          <br>
                                          <panel style="font-size:14px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> You must select first the drop down before proceeding.
                                          </panel>
                                      </div>
                                      <div id = "error-add-select-option" class = "panel panel-danger" hidden>
                                          <br>
                                          <panel style="font-size:14px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> There's no item to be selected.
                                          </panel>
                                      </div>
                                      <label for = "new_job_id" style='font-size:15px;'>
                                        Job ID: 
                                      </label>

                                          <?php
                                            $sql_in= mysql_query("Select * from job_title");
                                            $row = mysql_num_rows($sql_in);
                                            $row += 1;
                                            
                                          ?>
                                          
                                          <span style='font-weight:bold;margin-left:2%;'><?php echo $row;?></span>
                                          
                                  </div>
                              </div>

                              <div class="form-group">
                                <div class="col-xs-10">
                                    <label for = "new_job_catid">
                                      * Category
                                    </label>
                                    <select id = 'new_job_catid' class= "form-control" required>
                                              <option value = "" selected disabled>---- Select Category ----</option>
                                              <?php 
                                                  
                                                    $sql_in= mysql_query("SELECT * from job_category where Status = 0 order by Name");
                                                    
                                                   
                                                    while ($r = mysql_fetch_assoc($sql_in)){
                                                      $catID = mysql_real_escape_string($r['CategoryID']);
                                                      $catName = ucwords(mysql_real_escape_string($r['Name']));
                                              ?>
                                                  <option value = <?php echo $catID; ?>  required><?php echo $catName; ?></option>
                                              <?php
                                                }
                                              ?>
                                    </select>
                                    <br>
                                    <label for = "new_job_name">
                                      * Job Title
                                    </label>
                                    <input type='text' maxlength='70' id = "new_job_name" class = "form-control" placeholder = "Enter Job Title" required>
                                    <br>
                                    <label for = "new_job_sf">
                                      * Service fee
                                    </label>
                                    <input type='text' id = "new_job_sf" class = "form-control" placeholder = "Enter rate of Job Service fee" required>
                                    <br>
                                    <label for = "new_job_cola">
                                      * Cola
                                    </label>
                                    <input type='text' id = "new_job_cola" class = "form-control" placeholder = "Enter rate of Job Cola" required>
                                    <br>
                                    <label for = "new_job_minsalary">
                                      * Min Salary per hour
                                    </label>
                                    <input type='text' id = "new_job_minsalary" class = "form-control" placeholder = "Enter Job Min Salary" required>
                                    <br>
                                    <label for = "new_job_maxsalary">
                                      * Max Salary per hour
                                    </label>
                                    <input type='text' id = "new_job_maxsalary" class = "form-control" placeholder = "Enter Job Max Salary" required>
                                    <br>
                                    <input type="hidden" id="new_job_qualid" value="1" />
                                    <label class="control-label" for="new_job_qual">Job Qualification</label>   
                                                  <select id = 'new_job_qual1' name = 'new_job_qual1' class= "form-control" onchange = 'SelectValQual(this.id)' >
                                                         <option value = "" selected disabled>-----Select Default Job Qualification-----</option>
                                                            <?php 
                                                                
                                                                  $sql_in= mysql_query("SELECT * from qualification where Status = 0 order by Name");
                                                                  
                                                                  while ($r = mysql_fetch_assoc($sql_in)){
                                                                    $qualID = mysql_real_escape_string($r['QualificationID']);
                                                                    $qualName = ucwords(mysql_real_escape_string($r['Name']));
                                                            ?>
                                                          <option value = <?php echo $qualID; ?>  required><?php echo $qualName; ?></option>
                                                            <?php
                                                              }
                                                            ?>
                                                  </select>
                                                  <button id="new_job_qual_btn" style='position:relative;left:100%;top:-35px;' class="btn btn-success" ><span class="glyphicon glyphicon-plus"></span></button>
                                    <br>
                                    <input type="hidden" id="new_job_reqid" value="1" />
                                    <label class="control-label" for="new_job_req">Job Requirement</label>    
                                                  <select id = 'new_job_req1' name = 'new_job_req1' class= "form-control" onchange = 'SelectValReq(this.id)' >
                                                          <option value = "" selected disabled>-----Select Default Job Requirement-----</option>
                                                            <?php 
                                                                
                                                                  $sql_in= mysql_query("SELECT * from requirement where Status = 0 order by Name");
                                                                  
                                                                  while ($r = mysql_fetch_assoc($sql_in)){
                                                                    $reqID = mysql_real_escape_string($r['RequirementID']);
                                                                    $reqName = ucwords(mysql_real_escape_string($r['Name']));
                                                            ?>
                                                          <option value = <?php echo $reqID; ?>  required><?php echo $reqName; ?></option>
                                                            <?php
                                                              }
                                                            ?>
                                                  </select>
                                                  <button id="new_job_req_btn" style='position:relative;left:100%;top:-35px;' class="btn btn-success" ><span class="glyphicon glyphicon-plus"></span></button>
                                    <br>
                                    <input type="hidden" id="new_job_skillid" value="1" />
                                    <label class="control-label" for="new_job_skill">Job Skill</label>  
                                              <select id = 'new_job_skill1' name = 'new_job_skill1' class= "form-control" onchange = 'SelectValSkill(this.id)' >
                                                          <option value = "" selected disabled>-----Select Default Job Skill-----</option>
                                                            <?php 
                                                                
                                                                  $sql_in= mysql_query("SELECT * from skill where Status = 0 order by Name");
                                                                  
                                                                  while ($r = mysql_fetch_assoc($sql_in)){
                                                                    $skillID = mysql_real_escape_string($r['SkillID']);
                                                                    $skillName = ucwords(mysql_real_escape_string($r['Name']));
                                                            ?>
                                                          <option value = <?php echo $skillID; ?>  required><?php echo $skillName; ?></option>
                                                            <?php
                                                              }
                                                            ?>
                                              </select>
                                              <button id="new_job_skill_btn" style='position:relative;left:100%;top:-35px;' class="btn btn-success" ><span class="glyphicon glyphicon-plus"></span></button>
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
