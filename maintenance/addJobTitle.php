<?php
  session_start();
  include "../php/dbconnect.php";
  //insert validation here
  $_SESSION['skills'] = array();
  $_SESSION['req'] = array();
  $_SESSION['qualif'] = array();
?>

                  <div class = "col-md-13">
                      <div class = "panel panel-primary" style='border-radius:0px;'>
                        
                          
                            <div class = "panel-heading" >
                              <div class = "slideanim slideright">
                                  <h2 class="modal-title">&nbsp; <span class="glyphicon glyphicon-list-alt" style="margin-right:10px;font-size: 20px;"></span>Add New Job </h2>
                              </div>
                            </div>
                            <br>
                            <form class="form-horizontal" role="form" method = "POST" enctype="multipart/form-data" id = "form_add_job">
                                  <div class='panel-body'>
                                
                                    <div class="col-sm-offset-1">
                                        <div class="col-lg-4">  
                                            <label for='new_job_dept' style = "font-size: 20px;">Department:</label>
                                            <br>
                                            <select id = 'new_job_dept' class='form-control' style="border-radius:0px;border:1px solid;padding: 1%;font-size:15px;" required>
                                                <option value = "" selected disabled>--- Select Department---</option>
                                                <?php 
                                                        
                                                            $sql_in= mysql_query("SELECT d.*, b.Description from department d join business_nature b on d.BusinessNatureID = b.BusinessNatureID where (d.Status = 0 and d.Name != ' ') order by Name");
                                                            
                                                           
                                                      while ($r = mysql_fetch_assoc($sql_in)){
                                                              $deptID = mysql_real_escape_string($r['DepartmentID']);
                                                              $deptName = ucfirst(mysql_real_escape_string($r['Name']));
                                                              $busName = ucfirst(mysql_real_escape_string($r['Description']));


                                                ?>
                                                      <option value = <?php echo $deptID; ?>  required><?php echo $deptName; ?> (<?php echo $busName; ?>)</option>
                                                <?php
                                                      }
                                                ?>
                                          </select>
                                        </div>
                                        <div class="col-lg-7">
                                            <label for='new_job_name' style = "font-size: 20px;">Job Title:</label>
                                            <br>
                                            <input type = "text" placeholder="Enter Job Title" class='form-control' style="border-radius:0px;border: 1px solid;font-size: 15px;">
                                        </div>
                                        
                                        <div class="col-lg-4">
                                          <br>
                                          <label for = "new_job_sf" style = "font-size:15px;">Service Fee:</label>
                                          <br>
                                          <input type = "text" id='new_job_sf' placeholder="Enter rate of Job Service fee" class='form-control' style="border-radius:0px;border: 1px solid;font-size: 15px;">
                                        </div>

                                        <div class="col-lg-3">
                                          <br>
                                          <label for = "new_job_cola" style="font-size:15px;">Cola:</label>
                                          <br>
                                          <input type='text' maxlength='5' id = "new_job_cola" class='form-control' style="border-radius:0px;border: 1px solid;font-size: 15px;" placeholder = "Enter rate of Job Cola" required>
                                        </div>

                                        <div class="col-lg-4">
                                          <br>
                                          <label for = "new_job_salary" style="font-size:15px;">Salary:</label>
                                          <br>
                                          <input type='text' maxlength='11' id = "new_job_salary" class='form-control' style="border-radius:0px;border: 1px solid;font-size: 15px;" placeholder = "Enter Job Salary" required> 
                                        </div>

                                        <div class="col-lg-11">
                                          <br>
                                          <fieldset>
                                            <legend>Qualifications:</legend>
                                              <div class="col-lg-5">
                                                <label for='new_job_eduid'>Educational Level:</label>
                                                <br>
                                                <select id='new_job_eduid' class='form-control' style="border-radius:0px;border:1px solid;padding: 1%;font-size:15px;">
                                                  <option value = "" selected disabled>--- Select Education Level---</option>
                                                  <option value = "0" >College Degree</option>
                                                  <option value = "1" class = "form-control">High School Graduate</option>
                                                  <option value = "2" class = "form-control">Masteral Degree</option>
                                                </select>
                                              </div>

                                              <div class="col-lg-7">
                                                <label for='new_job_course'>Course</label>
                                                <br>
                                                <select id = "new_job_course" class='form-control' style = "border-radius:0px;border:1px solid;padding: 1%;font-size:15px;">
                                                    <option value = "" selected disabled>--- Select Course---</option>
                                                    <?php
                                                      $sql_in= mysql_query("select * from course where status = 0 order by Name");
                                                      while ($r = mysql_fetch_assoc($sql_in)){
                                                              $cID = mysql_real_escape_string($r['CourseID']);
                                                              $courseName = ucfirst(mysql_real_escape_string($r['Name']));


                                                    ?>
                                                      <option value = <?php echo $cID; ?>  required><?php echo $courseName; ?> </option>
                                                    <?php
                                                      }
                                                    ?>
                                                  </select>
                                              </div>
                                              <div class="col-lg-5">
                                                <br>
                                                <label for='new_job_qualid'>Qualification Name</label>
                                                <br>
                                                <select id = "new_job_qualid" class='form-control' style = "border-radius:0px;border:1px solid;padding: 1%;font-size:15px;">
                                                    <option value = "" selected disabled>--- Select Qualification Name---</option>
                                                    <?php
                                                      $sql_in= mysql_query("select * from qualification where status = 0 order by Name");
                                                      while ($r = mysql_fetch_assoc($sql_in)){
                                                              $qualID = mysql_real_escape_string($r['QualificationID']);
                                                              $qualName = ucfirst(mysql_real_escape_string($r['Name']));


                                                    ?>
                                                      <option value = <?php echo $qualID; ?>  required><?php echo $qualName; ?> </option>
                                                    <?php
                                                      }
                                                    ?>
                                                </select>
                                              </div>
                                              <div class="col-lg-7">
                                                <br>
                                                <label for='new_job_qualdesc'>Qualification Description</label>
                                                <br>
                                                <select id = "new_job_qualdesc" class='form-control' style = "border-radius:0px;border:1px solid;padding: 1%;font-size:15px;">
                                                    <option value = "" selected disabled>--- Select Qualification Description---</option>
                                                </select>
                                              </div>
                                              <div class="col-lg-6">
                                                <br>
                                                <label for='new_job_skill'>Skill</label>
                                                <br>
                                                <select id = "new_job_skill" class='form-control' style = "border-radius:0px;border:1px solid;padding: 1%;font-size:15px;">
                                                    <option value = "" selected disabled>--- Select Skill---</option>
                                                </select>
                                              </div>
                                              <div class="col-lg-6">
                                                <br>
                                                <label for='new_job_reqid'>Requirement Name</label>
                                                <br>
                                                <select id = "new_job_reqid" class='form-control' style = "border-radius:0px;border:1px solid;padding: 1%;font-size:15px;">
                                                    <option value = "" selected disabled>--- Select Requirement Name---</option>
                                                    <?php
                                                      $sql_in= mysql_query("select * from requirement where status = 0 order by Name");
                                                      while ($r = mysql_fetch_assoc($sql_in)){
                                                              $reqID = mysql_real_escape_string($r['RequirementID']);
                                                              $reqName = ucfirst(mysql_real_escape_string($r['Name']));

                                                    ?>
                                                      <option value = <?php echo $reqID; ?>  required><?php echo $reqName; ?> </option>
                                                    <?php
                                                      }
                                                    ?>
                                                </select>
                                              </div>
                                        </fieldset>
                                        <br>
                                        <fieldset>
                                          <legend>Additional Qualifications:</legend>
                                            <div class="col-lg-6">
                                              <fieldset>
                                                <legend>Age Requirement:</legend>
                                                  <div class="col-sm-offset-2">
                                                    <div class="col-lg-4">
                                                      <label>Minimum:</label>
                                                      <br>
                                                      <input type="number" id='new_job_agemin' class='form-control' style = "border-radius:0px;border: 1px solid;font-size: 15px;">
                                                    </div>
                                                    <div class="col-lg-4">
                                                      <label>Maximum: </label>
                                                      <br>
                                                      <input type="number" id='new_job_agemax' class='form-control' style = "border-radius:0px;border: 1px solid;font-size: 15px;">
                                                    </div>
                                                  </div>
                                              </fieldset>
                                            </div>
                                            <div class="col-lg-6">
                                              <fieldset>
                                                <legend>Height Requirement (cm):</legend>
                                                  <div class="col-sm-offset-2">
                                                    <div class="col-lg-4">
                                                      <label>Minimum:</label>
                                                      <br>
                                                      <input type="number" id='new_job_heightmin' class='form-control' style = "border-radius:0px;border: 1px solid;font-size: 15px;">
                                                    </div>
                                                    <div class="col-lg-4">
                                                      <label>Maximum: </label>
                                                      <br>
                                                      <input type="number" id='new_job_heightmax' class='form-control' style = "border-radius:0px;border: 1px solid;font-size: 15px;">
                                                    </div>
                                                  </div>
                                                  
                                              </fieldset>
                                            </div>
                                        </fieldset>
                                        <br><br>
                                      </div>
                                  </div>
                                  
                                  <div class="col-sm-offset-1">
                                      <input type="submit" class="btn btn-success" value="Add" name="submit"/>
                                      <button type="reset" class="btn btn-info" ><span class = 'fa fa-fw fa-eraser' style="margin-right:10px;"></span>Clear</button>
                                      <button type="reset" class="btn btn-danger" data-dismiss="modal"><span class = 'glyphicon glyphicon-remove' style="margin-right:10px;"></span>Cancel</button>
                                  </div>
                                  
                              </div>
                          </form>  
                      </div>

               </div>
       
<script>
    $("#new_job_dept").change(function() {
    $("#skill").load("getskill.php?d=" + $("#new_job_dept").val());
    });

    function addQualifications(val) 
      {
        if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code function() {}or IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("tQualif").innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET","qualifications.php?&q="+val,true);
            xmlhttp.send();
            alert(responseText);
      }

      function addSkills(val) 
      {
        if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("tSkill").innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET","skills.php?&s="+val,true);
            xmlhttp.send();
      }

      function addRequirements(val) 
      {
        if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("tReq").innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET","requirements.php?&r="+val,true);
            xmlhttp.send();
      }
      function removeReq(id)
      {
        if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("tReq").innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET","removerequirements.php?&r="+id,true);
            xmlhttp.send();

      }
       function removeQua(id)
      {
        if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("tQualif").innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET","removequalifications.php?&q="+id,true);
            xmlhttp.send();

      } 
      function removeSkill(id)
      {
        if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("tSkill").innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET","removeskills.php?&s="+id,true);
            xmlhttp.send();

      }
</script>

</body>
</html>
