<head>
    <link href="../bootstrap1/css/bootstrap-switch.css" rel="stylesheet">
    <script src="../bootstrap1/js/bootstrap-switch-highlight.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch.js"></script>
    <script src="../bootstrap1/js/bootstrap-switch-main.js"></script>
</head>

<script>
		$(function() {
		$('#table_benefit').dataTable({
        "columns": [
        null,
        { "width": "65%" },
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

     var  dataString = "cid=" + id + "&";
          dataString += "state=" + value + "&";
          dataString += "columnId=" + "BenefitID" + "&";
          dataString += "columnState=" + "Status" + "&";
          dataString += "table=" + "benefit";

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

		});
</script>


<table class = "table table-hovered display" id = "table_benefit">
                                <thead>
                                  <tr>
                                    <th><center>State</center></th>
                                    <th><center>Benefit Name</center></th>
                                    <th><center>Action</center></th>
                                  </tr> 
                                </thead>
                                <tbody>

<?php
	session_start();
	include "../php/dbconnect.php";

	if(isset($_POST['id'])){
		
		$benId = mysql_real_escape_string($_POST['id']);
		$benName = strtolower(mysql_real_escape_string($_POST['benname']));


    $check = mysql_query("SELECT * from `benefit` where Name = '$benName'");
    $row = mysql_num_rows($check);

    if($row >= 1){
       
          while($res = mysql_fetch_assoc($check)){
            $benId = $res['BenefitID'];
            $benState = $res['Status'];
            
              if($benState == 3){
                $query1 = mysql_query("Update `benefit` Set Status = 1 WHERE BenefitID = $benId;");
                ?>
                  <div>
                      <script>
                        $(function(){
                           $("#success-edit-record").show().delay(5000).fadeOut();
                        });
                      </script>
                  </div>
                <?php
              }
              else{
                    ?>
                      <div>
                          <script>
                              $(function(){
                                  $(document).ready(function(){
                                   $("#error-exist").show().delay(5000).fadeOut();
                                  });
                              });
                          </script>
                      </div>
                    <?php
              }
        }
    }
    else{
        $query1 = mysql_query("Update `benefit` Set Name = '$benName' WHERE BenefitID = $benId;");
        ?>
          <div>
              <script>
                  $(function(){
                      $("#success-edit-record").show().delay(5000).fadeOut();
                 });
              </script>
          </div>
        <?php
    }
	
		$query2 = mysql_query("SELECT * from benefit where Status != 3");
                                    if ($query2 == FALSE){
                                      die ("Error Program: " . mysql_error());
                                    }

                                    while($res = mysql_fetch_assoc($query2)){
                                        $benID = $res['BenefitID'];
                                        $benName = ucwords($res['Name']);
                                        $benState = $res['Status'];

                                      if($benState == 0){
                                          $strstat = "Active";
                                        ?>
                                            <div>
                                                <script>
                                                  $(function(){
                                                      $(document).ready(function(){
                                                        $('input[name=edit_checkbox_<?php echo $benID;?>]').bootstrapSwitch('state', true, true);
                                                      });
                                                  });
                                                </script>
                                            </div>
                                         <?php
                                      }
                                      else if($benState == 1){
                                          $strstat = "Inactive";
                                      }


?>

<tr>
                                          <td>
                                            <center>
                                              <?php echo "<div id='changeState_$benID'>
                                                              $strstat
                                                            </div>"; 
                                              ?>
                                              <?php echo "<input type = 'hidden' id = 'changeid_ben_$benID' value = '$benID'>"; ?>
                                            </center>
                                          </td>
                                          <td>
                                            <center>
                                              <font style="font-size:20px;"><?php echo "$benName"; ?></font>
                                              <?php echo "<input type = 'hidden' id = 'changename_ben_$benID' value = \"$benName\">"; ?>
                                            </center>
                                          </td>
                                          
                                          <td>
                                             <center>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-success' id = 'ben_$benID' onclick = 'ChangeBenefit(this.id);' title='Edit'>
                                                  <span class = 'glyphicon glyphicon-edit' ></span></button>"; 
                                              ?>
                                              <?php 
                                                  echo "<input id='switch-state' name='edit_checkbox_$benID' type='checkbox' value='$benID' >";
                                              ?>
                                               <?php 
                                                  echo "<button class = 'btn btn-raised btn-danger' id = 'ben_$benID' onclick = 'DeleteBenefit(this.id);' title='Delete'>
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
<?php
	}
?>