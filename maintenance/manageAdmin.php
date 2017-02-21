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
	

		<title>Admin | User Admin</title>

		<link href="../bootstrap1/css/bootstrap.css" rel="stylesheet">
    <link href="../bootstrap1/css/dataTables.bootstrap.css" rel="stylesheet" media="screen">

    <link href="../bootstrap1/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap1/css/sb-admin.css" rel="stylesheet">

    <link href="../css/main.css" rel="stylesheet">
    <link href="../semantic/out/semantic.css" rel="stylesheet">

    <link href="../bootstrap1/css/custom_bootstrap_animation.css" rel="stylesheet">
    <link href="../bootstrap1/css/bootstrap-switch.css" rel="stylesheet">

    <link rel="stylesheet" href="../bootstrap1/bootstrap-fileinput-4.3.4/css/fileinput.css" media="screen">
   
    <script src="../bootstrap1/js/jquery-1.11.3.js"></script>
    <script src="../bootstrap1/js/bootstrap.min.js"></script>

    <script src="../bootstrap1/js/jquery.dataTables.js"></script>
    <script src="../bootstrap1/js/dataTables.bootstrap.js"></script>

    <script src="../bootstrap1/js/bootstrap-switch-highlight.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch.js"></script>

    <script src="../bootstrap1/js/bootstrap-switch-main.js"></script>
    <script src="../bootstrap/bootstrap-fileinput-4.3.4/js/plugins/canvas-to-blob.min.js"></script>

    <script src="../bootstrap1/bootstrap-fileinput-4.3.4/js/plugins/purify.min.js"></script> 
    <script src="../bootstrap1/bootstrap-fileinput-4.3.4/js/plugins/sortable.min.js"></script> 

    <script src="../bootstrap1/bootstrap-fileinput-4.3.4/js/fileinput.min.js"></script>

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

                    var dataString = "cid=" + id + "&";
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

                $("#new_am_img").fileinput({
                    uploadUrl: "upload.php",
                    uploadExtraData: {amid: $('#new_am_id').val()},
                    allowedFileExtensions: ["jpg", "JPG", "jpeg", "JPEG", "png", "PNG"],
                    removeFromPreviewOnError: true,
                    browseOnZoneClick: true,
                    showCaption: false,
                    showBrowse: false,
                    showClose: false,
                    showUpload: false,
                    showRemove: false,
                    minFileCount: 1,
                    maxFileCount: 1,
                    resizeImage: true,
                    overwriteInitial: false,
                    dropZoneTitle: 'Drag and Drop Image here &hellip;',
                    initialPreviewAsData: true

                }).on('fileuploaded', function(event, data, previewId, index){
                     $('#new_am_img_status').val(data.response.initialPreview);

                });


                $('#form_add_am').on("submit" , function(e){
                  var amImg = $('#new_am_img_status').val();
                  var amFName = $('#new_am_fname').val();
                  var amMName = $('#new_am_mname').val();
                  var amLName = $('#new_am_lname').val();
                  var amAddress = $('#new_am_address').val();
                  var amUser = $('#new_am_user').val();
                  var amRoleId = $('#new_am_roleid').val();
                  var amPass = $('#new_am_pass').val();
                  var err_val = '';

                      if(!amMName){
                        amMName = 'N/A';
                      }


                      err_val = fnvalidate(err_val, amImg, amFName, amMName, amLName, amUser, amPass, amAddress, isAlpha, isAlphanumeric);
                      
                      if(!err_val){
                        var dataString = "amimg=" + amImg + '&';
                            dataString += "amfname=" + amFName + '&';
                            dataString += "ammname=" + amMName + '&';
                            dataString += "amlname=" + amLName + '&';
                            dataString += "amaddress=" + amAddress + '&';
                            dataString += "amuser=" + amUser + '&';
                            dataString += "amroleid=" + amRoleId + '&';
                            dataString += "ampass=" + amPass;
                                 
                            $.ajax({
                                type: "POST",
                                url: "add_am.php",
                                data: dataString,
                                cache: false,
                                success: function(response){
                                  alert(response);
                                  if(response.trim() == "inserted"){
                                    $("#success-add-record").show().delay(5000).fadeOut();
                                    window.setTimeout(function(){location.reload()},500);
                                  }
                                  else if(response.trim() == "exist"){
                                    $("#error-exist").show().delay(5000).fadeOut();
                                  }
                                  else if(response.trim() == "user_exist"){
                                    $("#error-amuserpass").show().delay(5000).fadeOut();
                                  }
                                    $("#add_am").modal('hide');
                                  }
                                });
                        }
                        else{
                          for(var i = 0;i < err_val.length; i++){
                                fnError(err_val[i]);
                          }
                          $("#add_am").modal('hide');
                        }
                
                return false;
                  
                });

                

        //insert edit ajax
                $('#form_edit_am').on("submit" , function(e){
                   
                    var id = $('#changing_id').text();
                    var amImg = $('#edit_am_img_status').val();
                    var amFName = $('#edit_am_fname').val();
                    var amMName = $('#edit_am_mname').val();
                    var amLName = $('#edit_am_lname').val();
                    var amAddress = $('#edit_am_address').val();
                    var amUser = $('#edit_am_user').val();
                    var amRoleid = $('#edit_am_roleid').val();
                    var amPass = $('#edit_am_pass').val();
                    var err_val = '';

                      if(!amMName){
                        amMName = 'N/A';
                      }
                      err_val = fnvalidate(err_val, amImg, amFName, amMName, amLName, amUser, amPass, amAddress, isAlpha, isAlphanumeric);
                   
                            if(!err_val){
                                  var dataString = "id=" + id + "&";
                                      dataString += "amimg=" + amImg + "&";
                                      dataString += "amfname=" + amFName + "&";
                                      dataString += "ammname=" + amMName + "&";
                                      dataString += "amlname=" + amLName + "&";
                                      dataString += "amaddress=" + amAddress + '&';
                                      dataString += "amuser=" + amUser + '&';
                                      dataString += "amroleid=" + amRoleid + '&';
                                      dataString += "ampass=" + amPass;

                                        $.ajax({
                                            type: "POST",
                                            url: "edit_am.php",
                                            data: dataString,
                                            cache: false,
                                            success: function(response){
                                              $('#am_list').html(response);
                                              $("#edit_am").modal('hide');
                                            }
                                          });
                            }
                            else{
                              for(var i = 0;i < err_val.length; i++){
                                fnError(err_val[i]);
                              }
                              $("#edit_am").modal('hide');
                            }

                  return false;
                    
                    
                  });

          //delete ajax
                 $('#form_delete_am').on("submit" , function(e){
                   
                  var id = $('#delete_id').text();
                  var dataString = "id=" + id;
                    
                    $.ajax({
                      type: "POST",
                      url: "delete_am.php",
                      data: dataString,
                      cache: false,
                      success: function(response){
                      $("#delete_am").modal('hide');
                      $('#am_list').html(response);

                      }
                    });
                  
                  return false;
                    
                    
                  });
       });
              
              function fnvalidate(err_val, amImg, amFname, amMName, amLName, amUser, amPass, amAddress, isAlpha, isAlphanumeric){
                  if(!amImg){
                          err_val += '0';
                  }
                  if(checker(amFname, isAlpha) == true){
                          err_val += '1';
                  }

                  if(amMName != 'N/A' && checker(amMName, isAlpha) == true){
                          err_val += '2';
                  }

                 if(checker(amLName, isAlpha) == true){
                          err_val += '3';
                  }

                  if(checker(amUser, isAlphanumeric) == true){
                          err_val += '4';
                  }

                  if(checker(amPass, isAlphanumeric) == true){
                          err_val += '5';
                  }
                  if(checker(amAddress, isAlphanumeric) == true){
                          err_val += '6';
                  }
                  return err_val;
              }

              function fnError(error){
                if(error == '0'){
                    $("#error-amimg").show().delay(5000).fadeOut();
                }
                if(error == '1'){
                    $("#error-amfname").show().delay(5000).fadeOut();
                }
                if(error == '2'){
                    $("#error-ammname").show().delay(5000).fadeOut();
                }
                if(error == '3'){
                    $("#error-amlname").show().delay(5000).fadeOut();
                }
                if(error == '4'){
                    $("#error-amusername").show().delay(5000).fadeOut();
                }
                if(error == '5'){
                    $("#error-ampass").show().delay(5000).fadeOut();
                }
                if(error == '6'){
                    $("#error-amaddress").show().delay(5000).fadeOut();
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

              function isAlpha(str) {
                        return /[a-zA-Z-' ]+$/.test(str);
                  }
              function isAlphanumeric(str) {
                        return /[a-zA-Z0-9.!@#$%^&*() ']+$/.test(str);
                  }

              function ChangeAM(aID){
                    var change_id = $('#changeid_' + aID).val();
                    var change_img_loc = $('#changeimg_' + aID).val();
                    var change_img_fname = $('#changeimg_' + aID).val().replace('admin/' + change_id + '/','')

                    var dataString = 'editid=' + change_id + '&';
                        dataString += 'editimgloc=' + change_img_loc + '&';
                        dataString += 'editimgfname=' + change_img_fname;

                    $.ajax({
                          type: "POST",
                          url: "edit_account_img.php",
                          data: dataString,
                          cache: false,
                          success: function(response){
                          $('#edit_img').html(response);
                        }
                    });


                    $('#changing_id').text($('#changeid_' + aID).val());
                    $('#edit_am_fname').val($('#changefname_' + aID).val());
                    $('#edit_am_mname').val($('#changemname_' + aID).val());
                    $('#edit_am_lname').val($('#changelname_' + aID).val());
                    $('#edit_am_address').val($('#changeaddress_' + aID).val());
                    $('#edit_am_user').val($('#changeauser_' + aID).val());
                    $('#edit_am_pass').val($('#changepass_' + aID).val());
                    $('#edit_am_roleid').val($('#changeroleid_' + aID).val());
                    $('#edit_am_img_status').val(change_img_loc);
                    $('#edit_am').modal('show');
                     
                  }

                function DeleteAM(aID){
                  var img = $('#changeimg_' + aID).val();
                  var dataString = 'image=' + img;
                  $.ajax({
                      type: "POST",
                      url: "delete_account_img.php",
                      data: dataString,
                      cache: false,
                      success: function(response){
                      $('#delete_am_img').html(response);
                      }
                  });
                  $('#delete_id').text($('#changeid_' + aID).val());
                  $('#delete_am_fname').text($('#changefname_' + aID).val());
                  $('#delete_am_mname').text($('#changemname_' + aID).val());
                  $('#delete_am_lname').text($('#changelname_' + aID).val());
                  $('#delete_am_address').text($('#changeaddress_' + aID).val());
                  $('#delete_am_user').text($('#changeauser_' + aID).val());
                  $('#delete_am_pass').text($('#changepasslen_' + aID).val());
                  $('#delete_am_rolename').text($('#changerolename_' + aID).val());
                  $('#delete_am').modal('show');
                  
                }

      </script>
	</head>

	
		<!-- Navigation -->


<body>
<?php
  include "../Navigation/nav_maintenance.php";
?>
        <br><br><br><br>
        <div id="page-wrapper">
            <div class="row">
                  <div class = "col-lg-13">
                      <div class = "panel panel-primary" style='border-radius:0px;'>
                            <div class = "panel-heading" >
                              <div class = "slideanim slideright">
                                  <span class = "panel-title" style = "line-height:2;border-bottom-color:black;">
                                        <span style = "font-size:30px;" class = "slideanim slidetop" title = "User Admin that will manage both client and staff"> Manage User Admin
                                        </span>
                                        <span style="position:relative;margin-left:9%;top:15px;font-size:15px;">*This page will let you to manage agency's User Admin.
                                        </span> 
                                        <span class = "pull-right" style='position:relative;top:40px;'><a href = "#" data-toggle = "modal" data-target = "#add_am" class = "btn btn-raised btn-success"> <span class = "glyphicon glyphicon-plus"></span> Add New</a> 
                                        </span>
                                    </span>
                                  
                              </div>
                            </div>

                            
                            <div id = "error-amfname" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You entered a not acceptable keys on First Name.
                                </panel>
                            </div>
                            <div id = "error-ammname" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You entered a not acceptable keys on Middle Name.
                                </panel>
                            </div>
                            <div id = "error-amlname" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You entered a not acceptable keys on Last Name.
                                </panel>
                            </div>
                            <div id = "error-amusername" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You entered a not acceptable keys on User Name.
                                </panel>
                            </div>
                            <div id = "error-ampass" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You entered a not acceptable keys on Password.
                                </panel>
                            </div>
                            <div id = "error-amaddress" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You entered a not acceptable keys on Address.
                                </panel>
                            </div>
                            <div id = "error-amimg" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Attention: You must upload first the Image.
                                </panel>
                            </div>
                            <div id = "error-exist" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Data already exist.
                                </panel>
                            </div>
                            <div id = "error-amuserpass" class = "panel panel-danger" hidden>
                                <br>
                                <panel style="font-size:25px;margin-left:2%;color:red;"><span class="glyphicon glyphicon-alert"></span> Username already exist.
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

                            <div class = "panel-body" id = "am_list">
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

                                      $query = mysql_query("Select a.*, r.Name as RName from user_admin a join user_role r on a.RoleID = r.RoleID where a.Status != 3");
                                      
                                      while($res = mysql_fetch_assoc($query)){
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
                                          echo "<script>
                                                  $(function(){
                                                    $(document).ready(function(){
                                                      $('input[name=my_checkbox_$aID]').bootstrapSwitch('state', true, true);
                                                    })
                                                      
                                                  });
                                                    </script>";
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
                                                  echo "<input id='switch-state' name='my_checkbox_$aID' type='checkbox' value='$aID' >";
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

<div id="delete_am" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_delete_am">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-trash" style="margin-right:10px;"></span>Delete message </h2>
                    </div>

                    <div style = "margin-left:10%;margin-top:10px;margin-bottom:10px;">
                        <br><br>
                        
                          <div class="form-group" readonly>
                              <div class="col-xs-10">
                                  <font style="font-size:18px;">You are about to delete the following record on the list.<br>
                                    By clicking the delete button you will delete.. <br><br>User ID: <font style="color:red;margin-left:6%;"><span id ="delete_id"></span></font>
                                    <div id='delete_am_img'>
                                    </div>
                                    <br>Name: <font style="color:red;margin-left:1%;"><span id ="delete_am_lname"></span>, <span id ="delete_am_fname"></span> <span id ="delete_am_mname"></span></font>
                                    <br>Address: <font style="color:red;margin-left:1%;"><span id ="delete_am_address"></span></font>
                                    <br>Username: <font style="color:red;margin-left:1%;"><span id ="delete_am_user"></span></font>
                                    <br>Password: <font style="color:red;margin-left:1%;"><span id ="delete_am_pass"></span></font>
                                    <br>Role Name: <font style="color:red;margin-left:1%;"><span id ="delete_am_rolename"></span></font>
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
<div id="edit_am" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_edit_am">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-edit" style="margin-right:10px;"></span>Edit User Admin </h2>
                    </div>

                    <div style = "margin-left:10%;margin-bottom:10px;">
                        <br><br>
                        
                          <div class="form-group" readonly>
                              <div class="col-xs-10">
                                  <label for = "edit_qual_id">User ID: <span id ="changing_id"></span></label>
                              </div>
                          </div>

                          <div class="form-group">
                            <div class="col-xs-10">
                                <label for = "edit_am_img">
                                        * Image
                                </label>
                                <br>
                                <div id='edit_img'>
                                </div>
                                <input type='text' id="edit_am_img_status" hidden>
                                <br>
                                <label for = "edit_am_fname">
                                  * First Name
                                </label>
                                <input type='text' maxlength='30' id = "edit_am_fname" class = "form-control" placeholder = "Enter First Name" required>
                                <br>
                                <label for = "edit_am_mname">
                                  Middle Name
                                </label>
                                <input type='text' maxlength='30' id = "edit_am_mname" class = "form-control" placeholder = "Enter Middle Name" >
                                <br>
                                <label for = "edit_am_lname">
                                  * Last Name
                                </label>
                                <input type='text' maxlength='30' id = "edit_am_lname" class = "form-control" placeholder = "Enter Last Name" required>
                                <br>
                                <label for = "edit_am_address">
                                  * Address
                                </label>
                                <input type='text' maxlength='100' id = "edit_am_address" class = "form-control" placeholder = "Enter Address" required>
                                <br>
                                <label for = "edit_am_user">
                                  * User
                                </label>
                                <input type='text' maxlength='15' id = "edit_am_user" class = "form-control" placeholder = "Enter User" required>
                                <br>
                                <label for = "edit_am_pass">
                                  * Password
                                </label>
                                <input type='password' maxlength='15' id = "edit_am_pass" class = "form-control" placeholder = "Enter Password" required>
                                <br>
                                <label for = "edit_am_roleid">
                                  * Role Name
                                </label>
                                <select id = 'edit_am_roleid' class= "form-control" required>
                                              <?php 
                                                
                                                    $sql_in= mysql_query("SELECT * from user_role where Status = 0 order by Name");
                                                    
                                                   
                                                    while ($r = mysql_fetch_assoc($sql_in)){
                                                      $roleID = mysql_real_escape_string($r['RoleID']);
                                                      $roleName = ucfirst(mysql_real_escape_string($r['Name']));

                                              ?>
                                                  <option value = <?php echo $roleID; ?>  required><?php echo $roleName; ?></option>
                                              <?php
                                                }
                                              ?>
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

<div id="add_am" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
          <form class="form-horizontal" role="form" action = "" method = "POST" enctype="multipart/form-data" id = "form_add_am">
               
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-user" style="margin-right:10px;"></span>Add New User Admin </h2>
                    </div>
                    <div class="modal-body">
                        <div style = "margin-left:10%;margin-bottom:10px;">
                            
                            <br><br>
                            
                              <div class="form-group" readonly>
                                  <div class="col-xs-10">
                                      <label for = "new_am_id" style='font-size:15px;'>
                                        User ID: 
                                      </label>

                                          <?php
                                            $sql_in= mysql_query("Select * from user_admin");
                                            $row = mysql_num_rows($sql_in);
                                            $row += 1;
                                          ?>
                                          <span style='font-weight:bold;margin-left:2%;' ><?php echo $row;?></span>
                                          <?php echo "<input type='text' id='new_am_id' value='$row' hidden>";?>
                                  </div>
                              </div>

                              <div class="form-group">
                                <div class="col-xs-10">
                                    <label for = "new_am_img">
                                        * Image
                                    </label>
                                    <br>
                                    <input id="new_am_img" name='upload_name[]' type="file" class='file-loading' accept="image/*" data-preview-file-type="text">
                                    <input id="new_am_img_status" type="text" hidden>
                                    <br>
                                    <label for = "new_am_fname">
                                      * First Name
                                    </label>
                                    <input type='text' maxlength='30' id = "new_am_fname" class = "form-control" placeholder = "Enter First Name" required>
                                    <br>
                                    <label for = "new_am_mname">
                                        Middle Name
                                    </label>
                                    <input type='text' maxlength='30' id = "new_am_mname" class = "form-control" placeholder = "Enter Middle Name" >
                                    <br>
                                    <label for = "new_am_lname">
                                      * Last Name
                                    </label>
                                    <input type='text' maxlength='30' id = "new_am_lname" class = "form-control" placeholder = "Enter Last Name" required>
                                    <br>
                                    <label for = "new_am_address">
                                      * Address
                                    </label>
                                    <input type='text' maxlength='100' id = "new_am_address" class = "form-control" placeholder = "Enter Address" required>
                                    <br>
                                    <label for = "new_am_user">
                                      * User
                                    </label>
                                    <input type='text' maxlength='15' id = "new_am_user" class = "form-control" placeholder = "Enter User" required>
                                    <br>
                                    <label for = "new_am_pass">
                                      * Password
                                    </label>
                                    <input type='password' maxlength='15' id = "new_am_pass" class = "form-control" placeholder = "Enter Password" required>
                                    <br>
                                    <label for = "new_am_roleid">
                                      * Role Name
                                    </label>
                                    <select id = 'new_am_roleid' class= "form-control" required>
                                              <option value = "" selected disabled>--- Select Role ---</option>
                                              <?php 
                                                
                                                    $sql_in= mysql_query("SELECT * from user_role where Status = 0 order by Name");
                                                    
                                                   
                                                    while ($r = mysql_fetch_assoc($sql_in)){
                                                      $roleID = mysql_real_escape_string($r['RoleID']);
                                                      $roleName = ucfirst(mysql_real_escape_string($r['Name']));

                                              ?>
                                                  <option value = <?php echo $roleID; ?>  required><?php echo $roleName; ?></option>
                                              <?php
                                                }
                                              ?>
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
