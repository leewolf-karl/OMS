var reqEndSelect = false;
var qualEndSelect = false;
var editQualEndSelect = false;
var skillEndSelect = false;
$(function(){
                var addReqNext = 1;
                var addReqPrev = 1;
                $("#new_job_req_btn").click(function(e){
                    e.preventDefault();
                    var countHold = $("#new_job_reqid").val(); 
                    var ifGet = false;
                    var ifFind = false;
                 

                    if(!reqEndSelect){
                      if($('#new_job_req' + addReqPrev).val()){
                        if(countHold.length < 9){
                          var addto = "#new_job_req" + addReqPrev;
                          var addRemove = "#new_job_req" + addReqPrev;
                          addReqNext = addReqNext + 1;
                          var ctr = 0;
                          var i = 1;
                         
                          while(ifGet == false){
                              while(ifFind == false){
                                  if(i <= countHold.length){
                                      if(i == countHold[ctr]){
                                        ifFind = true;
                                      }
                                      else{
                                        if(ctr < countHold.length - 1){
                                          ctr++;
                                        }
                                        else{
                                          ifFind = true;
                                          ifGet = true;
                                          addReqNext = i;
                                        }
                                      }
                                  }
                                  else{
                                    ifFind = true;
                                    ifGet = true;
                                    addReqNext = i;
                                  }
                              }
                                  ctr = 0;
                                  ifFind = false;
                                  i++;
                          }
                          
                          var addField = FieldReq('new_job_req', addReqNext, addReqPrev);
                          var newIn = addField.newIn;
                          var removeBtn = addField.removeBtn;
                          $(addto).after(newIn);
                          $(addRemove).after(removeBtn);
                          $("#new_job_req" + addReqNext).attr('data-source',$(addto).attr('data-source'));
                          $("#new_job_reqid").val($("#new_job_reqid").val() + addReqNext); 
                          addReqPrev = addReqNext;
                        }
                        else{
                          $("#error-add-select-consume").show().delay(5000).fadeOut();
                        }
                      }
                      else{
                        $("#error-add-select-fill").show().delay(5000).fadeOut();
                      }
                    }
                    else{
                        $("#error-add-select-option").show().delay(5000).fadeOut();
                    }
                    
                        $('.remove-me').click(function(e){
                            e.preventDefault();
                            var fieldNum = this.id.charAt(this.id.length-1);
                            var fieldID = "#new_job_req" + fieldNum;
                            var valHold = "";
                            var countHold = $("#new_job_reqid").val(); 
                            var ifLast = false;
                            while(ifLast==false){
                              for(var i=0;i<countHold.length;i++){
                                if(i + 1 == countHold.length){
                                    if(countHold[i] != fieldNum){
                                        valHold += countHold[i];
                                    }
                                  ifLast = true;
                                }
                                else{
                                  if(countHold[i] != fieldNum){
                                      valHold += countHold[i];
                                  }
                                }
                              }
                            }
                            $("#new_job_reqid").val(valHold);
                            $(this).remove();
                            $(fieldID).remove();
                            SelectValReq("new_job_req");
                            reqEndSelect = false;
                        });
                });

                var addQualNext = 1;
                var addQualPrev = 1;
                $("#new_job_qual_btn").click(function(e){
                    e.preventDefault();
                    countHold = $("#new_job_qualid").val(); 
                    ifGet = false;
                    ifFind = false;
                 
                    if(!qualEndSelect){
                      if($('#new_job_qual' + addQualPrev).val()){
                        if(countHold.length < 9){
                          addto = "#new_job_qual" + addQualPrev;
                          addRemove = "#new_job_qual" + addQualPrev;
                          addQualNext = addQualNext + 1;
                          ctr = 0;
                          i = 1;
                         
                          while(ifGet == false){
                              while(ifFind == false){
                                  if(i <= countHold.length){
                                      if(i == countHold[ctr]){
                                        ifFind = true;
                                      }
                                      else{
                                        if(ctr < countHold.length - 1){
                                          ctr++;
                                        }
                                        else{
                                          ifFind = true;
                                          ifGet = true;
                                          addQualNext = i;
                                        }
                                      }
                                  }
                                  else{
                                    ifFind = true;
                                    ifGet = true;
                                    addQualNext = i;
                                  }
                              }
                                  ctr = 0;
                                  ifFind = false;
                                  i++;
                          }
                          
                          addField = FieldQual('new_job_qual', addQualNext, addQualPrev);
                          newIn = addField.newIn;
                          removeBtn = addField.removeBtn;
                          $(addto).after(newIn);
                          $(addRemove).after(removeBtn);
                          $("#new_job_qual" + addQualNext).attr('data-source',$(addto).attr('data-source'));
                          $("#new_job_qualid").val($("#new_job_qualid").val() + addQualNext); 
                          addQualPrev = addQualNext;
                        }
                        else{
                          $("#error-add-select-consume").show().delay(5000).fadeOut();
                        }
                      }
                      else{
                        $("#error-add-select-fill").show().delay(5000).fadeOut();
                      }
                    }
                    else{
                        $("#error-add-select-option").show().delay(5000).fadeOut();
                    }
                    
                        $('.remove-me').click(function(e){
                            e.preventDefault();
                            fieldNum = this.id.charAt(this.id.length-1);
                            fieldID = "#new_job_qual" + fieldNum;
                            valHold = "";
                            countHold = $("#new_job_qualid").val(); 
                            ifLast = false;
                            while(ifLast==false){
                              for(var i=0;i<countHold.length;i++){
                                if(i + 1 == countHold.length){
                                    if(countHold[i] != fieldNum){
                                        valHold += countHold[i];
                                    }
                                  ifLast = true;
                                }
                                else{
                                  if(countHold[i] != fieldNum){
                                      valHold += countHold[i];
                                  }
                                }
                              }
                            }
                            $("#new_job_qualid").val(valHold);
                            $(this).remove();
                            $(fieldID).remove();
                            SelectValQual("new_job_qual");
                            qualEndSelect = false;
                        });

                });
                var editQualNext = 1;
                var editQualPrev = 1;
                $("#edit_job_qual_btn").click(function(e){
                    e.preventDefault();
                    countHold = $("#edit_job_qualid").val(); 

                    ifGet = false;
                    ifFind = false;
                 
                    if(!qualEndSelect){
                      if($('#edit_job_qual' + editQualPrev).val()){
                        if(countHold.length < 9){
                          addto = "#edit_job_qual" + editQualPrev;
                          addRemove = "#edit_job_qual" + editQualPrev;
                          editQualNext = editQualNext + 1;
                          ctr = 0;
                          i = 1;
                         
                          while(ifGet == false){
                              while(ifFind == false){
                                  if(i <= countHold.length){
                                      if(i == countHold[ctr]){
                                        ifFind = true;
                                      }
                                      else{
                                        if(ctr < countHold.length - 1){
                                          ctr++;
                                        }
                                        else{
                                          ifFind = true;
                                          ifGet = true;
                                          editQualNext = i;
                                        }
                                      }
                                  }
                                  else{
                                    ifFind = true;
                                    ifGet = true;
                                    editQualNext = i;
                                  }
                              }
                                  ctr = 0;
                                  ifFind = false;
                                  i++;
                          }
                          
                          addField = FieldQual('edit_job_qual', editQualNext, editQualPrev);
                          newIn = addField.newIn;
                          removeBtn = addField.removeBtn;
                          $(addto).after(newIn);
                          $(addRemove).after(removeBtn);
                          $("#edit_job_qual" + editQualNext).attr('data-source',$(addto).attr('data-source'));
                          $("#edit_job_qualid").val($("#edit_job_qualid").val() + editQualNext); 
                          editQualPrev = editQualNext;
                        }
                        else{
                          $("#error-edit-select-consume").show().delay(5000).fadeOut();
                        }
                      }
                      else{
                        $("#error-edit-select-fill").show().delay(5000).fadeOut();
                      }
                    }
                    else{
                        $("#error-edit-select-option").show().delay(5000).fadeOut();
                    }
                    
                      $('.remove-me').click(function(e){
                            e.preventDefault();
                            fieldNum = this.id.charAt(this.id.length-1);
                            fieldID = "#edit_job_qual" + fieldNum;
                            valHold = "";
                            countHold = $("#edit_job_qualid").val(); 
                            ifLast = false;
                            while(ifLast==false){
                              for(var i=0;i<countHold.length;i++){
                                if(i + 1 == countHold.length){
                                    if(countHold[i] != fieldNum){
                                        valHold += countHold[i];
                                    }
                                  ifLast = true;
                                }
                                else{
                                  if(countHold[i] != fieldNum){
                                      valHold += countHold[i];
                                  }
                                }
                              }
                            }
                            $("#edit_job_qualid").val(valHold);
                            $(this).remove();
                            $(fieldID).remove();
                            SelectValQual("edit_job_qual");
                            qualEndSelect = false;
                        });

                });

                $("#edit_job_qual_btn2").click(function(e){
                    e.preventDefault();
                    countHold = $("#edit_job_qualid").val(); 

                    ifGet = false;
                    ifFind = false;

                    CheckSelectValQual();
                    var fieldVal = valueTransfer(countHold, '#edit_job_qual');
                
                    if(fieldVal.length == 1 && qualValues != ""){
                      editQualPrev = countHold;
                    }
                    else{
                      editQualPrev = fieldVal.length;
                    }
                    alert(qualValues);
                    if(qualValues == ""){
                      qualEndSelect = true;
                    }
                    else{
                       qualEndSelect = false;
                    }
                    
              
                    if(!qualEndSelect){
                      if($('#edit_job_qual' + editQualPrev).val()){
                        if(countHold.length < 9){
                          addto = "#edit_job_qual" + editQualPrev;
                          addRemove = "#edit_job_qual" + editQualPrev;
                          editQualNext = editQualNext + 1;
                          ctr = 0;
                          i = 1;
                         
                          while(ifGet == false){
                              while(ifFind == false){
                                  if(i <= countHold.length){
                                      if(i == countHold[ctr]){
                                        ifFind = true;
                                      }
                                      else{
                                        if(ctr < countHold.length - 1){
                                          ctr++;
                                        }
                                        else{
                                          ifFind = true;
                                          ifGet = true;
                                          editQualNext = i;
                                        }
                                      }
                                  }
                                  else{
                                    ifFind = true;
                                    ifGet = true;
                                    editQualNext = i;
                                  }
                              }
                                  ctr = 0;
                                  ifFind = false;
                                  i++;
                          }
                          
                          addField = EditFieldQual('edit_job_qual', editQualNext, editQualPrev);
                          newIn = addField.newIn;
                          removeBtn = addField.removeBtn;
                          $(addto).after(newIn);
                          $(addRemove).after(removeBtn);
                          $("#edit_job_qual" + editQualNext).attr('data-source',$(addto).attr('data-source'));
                          $("#edit_job_qualid").val($("#edit_job_qualid").val() + editQualNext); 
                          editQualPrev = editQualNext;
                        }
                        else{
                          $("#error-edit-select-consume").show().delay(5000).fadeOut();
                        }
                      }
                      else{
                        $("#error-edit-select-fill").show().delay(5000).fadeOut();
                      }
                    }
                    else{
                        $("#error-edit-select-option").show().delay(5000).fadeOut();
                    }
                    
                      $('.remove-me').click(function(e){
                            e.preventDefault();
                            fieldNum = this.id.charAt(this.id.length-1);
                            fieldID = "#edit_job_qual" + fieldNum;
                            valHold = "";
                            countHold = $("#edit_job_qualid").val(); 
                            ifLast = false;
                            while(ifLast==false){
                              for(var i=0;i<countHold.length;i++){
                                if(i + 1 == countHold.length){
                                    if(countHold[i] != fieldNum){
                                        valHold += countHold[i];
                                    }
                                  ifLast = true;
                                }
                                else{
                                  if(countHold[i] != fieldNum){
                                      valHold += countHold[i];
                                  }
                                }
                              }
                            }
                            $("#edit_job_qualid").val(valHold);
                            $(this).remove();
                            $(fieldID).remove();
                            CheckSelectValQual();
                            qualEndSelect = false;
                        });
                       return false;

                });
                        $('.remove-me2').click(function(e){
                            e.preventDefault();
                            fieldNum = this.id.charAt(this.id.length-1);
                            fieldID = "#edit_job_qual" + fieldNum;
                            valHold = "";
                            countHold = $("#edit_job_qualid").val(); 
                            ifLast = false;
                            while(ifLast==false){
                              for(var i=0;i<countHold.length;i++){
                                if(i + 1 == countHold.length){
                                    if(countHold[i] != fieldNum){
                                        valHold += countHold[i];
                                    }
                                  ifLast = true;
                                }
                                else{
                                  if(countHold[i] != fieldNum){
                                      valHold += countHold[i];
                                  }
                                }
                              }
                            }
                            $("#edit_job_qualid").val(valHold);
                            $(this).remove();
                            $(fieldID).remove();
                            SelectValQual("edit_job_qual");
                            qualEndSelect = false;
                        });



                var addSkillNext = 1;
                var addSkillPrev = 1;
                $("#new_job_skill_btn").click(function(e){
                    e.preventDefault();
                    countHold = $("#new_job_skillid").val(); 
                    ifGet = false;
                    ifFind = false;
                 
                    if(!skillEndSelect){
                      if($('#new_job_skill' + addSkillPrev).val()){
                        if(countHold.length < 9){
                          addto = "#new_job_skill" + addSkillPrev;
                          addRemove = "#new_job_skill" + addSkillPrev;
                          addSkillNext = addSkillNext + 1;
                          ctr = 0;
                          i = 1;
                         
                          while(ifGet == false){
                              while(ifFind == false){
                                  if(i <= countHold.length){
                                      if(i == countHold[ctr]){
                                        ifFind = true;
                                      }
                                      else{
                                        if(ctr < countHold.length - 1){
                                          ctr++;
                                        }
                                        else{
                                          ifFind = true;
                                          ifGet = true;
                                          addSkillNext = i;
                                        }
                                      }
                                  }
                                  else{
                                    ifFind = true;
                                    ifGet = true;
                                    addSkillNext = i;
                                  }
                              }
                                  ctr = 0;
                                  ifFind = false;
                                  i++;
                          }
                       
                          addField = FieldSkill('new_job_skill', addSkillNext, addSkillPrev);
                          newIn = addField.newIn;
                          removeBtn = addField.removeBtn;
                          $(addto).after(newIn);
                          $(addRemove).after(removeBtn);
                          $("#new_job_skill" + addSkillNext).attr('data-source',$(addto).attr('data-source'));
                          $("#new_job_skillid").val($("#new_job_skillid").val() + addSkillNext); 
                          addSkillPrev = addSkillNext;
                        }
                        else{
                          $("#error-add-select-consume").show().delay(5000).fadeOut();
                        }
                      }
                      else{
                        $("#error-add-select-fill").show().delay(5000).fadeOut();
                      }
                    }
                    else{
                        $("#error-add-select-option").show().delay(5000).fadeOut();
                    }
                    
                        $('.remove-me').click(function(e){
                            e.preventDefault();
                            fieldNum = this.id.charAt(this.id.length-1);
                            fieldID = "#new_job_skill" + fieldNum;
                            valHold = "";
                            countHold = $("#new_job_skillid").val(); 
                            ifLast = false;
                            while(ifLast==false){
                              for(var i=0;i<countHold.length;i++){
                                if(i + 1 == countHold.length){
                                    if(countHold[i] != fieldNum){
                                        valHold += countHold[i];
                                    }
                                  ifLast = true;
                                }
                                else{
                                  if(countHold[i] != fieldNum){
                                      valHold += countHold[i];
                                  }
                                }
                              }
                            }
                            $("#new_job_skillid").val(valHold);
                            $(this).remove();
                            $(fieldID).remove();
                            SelectValSkill("new_job_skill");
                            skillEndSelect = false;
                        });

                });

});              
              var reqValues = "";
              var qualValues = "";
              var skillValues = "";
              function FieldReq(fieldid, counter, previous){
                  return {newIn: "<select autocomplete = 'off' class = 'form-control' id='"+ fieldid + counter + "' name = '"+ fieldid + counter + "' onchange = 'SelectValReq(this.id)' required><option value = '' selected disabled>-----Select Default Job Requirement-----</option>" + reqValues + "</select>", removeBtn: '<button id="'+ fieldid + '_remove' +(previous) +'" style="position:relative;left:100%;top:-35px;" class="btn btn-danger remove-me" ><span class="glyphicon glyphicon-minus"></span></button></div></div><div id="field">'};
              }
              function FieldQual(fieldid, counter, previous){
                  return {newIn: "<select autocomplete = 'off' class = 'form-control' id='"+ fieldid + counter + "' name = '"+ fieldid + counter + "' onchange = 'SelectValQual(this.id)' required><option value = '' selected disabled>-----Select Default Job Qualification-----</option>" + qualValues + "</select>", removeBtn: '<button id="'+ fieldid + '_remove' +(previous) +'" style="position:relative;left:100%;top:-35px;" class="btn btn-danger remove-me" ><span class="glyphicon glyphicon-minus"></span></button></div></div><div id="field">'};
              }
              function EditFieldQual(fieldid, counter, previous){
                  return {newIn: "<select autocomplete = 'off' class = 'form-control' id='"+ fieldid + counter + "' name = '"+ fieldid + counter + "' onchange = 'CheckSelectValQual()' required><option value = '' selected disabled>-----Select Default Job Qualification-----</option>" + qualValues + "</select>", removeBtn: '<button id="'+ fieldid + '_remove' +(previous) +'" style="position:relative;left:100%;top:-35px;" class="btn btn-danger remove-me" ><span class="glyphicon glyphicon-minus"></span></button></div></div><div id="field">'};
              }
              function FieldSkill(fieldid, counter, previous){
                  return {newIn: "<select autocomplete = 'off' class = 'form-control' id='"+ fieldid + counter + "' name = '"+ fieldid + counter + "' onchange = 'SelectValSkill(this.id)' required><option value = '' selected disabled>-----Select Default Job Skill-----</option>" + skillValues + "</select>", removeBtn: '<button id="'+ fieldid + '_remove' +(previous) +'" style="position:relative;left:100%;top:-35px;" class="btn btn-danger remove-me" ><span class="glyphicon glyphicon-minus"></span></button></div></div><div id="field">'};
              }
              function valueTransfer(strId, strField){
                var transferedVal = '';

                  for(var ctr = 0;ctr < strId.length; ctr++){
                      transferedVal += $(strField + strId[ctr]).val();
                  }
                  return transferedVal;
              }

              function SelectValReq(selectReqID){
                  if(selectReqID[0] == 'n'){
                    var dropVal = valueTransfer($('#new_job_reqid').val(), '#new_job_req');
                  }
                  else{
                    dropVal = valueTransfer($('#edit_job_reqid').val(), '#edit_job_req');
                  }
                  

                  var dataString = "id=" + dropVal + "&";
                      dataString += "table=" + 'requirement' + "&";
                      dataString += "columnid=" + 'RequirementID';
                   
                    $.ajax({
                        type: "POST",
                        url: "add_job_select.php",
                        data: dataString,
                        cache: false,
                        success: function(response){
                          if(response.trim() == ""){
                            reqEndSelect = true;
                          }
                          else{
                            reqEndSelect = false;
                            $('#' + selectReqID).find('option:not(:selected)').remove();
                            reqValues = response;
                          }
                        }
                    });
              };

              function SelectValQual(selectQualID){
                if(selectQualID[0] == 'n'){
                  dropVal = valueTransfer($('#new_job_qualid').val(), '#new_job_qual');
                }
                else{
                  dropVal = valueTransfer($('#edit_job_qualid').val(), '#edit_job_qual');
                }
                  

                  var dataString = "id=" + dropVal + "&";
                      dataString += "table=" + 'qualification' + "&";
                      dataString += "columnid=" + 'QualificationID';
                   
                    $.ajax({
                        type: "POST",
                        url: "add_job_select.php",
                        data: dataString,
                        cache: false,
                        success: function(response){
                          if(response.trim() == ""){
                            qualEndSelect = true;
                          }
                          else{
                            qualEndSelect = false;
                            $('#' + selectQualID).find('option:not(:selected)').remove();
                            qualValues = response;

                          }
                        }
                    });
                     return false;
              };

              function CheckSelectValQual(){
                  dropVal = valueTransfer($('#edit_job_qualid').val(), '#edit_job_qual');
           
                  var dataString = "id=" + dropVal + "&";
                      dataString += "table=" + 'qualification' + "&";
                      dataString += "columnid=" + 'QualificationID';
                   
                    $.ajax({
                        type: "POST",
                        url: "add_job_select.php",
                        data: dataString,
                        cache: false,
                        success: function(response){
                       
                          if(response.trim() == ""){
                            qualEndSelect = true;
                          }
                          else{
                            qualEndSelect = false;
                            $('#' + selectQualID).find('option:not(:selected)').remove();
                            qualValues = response;

                          }
                        }
                    });
                     return false;
              };

              function SelectValSkill(selectSkillID){
                  if(selectSkillID[0] == 'n'){
                    dropVal = valueTransfer($('#new_job_skillid').val(), '#new_job_skill');
                  }
                  else{
                    dropVal = valueTransfer($('#edit_job_skillid').val(), '#edit_job_skill');
                  }
                  
              
                  var dataString = "id=" + dropVal + "&";
                      dataString += "table=" + 'skill' + "&";
                      dataString += "columnid=" + 'SkillID';
                   
                    $.ajax({
                        type: "POST",
                        url: "add_job_select.php",
                        data: dataString,
                        cache: false,
                        success: function(response){
                          if(response.trim() == ""){
                            skillEndSelect = true;
                          }
                          else{
                            skillEndSelect = false;
                            $('#' + selectSkillID).find('option:not(:selected)').remove();
                            skillValues = response;
                          }
                        }
                    });
              };